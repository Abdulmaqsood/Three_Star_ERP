<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Services\QuickBookService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $quickBooksService;

    public function __construct(QuickBookService $quickBooksService)
    {
        $this->quickBooksService = $quickBooksService;
    }
    // all payentMethods 
    public function index()
    {
        // $data['payments'] = PaymentMethod::all();
        $data['payments'] = $this->quickBooksService->allPaymentMethod();
        return view('admin.payment_methods', $data);
    }
    public function add()
    {
        return view('admin.add_payment_method');
    }
    public function edit(PaymentMethod $payment)
    {
        $data['payment'] = $payment;
        return view('admin.edit_payment_method', $data);
    }


    // store vendors
    public function store(Request $request)
    {

        $validate =  $request->validate([
            'method' => 'required|string|max:255',
            // 'description' => 'required|string',
        ]);
      
        $response = $this->quickBooksService->createPaymentMethod($request->all());
        if (isset($response['error'])) {
            return redirect()->route('paymentMethods')->with('error', $response['error']);
        }
        return redirect()->route('paymentMethods')->with('success', 'Payment Method Created Successfully.');
    }
   
    // update vendors
    public function update(Request $request, PaymentMethod $payment)
    {
        $validate =  $request->validate([
            'method' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
       
        $payment->update([
            'method' => $request->method,
            'description' => $request->description,
        ]);
        return redirect()->route('paymentMethods')->with('success', 'Payment Method Updated Successfully.');
    }
    public function delete(PaymentMethod $payment)
    {
        $payment->delete();
        return redirect()->back()->with('success', 'Payment Method deleted Successfully.');
    }
}
