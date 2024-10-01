@extends('layout.master')
@push('custom-css')
    {{-- <style type="text/css" media="screen">
    html {
        font-family: sans-serif;
        line-height: 1.15;
        margin: 0;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
        font-size: 10px;
        margin: 36pt;
    }

    h4 {
        margin-top: 0;
        margin-bottom: 0.5rem;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    strong {
        font-weight: bolder;
    }

    img {
        vertical-align: middle;
        border-style: none;
    }

    table {
        border-collapse: collapse;
    }

    th {
        text-align: inherit;
    }

    h4,
    .h4 {
        margin-bottom: 0.5rem;
        font-weight: 500;
        line-height: 1.2;
    }

    h4,
    .h4 {
        font-size: 1.5rem;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
    }

    .table.table-items td {
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .mt-5 {
        margin-top: 3rem !important;
    }

    .pr-0,
    .px-0 {
        padding-right: 0 !important;
    }

    .pl-0,
    .px-0 {
        padding-left: 0 !important;
    }

    .text-right {
        text-align: right !important;
    }

    .text-center {
        text-align: center !important;
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    * {
        font-family: "DejaVu Sans";
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    table,
    th,
    tr,
    td,
    p,
    div {
        line-height: 1.1;
    }

    .party-header {
        font-size: 1.5rem;
        font-weight: 400;
    }

    .total-amount {
        font-size: 12px;
        font-weight: 700;
    }

    .border-0 {
        border: none !important;
    }

    .cool-gray {
        color: #6B7280;
    }
</style> --}}
@endpush
@section('content')

    <div class="container">
        <table class="table ">
            <tbody>
                <tr>
                    <td class="border-0 pl-0" width="70%">
                        <img src="{{ asset('assets/media/logo.svg') }}" alt="logo" height="70">

                        {{-- <h4 class="text-uppercase">
                            <strong>Invoice Name</strong>
                        </h4> --}}
                    </td>
                    <td class="border-0 pl-0">
                        {{-- @if ($invoice->status) --}}
                        <h4 class="text-uppercase cool-gray">
                            <strong>Invoice</strong>
                        </h4>
                        {{-- @endif --}}
                        @php
                            use Carbon\Carbon;

                        @endphp
                        <p class="m-0">Due Date: <strong> {{ $invoice->DueDate }}</strong></p>
                        <p class="m-0">Invoice # :<strong> {{ $invoice->DocNumber }}</strong></p>
                        {{-- <p class="m-0">Terms  :<strong> {{ $invoice->customer->terms }}</strong></p> --}}
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            {{-- <thead>
                <tr>
                    <th class="border-0 pl-0 party-header text-primary fw-bold fs-4" width="48.5%">
                        Company Info
                    </th>

                </tr>
            </thead> --}}
            <tbody>
                <tr>
                    <td class="px-0">
                        @if ($company)
                            <p class="">
                                <strong>{{ $company->name }}</strong>
                            </p>


                            <p class="m-0">
                                {{ $company->address }},
                            </p>

                            <p class="m-0">
                                {{ $company->contact_number }}
                            </p>

                            <p class="m-0">
                                {{ $company->email }}
                            </p>
                            <p class="m-0">
                                {{ $company->registration_number }}
                            </p>
                            <p class="m-0">
                                {{ $company->business_number }}
                            </p>
                        @endif

                    </td>
                </tr>
            </tbody>
        </table>
        <div class="separator border-primary my-5"></div>

        <div class="d-flex">
            {{-- Seller - Buyer --}}
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-0 pl-0 party-header text-primary fw-bold fs-4" width="48.5%">
                            Billing To
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="px-0">
                            @if ($invoice->BillAddr)
                                {{-- <p class="m-0">
                                    <strong>{{ $invoice->BillAddr->first_name }}
                                        {{ $invoice->BillAddr->last_name }}</strong>
                                </p> --}}


                                <p class="m-0">
                                    {{ $invoice->BillAddr->Line1 ?? $customer->BillAddr->Line1 }}
                                </p>
                                <p class="m-0">
                                    {{ $invoice->BillAddr->City ?? $customer->BillAddr->City }}
                                </p>
                                {{-- <p class="m-0">
                                    {{ $invoice->BillAddr->address->province }}
                                </p> --}}
                                <p class="m-0">
                                    {{ $invoice->BillAddr->Country ?? $customer->BillAddr->Country }}
                                </p>
                                {{-- <p class="m-0">
                                    {{ $invoice->BillAddr->phone_number ?? ""}}
                                </p> --}}
                            @else
                                <p class="m-0">
                                    <strong>{{ $customer->DisplayName }}</strong>
                                </p>

                                <p class="m-0">
                                    {{  $customer->BillAddr->Line1 ?? ""}}
                                </p>
                                <p class="m-0">
                                    {{  $customer->BillAddr->City ?? ""}}
                                </p>
                                {{-- <p class="m-0">
                                    {{ $invoice->BillAddr->address->province }}
                                </p> --}}
                                <p class="m-0">
                                    {{  $customer->BillAddr->Country ?? ""}}
                                </p>
                                <p class="m-0">{{ $customer->PrimaryPhone->FreeFormNumber ?? '' }} </p>

                            @endif
                            {{-- @foreach ($invoice->seller->custom_fields as $key => $value)
                    <p class="seller-custom-field">
                        {{ ucfirst($key) }}: {{ $value }}
                    </p>
                @endforeach --}}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <tr>
                        <th class="border-0 pl-0 party-header text-primary fw-bold fs-4" width="48.5%">
                            Shipping To
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-0">
                            @if ($invoice->ShipAddr)
                                <p class="m-0">
                                    <strong>{{ $customer->DisplayName }}</strong>
                                </p>

                                <p class="m-0">{{ $invoice->ShipAddr ? $invoice->ShipAddr->Line1 : $customer->ShipAddr->Line1 }} </p>
                                <p class="m-0">{{ $invoice->ShipAddr ? $invoice->ShipAddr->City : $customer->ShipAddr->City }} </p>
                                <p class="m-0">{{ $invoice->ShipAddr ? $invoice->ShipAddr->Country : $customer->ShipAddr->Country }} </p>
                                <p class="m-0">{{ $customer->PrimaryPhone->FreeFormNumber ?? '' }} </p>
                            @else
                                <p class="m-0">
                                    <strong>{{ $customer->DisplayName }}</strong>
                                </p>

                                <p class="m-0">{{ $customer->ShipAddr ? $customer->ShipAddr->Line1 : '' }} </p>
                                <p class="m-0">{{ $customer->ShipAddr ? $customer->ShipAddr->City : '' }} </p>
                                <p class="m-0">{{ $customer->ShipAddr ? $customer->ShipAddr->Country : '' }} </p>
                                <p class="m-0">{{ $customer->PrimaryPhone->FreeFormNumber ?? '' }} </p>
                            @endif
                            {{-- @foreach ($invoice->seller->custom_fields as $key => $value)
                    <p class="seller-custom-field">
                        {{ ucfirst($key) }}: {{ $value }}
                    </p>
                @endforeach --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="text-end mx-3 my-4">
                <h3>
                    <strong>{{ $invoice->total }}$</strong>
                </h3>
                <h4 class="text-uppercase cool-gray">
                    <strong>TOTAL</strong>
                </h4>
            </div> --}}
        </div>

        {{-- Table --}}
        <table class="table table-items mt-2">
            <thead>
                <tr class="bg-primary text-white fw-bold  rounded">
                    <th scope="col" class="border-0 ps-3 fs-6"> Sku</th>
                    <th scope="col" class="border-0 ps-3 fs-6"> Product Name</th>
                    {{-- @if ($invoice->hasItemUnits) --}}
                    {{-- <th scope="col" class="text-center border-0">Invoice Units</th> --}}
                    {{-- @endif --}}
                    <th scope="col" class="text-center border-0 fs-6"> Pack</th>
                    <th scope="col" class="text-center border-0 fs-6">Rate</th>
                    {{-- @if ($invoice->hasItemDiscount) --}}
                    {{-- <th scope="col" class="text-center border-0  fs-6"> SubTotal</th> --}}
                    {{-- @endif --}}
                    {{-- @if ($invoice->hasItemTax) --}}
                    <th scope="col" class="text-center border-0 fs-6"> </th>
                    {{-- @endif --}}
                    <th scope="col" class="text-center border-0 fs-6">Amount</th>
                </tr>
            </thead>
            <tbody>

                @if ($invoice->Line)
                    @php
                        $invoiceLines = $invoice->Line;
                         $myAmount = 0;
                        array_pop($invoiceLines);
                    @endphp
                    {{-- Items --}}
                    @foreach ($invoiceLines as $item)
                        <tr>
                            <td class="pl-0">
                                @foreach ($products as $product)
                                    @if ($item->SalesItemLineDetail->ItemRef == $product->quickbook_id)
                                        {{ $product->sku }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="pl-0">
                                @foreach ($products as $product)
                                    @if ($item->SalesItemLineDetail->ItemRef == $product->quickbook_id)
                                        {{ $product->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">{{ $item->SalesItemLineDetail->Qty }}</td>


                            <td class="text-center">
                                ${{ $item->SalesItemLineDetail->UnitPrice }}
                            </td>
                            {{-- @if ($invoice->hasItemDiscount) --}}

                            {{-- @endif --}}
                            {{-- @if ($invoice->hasItemTax) --}}
                            {{-- <td class="text-center">
                                ${{ $item->sub_total }}
                            </td> --}}
                            {{-- @endif --}}

                            <td class="text-center pr-0">
                                {{-- {{ $item->tax }}$ --}}
                            </td>
                            {{-- @if ($invoice->hasItemUnits) --}}
                            <td class="text-center">${{ $item->Amount }}</td>
                            {{-- @endif --}}
                            @php
                              $myAmount += $item->Amount;
                            @endphp
                        </tr>
                    @endforeach
                    {{-- Summary --}}
                    {{-- @if ($invoice->hasItemOrInvoiceDiscount()) --}}
                    <tr>
                        {{-- <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="pl-0 text-primary fw-bold fs-4">Subtotal</td>
                        <td class="text-center text-primary fw-bold fs-4">

                            ${{ $myAmount ?? 0 }}
                        </td>
                    </tr>
                    {{-- @endif --}}
                    {{-- @if ($invoice->taxable_amount) --}}
                    <tr>
                        {{-- <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" pl-0 text-primary fw-bold fs-4">Tax (HST/GST @ 13%)</td>
                        <td class="text-center text-primary fw-bold fs-4 ">
                            ${{ $invoice->TotalAmt - $myAmount }}
                        </td>
                    </tr>
                    {{-- @endif --}}
                    {{-- @if ($invoice->tax_rate) --}}
                    <tr>
                        {{-- <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td> --}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" pl-0 text-primary fw-bold fs-4">Total</td>
                        <td class="text-center text-primary fw-bold fs-4  total-amount">
                            ${{ $invoice->TotalAmt ?? '' }}
                        </td>
                    </tr>
                    {{-- @endif --}}
                    {{-- @if ($invoice->hasItemOrInvoiceTax()) --}}
                    {{-- <tr>
                        <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" pl-0 text-primary fw-bold fs-4">Paid By Customer</td>
                        <td class="text-center text-primary fw-bold fs-4">
                            {{ $invoice->customer->first_name }} {{ $invoice->customer->last_name }}
                        </td>
                    </tr> --}}
                    {{-- @endif --}}
                @endif

            </tbody>
        </table>

        {{-- @if ($invoice->notes) --}}
        {{-- <p class="mt-4">
            <strong class="total-amount fs-5">Payment Details</strong>:
        </p> --}}
        {{-- @endif --}}

        {{-- <p>
            <strong class="total-amount">Gateway</strong>: {{ $invoice->customer->payment_method->method }}
        </p> --}}

        {{-- <div class="separator border-primary my-5 "></div>
        <div class="text-center">
            <h1 >Thank You for your purchase.</h1>
        </div>
        <div class="separator border-primary my-5"></div> --}}

    </div>
@endsection
