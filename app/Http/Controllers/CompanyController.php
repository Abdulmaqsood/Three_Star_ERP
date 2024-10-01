<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Show the form for adding or editing a company
    public function showForm()
    {
        // Fetch the company if $id is provided, otherwise create a new instance
        $company = Company::first();
        return view('admin.company_form', compact('company'));
    }

     // Store a new company
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'address' => 'required|string|max:255',
             'contact_number' => 'required|string|max:20',
             'email' => 'required|email|max:255',
             'registration_number' => 'required|string|max:255',
             'business_number' => 'required|string|max:255',
         ]);
 
         $company = new Company();
         $company->fill($validatedData);
         $company->save();
 
         return redirect()->route('company.form', ['id' => $company->id])->with('success', 'Company added successfully!');
     }
 
     // Update an existing company
     public function update(Request $request, $id)
     {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'address' => 'required|string|max:255',
             'contact_number' => 'required|string|max:20',
             'email' => 'required|email|max:255',
             'registration_number' => 'nullable|string|max:255',
             'business_number' => 'nullable|string|max:255',
         ]);
 
         $company = Company::findOrFail($id);
         $company->fill($validatedData);
         $company->save();
 
         return redirect()->route('company.form', ['id' => $company->id])->with('success', 'Company updated successfully!');
     }
}
