<?php

use App\Http\Controllers\AddressController as ControllersAddressController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuickBooksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\AddressController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

Route::get('/', function () {
    return view('auth.login');
});

// User Routes
// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });




// Admin Routes


Route::middleware(['auth', 'verified'])->group(function () {
          Route::get('admin/clear', function () {
     Artisan::call('optimize:clear');
});    Route::get('admin/storage', function () {
     Artisan::call('storage:link');
});   Route::get('admin/migrate', function () {
     Artisan::call('migrate');
});
    // Dashboard
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Admin add
    Route::get('admin/all/users', [AdminController::class, 'index'])->name('all.users');
    Route::post('admin/add/user', [AdminController::class, 'store'])->name('admin.create');
    Route::get('admin/{user}/user', [AdminController::class, 'show'])->name('admin.view');
    Route::post('admin/user/{user}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::post('admin/email/{user}/update', [AdminController::class, 'email_update'])->name('admin.update.email');
    Route::post('admin/{user}/update', [AdminController::class, 'password_update'])->name('admin.update.password');
    Route::post('admin/role/{user}/update', [AdminController::class, 'role_update'])->name('admin.update.role');
    Route::get('admin/{user}/delete', [AdminController::class, 'delete'])->name('admin.delete');

    Route::get('/admin/{id}/users', [AdminController::class, 'getUser']);


    // vendor 
    Route::get('admin/vendors', [VendorController::class, 'index'])->name('vendors');
    Route::get('admin/add/vendor', [VendorController::class, 'add'])->name('add.vendor');
    Route::post('admin/add/vendor', [VendorController::class, 'store'])->name('store.vendor');
    Route::get('admin/edit/{vendor}/vendor', [VendorController::class, 'edit'])->name('edit.vendor');
    Route::post('admin/vendor/{vendor}/update', [VendorController::class, 'update'])->name('update.vendor');
    Route::get('admin/vendor/{vendor}/delete', [VendorController::class, 'delete'])->name('delete.vendor');
    // manufacturer
    Route::get('admin/manufacturers', [VendorController::class, 'allManufacturer'])->name('manufacturers');
    Route::get('admin/add/manufacturer', [VendorController::class, 'addManufacturer'])->name('add.manufacturer');
    Route::post('admin/add/manufacturer', [VendorController::class, 'storeManufacturer'])->name('store.manufacturer');
    Route::get('admin/edit/{manufacturer}/manufacturer', [VendorController::class, 'editManufacturer'])->name('edit.manufacturer');
    Route::post('admin/manufacturer/{manufacturer}/update', [VendorController::class, 'updateManufacturer'])->name('update.manufacturer');
    Route::get('admin/manufacturer/{manufacturer}/delete', [VendorController::class, 'deleteManufacturer'])->name('delete.manufacturer');

    // Category 
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('admin/categories/search', [CategoryController::class, 'search'])->name('categories.search');

    Route::get('admin/add/category', [CategoryController::class, 'add'])->name('add.category');
    Route::post('admin/add/category', [CategoryController::class, 'store'])->name('store.category');
    Route::get('admin/edit/{category}/category', [CategoryController::class, 'edit'])->name('edit.category');
    Route::post('admin/category/{category}/update', [CategoryController::class, 'update'])->name('update.category');
    Route::get('admin/{category}/category/delete', [CategoryController::class, 'delete'])->name('delete.category');
    // Sub Category
    Route::get('admin/subCategory', [CategoryController::class, 'allSubcategory'])->name('subCategories');
    Route::get('admin/subCategories/search', [CategoryController::class, 'searchSubcategory'])->name('subCategories.search');

    Route::get('admin/add/SubCategory', [CategoryController::class, 'addSubCategory'])->name('add.subCategory');
    Route::post('admin/add/subCategory', [CategoryController::class, 'storeSubCategory'])->name('store.subCategory');
    Route::get('admin/edit/{subCategory}/subCategory', [CategoryController::class, 'editSubCategory'])->name('edit.subCategory');
    Route::post('admin/subCategory/{subCategory}/update', [CategoryController::class, 'updateSubCategory'])->name('update.subCategory');
    Route::get('admin/subCategory/{subCategory}/delete', [CategoryController::class, 'deleteSubCategory'])->name('delete.subCategory');

    // Product Routes
    Route::get('admin/products', [ProductController::class, 'index'])->name('products');
    Route::get('admin/add/product', [ProductController::class, 'add'])->name('add.product');
    Route::post('admin/add/product', [ProductController::class, 'store'])->name('store.product');
    Route::get('admin/edit/{product}/product', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('admin/update/{id}/product', [ProductController::class, 'update'])->name('update.product');
    Route::get('admin/{product}/product/delete', [ProductController::class, 'delete'])->name('delete.product');

    // export product file
    Route::post('admin/import/products', [ProductController::class, 'import'])->name('import.products');
    Route::get('admin/export/products', [ProductController::class, 'export'])->name('export.products');
    // export customer file
    Route::post('admin/import/customers', [CustomerController::class, 'import'])->name('import.customers');
    Route::get('admin/export/customers', [CustomerController::class, 'export'])->name('export.customers');


    // Customers routes
    Route::get('admin/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('admin/add/customer', [CustomerController::class, 'add'])->name('add.customer');
    Route::get('admin/show/{customer}/customer', [CustomerController::class, 'show'])->name('show.customer');
         Route::get('admin/show/invoice/{customer}/customer', [CustomerController::class, 'show_invoices'])->name('show.customer.invoices');
    Route::post('admin/store/customer', [CustomerController::class, 'store'])->name('store.customer');
    Route::get('admin/edit/{id}/customer', [CustomerController::class, 'edit'])->name('edit.customer');
    Route::post('admin/update/{customer}/customer', [CustomerController::class, 'update'])->name('update.customer');
    Route::get('admin/{customer}/customer/delete', [CustomerController::class, 'delete'])->name('delete.customer');
    
    // Invoice Drafts
    Route::get('admin/drafts', [InvoiceController::class, 'drafts'])->name('drafts');
    Route::post('admin/store/draft/invoice', [InvoiceController::class, 'storeDraft'])->name('store.draft.invoice');
    Route::get('admin/edit/draft/{invoice}/invoice', [InvoiceController::class, 'editDraft'])->name('edit.draft.invoice');
    Route::post('admin/draft/{id}/delete', [InvoiceController::class, 'deleteDraft'])->name('delete.draft.invoice');
    
    // Payment Method routes
    Route::get('admin/pay/method', [PaymentController::class, 'index'])->name('paymentMethods');
    Route::get('admin/add/pay', [PaymentController::class, 'add'])->name('add.paymentMethods');
    Route::post('admin/store/pay', [PaymentController::class, 'store'])->name('store.paymentMethods');
    Route::get('admin/edit/{payment}/pay', [PaymentController::class, 'edit'])->name('edit.paymentMethods');
    Route::post('admin/update/{payment}/pay', [PaymentController::class, 'update'])->name('update.paymentMethods');
    Route::get('admin/{payment}/pay/delete', [PaymentController::class, 'delete'])->name('delete.paymentMethods');

    // Add New Address
    Route::post('admin/update/{address}/address', [ControllersAddressController::class, 'update'])->name('update.customerAddress');

    // Assign Product to User
    Route::get('admin/assign/product', [ProductController::class, 'assignProduct'])->name('add.customer.product');
    Route::post('admin/store/product', [ProductController::class, 'storeAssignProduct'])->name('store.customer.product');
    Route::get('admin/{customer}/customer/{product}/product/edit/', [ProductController::class, 'editAssignProduct'])->name('edit.customer.product');
    Route::post('admin/{customer}/customer/product/{product}/update', [ProductController::class, 'updateAssignProduct'])->name('update.customer.product');
    Route::get('admin/all/favourite/{customer}/product', [ProductController::class, 'allAssignProduct'])->name('all.assigned.products');
    Route::post('admin/{customer}/customer/{product}/product/delete', [ProductController::class, 'deleteAssignProduct'])->name('delete.customer.product');
    Route::get('admin/assign/product/download', [ProductController::class, 'downloadAssignProduct'])->name('export.assignProducts');
    Route::get('admin/all/favourites', [ProductController::class, 'allFavourites'])->name('all.favourites');

    // Company Details
    Route::get('admin/company/form/{id?}', [CompanyController::class, 'showForm'])->name('company.form');
    Route::post('admin/company', [CompanyController::class, 'store'])->name('store.company');
    Route::put('admin/company/{id}', [CompanyController::class, 'update'])->name('update.company');





    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // QuickBook api
    Route::get('admin/quickbooks/connect', [QuickBooksController::class, 'connect'])->name('quickbooks.connect');
    Route::get('admin/quickbooks/callback', [QuickBooksController::class, 'callback']);
    Route::get('admin/quickbooks/dashboard', [QuickBooksController::class, 'dashboard'])->name('quickbooks.dashboard')->middleware('quickbooks.auth');


    Route::get('admin/quickbook/customers', [CustomerController::class, 'quickbookCustomers'])->name('quickbooks.customers');
    Route::get('admin/quickbook/products', [ProductController::class, 'quickbookProducts'])->name('quickbooks.products');
    Route::get('admin/quickbook/invoices', [InvoiceController::class, 'quickbookInvoices'])->name('quickbooks.invoices');


    // Route::get('/invoice', [InvoiceController::class, 'invoice'])->name('profile.edit');

    // Invoice Routes
    Route::get('admin/invoices', [InvoiceController::class, 'index'])->name('invoices');
    Route::get('admin/add/invoice/{customer?}', [InvoiceController::class, 'add'])->name('add.invoice');
    Route::get('admin/show/{invoice}/invoice', [InvoiceController::class, 'show'])->name('show.invoice');
    Route::get('admin/download/{invoice}/invoice', [InvoiceController::class, 'download'])->name('download.invoice');
    Route::get('admin/edit/{invoice}/invoice', [InvoiceController::class, 'edit'])->name('edit.invoice');
    Route::post('admin/update/{invoice}/invoice', [InvoiceController::class, 'update'])->name('update.invoice');
    Route::post('admin/store/invoice', [InvoiceController::class, 'store'])->name('store.invoice');
    Route::get('admin/delete/{invoice}/invoice', [InvoiceController::class, 'delete'])->name('delete.invoice');

    // price ajax
    // Route::get('admin/product/{product}/{customer}/price', [ProductController::class, 'getProductPrice'])->name('product.price');
    Route::get('/check-product-assignment', [ProductController::class, 'assign'])->name('product.price');
    Route::get('/get-products', [ProductController::class, 'getProductsForCustomer'])->name('get.products');


    // routes category


    Route::get('/admin/calendar', function () {
        return view('admin.calendar');
    })->name('calendar');
});

require __DIR__ . '/auth.php';
// require __DIR__ . '/AdminAuth.php';
