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
                        Edit Favourite Customer Product </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>

                        <li class="breadcrumb-item text-muted">
                            Favourites Products </li>
                        <li class="breadcrumb-item text-dark">
                            Favourite Product </li>

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

                <form action="{{ route('update.customer.product', ['customer' => $customer->Id, 'product' => $product->Id]) }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->Id}}">
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 w-lg-100 gap-lg-12">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Favourite Product</h2>
                                </div>
                            </div>
                            <!--end::Card header-->


                            <!--begin::Card body-->
                            <div class="card-body pt-0">

                                <!--begin::Col-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" name="product" class="form-control mb-2"
                                            placeholder="Product Name..." value="{{ $product->Name }}" readonly>
                                        <!--end::Input-->

                                        @error('product_id')
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
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product Price </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" id="product_price" name="product_price"
                                            class="form-control mb-2" placeholder="Product Price ..."
                                            value="{{ $product->UnitPrice }}" readonly>
                                        <!--end::Input-->

                                        @error('product_price')
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
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product Cost </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" id="product_cost" name="product_cost"
                                            class="form-control mb-2" placeholder="Product Cost ..."
                                            value="{{ $product->PurchaseCost }}" readonly>
                                        <!--end::Input-->

                                        @error('product_cost')
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
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product Assigned Price </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" id="assign_price" name="assign_price"
                                            class="form-control mb-2" placeholder="Assigned Price ..."
                                            value="{{ $myProduct->assign_price }}">
                                        <!--end::Input-->

                                        @error('assign_price')
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
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required form-label">Profit </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" id="profit" name="profit" class="form-control mb-2"
                                            placeholder="Product Profit ..." value="{{ $myProduct->profit }}" readonly>
                                        <!--end::Input-->

                                        @error('profit')
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
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" form-label">Pack</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" id="quantity" name="quantity" class="form-control mb-2"
                                            placeholder="Product Pack ..." value="{{ $myProduct->quantity ?? ""}}" >
                                        <!--end::Input-->

                                        {{-- @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->

                            </div>
                            <!--end::Card body-->



                        </div>
                        <!--end::Main column-->
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
            $('#assign_price').on('input', function() {
                var productCost = parseFloat($('#product_cost').val()) || 0;
                var assignPrice = parseFloat($(this).val()) || 0;
                 // Calculate the profit percentage
                 let profit = 0;
                if (productCost > 0) {
                    profit = ((assignPrice - productCost) / productCost) * 100;
                }
                // var profit = productPrice - assignPrice;
                $('#profit').val(profit.toFixed(2) + '%'); // Format the profit to 2 decimal places
            });
    
            // Initial calculation in case there's already an assign price
            $('#assign_price').trigger('input');
        });
    </script>
@endpush
