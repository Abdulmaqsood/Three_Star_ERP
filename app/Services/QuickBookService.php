<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\QuickBooksToken;
use Illuminate\Support\Facades\Session;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Facades\Invoice as QBOInvoice;
use QuickBooksOnline\API\Facades\Customer as QBOCustomer;
use QuickBooksOnline\API\Facades\Item as QBOProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use QuickBooksOnline\API\Facades\Item;
use stdClass;

class QuickBookService
{
    private $dataService;
    public function __construct()
    {
        $config = config('quickbooks');
        $tokens = QuickBooksToken::first();

        $this->dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $config['client_id'],
            'ClientSecret' => $config['client_secret'],
            'RedirectURI' => $config['redirect_uri'],
            'baseUrl' => $config['base_url'],
            'accessTokenKey' => $tokens ? $tokens->access_token : $config['access_token'],
            'refreshTokenKey' => $tokens ? $tokens->refresh_token : $config['refresh_token'],
            'QBORealmID' => $config['realm_id'],
        ));
        // $this->dataService->throwExceptionOnError(true);

        $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
        try {
            $accessTokenObj = $OAuth2LoginHelper->refreshAccessTokenWithRefreshToken($tokens ? $tokens->refresh_token : $config['refresh_token']);
            $newAccessToken = $accessTokenObj->getAccessToken();
            $newRefreshToken = $accessTokenObj->getRefreshToken();

            $tokens->update([
                'access_token' => $newAccessToken,
                'refresh_token' => $newRefreshToken,
                // 'expires_at' => $expiresAt
            ]);
        } catch (\Exception $e) {
            // Handle the error, possibly re-authenticate the user
            Log::error('Error refreshing QuickBooks token: ' . $e->getMessage());
        }
    }

    public function fetchCustomers()
    {
        $customers = Customer::with('payment_method', 'address')->get();
        $errors = [];
        $successCount = 0;

        foreach ($customers as $customer) {

            $quickBooksCustomer = [
                // "Id" => $customer->id,
                "Title" => $customer->title,
                "BillAddr" => [
                    "Line1" => $customer->address->address_1 ?? '',
                ],
                "ShipAddr" => [
                    "Line1" => $customer->address->address_2 ?? '',
                ],
                "GivenName" => $customer->first_name,
                "MiddleName" => $customer->middle_name,
                "Suffix" => $customer->suffix,
                "CompanyName" => $customer->company,

                "FullyQualifiedName" => $customer->display_name ?? "{$customer->first_name} {$customer->last_name}",
                "DisplayName" => $customer->display_name ?? "{$customer->first_name} {$customer->last_name}",
                "PrintOnCheckName" => $customer->cheque_print_name,
                "BusinessNumber" => $customer->business_number,
                "UserId" => $customer->id,
                "Mobile" => $customer->phone_number ?? '',
                "Fax" => $customer->fax,
                "FamilyName" => $customer->last_name,
                "WebAddr" => $customer->website ?? '',
                "PrimaryEmailAddr" => [
                    "Address" => $customer->email,
                ],
                "PaymentMethodRef" => [
                    "value" => $customer->payment_method_id,
                    "name" => $customer->payment_method->method,
                ],
                "PrimaryPhone" => [
                    "FreeFormNumber" => $customer->phone_number,
                ],
                "Notes" => $customer->description,
            ];

            try {
                // Check if customer already exists in QuickBooks using FullyQualifiedName
                $existingCustomerQuery = $this->dataService->Query("SELECT * FROM Customer WHERE Id = '{$customer->quickbook_id}'");
                $existingCustomer = $existingCustomerQuery ? reset($existingCustomerQuery) : null;

                if (empty($existingCustomer)) {
                    // Customer does not exist in QuickBooks, create a new one
                    $qboCustomerObject = QBOCustomer::create($quickBooksCustomer);

                    // Add the customer to QuickBooks
                    $result = $this->dataService->Add($qboCustomerObject);

                    if ($result) {
                        // Update Laravel customer record with QuickBooks ID
                        $customer->quickbook_id = $result->Id;
                        $customer->save();

                        $successCount++;
                    } else {
                        $error = $this->dataService->getLastError();
                        $errors[] = "Error adding customer {$customer->id}: {$error->getResponseBody()}";
                        Log::error("Error adding customer {$customer->id}: {$error->getResponseBody()}");
                    }
                } else {
                    if ($existingCustomer->Active === false) {
                        $errors[] = "Customer {$customer->id} has been deleted in QuickBooks and cannot be modified.";
                        Log::error("Customer {$customer->id} has been deleted in QuickBooks and cannot be modified.");
                        continue;
                    }

                    // Update the existing customer
                    $quickBooksCustomer['Id'] = $existingCustomer->Id;
                    $quickBooksCustomer['SyncToken'] = $existingCustomer->SyncToken;

                    $qboCustomerObject = QBOCustomer::create($quickBooksCustomer);

                    // Update the customer in QuickBooks
                    $result = $this->dataService->Update($qboCustomerObject);

                    if ($result) {
                        // Update Laravel customer record with QuickBooks ID if not already set
                        // if (!$customer->id) {
                        //     $customer->id = $result->Id;
                        //     $customer->save();
                        // }
                        $successCount++;
                    } else {
                        $error = $this->dataService->getLastError();
                        $errors[] = "Error updating customer {$customer->id}: {$error->getResponseBody()}";

                        Log::error("Error updating customer {$customer->id}: {$error->getResponseBody()}");
                    }
                }
            } catch (\Exception $e) {
                $errors[] = "Exception adding/updating customer {$customer->id}: {$e->getMessage()}";
                Log::error("Exception adding/updating customer {$customer->id}: {$e->getMessage()}");
            }
        }

        if (count($errors) > 0) {
            Session::flash('error', 'Some customers could not be added to QuickBooks. Check the logs for more details.');
        } else {
            Session::flash('success', 'All customers were successfully added to QuickBooks.');
        }

        return [
            'success_count' => $successCount,
            'error_count' => count($errors),
            'errors' => $errors
        ];
    }
    public function fetchProducts()
    {
        // Fetch all products from the Laravel database
        $products = Product::with('category', 'vendor', 'manufacturer')->get();
        $errors = [];
        $successCount = 0;

        foreach ($products as $product) {
            $quickBooksProduct = [
                "Name" => $product->name,
                "UnitPrice" => $product->price,
                "PurchaseCost" => $product->cost,
                "Sku" => $product->sku,
                "FullyQualifiedName" => $product->name,
                "TrackQtyOnHand" => true,
                "Type" => "Inventory",
                "Active" => true,
                "IncomeAccountRef" => [
                    "name" => "Sales of Product Income",
                    "value" => "79"
                ],
                "AssetAccountRef" => [
                    "name" => "Inventory Asset",
                    "value" => "81"
                ],
                "ExpenseAccountRef" => [
                    "name" => "Cost of Goods Sold",
                    "value" => "80"
                ],
                "QtyOnHand" => 0,
                "InvStartDate" => Carbon::now(),
            ];

            try {
                $productName = addslashes($product->name);

                // Check if the product already exists in QuickBooks
                $existingProductQuery = $this->dataService->Query("SELECT * FROM Item WHERE Id = '{$product->quickbook_id}'");
                $existingProduct = $existingProductQuery ? reset($existingProductQuery) : null;
                if (empty($existingProduct)) {
                    // Product does not exist in QuickBooks, create a new one
                    $qboProductObject = QBOProduct::create($quickBooksProduct);

                    // Add the product to QuickBooks
                    $result = $this->dataService->Add($qboProductObject);

                    if ($result) {
                        // Update Laravel product record with QuickBooks ID
                        $product->quickbook_id = $result->Id;
                        $product->save();

                        $successCount++;
                    } else {
                        $error = $this->dataService->getLastError();
                        $errors[] = "Error adding product {$product->id}: {$error->getResponseBody()}";
                        Log::error("Error adding product {$product->id}: {$error->getResponseBody()}");
                    }
                } else {
                    if ($existingProduct->Active === false) {
                        $errors[] = "Product {$product->name} is inactive in QuickBooks.";
                        Log::error("Product {$product->name} is inactive in QuickBooks.");
                        continue;
                    }

                    // Update the existing product
                    $quickBooksProduct['Id'] = $existingProduct->Id;
                    $quickBooksProduct['SyncToken'] = $existingProduct->SyncToken;

                    $qboProductObject = QBOProduct::create($quickBooksProduct);

                    // Update the product in QuickBooks
                    $result = $this->dataService->Update($qboProductObject);

                    if ($result) {
                        // Update Laravel product record with QuickBooks ID if not already set
                        // if (!$product->id) {
                        //     $product->id = $result->Id;
                        //     $product->save();
                        // }
                        $successCount++;
                    } else {
                        $error = $this->dataService->getLastError();
                        $errors[] = "Error updating product {$product->id}: {$error->getResponseBody()}";
                        Log::error("Error updating product {$product->id}: {$error->getResponseBody()}");
                    }
                }
            } catch (\Exception $e) {
                $errors[] = "Exception adding/updating product {$product->id}: {$e->getMessage()}";
                Log::error("Exception adding/updating product {$product->id}: {$e->getMessage()}");
            }
        }

        if (count($errors) > 0) {
            Session::flash('error', 'Some products could not be added to QuickBooks. Check the logs for more details.');
        } else {
            Session::flash('success', 'All products were successfully added to QuickBooks.');
        }

        return [
            'success_count' => $successCount,
            'error_count' => count($errors),
            'errors' => $errors
        ];
    }
    public function fetchInvoices()
    {
        // Fetch all invoices from the Laravel database
        $invoices = Invoice::with('items', 'customer')->get();
        $errors = [];
        $successCount = 0;
        foreach ($invoices as $invoice) {
            $netAmount =  $invoice->sub_total + $invoice->tax;
            $taxPercent =  ($invoice->tax / ($invoice->total - $invoice->tax)) * 100;
            $quickBooksInvoice = [
                // "Id" => $invoice->id,
                "TxnDate" => $invoice->created_at, // Format date properly
                "PrintStatus" => "NeedToPrint",
                "SalesTermRef" => [
                    "value" => "3" // Update with actual SalesTermRef value if available
                ],
                "CustomerRef" => [
                    "value" => $invoice->customer->quickbook_id  // Make sure this matches the QuickBooks customer ID
                ],
                "CustomerMemo" => [
                    "value" => $invoice->customer->title
                ],
                "BillAddr" => [
                    "Line1" => $invoice->customer->address->address_1 ?? '',
                    "Line2" => $invoice->customer->address->address_2 ?? '',
                    "Line3" => $invoice->customer->address->city ?? '',
                    "Line4" => $invoice->customer->address->postal_code ?? '',
                ],
                "ShipAddr" => [
                    "Line1" => $invoice->shipping->address ?? '',
                    "City" => $invoice->shipping->city ?? '',
                    "PostalCode" => $invoice->shipping->province ?? '',
                    "CountrySubDivisionCode" => $invoice->shipping->country ?? '',
                ],
                "DocNumber" => $invoice->invoice_number,
                "DueDate" => $invoice->due_date ? $invoice->due_date : '', // Format date properly
                "PrivateNote" => $invoice->description,
                "TotalAmt" => $invoice->total, // Ensure this is calculated properly
                "ApplyTaxAfterDiscount" => false,
                "Balance" => $invoice->total, // Ensure this is calculated properly
                "BillEmail" => [
                    "Address" => $invoice->customer->email ?? ''
                ],
                "EmailStatus" => "NotSet",

                "Line" => [],
                "TxnTaxDetail" => [
                    // "TxnTaxCodeRef" => [
                    //     "value" => " " // Update with actual tax code
                    // ],
                    "TotalTax" => $invoice->tax, // Ensure this is calculated properly
                    "TaxLine" => [
                        [
                            "DetailType" => "TaxLineDetail",
                            "Amount" => $invoice->tax,
                            "TaxLineDetail" => [
                                "NetAmountTaxable" => $invoice->total, // Ensure this is calculated properly
                                "TaxPercent" => $taxPercent, // Ensure this is calculated properly
                                "TaxRateRef" => [
                                    "value" => "3" // Update with actual tax rate ref
                                ],
                                "PercentBased" => true
                            ]
                        ]
                    ]
                ]
            ];

            foreach ($invoice->items as $item) {
                $products = $this->dataService->Query("SELECT * FROM Item WHERE SKU LIKE '%{$item->product->sku}%'");
                if (empty($products) || !isset($products[0]->Id)) {
                    $errors[] = "Product with SKU {$item->product->sku} not found in QuickBooks.";
                    Log::error("Product with SKU {$item->product->sku} not found in QuickBooks.");
                    continue;
                }
                $product = $products[0];
                $quickBooksInvoice['Line'][] = [
                    "DetailType" => "SalesItemLineDetail",
                    "Amount" => $item->total,
                    "SalesItemLineDetail" => [
                        "Qty" => $item->quantity,
                        "UnitPrice" => $item->unit_price,
                        "ItemRef" => [
                            "name" => $product,
                            "value" => $product->Id // Ensure this matches the QuickBooks item ID
                        ],
                        "TaxCodeRef" => [
                            "value" => "GST" // Update with actual tax code if applicable
                        ]
                    ],
                    "Description" => $item->description,
                ];
            }

            // Add SubTotal line
            $quickBooksInvoice['Line'][] = [
                "DetailType" => "SubTotalLineDetail",
                "Amount" => $invoice->total, // Ensure this is calculated properly
                "SubTotalLineDetail" => []
            ];


            try {

                // Check if invoice already exists in QuickBooks
                $existingInvoice = $this->dataService->Query("SELECT * FROM Invoice WHERE Id = '{$invoice->quickbook_id}'");
                if (empty($existingInvoice)) {
                    $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
                    // Add the invoice to QuickBooks
                    $result = $this->dataService->Add($qboInvoiceObject);
                    if ($result) {
                        // Update Laravel customer record with QuickBooks ID
                        $invoice->quickbook_id = $result->Id;
                        $invoice->save();

                        $successCount++;
                    } else {
                        $error = $this->dataService->getLastError();
                        $errors[] = "Error adding invoice {$invoice->id}: {$error->getResponseBody()}";
                        Log::error("Error adding invoice {$invoice->id}: {$error->getResponseBody()}");
                    }
                } else {
                    $existingInvoice = reset($existingInvoice);
                    // @dd($existingInvoice->CustomerRef);
                    // Check if the associated customer is inactive
                    $customer = $this->dataService->FindById('Customer', $existingInvoice->CustomerRef);
                    if ($customer && !$customer->Active) {
                        $errors[] = "Customer {$invoice->customer->quickbook_id} is inactive in QuickBooks.";
                        Log::error("Customer {$invoice->customer->quickbook_id} is inactive in QuickBooks.");
                        continue;
                    }

                    $quickBooksInvoice['Id'] = $existingInvoice->Id;
                    $quickBooksInvoice['SyncToken'] = $existingInvoice->SyncToken;

                    $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
                    // @dd($qboInvoiceObject);
                    // Update the invoice in QuickBooks
                    $result = $this->dataService->Update($qboInvoiceObject);
                    if ($result) {
                        $successCount++;
                    } else {
                        $error = $this->dataService->getLastError();
                        $errors[] = "Error adding invoice {$invoice->id}: {$error->getResponseBody()}";
                        Log::error("Error adding invoice {$invoice->id}: {$error->getResponseBody()}");
                    }
                }
            } catch (\Exception $e) {
                $errors[] = "Exception adding invoice {$invoice->id}: {$e->getMessage()}";
                Log::error("Exception adding invoice {$invoice->id}: {$e->getMessage()}");
            }
        }



        if (count($errors) > 0) {
            @dd($errors);
            Session::flash('error', 'Some invoices could not be added to QuickBooks. Check the logs for more details.');
        } else {
            Session::flash('success', 'All invoices were successfully added to QuickBooks.');
        }

        return [
            'success_count' => $successCount,
            'error_count' => count($errors),
            'errors' => $errors
        ];
    }

    // Customer Module
    public function allCustomers()
    {
        $customers = $this->dataService->Query("SELECT * FROM Customer");
        return $customers;
    }


    // Product Module 
    public function allProducts()
    {
        $products = $this->dataService->Query("SELECT * FROM Item WHERE Type = 'NONINVENTORY'");
        return $products;
    }
  public function createProduct($data)
{
    
    try {
        // Step 1: Query Income Account (e.g., Sales of Product Income)
        $incomeAccountQuery = $this->dataService->Query("SELECT * FROM Account WHERE AccountType = 'Income' AND Name = 'Sales of Product Income'");
        $incomeAccount = current($incomeAccountQuery);
            $taxCodes = $this->dataService->Query("SELECT * FROM TaxCode");

          foreach ($taxCodes as $taxCode) {
        if ($taxCode->Name === 'HST ON') {
            $taxRef = $taxCode->Id;
        }
    }
        // // Step 2: Query Expense Account (e.g., Cost of Goods Sold)
        // $expenseAccountQuery = $this->dataService->Query("SELECT * FROM Account WHERE AccountType = 'Expense' AND Name = 'Cost of Goods Sold'");
        // $expenseAccount = current($expenseAccountQuery);

        // // Step 3: Ensure the accounts were found and have valid IDs
        // if (!$incomeAccount || !$expenseAccount) {
        //     return ['error' => 'Unable to find the necessary accounts in QuickBooks.'];
        // }

        // Prepare QuickBooks product data with dynamic account references
        $quickBooksProduct = [
            "Name" => $data['name'],
            "UnitPrice" => $data['price'],
            "PurchaseCost" => $data['cost'],
            "Sku" => $data['sku'],
            "FullyQualifiedName" => $data['name'],
            "Type" => "NonInventory", // Ensure the Type is properly capitalized
            "Active" => true,
            "Description" => $data['pack'],
            "IncomeAccountRef" => [
                "name" => $incomeAccount->Name,
                "value" => $incomeAccount->Id,
            ],
            "SalesTaxCodeRef" => [
                "value" => $taxRef,
            ],
            // "ExpenseAccountRef" => [
            //     "name" => $expenseAccount->Name,
            //     "value" => $expenseAccount->Id,
            // ],
            "InvStartDate" => now(), // Format date as a string
        ];

        $qboProductObject = QBOProduct::create($quickBooksProduct);
        // Add the product to QuickBooks
        $quickBooksResult = $this->dataService->Add($qboProductObject);

        if (!$quickBooksResult) {
            // Capture the last error
            $error = $this->dataService->getLastError();
            if ($error) {
                Log::error('QuickBooks Error: ' . $error->getResponseBody());
                return ['error' => 'Failed to create product in QuickBooks: ' . $error->getResponseBody()];
            }
            return ['error' => 'Failed to create product in QuickBooks.'];
        }

        return ['success' => true, 'Id' => $quickBooksResult->Id];
    } catch (\Exception $e) {
        // Log the error (optional)
        Log::error('QuickBooks product creation error: ' . $e->getMessage());
        return ['error' => 'Failed to create product in QuickBooks.'];
    }
}





    // Invoice Module 
    public function allInvoices()
    {
        $invoices = $this->dataService->Query("SELECT * FROM Invoice");
        return $invoices;
    }



    // Terms Fucntion to fetch Terms from Quickbook 
    public function allTerms()
    {
        $terms = $this->dataService->Query("SELECT * FROM Term");
        return $terms;
    }

    // All Payment Methods fetch from quickbook
    public function allPaymentMethod()
    {
        $paymentMethods = $this->dataService->Query("SELECT * FROM PaymentMethod");
        return $paymentMethods;
    }

    public function createPaymentMethod(array $data)
    {
        // Build the payment method data array
        $quickBooksPaymentMethod = [
            "Name" => $data['method'] ?? '',
            "Type" => $data['type'] ?? 'CASH',
            "Active" => isset($data['active']) ? $data['active'] : true,
        ];

        try {
            // Validate that required fields are provided
            if (empty($quickBooksPaymentMethod['Name'])) {
                return ['error' => 'Payment Method data is missing required fields.'];
            }

            $result = $this->dataService->Add($quickBooksPaymentMethod);

            // Check the result
            if (!$result || !$result->Id) {
                return ['error' => 'Payment Method Object Not Valid.'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to create payment method in QuickBooks: ' . $e->getMessage()];
        }
    }






    public function createCustomer(array $data)
    {
        $quickBooksCustomer = [
            "Title" => $data['title'] ?? '',
            "BillAddr" => [
                "Line1" => $data['address_1'] ?? '',
                "Line2" => $data['address_2'] ?? '',
                "City" => $data['city'] ?? '',
                "Country" => $data['country'] ?? '',
                "PostalCode" => $data['zipCode'] ?? '',
            ],
            "ShipAddr" => [
                "Line1" => $data['shippingAddress_1'] ?? ($data['address_1'] ?? ''),
                "Line2" => $data['shippingAddress_2'] ?? ($data['address_2'] ?? ''),
                "City" => $data['shippingCity'] ?? ($data['city'] ?? ''),
                "Country" => $data['shippingCountry'] ?? ($data['country'] ?? ''),
                "PostalCode" => $data['shippingZipCode'] ?? ($data['zipCode'] ?? ''),
            ],
            "GivenName" => $data['first_name'] ?? '',
            "MiddleName" => $data['middle_name'] ?? '',
            "FamilyName" => $data['last_name'] ?? '',
            "Suffix" => $data['suffix'] ?? '',
            "CompanyName" => $data['company_name'] ?? '',
            "FullyQualifiedName" => $data['display_name'] ?? '',
            "DisplayName" => $data['display_name'] ?? '',
            "PrintOnCheckName" => $data['display_name'] ?? '',
            "BusinessNumber" => $data['business_number'] ?? '',
            "PrimaryPhone" => [
                "FreeFormNumber" => $data['phone_number'] ?? '',
            ],
            "Mobile" => [
                "FreeFormNumber" => $data['mobile_number'] ?? '',
            ],
            "Fax" => [
                "FreeFormNumber" => $data['fax'] ?? '',
            ],
            "AlternatePhone" => [
                "FreeFormNumber" => $data['other'] ?? '',
            ],
            "WebAddr" => [
                "URI" => $data['website'] ?? '',
            ],
            "PrimaryEmailAddr" => [
                "Address" => $data['email'] ?? '',
            ],
            "PaymentMethodRef" => [
                "value" => $data['payment_method_id'] ?? '',
                // "name" => $data['payment_method'] ?? '',
            ],
            "SalesTermRef" => [
                "value" => $data['term_id'] ?? '',
                // "name" => $data['term'] ?? '',
            ],
            "Notes" => $data['notes'] ?? '',
            "BusinessNumber" => $data['business_number'] ?? '',
            // "Taxable" => $data['taxable'] ?? 'false',
            // "CurrencyRef" => $data['currency_ref'] ?? 'USD',
        ];
        try {
            if (empty($quickBooksCustomer) || !isset($quickBooksCustomer['DisplayName'])) {
                return ['error' => 'Customer data is missing required fields.'];
            }

            $qboCustomerObject = QBOCustomer::create($quickBooksCustomer);
                            // @dd($qboCustomerObject);

            $result = $this->dataService->Add($qboCustomerObject);

            if (!$result || !$result->Id) {
                return ['error' => 'Customer Object Not Valid.'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to create customer in QuickBooks: ' . $e->getMessage()];
        }
    }
    public function showCustomer($id)
    {
        $query = "SELECT * FROM Customer WHERE Id = '$id'";
        $result = $this->dataService->Query($query);
        if ($result) {
            $customer = $result[0];
            return $customer;
        } else {
            return null;
        }
    }
    public function createVendor(array $data)
    {

        $quickBooksVendor = new \QuickBooksOnline\API\Data\IPPVendor();
        $quickBooksVendor->FullyQualifiedName = $data['name'] ?? '';
        $quickBooksVendor->DisplayName = $data['name'] ?? '';
        $quickBooksVendor->PrimaryPhone = [
            "FreeFormNumber" => $data['phone_number'] ?? '',
        ];
        $quickBooksVendor->PrimaryEmailAddr = [
            "Address" => $data['email'] ?? '',
        ];

        try {
            // if ($quickBooksVendor) {
            //     return ['error' => 'Vendor data is missing required fields.'];
            // }
            $result = $this->dataService->Add($quickBooksVendor);

            if (!$result || !$result->Id) {
                return ['error' => 'Vendor Object Not Valid.'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to create vendor in QuickBooks: ' . $e->getMessage()];
        }
    }

    public function updateCustomer($customerId, array $data)
    {
        try {
            if (!$this->dataService) {
                return ['error' => 'DataService is not initialized.'];
            }

            // Find the existing customer by ID
            $existingCustomer = $this->dataService->FindById('Customer', $customerId);
            if (!$existingCustomer) {
                return ['error' => 'Customer not found in QuickBooks.'];
            }

            // Prepare the customer data for update
            $quickBooksCustomer = [
                // "Id" => $customerId,
                "Title" => $data['title'] ?? $existingCustomer->Title,
                "BillAddr" => [
                    "Line1" => $data['address_1'] ?? ($existingCustomer->BillAddr->Line1 ?? ''),
                    "Line2" => $data['address_2'] ?? ($existingCustomer->BillAddr->Line2 ?? ''),
                    "City" => $data['city'] ?? ($existingCustomer->BillAddr->City ?? ''),
                    "Country" => $data['country'] ?? ($existingCustomer->BillAddr->Country ?? ''),
                    "PostalCode" => $data['zipCode'] ?? ($existingCustomer->BillAddr->PostalCode ?? ''),
                ],
                "ShipAddr" => [
                    "Line1" => $data['shippingAddress_1'] ?? ($data['address_1'] ?? ($existingCustomer->ShipAddr->Line1 ?? '')),
                    "Line2" => $data['shippingAddress_2'] ?? ($data['address_2'] ?? ($existingCustomer->ShipAddr->Line2 ?? '')),
                    "City" => $data['shippingCity'] ?? ($data['city'] ?? ($existingCustomer->ShipAddr->City ?? '')),
                    "Country" => $data['shippingCountry'] ?? ($data['country'] ?? ($existingCustomer->ShipAddr->Country ?? '')),
                    "PostalCode" => $data['shippingZipCode'] ?? ($data['zipCode'] ?? ($existingCustomer->ShipAddr->PostalCode ?? '')),
                ],
                "GivenName" => $data['first_name'] ?? $existingCustomer->GivenName,
                "MiddleName" => $data['middle_name'] ?? $existingCustomer->MiddleName,
                "FamilyName" => $data['last_name'] ?? $existingCustomer->FamilyName,
                "Suffix" => $data['suffix'] ?? $existingCustomer->Suffix,
                "CompanyName" => $data['company_name'] ?? $existingCustomer->CompanyName,
                "FullyQualifiedName" => $data['display_name'] ?? $existingCustomer->FullyQualifiedName,
                "DisplayName" => $data['display_name'] ?? $existingCustomer->DisplayName,
                "PrintOnCheckName" => $data['display_name'] ?? $existingCustomer->PrintOnCheckName,
                "BusinessNumber" => $data['business_number'] ?? $existingCustomer->BusinessNumber,
                "PrimaryPhone" => [
                    "FreeFormNumber" => $data['phone_number'] ?? ($existingCustomer->PrimaryPhone->FreeFormNumber ?? ''),
                ],
                "Mobile" => [
                    "FreeFormNumber" => $data['mobile_number'] ?? ($existingCustomer->Mobile->FreeFormNumber ?? ''),
                ],
                "Fax" => [
                    "FreeFormNumber" => $data['fax'] ?? ($existingCustomer->Fax->FreeFormNumber ?? ''),
                ],
                "AlternatePhone" => [
                    "FreeFormNumber" => $data['other'] ?? ($existingCustomer->AlternatePhone->FreeFormNumber ?? ''),
                ],
                "WebAddr" => [
                    "URI" => $data['website'] ?? ($existingCustomer->WebAddr->URI ?? ''),
                ],
                "PrimaryEmailAddr" => [
                    "Address" => $data['email'] ?? ($existingCustomer->PrimaryEmailAddr->Address ?? ''),
                ],
                "PaymentMethodRef" => [
                    "value" => $data['payment_method_id'] ?? ($existingCustomer->PaymentMethodRef->value ?? '')
                ],
                "SalesTermRef" => [
                    "value" => $data['term_id'] ?? '',
                ],
                "Notes" => $data['notes'] ?? $existingCustomer->Notes,
                // "Taxable" => $data['taxable'] ?? $existingCustomer->Taxable,
                // "CurrencyRef" => [
                //     "value" => $data['currency_ref'] ?? ($existingCustomer->CurrencyRef->value ?? 'USD'),
                // ],
            ];
            // Update the existing customer
            $quickBooksCustomer['Id'] = $existingCustomer->Id;
            $quickBooksCustomer['SyncToken'] = $existingCustomer->SyncToken;
            // Create a QuickBooks customer object
            $qboCustomerObject = QBOCustomer::create($quickBooksCustomer);
            // Send the update request to QuickBooks
            $result = $this->dataService->Update($qboCustomerObject);

            if (!$result || !$result->Id) {
                return ['error' => 'Failed to update customer in QuickBooks.'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to update customer in QuickBooks: ' . $e->getMessage()];
        }
    }

    public function updateProduct($productId, array $data)
    {
        try {
                    $incomeAccountQuery = $this->dataService->Query("SELECT * FROM Account WHERE AccountType = 'Income' AND Name = 'Sales of Product Income'");
        $incomeAccount = current($incomeAccountQuery);
                    $taxCodes = $this->dataService->Query("SELECT * FROM TaxCode");

          foreach ($taxCodes as $taxCode) {
        if ($taxCode->Name === 'HST ON') {
            $taxRef = $taxCode->Id;
        }
    }
            if (!$this->dataService) {
                return ['error' => 'DataService is not initialized.'];
            }

            // Find the existing product by ID
            $existingProduct = $this->dataService->FindById('Item', $productId);
            if (!$existingProduct) {
                return ['error' => 'Product not found in QuickBooks.'];
            }

            $quickBooksProduct = [
                "Name" => $data['name'] ?? $existingProduct->Name,
                "UnitPrice" => $data['price'] ?? $existingProduct->UnitPrice,
                "PurchaseCost" => $data['cost'] ?? $existingProduct->PurchaseCost,
                "Sku" => $data['sku'] ?? $existingProduct->Sku,
                "FullyQualifiedName" => $data['name'] ?? $existingProduct->FullyQualifiedName,
                "Description" => $data['pack'] ?? $existingProduct->Description,
                "Type" => "NonInventory",
                "Active" =>  true,
                "IncomeAccountRef" => [
                    "name" => $incomeAccount->Name,
                    "value" => $incomeAccount->Id
                ],
                "SalesTaxCodeRef" => [
                    "value" => $taxRef,
                ],
                // "AssetAccountRef" => [
                //     "name" => "Inventory Asset",
                //     "value" => "81"
                // ],
                // "ExpenseAccountRef" => [
                //     "name" => "Cost of Goods Sold",
                //     "value" => "80"
                // ],
                // "QtyOnHand" => $data['qty_on_hand'] ?? 0,
                "InvStartDate" => $data['inv_start_date'] ?? now(),
            ];
            $quickBooksProduct['Id'] = $existingProduct->Id;
            $quickBooksProduct['SyncToken'] = $existingProduct->SyncToken;
            // Create a QuickBooks product object
            $qboProductObject = QBOProduct::create($quickBooksProduct);
            // Send the update request to QuickBooks
            $result = $this->dataService->Update($qboProductObject);

            if (!$result) {
                return ['error' => 'Failed to update product in QuickBooks.'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to update product in QuickBooks: ' . $e->getMessage()];
        }
    }



    public function editCustomer($id)
    {
        $query = "SELECT * FROM Customer WHERE Id = '$id'";
        $user = $this->dataService->Query($query);
        if ($user) {
            $customer = $user[0];
            return $customer;
        } else {
            return null;
        }
    }
    public function editInvoice($id)
    {
        $query = "SELECT * FROM Invoice WHERE Id = '$id'";
        $Invoice = $this->dataService->Query($query);
        if ($Invoice) {
            $invoice = $Invoice[0];
            return $invoice;
        } else {
            return null;
        }
    }
    public function editProduct($id)
    {
        try {
            $query = "SELECT * FROM Item WHERE Id = '$id'";
            $product = $this->dataService->Query($query);
            if (!$product) {
                return null;
            }
            return $product[0];
        } catch (\Exception $e) {
            return null;
        }
    }






    public function getAllInvoices()
    {
        $invoices = $this->dataService->Query("SELECT * FROM Invoice");
        return $invoices;
    }
    public function getAllVendors()
    {
        $vendors = $this->dataService->Query("SELECT * FROM Vendor");
        return $vendors;
    }

    // Category Functions
    public function getAllCategories()
    {
        $query = "SELECT * FROM Item WHERE Type = 'Category'";
        $categories = $this->dataService->Query($query);
        return $categories;
    }

    public function createCategory(array $data)
    {
        try {
            // Prepare the category data
            $categoryData = [
                "Name" => $data['name'] ?? '',
                "Type" => "Category",
                "SubItem" => false,
                "FullyQualifiedName" => $data['name'] ?? '',
                "Active" => true
            ];


            $qboCategoryObject = Item::create($categoryData);
            $result = $this->dataService->Add($qboCategoryObject);

            // Check if the creation was successful
            if (!$result || !$result->Id) {
                return ['error' => 'Failed to create category in QuickBooks.'];
            }

            return ['success' => true];
        } catch (\Exception $e) {
            return ['error' => 'Failed to create category in QuickBooks: ' . $e->getMessage()];
        }
    }

    public function editCategory($id)
    {
        $query = "SELECT * FROM Item WHERE Id = '$id' AND Type = 'Category'";
        $result = $this->dataService->Query($query);
        if ($result) {
            $category = $result[0];
            return $category;
        } else {
            return null;
        }
    }
    public function updateCategory($category)
    {
        try {
            // $qboCategoryObject = Item::create($category);
            $result = $this->dataService->Update($category);
            // @dd($result);
            return $result;
        } catch (\Exception $e) {
            throw new \Exception('Failed to update category in QuickBooks: ' . $e->getMessage());
        }
    }

    public function getAllSubCategories()
    {
        $query = "SELECT * FROM Item WHERE Type = 'Category' AND SubItem = true";
        $subcategories = $this->dataService->Query($query);
        return $subcategories;
    }



    public function fetchSpecificProducts($productIds)
    {
        // Convert the array of product IDs into a comma-separated string
        $idsString = implode(',', $productIds);
        // @dd($idsString);

        // Query QuickBooks for products with the specified IDs
        $query = "SELECT * FROM Item WHERE Id IN ($idsString) AND Type = 'NONINVENTORY'";
        $products = $this->dataService->Query($query);

        return $products;
    }



    public function fetchInvoiceProducts($productIds)
    {
        // Convert the array of product IDs into a comma-separated string
        // $idsString = implode(',', $productIds);
        $fetchedProducts = [];

        foreach ($productIds as $id) {
            // Query QuickBooks for the specific product by ID
            $query = "SELECT * FROM Item WHERE Id = '$id' AND Type = 'NONINVENTORY'";
            $product = $this->dataService->Query($query);
            if ($product) {
                $fetchedProducts[] = $product[0];
            }
        }


        // // Loop through QuickBooks products and check if they match the provided IDs
        // foreach ($products as $product) {
        //     if (in_array($product->Id, $productIds)) {
        //         $fetchedProducts[] = $product;
        //     }
        // }

        return $fetchedProducts;
    }




    /// Invoices Manages
    public function processInvoiceData($data)
    {
        try {
            $taxCodes = $this->dataService->Query("SELECT * FROM TaxCode");

          foreach ($taxCodes as $taxCode) {
        if ($taxCode->Name === 'HST ON') {
            $taxRef = $taxCode->Id;
        }
    }

            // Fetch the customer from QuickBooks
            $customer = $this->dataService->FindById('Customer', $data['customer_id']);
            if (!$customer) {
                return ['error' => "Customer with ID {$data['customer_id']} not found in QuickBooks."];
            }

            $taxPercent = ($data['invoice_tax'] / ($data['invoice_grand_total'] - $data['invoice_tax'])) * 100;
            $quickBooksInvoice = [
                "TxnDate" => now()->format('Y-m-d'), // Format the current date
                "PrintStatus" => "NeedToPrint",
                "SalesTermRef" => [
                    "value" => "3" // Set to your actual SalesTermRef value
                ],
                "CustomerRef" => [
                    "value" => $customer->Id // Ensure this matches the QuickBooks customer ID
                ],
                "ShipAddr" => [
                    "Line1" => $data['shipping_address'] ?? '',
                    "City" => $data['shipping_city'] ?? '',
                    "CountrySubDivisionCode" => $data['shipping_province'] ?? '',
                    "Country" => $data['shipping_country'] ?? '',
                ],
                "DocNumber" => $data['invoice_number'],
                "DueDate" => now()->addDays(30), // Set due date 30 days from now
                "PrivateNote" => $data['invoice_description'] ?? '',
                "TotalAmt" => $data['invoice_grand_total'],
                "ApplyTaxAfterDiscount" => false,
                "Balance" => $data['invoice_grand_total'],
                "BillEmail" => [
                    "Address" => $customer->PrimaryEmailAddr->Address ?? ''
                ],
                "EmailStatus" => "NotSet",
                "Line" => [],
                "TxnTaxDetail" => [
                    "TotalTax" => $data['invoice_tax'],
                    // "TaxLine" => [
                    //     [
                    //         "DetailType" => "TaxLineDetail",
                    //         "Amount" => $data['invoice_tax'],
                    //         "TaxLineDetail" => [
                    //             "NetAmountTaxable" => $data['invoice_grand_total'],
                    //             "TaxPercent" => $taxPercent,
                    //             "TaxRateRef" => [
                    //                 "value" => "3" // Replace with actual tax rate ref
                    //             ],
                    //             "PercentBased" => true
                    //         ]
                    //     ]
                    // ]
                ]
            ];

            // Add each product as a line item in the QuickBooks invoice
            foreach ($data['products'] as $item) {
                $products = $this->dataService->Query("SELECT * FROM Item WHERE Id LIKE '%{$item['id']}%'");
                if (empty($products) || !isset($products[0]->Id)) {
                    // throw new \Exception("Product with SKU {$item['id']} not found in QuickBooks.");
                    return ['error' => "Product with SKU {$item['id']} not found in QuickBooks."];
                }
                $product = $products[0];
                $quickBooksInvoice['Line'][] = [
                    "DetailType" => "SalesItemLineDetail",
                    "Amount" => $item['amount'],
                    "SalesItemLineDetail" => [
                        "Qty" => $item['quantity'],
                        "UnitPrice" => $item['price'],
                        "ItemRef" => [
                            "value" => $product->Id // Ensure this matches the QuickBooks item ID
                        ],
                        "TaxCodeRef" => [
                            "value" => $taxRef // Replace with the actual tax code
                        ]
                    ],
                    "Description" => $item['description'] ?? ''
                ];
            }

            $existingInvoice = $this->dataService->Query("SELECT * FROM Invoice WHERE Id = '{$data['invoice_id']}'");

            if (empty($existingInvoice)) {
                // Add the invoice to QuickBooks
                $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
                $result = $this->dataService->Add($qboInvoiceObject);
            } else {
                $existingInvoice = reset($existingInvoice);
                $quickBooksInvoice['Id'] = $existingInvoice->Id;
                $quickBooksInvoice['SyncToken'] = $existingInvoice->SyncToken;
                $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);

                $result = $this->dataService->Update($qboInvoiceObject);
            }

            if ($result) {
                return $result;
            } else {
                $error = $this->dataService->getLastError();
                return ['error' => "Failed to create/update invoice in QuickBooks  {$error->getResponseBody()}"];
            }

        } catch (\Exception $e) {
            Log::error("Error in createInvoiceInQuickBooks: " . $e->getMessage());
            return ['error' => "Failed to create/update invoice in QuickBooks" . $e->getMessage()];
        }
    }

    // private function createInvoiceInQuickBooks($data)
    // {
    //     try {
    //         // Fetch the customer from QuickBooks
    //         $customer = $this->dataService->FindById('Customer', $data['customer_id']);
    //         if (!$customer) {
    //             return ['error' => "Customer with ID {$data['customer_id']} not found in QuickBooks."];
    //         }

    //         $taxPercent = ($data['invoice_tax'] / ($data['invoice_grand_total'] - $data['invoice_tax'])) * 100;
    //         $quickBooksInvoice = [
    //             "TxnDate" => now()->format('Y-m-d'), // Format the current date
    //             "PrintStatus" => "NeedToPrint",
    //             "SalesTermRef" => [
    //                 "value" => "3" // Set to your actual SalesTermRef value
    //             ],
    //             "CustomerRef" => [
    //                 "value" => $customer->Id // Ensure this matches the QuickBooks customer ID
    //             ],
    //             "ShipAddr" => [
    //                 "Line1" => $data['shipping_address'] ?? '',
    //                 "City" => $data['shipping_city'] ?? '',
    //                 "CountrySubDivisionCode" => $data['shipping_province'] ?? '',
    //                 "Country" => $data['shipping_country'] ?? '',
    //             ],
    //             "DocNumber" => $data['invoice_number'],
    //             "DueDate" => now()->addDays(30), // Set due date 30 days from now
    //             "PrivateNote" => $data['invoice_description'] ?? '',
    //             "TotalAmt" => $data['invoice_grand_total'],
    //             "ApplyTaxAfterDiscount" => false,
    //             "Balance" => $data['invoice_grand_total'],
    //             "BillEmail" => [
    //                 "Address" => $customer->PrimaryEmailAddr->Address ?? ''
    //             ],
    //             "EmailStatus" => "NotSet",
    //             "Line" => [],
    //             "TxnTaxDetail" => [
    //                 "TotalTax" => $data['invoice_tax'],
    //                 "TaxLine" => [
    //                     [
    //                         "DetailType" => "TaxLineDetail",
    //                         "Amount" => $data['invoice_tax'],
    //                         "TaxLineDetail" => [
    //                             "NetAmountTaxable" => $data['invoice_grand_total'],
    //                             "TaxPercent" => $taxPercent,
    //                             "TaxRateRef" => [
    //                                 "value" => "3" // Replace with actual tax rate ref
    //                             ],
    //                             "PercentBased" => true
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ];

    //         // Add each product as a line item in the QuickBooks invoice
    //         foreach ($data['products'] as $item) {
    //             $products = $this->dataService->Query("SELECT * FROM Item WHERE SKU LIKE '%{$item['id']}%'");
    //             if (empty($products) || !isset($products[0]->Id)) {
    //                 throw new \Exception("Product with SKU {$item['id']} not found in QuickBooks.");
    //             }

    //             $product = $products[0];
    //             $quickBooksInvoice['Line'][] = [
    //                 "DetailType" => "SalesItemLineDetail",
    //                 "Amount" => $item['amount'],
    //                 "SalesItemLineDetail" => [
    //                     "Qty" => $item['quantity'],
    //                     "UnitPrice" => $item['price'],
    //                     "ItemRef" => [
    //                         "value" => $product->Id // Ensure this matches the QuickBooks item ID
    //                     ],
    //                     "TaxCodeRef" => [
    //                         "value" => "GST" // Replace with the actual tax code
    //                     ]
    //                 ],
    //                 "Description" => $item['description'] ?? ''
    //             ];
    //         }

    //         // Add the subtotal line
    //         $quickBooksInvoice['Line'][] = [
    //             "DetailType" => "SubTotalLineDetail",
    //             "Amount" => $data['invoice_grand_total'],
    //             "SubTotalLineDetail" => []
    //         ];

    //         // Check if the invoice already exists in QuickBooks
    //         $existingInvoice = $this->dataService->Query("SELECT * FROM Invoice WHERE DocNumber = '{$data['invoice_number']}'");
    //         if (empty($existingInvoice)) {
    //             // Add the invoice to QuickBooks
    //             $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
    //             $result = $this->dataService->Add($qboInvoiceObject);
    //         } else {
    //             // Update the existing invoice in QuickBooks
    //             $existingInvoice = reset($existingInvoice);
    //             $quickBooksInvoice['Id'] = $existingInvoice->Id;
    //             $quickBooksInvoice['SyncToken'] = $existingInvoice->SyncToken;
    //             $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
    //             $result = $this->dataService->Update($qboInvoiceObject);
    //         }

    //         if (!$result) {
    //             return ['error' => "Failed to create/update invoice in QuickBooks."];
    //         }

    //         return $result;
    //     } catch (\Exception $e) {
    //         Log::error("Error in createInvoiceInQuickBooks: " . $e->getMessage());
    //         return ['error' => "Failed to create/update invoice in QuickBooks" . $e->getMessage()];
    //     }
    // }

    // private function saveOrUpdateShippingDetails($data)
    // {
    //     try {
    //         // Fetch the customer from QuickBooks using their QuickBooks ID
    //         $customer = $this->dataService->FindById('Customer', $data['customer_id']);

    //         if (!$customer) {
    //             throw new \Exception("Customer with ID {$data['customer_id']} not found in QuickBooks.");
    //         }

    //         // Prepare the shipping details array
    //         $shippingDetails = [
    //             "ShipAddr" => [
    //                 "Line1" => $data['shipping_address'] ?? '',
    //                 "City" => $data['shipping_city'] ?? '',
    //                 "CountrySubDivisionCode" => $data['shipping_province'] ?? '',
    //                 "PostalCode" => $data['shipping_country'] ?? '',
    //             ]
    //         ];

    //         // Check if the customer already has shipping details
    //         if (!empty($customer->ShipAddr)) {
    //             // Update the shipping details
    //             $customer->ShipAddr = $shippingDetails['ShipAddr'];
    //         } else {
    //             // Add new shipping details
    //             $customer->ShipAddr = $shippingDetails['ShipAddr'];
    //         }

    //         // Update the customer in QuickBooks with the new shipping details
    //         $updatedCustomer = $this->dataService->Update($customer);

    //         if (!$updatedCustomer) {
    //             throw new \Exception("Failed to update shipping details for customer ID {$data['customer_id']} in QuickBooks.");
    //         }

    //         return $updatedCustomer;
    //     } catch (\Exception $e) {
    //         Log::error("Error in saveOrUpdateShippingDetails: " . $e->getMessage());
    //         throw $e;
    //     }
    // }

}
