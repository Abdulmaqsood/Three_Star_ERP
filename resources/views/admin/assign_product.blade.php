@extends('layout.master')

@section('content')
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">
                        Assign User Product </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>

                        <li class="breadcrumb-item text-muted">
                            Assigned Products </li>
                        <li class="breadcrumb-item text-dark">
                            Assign Product </li>

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

                <form action="{{ route('store.customer.product') }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 w-lg-100 gap-lg-12">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Assign Product</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Label-->
                                    <label class="required form-label">Customer</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <select name="customer_id" data-placeholder="Select a Customer..."
                                        class="form-select form-select-solid fw-bold ">
                                        @if ($customers)
                                            <option value="null">Select Customer ...
                                            </option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->first_name }}
                                                    {{ $customer->last_name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled>Customer Not available...
                                            </option>
                                        @endif


                                    </select>
                                    <!--end::Input-->
                                    @error('customer_id')
                                        <span class="text-danger">Customer Required</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->
                                <!-- Product Selection -->
                                <div class="card-body pt-0">
                                    <label class="required form-label">Products</label>
                                    <select name="product_id[]" data-placeholder="Select a Product..."
                                        class="form-select form-select-solid fw-bold" multiple>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-name="{{ $product->name }}">
                                                {{ $product->name }} -
                                                Rs.{{ $product->price }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <span class="text-danger">Products Required</span>
                                    @enderror
                                </div>

                                <!-- Assign Price Inputs -->
                                <div id="priceInputs">

                                </div>

                                {{-- <!-- Assign Cost Input -->
                                <div class="card-body pt-0">
                                    <label class="required form-label">Assign Cost</label>
                                    <input type="text" name="assign_price" class="form-control mb-2"
                                        placeholder="Assign Price" value="">
                                    @error('assign_price')
                                        <span class="text-danger">Price Required/Invalid</span>
                                    @enderror
                                </div> --}}
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->

                        <div class="d-flex justify-content-end">


                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    Save Changes
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
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
        // JavaScript to handle dynamic price inputs based on selected products
        $(document).ready(function() {
            // Initialize Select2 for product selection
            $('select[name="product_id[]"]').select2({
                placeholder: "Select Products...",
            });

            // Handle change event for product selection
            $('select[name="product_id[]"]').on('change', function() {
                var selectedProducts = $(this).val();
                var priceInputsHtml = '';

                // Clear existing price inputs
                $('#priceInputs').empty();

                // Generate input fields for each selected product
                if (selectedProducts) {
                    selectedProducts.forEach(function(productId) {
                        // Get the product name from the select element
                        var productName = $('select[name="product_id[]"] option[value="' +
                            productId + '"]').text().trim();

                        priceInputsHtml += '<div class="card-body pt-0">';
                        priceInputsHtml += '<label class="required form-label">Assign Cost for ' +
                            productName + '</label>';
                        priceInputsHtml += '<input type="text" name="product_prices[' + productId +
                            ']" class="form-control mb-2" placeholder="Assign Price" value="">';
                        priceInputsHtml += '</div>';
                    });
                }

                // Append generated input fields to priceInputs div
                $('#priceInputs').append(priceInputsHtml);

                // Update assigned prices object when inputs are changed
                $('input[name^="product_prices"]').on('input', function() {
                    var productId = $(this).attr('name').match(/\d+/)[0];
                    assignedPrices[productId] = $(this).val();
                });
            });
        });
    </script>
@endpush
