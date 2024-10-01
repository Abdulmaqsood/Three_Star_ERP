<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Manufacturer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Services\QuickBookService;


class CustomerController extends Controller
{
    protected $quickBooksService;

    public function __construct(QuickBookService $quickBooksService)
    {
        $this->quickBooksService = $quickBooksService;
    }

    public function quickbookCustomers()
    {
        $result = $this->quickBooksService->fetchCustomers();
        return redirect()->route('customers')->with('result', $result);
    }


    public function index()
    {
        // $data['users'] = Customer::with('payment_method')->get();
        $data['products'] =$this->quickBooksService->allProducts();
        $data['users'] = $this->quickBooksService->allCustomers();
        // @dd($data['users']);
        return view('admin.customers', $data);
    }
    public function add()
    {
        // $data['payments'] = PaymentMethod::all();
        $data['payments'] = $this->quickBooksService->allPaymentMethod();
        $data['terms'] = $this->quickBooksService->allTerms();
        return view('admin.add_customer', $data);
    }
    public function show($customer)
    {
        // $data['user'] = $customer;
        $data['user'] = $this->quickBooksService->showCustomer($customer);
        return view('admin.customer_detail', $data);
    }
    public function show_invoices($customer)
    {
       
        $data['invoices'] = $this->quickBooksService->allInvoices();
        $data['customers'] = $this->quickBooksService->allCustomers();
        $data['user'] = $this->quickBooksService->showCustomer($customer);
        $allInvoices = $this->quickBooksService->allInvoices();

        $data['invoices'] = collect($allInvoices)->filter(function ($invoice) use ($customer) {
            return $invoice->CustomerRef == $customer;
        });
        return view('admin.customer_invoices', $data);
    }
    
    public function edit($id)
    {
        
        $customer = $this->quickBooksService->editCustomer($id);
        $paymentMethod = $this->quickBooksService->allPaymentMethod();
        $terms = $this->quickBooksService->allTerms();
        if ($customer) {
            $data['user'] = $customer;
            $data['payments']= $paymentMethod;
            $data['terms']= $terms;
            return view('admin.edit_customer', $data);
        } else {
            return redirect()->back() 
                ->with('error', 'Customer details not found.');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'nullable|integer',
            'term_id' => 'nullable|integer',
            'business_number' => 'nullable',
            'notes' => 'nullable',
            'title' => 'nullable|string|max:16',
            'display_name' => 'required',
            'company_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => ['nullable', 'regex:/^(\+?\d{1,4}[\s.-]?)?(\(?\d{1,4}\)?[\s.-]?)?(\d{1,4}[\s.-]?){1,4}\d{1,9}$/'],
            'mobile_number' => ['nullable', 'regex:/^(\+?\d{1,4}[\s.-]?)?(\(?\d{1,4}\)?[\s.-]?)?(\d{1,4}[\s.-]?){1,4}\d{1,9}$/'],
            'suffix' => 'nullable|max:255',
            'fax' => 'nullable|max:255',
            'other' => 'nullable|max:255',
            'website' => 'nullable|url|max:255',
            'address_1' => 'nullable|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipCode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'shippingAddress_1' => 'nullable|string|max:255',
            'shippingAddress_2' => 'nullable|string|max:255',
            'shippingCity' => 'nullable|string|max:255',
            'shippingState' => 'nullable|string|max:255',
            'shippingZipCode' => 'nullable|string|max:255',
            'shippingCountry' => 'nullable|string|max:255',
        ]);
        // Pass the request data to the service
        $response = $this->quickBooksService->createCustomer($request->all());
        // @dd($response);
        if (isset($response['error'])) {
            // If there was an error, redirect back with the error message
            return redirect()->route('customers')->with('error', $response['error']);
        }

        // If successful, redirect with success message
        return redirect()->route('customers')->with('success', 'Customer Added Successfully.');
    }


    public function update(Request $request, $customer)
    {
        // Validate the request data (use the same validation rules as in the store function)
        $request->validate([
            'payment_method_id' => 'nullable|integer',
            'term_id' => 'nullable|integer',
            'business_number' => 'nullable',
            'notes' => 'nullable',
            'title' => 'nullable|string|max:16',
            'display_name' => 'required',
            'company_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => ['nullable', 'regex:/^(\+?\d{1,4}[\s.-]?)?(\(?\d{1,4}\)?[\s.-]?)?(\d{1,4}[\s.-]?){1,4}\d{1,9}$/'],
            'mobile_number' => ['nullable', 'regex:/^(\+?\d{1,4}[\s.-]?)?(\(?\d{1,4}\)?[\s.-]?)?(\d{1,4}[\s.-]?){1,4}\d{1,9}$/'],
            'suffix' => 'nullable|max:255',
            'fax' => 'nullable|max:255',
            'other' => 'nullable|max:255',
            'website' => 'nullable|url|max:255',
            'address_1' => 'nullable|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipCode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'shippingAddress_1' => 'nullable|string|max:255',
            'shippingAddress_2' => 'nullable|string|max:255',
            'shippingCity' => 'nullable|string|max:255',
            'shippingState' => 'nullable|string|max:255',
            'shippingZipCode' => 'nullable|string|max:255',
            'shippingCountry' => 'nullable|string|max:255',
        ]);
    
        // Update customer in QuickBooks
        $response = $this->quickBooksService->updateCustomer($customer, $request->all());
    
        if (isset($response['error'])) {
            // If there was an error, redirect back with the error message
            return redirect()->route('customers')->with('error', $response['error']);
        }
   
    
        return redirect()->route('customers')->with('success', 'Customer Updated Successfully.');
    }
    

    public function delete(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted Successfully.');
    }


    // CSV File Upload
    public function import(Request $request)
    {
        @dd($request->all());
        $request->validate([
            'file' => 'required|mimes:csv',
        ]);
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        DB::transaction(function () use ($fileContents) {
            foreach ($fileContents as $line) {
                $data = str_getcsv($line);
                //  @dd($data);
                //  $category = SubCategory::where('name', $data['8'])->first();
                $paymentMethodId = $data[8];
                // @dd($data);
                Customer::create([
                    'sku' => $data[0],
                    'name' => $data[1],
                    'type' => $data[2],
                    'price' => $data[3],
                    'cost' => $data[4],
                    'profit' => $data[5],
                    'image' => $data[6],
                ]);
            }
        });


        return redirect()->back()->with('success', 'Products imported successfully!');
    }


    public function export()
    {
        // Fetch all products from the database
        $customers = Customer::all();

        // Define CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="customers.csv"',
        ];
        // Prepare CSV data using PHP's output buffering
        $callback = function () use ($customers) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['id', 'Title', 'First Name', 'Middle Name', 'Last Name', 'Email', 'Suffix', 'Company', 'Display Name', 'Phone #', 'Mobile #', 'Fax', 'Other', 'Website', 'Cheque Print Name', 'Terms', 'Business Number', 'Payment Method', 'created_at', 'updated_at']);

            // Data rows
            foreach ($customers as $customer) {
                $paymentMethod = PaymentMethod::where('id', $customer->payment_method_id)->first();
                $paymentMethodId = $customer->payment_method_id;
                fputcsv($file, [
                    $customer->id,
                    $customer->title,
                    $customer->first_name,
                    $customer->middle_name,
                    $customer->last_name,
                    $customer->email,
                    $customer->suffix,
                    $customer->company,
                    $customer->display_name,
                    $customer->phone_number,
                    $customer->mobile_number,
                    $customer->fax,
                    $customer->other,
                    $customer->website,
                    $customer->cheque_print_name,
                    $customer->terms,
                    $customer->business_number,
                    $paymentMethod ? $paymentMethod->method : $paymentMethodId,
                    Carbon::parse($customer->created_at)->diffForHumans(),
                    Carbon::parse($customer->updated_at)->diffForHumans(),

                ]);
            }

            fclose($file);
        };

        // Return CSV as a streamed response
        return Response::stream($callback, 200, $headers);
    }
}
