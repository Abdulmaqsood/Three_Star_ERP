<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Vendor;
use App\Services\QuickBookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    protected $quickBooksService;

    public function __construct(QuickBookService $quickBooksService)
    {
        $this->quickBooksService = $quickBooksService;
    }
    // all vendors
    public function index()
    {
        $data['users'] = Vendor::all();
        // $data['users'] = $this->quickBooksService->getAllVendors();
        // @dd($data['users']);
        return view('admin.vendors',$data);
    }
    public function add()
    {
        return view('admin.add_vendor');
    }
    public function edit(Vendor $vendor)
    {
        $data['vendor'] = $vendor;
        return view('admin.edit_vendor',$data);
    }
  

    // store vendors
    public function store(Request $request)
    {
         $validate =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            // 'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],

        ]);
        // if ($request->hasFile('image')) {

        //     $file = $request->file('image');
        //     $filename = 'vendor-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/vendorImages', $filename);
        // }

        Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            // 'image' => $filename,
        ]);
        return redirect()->route('vendors')->with('success', 'Vendor Created Successfully.');
    }
    

    // update vendors
    public function update(Request $request, Vendor $vendor)
    {
        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            // 'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],

        ]);
        // if ($request->hasFile('image')) {
        //     if ($vendor->image) {
        //         Storage::delete($vendor->image);
        //     }
        //     $file = $request->file('image');
        //     $filename = 'vendor-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/vendorImages', $filename);
        //     $vendor->update([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'address' => $request->address,
        //         'image' => $filename
    
        //     ]);
        // }
        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        return redirect()->route('vendors')->with('success', 'Vendor Updated Successfully.');
    }
    public function delete(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->back()->with('success', 'Vendor deleted Successfully.');
    }
    // all manufacturer 
    public function allManufacturer()
    {
        $data['users'] = Manufacturer::all();
        return view('admin.manufacturers',$data);
    }
    public function addManufacturer()
    {
        return view('admin.add_manufacturer');
    }
    public function editManufacturer(Manufacturer $manufacturer)
    {
        $data['user'] = $manufacturer;
        return view('admin.edit_manufacturer',$data);
    }
    // store manufacturer
    public function storeManufacturer(Request $request)
    {
        // @dd($request->all());
      $validate =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|max:255',
            'contact_number' => 'nullable',
            'website' => 'nullable|string|max:255',            
        ]);
        // if ($request->hasFile('image')) {

        //     $file = $request->file('image');
        //     $filename = 'manufacturer-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/manufacturerImages', $filename);
        // }

        Manufacturer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'contact_number' => $request->contact_number,
            'website' => $request->website,
            // 'image' => $filename,
        ]);
        return redirect()->route('manufacturers')->with('success', 'Manufacturer Created Successfully.');
    }

    // update manufacturer
    public function updateManufacturer(Request $request, Manufacturer $manufacturer)
    {

        $validate =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|max:255',
            'contact_number' => 'nullable',
            'website' => 'nullable|string|max:255',            
        ]);
       
        // if ($request->hasFile('image')) {
        //     if ($manufacturer->image) {
        //         Storage::delete($manufacturer->image);
        //     }
        //     $file = $request->file('image');
        //     $filename = 'manufacturer-image' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/manufacturerImages', $filename);
        // }
        $manufacturer->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'contact_number' => $request->contact_number,
            'website' => $request->website,
        ]);
        return redirect()->route('manufacturers')->with('success', 'Manufacturer Updated Successfully.');
    }

    public function deleteManufacturer(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return redirect()->back()->with('success', 'Manufacturrer deleted Successfully.');
    }
}
