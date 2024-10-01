<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
     // store vendors
     public function update(Request $request, Address $address)
     {
        @dd($request->all());
         $validate =  $request->validate([
             'address_1' => 'required|string|max:255',
         ]);
       
         $address->update([
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'province' => $request->province,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
         ]);
         return redirect()->back()->with('success', 'Address Updated Successfully.');
     }
}
