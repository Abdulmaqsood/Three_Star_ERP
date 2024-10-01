<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manufacturer;
use App\Models\PaymentMethod;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    public function index()
    {
        $data['users'] = Admin::all();
        return view('admin.allUsers', $data);
    }
    public function add()
    {
        $data['payments'] = PaymentMethod::all();
        $data['vendors'] = Vendor::all();
        $data['manufacturers'] = Manufacturer::all();
        return view('admin.add_customer', $data);
    }
    public function show(User $customer)
    {
        $data['user'] = $customer;
        return view('admin.customer_detail',$data);
    }
    public function edit(User $customer)
    {
       
        $data['user'] = $customer;
        $data['payments'] = PaymentMethod::all();
        return view('admin.edit_customer', $data);
    }
    public function store(Request $request)
    {
        // @dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'display_name' => 'required',
            'address_1' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_method_id' => 'required',
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        DB::transaction(function () use ($request) {
            if ($request->hasFile('image')) {

                $file = $request->file('image');
                $filename = 'user-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/userImages', $filename);
            }
            $user =  User::create([
                'title' => $request->title,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'image' => $filename,
                'suffix' => $request->suffix,
                'company' => $request->company_name,
                'display_name' => $request->display_name,
                'email' => $request->email,
                // 'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'mobile_number' => $request->mobile_number,
                'fax' => $request->fax,
                'other' => $request->other,
                'website' => $request->website,
                'cheque_print_name' => $request->cheque_print_name,
                'business_number' => $request->business_number,
                'terms' => $request->terms,
                'payment_method_id' => $request->payment_method_id,
            ]);

            $user->address()->create([
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'city' => $request->city,
                'province' => $request->province,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ]);
        });


        return redirect()->route('customers')->with('success', 'Customer Added Successfully.');
    }
    
    public function update(Request $request,User $customer)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'display_name' => 'required',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_method_id' => 'required',

        ]);
        // @dd($request->all());
        

            if ($request->hasFile('image')) {
                if ($customer->image) {
                    Storage::delete($customer->image);
                }
                $file = $request->file('image');
                $filename = 'user-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/userImages', $filename);
                $customer->update([
                    'title' => $request->title,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'image' => $filename,
                    'suffix' => $request->suffix,
                    'company' => $request->company_name,
                    'display_name' => $request->display_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'mobile_number' => $request->mobile_number,
                    'fax' => $request->fax,
                    'other' => $request->other,
                    'website' => $request->website,
                    'cheque_print_name' => $request->cheque_print_name,
                    'business_number' => $request->business_number,
                    'terms' => $request->terms,
                    'payment_method_id' => $request->payment_method_id,
                ]);
    
            }
            $customer->update([
                'title' => $request->title,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'suffix' => $request->suffix,
                'company' => $request->company_name,
                'display_name' => $request->display_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'mobile_number' => $request->mobile_number,
                'fax' => $request->fax,
                'other' => $request->other,
                'website' => $request->website,
                'cheque_print_name' => $request->cheque_print_name,
                'business_number' => $request->business_number,
                'terms' => $request->terms,
                'payment_method_id' => $request->payment_method_id,
            ]);

           
    


        return redirect()->route('customers')->with('success', 'Customer Updated Successfully.');
    }
    
}
