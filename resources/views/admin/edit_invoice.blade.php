@extends('layout.master')
@push('custom-css')
    <style>
        /* Ensure that only the bottom border is visible */
        .form-group {
            border: none;
            border-bottom: 1px solid #dcdcdc;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .form-label {
            margin-right: 1rem;
            white-space: nowrap;
            font-weight: bold;
        }

        .form-control-custom {
            border: none;
            /* border-bottom: 1px solid #dcdcdc; */
            border-radius: 0;
            box-shadow: none;
            padding: 0.5rem;
        }

        .float-right {
            float: right;
            width: 30%;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mt-4 {
            margin-top: 2.5rem !important;
        }
    </style>
@endpush
@section('content')
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">
                        Edit Invoice </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('invoices') }}" class="text-muted text-hover-primary">
                                Invoices </a>
                        </li>


                        <li class="breadcrumb-item text-muted">
                            Edit Invoice </li>



                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                    {{-- <a href="#" class="btn bg-body btn-color-gray-700 btn-active-primary me-4" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_invite_friends">
                        Invite Friends
                    </a>

                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_project" id="kt_toolbar_primary_button">
                        New Project </a> --}}
                    <a href="{{ URL::previous() }}" class="btn btn-primary">
                        Go Back </a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <form action="{{ route('update.invoice', $invoice->Id) }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice->Id }}">
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 w-lg-100 gap-lg-12">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Edit Invoice</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Invoice Number</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="invoice_number" class="form-control mb-2"
                                        placeholder="Invoice Number"
                                        value="{{ old('invoice_number', $invoice->DocNumber) }}">
                                    <!--end::Input-->

                                    @error('invoice_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->


                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class=" form-label">Shipping Address</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="shipping_address" class="form-control mb-2"
                                        placeholder="Shipping Address"
                                        value="{{ old('shipping_address', $invoice->ShipAddr->Line1 ?? '') }}">
                                    <!--end::Input-->

                                    @error('shipping_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <div class="row">
                                    <!--begin::Input group-->
                                    <div class="col-lg-6 col-md-6 mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">Shipping City</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="shipping_city" class="form-control mb-2"
                                            placeholder="Shipping City"
                                            value="{{ old('shipping_city', $invoice->ShipAddr->City ?? '') }}">
                                        <!--end::Input-->

                                        @error('shipping_city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    {{-- <!--begin::Input group-->
                                    <div class="col-lg-4 col-md-4 mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">Shipping Province</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="shipping_province" class="form-control mb-2"
                                            placeholder="Shipping Province"
                                            value="{{ old('shipping_province', $invoice->ShipAddr->Country ?? '') }}">
                                        <!--end::Input-->

                                        @error('shipping_province')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group--> --}}

                                    <!--begin::Input group-->
                                    <div class="col-lg-6 col-md-6 mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">Shipping Country</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="shipping_country" class="form-control mb-2"
                                            placeholder="Shipping Country"
                                            value="{{ old('shipping_country', $invoice->ShipAddr->Country ?? '') }}">
                                        <!--end::Input-->

                                        @error('shipping_country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>

                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container"
                                    data-select2-id="select2-data-185-58z7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span class="required">Customer</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Customers"
                                            data-bs-original-title="Customers" data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
                                        </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <select name="customer_id" id="customer" data-placeholder="Select Customer..."
                                        class="form-select form-select-solid fw-bold">
                                        @if ($customers)
                                            <option value="">Select Customer...</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->Id }}"
                                                    {{ old('customer_id', $invoice->CustomerRef) == $customer->Id ? 'selected' : '' }}>
                                                    {{ $customer->DisplayName }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled>Customers Not available...</option>
                                        @endif
                                    </select>
                                    <!--end::Input-->

                                    @error('customer_id')
                                        <span class="text-danger">Customer Required</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div id="products">
                                    @php
                                        $QuickInvoice = array_pop($invoice->Line);
                                        if (!is_array($QuickInvoice)) {
                                            $QuickInvoice = [$QuickInvoice];
                                        }
                                    @endphp
                                    @foreach ($invoice->Line as $index => $product)
                                        @php
                                            if ($product->SalesItemLineDetail) {
                                                $itemRef = $product->SalesItemLineDetail->ItemRef ?? '';
                                                $qty = $product->SalesItemLineDetail->Qty ?? '';
                                                $UnitPrice = $product->SalesItemLineDetail->UnitPrice ?? '';
                                            }
                                        @endphp
                                        <div class="row product">
                                            <!--begin::Col-->
                                            <div class="col-lg-4 col-md-6">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2">
                                                        <span class="required">Product</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip" aria-label=""
                                                            data-bs-original-title="Country of origination"
                                                            data-kt-initialized="1">
                                                            <i class="ki-duotone ki-information fs-7"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span class="path3"></span></i>
                                                        </span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="products[{{ $index }}][id]" id="product"
                                                        data-placeholder="Select Product..."
                                                        class="form-select form-select-solid fw-bold product-select">
                                                        <option value="">Select Product...</option>

                                                        <!-- Populate products here -->
                                                        @foreach ($allProducts as $productOption)
                                                            <option value="{{ $productOption->Id }}"
                                                                {{ old('products.' . $index . '.id', $itemRef) == $productOption->Id ? 'selected' : '' }}>
                                                                {{ $productOption->Name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <!--end::Input-->
                                                    @error('products.' . $index . '.id')
                                                        <span class="text-danger">Product Required</span>
                                                    @enderror
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-2 col-md-6">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Price</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="products[{{ $index }}][price]"
                                                        class="form-control mb-2 price-input" placeholder="Price..."
                                                        value="{{ old('products.' . $index . '.price', $UnitPrice) }}"
                                                        readonly>
                                                    <!--end::Input-->

                                                    @error('products.' . $index . '.price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-2 col-md-6">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Quantity</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input type="tel" name="products[{{ $index }}][quantity]"
                                                        class="form-control mb-2 quantity-input" placeholder="Quantity..."
                                                        value="{{ old('products.' . $index . '.quantity', $qty) }}">
                                                    <!--end::Input-->

                                                    @error('products.' . $index . '.quantity')
                                                        <span class="text-danger">Product Quantity is Required</span>
                                                    @enderror
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->

                                            <!--begin::Col-->
                                            <div class="col-lg-2 col-md-6">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Amount</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input type="tel" name="products[{{ $index }}][amount]"
                                                        class="form-control mb-2 subtotal-input" placeholder="Amount..."
                                                        value="{{ old('products.' . $index . '.amount', $product->Amount) }}"
                                                        readonly>
                                                    <!--end::Input-->

                                                    @error('products.' . $index . '.amount')
                                                        <span class="text-danger">Amount is Required</span>
                                                    @enderror
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                            <div class="col-auto " style="margin-top : 25px;">
                                                <button type="button" class="btn btn-danger remove-product" onclick="removeProduct(this)">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <a href="#" type="button" onclick="addProduct()" class="btn btn-primary mb-4">Add
                                    Product</a>

                                <!-- Summary Fields -->
                                <div class="float-right ">
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">SubTotal</label>
                                                <input type="text" name="invoice_subtotal" id="invoice_subtotal"
                                                    class="form-control-custom" placeholder="SubTotal..."
                                                    value="{{ old('invoice_subtotal', $invoice->TotalAmt) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label class="form-label">Tax</label>
                                                <input type="text" name="invoice_tax" id="invoice_tax"
                                                    class="form-control-custom" placeholder="Tax..."
                                                    value="{{ old('invoice_tax', $invoice->TxnTaxDetail->TotalTax) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label class="form-label">Grand Total</label>
                                                <input type="text" name="invoice_grand_total" id="invoice_grand_total"
                                                    class="form-control-custom" placeholder="Grand Total..."
                                                    value="{{ old('invoice_grand_total', $invoice->TotalAmt) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('invoices') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->

                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->


                </form>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // Function to collect selected product IDs
            function getSelectedProductIds() {
                let selectedProductIds = [];
                $('.product-select').each(function() {
                    let productId = $(this).val();
                    if (productId) {
                        selectedProductIds.push(productId);
                    }
                });
                return selectedProductIds;
            }
            var selectedProductIds = getSelectedProductIds();

            $('#customer').change(function() {
                var customerId = $(this).val();
                if (customerId) {
                    $.ajax({
                        url: '{{ route('get.products') }}',
                        method: 'GET',
                        data: {
                            customer_id: customerId
                        },
                        success: function(response) {
                            var productSelects = $('.product-select');
                            productSelects.empty();
                            productSelects.append(
                                '<option value="">Select Product...</option>');

                            $.each(response.products, function(key, product) {
                                productSelects.append('<option value="' + product.Id +
                                    '" data-price="' + product.UnitPrice + '">' +
                                    product.Name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to retrieve products');
                        }
                    });
                } else {
                    $('.product-select').empty().append('<option value="">Select Product...</option>');
                }
            });

            function updatePrice() {
                $('#customer, .product-select').change(function() {
                    var customerId = $('#customer').val();
                    var productSelect = $(this).closest('.product').find('.product-select');
                    var productId = productSelect.val();
                    var priceInput = $(this).closest('.product').find('.price-input');

                    if (customerId && productId) {
                        $.ajax({
                            url: '/check-product-assignment',
                            method: 'GET',
                            data: {
                                customer_id: customerId,
                                product_id: productId
                            },
                            success: function(response) {
                                if (response.assigned) {
                                    priceInput.val(response.assigned_price);
                                } else {
                                    priceInput.val(response.product_price);
                                }
                                updateSubTotal(productSelect);
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    } else {
                        priceInput.val(0);
                    }
                });

                $(document).on('input', '.quantity-input', function() {
                    var productDiv = $(this).closest('.product');
                    updateSubTotal(productDiv);
                });
                $(document).on('input', '.quantity-input, #invoice_tax', function() {
                    updateSubTotal($(this).closest('.product'));
                    calculateInvoiceTotals();
                });

                function updateSubTotal(productDiv) {
                    var price = parseFloat(productDiv.find('.price-input').val()) || 0;
                    var quantity = parseFloat(productDiv.find('.quantity-input').val()) || 0;
                    var subTotal = price * quantity;
                    productDiv.find('.subtotal-input').val(subTotal.toFixed(2));
                }

            }

            function calculateInvoiceTotals() {
                let subtotal = 0;

                // Calculate the subtotal by summing up each product's subtotal
                $('.product').each(function() {
                    let subTotal = parseFloat($(this).find('.subtotal-input').val()) || 0;
                    subtotal += subTotal;
                });

                // Set the calculated subtotal value in the subtotal field
                $('#invoice_subtotal').val(subtotal.toFixed(2));

                // Calculate the tax as 13% of the subtotal
                let tax = subtotal * 0.13;

                // Set the tax value in the tax field (if you want to display it somewhere)
                $('#invoice_tax').val(tax.toFixed(2));

                // Calculate the grand total
                let grandTotal = subtotal + tax;

                // Set the grand total value in the grand total field
                $('#invoice_grand_total').val(grandTotal.toFixed(2));
            }

            function updateSubTotal(productDiv) {
                var price = parseFloat(productDiv.find('.price-input').val()) || 0;
                var quantity = parseFloat(productDiv.find('.quantity-input').val()) || 0;
                var subTotal = price * quantity;
                productDiv.find('.subtotal-input').val(subTotal.toFixed(2));
            }

            $(document).ready(function() {
                $('#customer').change(function() {
                    $('.product-select').trigger('change');
                });

                $('.product-select').change(function() {
                    updatePrice();
                });

                $(document).on('input', '.quantity-input', function() {
                    updateSubTotal($(this).closest('.product'));
                });

                updatePrice();
            });

            window.addProduct = function() {
                var index = $('.product').length;

                var newProductHtml = `
             <div class="row product">
                   <div class="col-lg-4 col-md-6">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold mb-2">
                        <span class="required">Product</span>
                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="" data-bs-original-title="Country of origination" data-kt-initialized="1">
                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </span>
                    </label>
                    <select name="products[${index}][id]" class="form-select form-select-solid fw-bold product-select">
                        <option value="">Select Product...</option>
                    </select>
                    @error('products.${index}.id')
                        <span class="text-danger">Product Required</span>
                    @enderror
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
            </div>
             <div class="col-lg-2 col-md-6">
                <div class="fv-row mb-7">
                    <label class="form-label">Price</label>
                    <input type="text" name="products[${index}][price]" class="form-control mb-2 price-input" placeholder="Price..." value="0" readonly>
                    @error('products.${index}.price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="fv-row mb-7">
                    <label class="required form-label">Quantity</label>
                    <input type="tel" name="products[${index}][quantity]" class="form-control mb-2 quantity-input" placeholder="Quantity..." value="">
                    @error('products.${index}.quantity')
                        <span class="text-danger">Product Quantity is Required</span>
                    @enderror
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="fv-row mb-7">
                    <label class="form-label">Amount</label>
                    <input type="tel" name="products[${index}][amount]" class="form-control mb-2 subtotal-input" placeholder="SubTotal..." value="0" readonly>
                    @error('products.${index}.amount')
                        <span class="text-danger">Amount is Required</span>
                    @enderror
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
            </div>
             <div class="col-auto" style="margin-top : 25px;">
            <button type="button" class="btn btn-danger remove-product" onclick="removeProduct(this)">X</button>
        </div>
        </div> `;

                $('#products').append(newProductHtml);

                var customerId = $('#customer').val();
                if (customerId) {
                    var selectedProductIds = getSelectedProductIds();
                    $.ajax({
                        url: '{{ route('get.products') }}',
                        method: 'GET',
                        data: {
                            customer_id: customerId,
                            selected_products: selectedProductIds 

                        },
                        success: function(response) {
                            var productSelect = $('#products .product-select:last');
                            productSelect.empty();
                            productSelect.append('<option value="">Select Product...</option>');

                            $.each(response.products, function(key, product) {
                                productSelect.append('<option value="' + product.Id +
                                    '" data-price="' + product.UnitPrice + '">' +
                                    product.Name + '</option>');
                            });

                            updatePrice();
                        },
                        error: function() {
                            alert('Failed to retrieve products');
                        }
                    });
                }

                updatePrice();
                calculateInvoiceTotals();

            };
            window.removeProduct = function(button) {
    $(button).closest('.product').remove();
}
        });
    </script>
@endpush
