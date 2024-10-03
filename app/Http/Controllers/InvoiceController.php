<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Services\QuickBookService;
use Illuminate\Support\Facades\DB;
use PDF;

class InvoiceController extends Controller
{
    protected $quickBooksService;

    public function __construct(QuickBookService $quickBooksService)
    {
        $this->quickBooksService = $quickBooksService;
    }

    public function quickbookInvoices()
    {
        $result = $this->quickBooksService->fetchInvoices();
        return redirect()->route('invoices')->with('result', $result);
    }

    public function index()
    {
        // $data['invoices'] = Invoice::with('items', 'customer')->get();
        $data['invoices'] = $this->quickBooksService->allInvoices();
        $data['customers'] = $this->quickBooksService->allCustomers();
        // @dd($data['invoices'][0]);
        return view('admin.invoices', $data);
    }

    public function add($customer = null)
    {
        // $data['customers'] = Customer::with('address')->get();
        // $data['products'] = Product::all();
        $data['customers'] = $this->quickBooksService->allCustomers();
        $data['products'] = $this->quickBooksService->allProducts();
        $data['customer'] = $this->quickBooksService->editCustomer($customer);
        $data['customerProducts'] = CustomerProduct::all();
        return view('admin.add_invoice', $data);
    }
    public function edit($invoice)
    {
        $invoice = $this->quickBooksService->editInvoice($invoice);
        $customers = $this->quickBooksService->allCustomers();
        $products = $this->quickBooksService->allProducts();
        if ($invoice) {
            $data['invoice'] = $invoice;
            $data['customers'] = $customers;
            $data['allProducts'] = $products;
            return view('admin.edit_invoice', $data);
        } else {
            return redirect()->back()
                ->with('error', 'Invoice details not found.');
        }
    }

    public function show($invoice)
    {
        // $data['invoice'] = Invoice::with('customer', 'items')->find($invoice);
        $data['invoice'] = $this->quickBooksService->editInvoice($invoice);
        $data['customer'] = $this->quickBooksService->editcustomer($data['invoice']->CustomerRef);
        $data['products'] = Product::all();
        $data['company'] = Company::first();
        return view('admin.show_invoice', $data);
    }
    public function download($invoice)
    {
        // @dd($invoice);

        // $data['invoice'] = Invoice::with('customer', 'items')->find($invoice);
        $data['invoice'] = $this->quickBooksService->editInvoice($invoice);
        $data['customer'] = $this->quickBooksService->editcustomer($data['invoice']->CustomerRef);
        $data['products'] = Product::all();
        $data['company'] = Company::first();

        $pdf = PDF::loadView('admin.download_invoice', $data);
        $fileName = 'invoice-' .  $data['invoice']->DocNumber . '.pdf';

        return $pdf->download($fileName);
        // return view('admin.download_invoice', $data);
    }
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            // Validate required fields, making shipping fields optional
            $request->validate([
                'invoice_number' => 'required',
                'customer_id' => 'required',
                'products' => 'required|array',
                'products.*.id' => 'required',
                'products.*.quantity' => 'required',
                'products.*.price' => 'required',
                'products.*.amount' => 'required',
                // Shipping details validation is now optional
                'shipping_address' => 'nullable|string|max:255',
                'shipping_city' => 'nullable|string|max:255',
                'shipping_province' => 'nullable|string|max:255',
                'shipping_country' => 'nullable|string|max:255',
            ]);


            $result = $this->quickBooksService->processInvoiceData($request->all());
            if ($result) {
                DB::commit();
                return redirect()->route('invoices')->with('success', 'Invoice created Successfully!');
            }
            return redirect()->route('invoices')->with('error', 'Failed to create invoice.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('invoices')->with('error', 'Failed to create invoice.');
        }
    }

    public function update(Request $request, $invoice)
    {
        DB::beginTransaction();
        try {
            // Validate request data
            $request->validate([
                'invoice_number' => 'nullable',
                'customer_id' => 'nullable',
                'products' => 'nullable|array',
                'products.*.id' => 'nullable',
                'products.*.quantity' => 'nullable|integer|min:1',
                'products.*.price' => 'nullable|numeric',
                'products.*.amount' => 'nullable|numeric',
                'shipping_address' => 'nullable|string|max:255',
                'shipping_city' => 'nullable|string|max:255',
                'shipping_province' => 'nullable|string|max:255',
                'shipping_country' => 'nullable|string|max:255',
            ]);

            // // Handle shipping information if present
            // if ($request->filled(['shipping_address', 'shipping_city', 'shipping_province', 'shipping_country'])) {
            //     $shipping = $invoice->shipping;
            //     if ($shipping) {
            //         // Update existing shipping information
            //         $shipping->update([
            //             'address' => $request->shipping_address,
            //             'city' => $request->shipping_city,
            //             'province' => $request->shipping_province,
            //             'country' => $request->shipping_country,
            //         ]);
            //     } else {
            //         // Create new shipping record if not exists
            //         $shipping = Shipping::create([
            //             'address' => $request->shipping_address,
            //             'city' => $request->shipping_city,
            //             'province' => $request->shipping_province,
            //             'country' => $request->shipping_country,
            //             'customer_id' => $request->customer_id,
            //         ]);
            //     }

            //     // Assign the shipping ID to the invoice
            //     $invoice->update(['shipping_id' => $shipping->id]);
            // } else {
            //     // If no shipping information provided, clear the shipping_id on the invoice
            //     $invoice->update(['shipping_id' => null]);
            // }

            // // Update invoice details
            // $invoice->update([
            //     'customer_id' => $request->customer_id,
            //     'invoice_number' => $request->invoice_number,
            //     'sub_total' => $request->invoice_subtotal,
            //     'tax' => $request->invoice_tax,
            //     'total' => $request->invoice_grand_total,
            //     'description' => $request->invoice_description ?? '',
            // ]);

            // // Handle invoice items
            // $existingItems = $invoice->items->keyBy('product_id');
            // $updatedItems = collect($request->products)->keyBy('id');

            // // Delete items that are no longer in the updated request
            // $itemsToDelete = $existingItems->diffKeys($updatedItems);
            // foreach ($itemsToDelete as $item) {
            //     $item->delete();
            // }

            // // Update or create invoice items
            // foreach ($request->products as $productData) {
            //     $item = $existingItems->get($productData['id']);
            //     if ($item) {
            //         // Update existing item
            //         $item->update([
            //             'quantity' => $productData['quantity'],
            //             'unit_price' => $productData['price'],
            //             'sub_total' => $productData['amount'],
            //             'total' => $productData['amount'],
            //         ]);
            //     } else {
            //         // Create new item
            //         InvoiceItem::create([
            //             'quantity' => $productData['quantity'],
            //             'unit_price' => $productData['price'],
            //             'sub_total' => $productData['amount'],
            //             'total' => $productData['amount'],
            //             'invoice_id' => $invoice->id,
            //             'product_id' => $productData['id'],
            //         ]);
            //     }
            // }


            $result = $this->quickBooksService->processInvoiceData($request->all());
            if ($result) {
                DB::commit();
                return redirect()->route('invoices')->with('success', 'Invoice Updated Successfully!');
            }
            // return redirect()->route('invoices')->with('error', 'Failed to Update invoice.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            return redirect()->route('invoices')->with('error', 'Failed to update invoice.');
        }
    }




    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back()->with('success', 'Invoice deleted Successfully.');
    }
     public function drafts()
    {
        $data['invoices'] = Invoice::with('items')->get();
        $data['products'] = $this->quickBooksService->allProducts();
        $data['customers'] = $this->quickBooksService->allCustomers();
        // @dd($data['invoices'][0]);
        return view('admin.drafts', $data);
    }
    public function editDraft($invoice)
    {
        $invoice = Invoice::where('id', $invoice)->with('items')->first();
        $customers = $this->quickBooksService->allCustomers();
        $products = $this->quickBooksService->allProducts();
        if ($invoice) {
            $data['invoice'] = $invoice;
            $data['customers'] = $customers;
            $data['allProducts'] = $products;
            return view('admin.edit_draft', $data);
        } else {
            return redirect()->back()
                ->with('error', 'Drafts details not found.');
        }
    }
    public function storeDraft(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'invoice_number' => 'required',
                'customer_id' => 'required',
                'products' => 'required|array',
                'products.*.id' => 'required',
                'products.*.quantity' => 'required',
                'products.*.price' => 'required',
                'products.*.amount' => 'required',
                // Shipping details validation is now optional
                'shipping_address' => 'nullable|string|max:255',
                'shipping_city' => 'nullable|string|max:255',
                'shipping_country' => 'nullable|string|max:255',
            ]);


            $invoice = Invoice::updateOrCreate(
                ['id' => $request->invoice_id],
                [
                    'invoice_number' => $request->invoice_number,
                    'customer_id' => $request->customer_id,
                    'shipping_address' => $request->shipping_address,
                    'shipping_city' => $request->shipping_city,
                    'shipping_country' => $request->shipping_country,
                    'sub_total' => $request->invoice_subtotal,
                    'tax' => $request->invoice_tax,
                    'total' => $request->invoice_grand_total,
                    'description' => $request->invoice_description,
                ]
            );

            foreach ($request->products as $productData) {
                InvoiceItem::updateOrCreate(
                    [
                        'invoice_id' => $invoice->id,
                        'product_id' => $productData['id']
                    ],
                    [
                        'quantity' => $productData['quantity'],
                        'unit_price' => $productData['price'],
                        'sub_total' => $productData['amount'],
                        'total' => $productData['amount'],
                    ]
                );
            }

            DB::commit();
            return redirect()->route('drafts')->with('success', 'Invoice save as draft Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('drafts')->with('error', 'Failed to add in draft.' . $e->getMessage());
        }
    }
    public function deleteDraft($id)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->items()->delete(); 
            $invoice->delete();

            DB::commit();
            return redirect()->route('drafts')->with('success', 'Draft clear successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('drafts')->with('error', 'Failed to delete draft. ' . $e->getMessage());
        }
    }
}
