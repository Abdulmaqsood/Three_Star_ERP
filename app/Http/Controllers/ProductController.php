<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Vendor;
use App\Services\QuickBookService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use QuickBooksOnline\API\Facades\Item;
use SplFileObject;


class ProductController extends Controller
{
    protected $quickBooksService;

    public function __construct(QuickBookService $quickBooksService)
    {
        $this->quickBooksService = $quickBooksService;
    }

    public function quickbookProducts()
    {
        $result = $this->quickBooksService->fetchProducts();
        return redirect()->route('products')->with('result', $result);
    }

    // all products
    public function index()
    {
        // $data['products'] = Product::all();
        $data['products'] = $this->quickBooksService->allProducts();
        $data['categories'] = SubCategory::all();

        return view('admin.products', $data);
    }
    public function add()
    {
        $data['categories'] = Category::all();
        $data['sub_categories'] = SubCategory::all();
        $data['vendors'] = Vendor::all();
        $data['manufacturers'] = Manufacturer::all();
        return view('admin.add_product', $data);
    }



    public function store(Request $request)
    {
        // @dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'sku' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'cost' => 'required|string|max:255',
            'profit' => 'required|string|max:255',
            'category_id' => 'required',
        ]);
        // Begin a transaction
        DB::beginTransaction();

        try {
            // Call the service to create the product in QuickBooks
            $result = $this->quickBooksService->createProduct($request->all());

            if (isset($result['error'])) {
                // If QuickBooks creation fails, rollback and return an error
                DB::rollBack();
                return redirect()->route('products')->with('error', $result['error']);
            }

            // If successful, create the product in the local database
            Product::create([
                'quickbook_id' => $result['Id'],
                'sku' => $request->sku,
                'name' => $request->name,
                'type' => "Inventory",
                'price' => $request->price,
                'cost' => $request->cost,
                'profit' => $request->profit,
                'pack' => $request->pack ?? 0,
                'description' => $request->description,
                'category_id' => $request->category_id ?? '',
                'sub_category_id' => $request->sub_category_id ?? null,
                'vendor_id' => $request->vendor_id ?? null,
                'vendor_code' => $request->vendor_code ?? "",
                'manufacturer_code' => $request->manufacturer_code ?? null,
                'manufacturer_id' => $request->manufacturer_id ?? null,
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('products')->with('success', 'Product Created Successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the error (optional)
            Log::error('Failed to create product: ' . $e->getMessage());

            return redirect()->route('products')->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    public function edit($product)
    {
        // Fetch the product details from QuickBooks or your local database
        $product = $this->quickBooksService->editProduct($product);
        
        if ($product) {
            $data['product'] = $product;
            $data['categories'] = Category::all();
            $data['sub_categories'] = SubCategory::all();
            $data['vendors'] = Vendor::all();
            $data['manufacturers'] = Manufacturer::all();
            return view('admin.edit_product', $data);
        } else {
            return redirect()->back()
                ->with('error', 'Product details not found.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'sku' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'cost' => 'required|string|max:255',
            'profit' => 'required|string|max:255',
            'category_id' => 'required',
            'pack' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sub_category_id' => 'nullable|integer',
            'vendor_id' => 'nullable|integer',
            'vendor_code' => 'nullable|string|max:255',
            'manufacturer_code' => 'nullable|string|max:255',
            'manufacturer_id' => 'nullable|integer',
        ]);

        // Begin a transaction
        DB::beginTransaction();

        try {
            $product = Product::where('quickbook_id', $id)->first();
            if (!$product) {
                return redirect()->route('products')->with('error', 'This Product Not Found in Database');
            }
            // Call the service to update the product in QuickBooks
            $response = $this->quickBooksService->updateProduct($product->quickbook_id, $request->all());

            if (isset($response['error'])) {
                // If QuickBooks update fails, rollback and return an error
                DB::rollBack();
                return redirect()->route('products')->with('error', $response['error']);
            }

            $product->update($validatedData);

            DB::commit();

            return redirect()->route('products')->with('success', 'Product Updated Successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            \Log::info($e->getMessage());
            return redirect()->route('products')->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }




    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted Successfully.');
    }


    // assign product

    public function assignProduct()
    {
        $data['products'] = Product::all();
        $data['customers'] = Customer::all();
        return view('admin.assign_product', $data);
    }
    public function editAssignProduct($customer, $product)
    {
        $user = $this->quickBooksService->editCustomer($customer);
        $product = $this->quickBooksService->editProduct($product);
        if ($product && $user) {
            $data['product'] = $product;
            $data['customer'] = $user;
            $data['myProduct'] = CustomerProduct::where('customer_id',   $user->Id)
                ->where('product_id', $product->Id)
                ->first();
            // @dd($data['myProduct']);
            return view('admin.edit_assign_product', $data);
        } else {
            return redirect()->back()
                ->with('error', 'Product details not found.');
        }
    }


    public function storeAssignProduct(Request $request)
    {
        // Debugging: display all request data
        // @dd($request->all());

        // Validate request data
        // $validate = $request->validate([
        //     'customer_id' => 'required|integer|exists:customers,id',
        //     'products' => 'required|array|min:1',
        //     'products.*' => 'integer|exists:products,id',
        //     'assignedPrice' => 'required|array|min:1',
        //     'assignedPrice.*' => 'required|numeric|min:0',
        //     'profit' => 'required|array|min:1',
        //     'profit.*' => 'required|numeric|min:0',
        // ]);
        $validator = Validator::make($request->all(), [
            'assignedPrice.*' => 'required|numeric',
        ]);
        // @dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal', $request->input('customer_id')); // Pass the customer_id to the session
        }
        foreach ($request->products as $productId) {
            // Ensure the product has valid assignedPrice and profit data
            if (isset($request->assignedPrice[$productId]) && isset($request->profit[$productId])) {
                $assignPrice = $request->assignedPrice[$productId];
                $profit = $request->profit[$productId];
                $quantity = $request->quantity[$productId] ?? null;

                // Create or update the customer-product association
                CustomerProduct::updateOrCreate(
                    ['product_id' => $productId, 'customer_id' => $request->customer_id],
                    ['assign_price' => $assignPrice, 'profit' => $profit, 'quantity' => $quantity]
                );
            }
        }

        return redirect()->back()->with('success', 'Product Assigned Successfully.');
    }


    public function updateAssignProduct(Request $request, $customer, $product)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'assign_price' => 'required|numeric|min:0',
        ]);

        $customerProduct = CustomerProduct::where('customer_id', $customer)
            ->where('product_id', $product)
            ->firstOrFail();

        $customerProduct->update([
            'product_id' => $request->product_id,
            'assign_price' => $request->assign_price,
            'profit' => $request->profit,
            'quantity' => $request->quantity,
        ]);

        // Redirect back with a success message
        return redirect()->route('all.assigned.products', $customer)->with('success', 'Customer Product updated successfully.');
    }

    public function allAssignProduct($customer)
    {
        $data['products'] = CustomerProduct::where('customer_id', $customer)->get();
        $data['customerId'] = $customer;

        return view('admin.allAssignedProducts', $data);
    }
    public function allFavourites()
    {
        // $data['customers'] = Customer::with('products')->get();
        $data['customers'] = $this->quickBooksService->allCustomers();
        return view('admin.all_favourites', $data);
    }

    public function deleteAssignProduct($customer, $product)
    {
        // Find the record
        $customerProduct = CustomerProduct::where('customer_id', $customer)
            ->where('product_id', $product)
            ->firstOrFail();

        // Delete the record
        $customerProduct->delete();
        // Redirect or return response
        return redirect()->back()->with('success', 'Product removed from favourites deleted successfully.');
    }
    // CSV File Upload
    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv',
        ]);
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $fileContents = array_slice($fileContents, 1);

        try {
            DB::transaction(function () use ($fileContents) {

                foreach ($fileContents as $line) {
                    $data = str_getcsv($line);
                    // $category = Category::where('name', $data['8'])->first();
                    // $searchCategory = explode(' ', $data[7]);
                    // $category = Category::where(function ($query) use ($searchCategory) {
                    //     foreach ($searchCategory as  $item) {
                    //         $query->orWhere('name', 'LIKE', "%{$item}%");
                    //     }
                    // })->first();
                    // Check if the SKU is unique
                    $existingProduct = Product::where('sku', $data[0])->first();
                    if ($existingProduct) {
                        throw new \Exception("SKU '{$data[0]}' already exists.");
                    }
                    $searchCategory = $data[7];
                    $category = Category::where('name', $searchCategory)->first();
                    if (!$category) {
                        throw new \Exception("Category '{$searchCategory}' not found.");
                    }
                    // $category = SubCategory::where('name', $data['8'])->first();
                    // $searchsubCategory = explode(' ', $data[8]);
                    // $subCategory = SubCategory::where(function ($query) use ($searchsubCategory) {
                    //     foreach ($searchsubCategory as  $item) {
                    //         $query->orWhere('name', 'LIKE', "%{$item}%");
                    //     }
                    // })->first();
                    $searchSubCategory = $data[8];
                    $subCategory = SubCategory::where('name', $searchSubCategory)->first();
                    if (!$subCategory) {
                        throw new \Exception("SubCategory '{$searchSubCategory}' not found.");
                    }
                    // $vendor = Vendor::where('name', $data['9'])->first();
                    // $searchVendor = explode(' ', $data[9]);

                    // $vendor =  Vendor::where(function ($query) use ($searchVendor) {
                    //     foreach ($searchVendor as $item) {
                    //         $query->orWhere('name', 'LIKE', "%{$item}%");
                    //     }
                    // })->first();
                    $searchVendor = $data[9];
                    $vendor = Vendor::where('name', $searchVendor)->first();
                    if (!$vendor) {
                        throw new \Exception("Vendor '{$searchVendor}' not found.");
                    }
                    // $manufacturer = SubCategory::where('name', $data['10'])->first();
                    // $searchManufacturer = explode(' ', $data[10]);

                    // $manufacturer =  Manufacturer::where(function ($query) use ($searchManufacturer) {
                    //     foreach ($searchManufacturer as $item) {
                    //         $query->orWhere('name', 'LIKE', "%{$item}%");
                    //     }
                    // })->first();
                    $searchManufacturer = $data[10];
                    $manufacturer = Manufacturer::where('name', $searchManufacturer)->first();
                    if (!$manufacturer) {
                        throw new \Exception("Manufacturer '{$searchManufacturer}' not found.");
                    }
                    Product::create([
                        'sku' => $data[0],
                        'name' => $data[1],
                        'price' => $data[2],
                        'cost' => $data[3],
                        'profit' => $data[4] ?? " ",
                        'vendor_code' => $data[5] ?? "",
                        'manufacturer_code' => $data[6] ?? "",
                        'category_id' => intval($category->id),
                        'sub_category_id' => intval($subCategory->id),
                        'vendor_id' => intval($vendor->id),
                        'manufacturer_id' =>  intval($manufacturer->id),
                    ]);
                }
            });


            return redirect()->back()->with('success', 'Products imported successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // public function export()
    // {
    //     // Fetch all products from the database
    //     $products = $this->quickBooksService->allProducts();

    //     // Define CSV headers
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="products.csv"',
    //     ];
    //     // Prepare CSV data using PHP's output buffering
    //     $callback = function () use ($products) {
    //         $file = fopen('php://output', 'w');

    //         // Header row
    //         fputcsv($file, ['sku', 'name', 'price', 'cost', 'profit', 'vendorCode', 'manufacturerCode', 'Category', 'subCategory', 'vendor', 'manufacturer']);

    //         // Data rows
    //         foreach ($products as $product) {
    //             $myProduct = Product::where('quickbook_id', $product->Id)->first();
    //             $category = Category::where('id', $myProduct->category_id)->first();
    //             $categoryId = $product->category_id;
    //             $subCategory = SubCategory::where('id', $myProduct->sub_category_id)->first();
    //             $subCategoryId = $product->sub_category_id;
    //             $vendor = Vendor::where('id', $myProduct->vendor_id)->first();
    //             $vendorId = $product->vendor_id;
    //             $manufacturer = Manufacturer::where('id', $myProduct->manufacturer_id)->first();
    //             $manufacturerId = $product->manufacturer_id;
    //             fputcsv($file, [
    //                 $product->Sku,
    //                 $product->Name,
    //                 $product->UnitPrice,
    //                 $product->PurchaseCost,
    //                 $myProduct->profit,
    //                 $myProduct->vendor_code ?? "",
    //                 $myProduct->manufacturer_code ?? "",
    //                 $category ? $category->name : $categoryId,
    //                 $subCategory ? $subCategory->name : $subCategoryId,
    //                 $vendor ? $vendor->name : $vendorId,
    //                 $manufacturer ? $manufacturer->name : $manufacturerId,
    //                 // Carbon::parse($product->created_at)->diffForHumans(),
    //                 // Carbon::parse($product->updated_at)->diffForHumans(),

    //             ]);
    //         }

    //         fclose($file);
    //     };

    //     // Return CSV as a streamed response
    //     return Response::stream($callback, 200, $headers);
    // }
    public function export()
    {
        // Fetch all products from QuickBooks and their related data in one go
        $products = $this->quickBooksService->allProducts();

        // Pre-fetch all necessary relationships in one query
        $myProducts = Product::with(['category', 'subCategory', 'vendor', 'manufacturer'])
            ->whereIn('quickbook_id', collect($products)->pluck('Id'))
            ->get()
            ->keyBy('quickbook_id');

        // Define CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ];

        // Prepare CSV data using PHP's output buffering
        $callback = function () use ($products, $myProducts) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['sku', 'name', 'price', 'cost', 'profit', 'vendorCode', 'manufacturerCode', 'Category', 'subCategory', 'vendor', 'manufacturer']);

            // Data rows
            foreach ($products as $product) {
                $myProduct = $myProducts->get($product->Id);
                $categoryName = $myProduct->category->name ?? $myProduct->category_id ?? '';
                $subCategoryName = $myProduct->subCategory->name ?? $myProduct->sub_category_id ?? '';
                $vendorName = $myProduct->vendor->name ?? $myProduct->vendor_id ?? '';
                $manufacturerName = $myProduct->manufacturer->name ?? $myProduct->manufacturer_id ?? '';

                fputcsv($file, [
                    $product->Sku,
                    $product->Name,
                    $product->UnitPrice,
                    $product->PurchaseCost,
                    $myProduct->profit ?? '',
                    $myProduct->vendor_code ?? '',
                    $myProduct->manufacturer_code ?? '',
                    $categoryName,
                    $subCategoryName,
                    $vendorName,
                    $manufacturerName,
                ]);
            }

            fclose($file);
        };

        // Return CSV as a streamed response
        return Response::stream($callback, 200, $headers);
    }

    public function downloadAssignProduct()
    {
        // Fetch all products from the database
        $products = CustomerProduct::with('user', 'product')->get();


        // Define CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="AssignedProducts.csv"',
        ];
        // Prepare CSV data using PHP's output buffering
        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['products', 'Customer ', 'AssignedAmount', 'ProductAmount']);

            // Data rows
            foreach ($products as $product) {
                $mainProduct = Product::where('id', $product->product_id)->first();
                $customer = Customer::where('id', $product->customer_id)->first();
                $assignedPrice = $product->assign_price;
                $mainPrice = $mainProduct->price;

                fputcsv($file, [
                    $mainProduct->name,
                    $customer->first_name . ' ' . $customer->last_name,
                    $assignedPrice,
                    $mainPrice
                ]);
            }

            fclose($file);
        };

        // Return CSV as a streamed response
        return Response::stream($callback, 200, $headers);
    }


    public function getProductPrice($product, $customer)
    {
        $assign =  CustomerProduct::where('customer_id', $customer)
            ->where('product_id', $product)
            ->first();
        $Product =  Product::find($product);
        // @dd($assign);
        if ($assign) {
            return response()->json(['price' => $assign->assign_price]);
        }
        if ($Product) {
            return response()->json(['price' => $Product->price]);
        } else {
            return response()->json(['price' => 0], 404);
        }
    }
    public function assign(Request $request)
    {
        $customerId = $request->input('customer_id');
        $productId = $request->input('product_id');

        // Check if the product is assigned to the customer
        $assignment = CustomerProduct::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        // Get the original product price
        $product = Product::find($productId);
        $productPrice = $product ? $product->price : 0;

        // If the product is assigned to the customer, use the assigned price
        if ($assignment) {
            return response()->json([
                'assigned' => true,
                'assigned_price' => $assignment->assign_price, 
                'pack' => $assignment->quantity, 
            ]);
        } else {
            return response()->json([
                'assigned' => false,
                'product_price' => $productPrice,
            ]);
        }
    }


    public function getProductsForCustomer(Request $request)
    {

        $customerId = $request->input('customer_id');
        $selectedProductIds = $request->input('selected_products', []);
        // Fetch related products from the customerProduct table
        $productIds = DB::table('customer_products')
            ->where('customer_id', $customerId)
            ->whereNotIn('product_id', $selectedProductIds)
            ->pluck('product_id')
            ->toArray();
        // Check if product IDs are available
        if (empty($productIds)) {
            return [];  // Return an empty array if no products are found
        }
        // Step 2: Fetch products from QuickBooks based on the product IDs
        $products = $this->quickBooksService->fetchInvoiceProducts($productIds);
        return response()->json(['products' => $products]);
    }
}
