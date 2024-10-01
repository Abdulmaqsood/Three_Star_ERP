<!DOCTYPE html>
<html lang="en">

<head>
    <title>Three Star</title>
    <meta charset="utf-8" />
    <meta name="description" content="Three Star" />

    <style>
        body {
            font-family: Inter, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* .container {
            padding: 10px;
        } */

        .d-flex {
            display: flex;
        }

        .flex-column {
            flex-direction: column;
        }

        .flex-row {
            flex-direction: row;
        }

        .flex-root {
            flex: 1;
        }

        .flex-row-fluid {
            width: 100%;
        }

        .page {
            display: flex;
            flex-direction: row;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fs-4 {
            font-size: 0.90rem;
        }

        .fs-6 {
            font-size: 1rem;
        }

        .m-0 {
            margin: 0;
        }

        .m-2 {
            margin: 0.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .my-4 {
            margin: 1.5rem 0;
        }

        .px-0 {
            padding-left: 0;
            padding-right: 0;
        }

        .ps-1 {
            padding-left: 0.25rem;
        }

        .ps-2 {
            padding-left: 0.5rem;
        }

        .ps-3 {
            padding-left: 1rem;
        }

        .pr-0 {
            padding-right: 0;
        }

        .text-right {
            text-align: right;
        }

        .bg-abc {
            background-color: #2e527d;
        }

        .text-white {
            color: white;
        }

        .text-primary {
            color: #2e527d;
        }

        .cool-gray {
            color: #6c757d;
        }

        .border-0 {
            border: none;
        }

        .border-primary {
            border-color: #2e527d;
            border-width: 2px;
            border-style: solid;
            margin: 1rem 0;
        }

        .separator {
            border-top: 1px solid #2e527d;
            margin: 1rem 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        td,
        th {
            vertical-align: top;
        }

        .table-items {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }

        .table-items th,
        .table-items td {
            /*border-bottom: 1px solid #2e527d;*/
            padding: 0.75rem;
            text-align: left;
        }

        .table-items th {
            background-color: #2e527d;
            color: white;
        }

        .total-amount {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .heading {
            padding: 0px;
            text-align: left;
            padding-bottom: 8px;
        }

        .total {
            display: flex;
            justify-content: end;
            flex-direction: column;
        }

        .text-center {
            text-align: center;
        }
        p{
            font-size: 0.90rem;
        }
    </style>
</head>

<body class="container">
    
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!-- Header Section -->
                <table class="mt-5">
                    <tbody>
                        <tr>
                            <td class="border-0" width="70%">
                                <img src="{{ public_path('assets/media/logo.svg') }}" alt="logo" height="70">
                            </td>
                            <td class="border-0">
                                <h4 class="text-uppercase cool-gray">
                                    <strong>Invoice</strong>
                                </h4>
                                <p class="m-0">Due Date: <strong> {{ $invoice->DueDate }} </strong></p>
                                <p class="m-0">Invoice #: <strong> {{ $invoice->DocNumber }} </strong></p>
                                {{-- <p class="m-0">Terms: <strong> {{ $customer->terms }}</strong></p> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Company Info -->
                <table>
                    {{-- <thead>
                        <tr>
                            <th class="heading text-primary fw-bold fs-4">Company Info</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <td class="px-0">
                                <p class="m-0"><strong>{{ $company->name }}</strong></p>
                                <p class="m-0"> {{ $company->address }}</p>
                                <p class="m-0"> {{ $company->contact_number }}</p>
                                <p class="m-0"> {{ $company->email }}</p>
                                <p class="m-0"> {{ $company->registration_number }}</p>
                                <p class="m-0"> {{ $company->business_number }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="separator border-primary"></div>

                <!-- Billing and Shipping Sections -->
                <!-- Combined Billing and Shipping Sections -->
                <div class="d-flex justify-content-between">
                    <!-- Combined Table -->
                    <table style="width: 100%; border-spacing: 0; padding: 0;">
                        <thead>
                            <tr>
                                <th class="heading border-0 text-primary fw-bold fs-4"
                                    style="padding-bottom: 20px; text-align: left;">Billing To</th>
                                <th class="heading border-0 text-primary fw-bold fs-4"
                                    style="padding-bottom: 20px; text-align: left;">Shipping To</th>
                                {{-- <th class="text-right border-0">
                                    <h3 style="margin: 0px 0px 6px 0px;"><strong>{{$invoice->total}}</strong></h3>
                                    <h4 class="text-uppercase cool-gray" style="margin: 0;"><strong>Total</strong></h4>
                                </th> --}}
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
                                            {{ $customer->BillAddr->Line1 ?? '' }}
                                        </p>
                                        <p class="m-0">
                                            {{ $customer->BillAddr->City ?? '' }}
                                        </p>
                                        {{-- <p class="m-0">
                                        {{ $invoice->BillAddr->address->province }}
                                    </p> --}}
                                        <p class="m-0">
                                            {{ $customer->BillAddr->Country ?? '' }}
                                        </p>
                                        <p class="m-0">{{ $customer->PrimaryPhone->FreeFormNumber ?? '' }} </p>
                                    @endif
                                </td>
                                <td class="px-0">
                                    @if ($invoice->ShipAddr)
                                        <p class="m-0">
                                            <strong>{{ $customer->DisplayName }}</strong>
                                        </p>

                                        <p class="m-0">
                                            {{ $invoice->ShipAddr ? $invoice->ShipAddr->Line1 : $customer->ShipAddr->Line1 }}
                                        </p>
                                        <p class="m-0">
                                            {{ $invoice->ShipAddr ? $invoice->ShipAddr->City : $customer->ShipAddr->City }}
                                        </p>
                                        <p class="m-0">
                                            {{ $invoice->ShipAddr ? $invoice->ShipAddr->Country : $customer->ShipAddr->Country }}
                                        </p>
                                        <p class="m-0">{{ $customer->PrimaryPhone->FreeFormNumber ?? '' }} </p>
                                    @else
                                        <p class="m-0">
                                            <strong>{{ $customer->DisplayName }}</strong>
                                        </p>

                                        <p class="m-0">{{ $customer->ShipAddr ? $customer->ShipAddr->Line1 : '' }}
                                        </p>
                                        <p class="m-0">{{ $customer->ShipAddr ? $customer->ShipAddr->City : '' }}
                                        </p>
                                        <p class="m-0">{{ $customer->ShipAddr ? $customer->ShipAddr->Country : '' }}
                                        </p>
                                        <p class="m-0">{{ $customer->PrimaryPhone->FreeFormNumber ?? '' }} </p>
                                    @endif
                                </td>
                                <td class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Invoice Items Table -->
                <table class="table-items mt-2">
                    <thead>
                        <tr class=" text-white fw-bold" >
                            <th scope="col" class="border-0 py-2 ps-2 fs-6">Product Sku</th>
                            <th scope="col" class="border-0 ps-3 fs-6">Product Name</th>
                            <th scope="col" class="text-center border-0 fs-6">Pack</th>
                            <th scope="col" class="text-center border-0 fs-6">Rate</th>
                            <th scope="col" class="text-center border-0 fs-6"></th>
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
                            @foreach ($invoiceLines as $item)
                                <tr>
                                    <td class="ps-1">
                                        @foreach ($products as $product)
                                            @if ($item->SalesItemLineDetail->ItemRef == $product->quickbook_id)
                                                {{ $product->sku }}
                                            @endif
                                        @endforeach

                                    </td>
                                    <td class="ps-1">
                                        @foreach ($products as $product)
                                            @if ($item->SalesItemLineDetail->ItemRef == $product->quickbook_id)
                                                {{ $product->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center"> {{ $item->SalesItemLineDetail->Qty }}</td>
                                    <td class="text-center"> ${{ $item->SalesItemLineDetail->UnitPrice }}</td>
                                    <td class="text-center pr-0"></td>
                                    <td class="text-center"> ${{ $item->Amount }} </td>
                                    @php
                                     $myAmount += $item->Amount;
                                    @endphp
                                </tr>
                            @endforeach
                            <!-- Summary -->
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-primary fw-bold fs-4">Subtotal</td>
                                <td class="text-center text-primary fw-bold fs-4"> ${{ $myAmount ?? 0 }} </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-primary fw-bold fs-4">Tax (HST/GST @ 13%)</td>
                                <td class="text-center text-primary fw-bold fs-4"> ${{ $invoice->TotalAmt - $myAmount}} </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-primary fw-bold fs-4">Total</td>
                                <td class="text-center text-primary fw-bold fs-4">${{ $invoice->TotalAmt ?? '' }}</td>
                            </tr>
                            {{-- <tr>
                                <td colspan="4"></td>
                                <td class="text-primary fw-bold fs-4">Paid by customer</td>
                                <td class="text-center text-primary fw-bold fs-4">{{$customer->first_name}} {{$customer->last_name}}</td>
                            </tr> --}}
                        @endif
                    </tbody>
                </table>

                <!-- Gateway Information -->
                {{-- <div>
                    <strong class="total-amount">Payment Details:</strong>
                    <p><strong>Gateway</strong>:
                        {{$customer->payment_method->method ?? 'N/A'}} </p>
                </div> --}}

                {{-- <div class="separator border-primary "></div>
                <!-- Thank You Message -->
                <div class="text-center">
                    <h3 class="m-2">Thank You for your purchase.</h3>
                </div>
                <div class="separator border-primary mb-2"></div> --}}

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

</body>

</html>
