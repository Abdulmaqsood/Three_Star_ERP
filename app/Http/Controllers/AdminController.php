<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{

    public function dashboard()
    {
        $data['customerCount'] = Customer::getCustomerCount();
        $data['productCount'] = Product::getProductCount();
        $data['categoryCount'] = SubCategory::getCategoryCount();
        $data['saleCount'] = Invoice::getTotalInvoicesAmount();
        $monthlySales = Invoice::getMonthlySales();
        // Format data for the chart
        $data['months'] = [];
        $data['sales'] = [];
        foreach ($monthlySales as $monthlyData) {
            $data['months'][] = date('F', mktime(0, 0, 0, $monthlyData->month, 1)); // Convert month number to month name
            $data['sales'][] = $monthlyData->total_sales;
        }

        // Format customer data for the chart
        $monthlyCustomers = Customer::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total_customers')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $data['customerMonths'] = [];
        $data['customerCounts'] = [];
        foreach ($monthlyCustomers as $customerData) {
            $data['customerMonths'][] = date('F', mktime(0, 0, 0, $customerData->month, 1)); // Convert month number to month name
            $data['customerCounts'][] = $customerData->total_customers;
        }
        // Format product data for the chart
        $monthlyProducts = Product::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total_products')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $data['productMonths'] = [];
        $data['productCounts'] = [];
        foreach ($monthlyProducts as $productData) {
            $data['productMonths'][] = date('F', mktime(0, 0, 0, $productData->month, 1)); // Convert month number to month name
            $data['productCounts'][] = $productData->total_products;
        }

        return view('admin.dashboard', $data);
    }
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.allUsers', $data);
    }

    public function store(Request $request)
    {
            // @dd($request->all());

        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // 'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // if ($request->hasFile('image')) {

        //     $file = $request->file('image');
        //     $filename = 'admin-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/adminImages', $filename);
        // }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // 'image' => $filename,
            'password' => $request->password,
        ]);
        return redirect()->back()->with('success', 'User Created Successfully.');
    }


    // Update Admin Detail
    public function update(Request $request, User $user)
    {
        // $validate =  $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // 'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updateInfo');
        }
        // if ($request->hasFile('image')) {
        //     if ($user->image) {
        //         Storage::delete($user->image);
        //     }
        //     $file = $request->file('image');
        //     $filename = 'admin-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/adminImages', $filename);
        //     $user->update([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'image' => $filename,
        //     ]);
        // }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'User Update Successfully.');
    }

    // email update function 
    public function email_update(Request $request, User $user)
    {
        $validate =  $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'Email Update Successfully.');
    }
    // password update function 
    public function password_update(Request $request, User $user)
    {
        // $validate =  $request->validate([
        //     'current_password' => 'required',
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updatePassword');
        }

        // Check if the provided current password matches the stored hashed password
        if (Hash::check($request->current_password, $user->password)) {
            // Update the user's password
            $user->update([
                'password' => Hash::make($request->password), // Hash the new password
            ]);

            return redirect()->back()->with('success', 'Password Updated Successfully.');
        }

        return redirect()->back()->with('error', 'Current Password Not Matched.');
    }
    // Role update function 
    public function role_update(Request $request, User $user)
    {
        $validate =  $request->validate([
            'role' => 'required',
        ]);

        $user->update([
            'role' => $request->role,
        ]);
        return redirect()->back()->with('success', 'User Role Assigned Successfully.');
    }
    // show admin detail
    public function show(User $user)
    {
        $data['user'] = $user;
        return view('admin.userView', $data);
    }
    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted Successfully.');
    }
}
