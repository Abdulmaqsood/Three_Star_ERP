<?php

try {

    // Check if invoice already exists in QuickBooks
    $existingInvoiceQuery = $this->dataService->Query("SELECT * FROM Invoice");
    $existingInvoice = $existingInvoiceQuery ? reset($existingInvoiceQuery) : null;

    if (empty($existingInvoice)) {
        $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
        // Add the invoice to QuickBooks
        $result = $this->dataService->Add($qboInvoiceObject);
        if ($result) {
            // Update Laravel product record with QuickBooks ID
            $invoice->id = $result->Id;
            $invoice->save();

            $successCount++;
        } else {
            $error = $this->dataService->getLastError();
            $errors[] = "Error adding Invoice {$invoice->invoice_number}: {$error->getResponseBody()}";
            Log::error("Error adding product {$invoice->invoice_number}: {$error->getResponseBody()}");
        }
    } else {
        $existingInvoice = reset($existingInvoice);
        // @dd($existingInvoice->CustomerRef);
        // Check if the associated customer is inactive
        $customer = $this->dataService->FindById('Customer', $existingInvoice->CustomerRef);
        if ($customer && !$customer->Active) {
            $errors[] = "Customer {$invoice->customer->id} is inactive in QuickBooks.";
            Log::error("Customer {$invoice->customer->idname} is inactive in QuickBooks.");
            continue;
        }
    
        $quickBooksInvoice['Id'] = $existingInvoice->Id;
        $quickBooksInvoice['SyncToken'] = $existingInvoice->SyncToken;
    
        $qboInvoiceObject = QBOInvoice::create($quickBooksInvoice);
        // @dd($qboInvoiceObject);
        // Update the invoice in QuickBooks
        $result = $this->dataService->Update($qboInvoiceObject);
    }
    
    if ($result) {
        $successCount++;
    } else {
        $error = $this->dataService->getLastError();
        $errors[] = "Error adding invoice {$invoice->id}: {$error->getResponseBody()}";
        Log::error("Error adding invoice {$invoice->id}: {$error->getResponseBody()}");
    }
    } catch (\Exception $e) {
    $errors[] = "Exception adding invoice {$invoice->id}: {$e->getMessage()}";
    Log::error("Exception adding invoice {$invoice->id}: {$e->getMessage()}");
    }





    try {
        $productName = addslashes($product->name);

        // Check if the product already exists in QuickBooks
        $existingProductQuery = $this->dataService->Query("SELECT * FROM Item WHERE Id = '{$product->id}'");
        $existingProduct = $existingProductQuery ? reset($existingProductQuery) : null;
        if (empty($existingProduct)) {
            // Product does not exist in QuickBooks, create a new one
            $qboProductObject = QBOProduct::create($quickBooksProduct);

            // Add the product to QuickBooks
            $result = $this->dataService->Add($qboProductObject);
            
            if ($result) {
                // Update Laravel product record with QuickBooks ID
                $product->id = $result->Id;
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
?>