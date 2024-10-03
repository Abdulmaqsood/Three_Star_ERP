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
                        Edit Product </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Home </a>
                        </li>

                        <li class="breadcrumb-item text-muted">
                            Store Management </li>

                        <li class="breadcrumb-item text-muted">
                            Products </li>

                        <li class="breadcrumb-item text-dark">
                            Edit Product </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->


            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class=" container-fluid ">
                <!--begin::Form-->
                <form action="{{ route('update.product', $product->Id) }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    @php
                        $myProduct = App\Models\Product::where('quickbook_id', $product->Id)
                            ->with('category', 'subCategory', 'vendor', 'manufacturer')
                            ->first();
                    @endphp
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                        <!--begin::Category & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Add Category</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <!--begin::Label-->
                                <label class="required form-label">Categories</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <select name="category_id" data-placeholder="Select a Category..."
                                    class="form-select form-select-solid fw-bold ">
@if ($categories)
    <option value="">Select main category...</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            @if (isset($myProduct) && optional($myProduct->category)->id == $category->id) selected @endif>
            {{ $category->name }}
        </option>
    @endforeach
@else
    <option disabled>Main Category Not available...</option>
@endif



                                </select>
                                <!--end::Input-->
                                @error('category_id')
                                    <span class="text-danger">Category Required</span>
                                @enderror
                                <!--end::Input group-->
                                <!--begin::Button-->
                                <a href="{{ route('add.category') }}" class="btn btn-light-primary btn-sm mb-10 mt-3">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create main category
                                </a>
                                <!--end::Button-->
                                <!--begin::Label-->
                                <label class=" form-label">SubCategories</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="sub_category_id" data-placeholder="Select a Category..."
                                    class="form-select form-select-solid fw-bold ">
@if ($sub_categories)
    <option value="">Select subCategory...</option>
    @foreach ($sub_categories as $category)
        <option value="{{ $category->id }}"
            @if (isset($myProduct) && optional($myProduct->subCategory)->id == $category->id) selected @endif>
            {{ $category->name }}
        </option>
    @endforeach
@else
    <option disabled>SubCategory Not available...</option>
@endif



                                </select>
                                <!--end::Input-->
                                @error('sub_category_id')
                                    <span class="text-danger">SubCategory Required</span>
                                @enderror
                                <!--end::Input group-->

                                <!--begin::Button-->
                                <a href="{{ route('add.subCategory') }}" class="btn btn-light-primary btn-sm mb-10 mt-3">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create subCategory
                                </a>
                                <!--end::Button-->

                          
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Category & tags-->
                        <!--begin::Category & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Vendor Detail</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <!--begin::Label-->
                                <label class=" form-label">Vendors</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <select name="vendor_id" data-placeholder="Select a Country..."
                                    class="form-select form-select-solid fw-bold ">
@if ($vendors)
    <option value="">Select vendors...</option>
    @foreach ($vendors as $vendor)
        <option value="{{ $vendor->id }}"
            @if (isset($myProduct) && optional($myProduct->vendor)->id == $vendor->id) selected @endif>
            {{ $vendor->name }}
        </option>
    @endforeach
@else
    <option disabled>Vendors Not available...</option>
@endif



                                </select>
                                <!--end::Input-->
                                @error('vendor_id')
                                    <span class="text-danger">Vendor Required</span>
                                @enderror


                                <!--end::Input group-->

                                <!--begin::Button-->
                                <a href="{{ route('add.vendor') }}" class="btn btn-light-primary btn-sm mb-10 mt-3">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new Vendor
                                </a>
                                <!--end::Button-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class=" form-label">Vendor Code</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="vendor_code" class="form-control mb-2"
                                        placeholder="Vendor Code..." value="{{ $myProduct->vendor_code ?? ""}}">
                                    <!--end::Input-->

                                    @error('vendor_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Label-->
                                <label class=" form-label">Manufacturer</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <select name="manufacturer_id" data-placeholder="Select a Country..."
                                    class="form-select form-select-solid fw-bold ">
@if ($manufacturers)
    <option value="">Select manufacturers...</option>
    @foreach ($manufacturers as $manufacturer)
        <option value="{{ $manufacturer->id }}"
            @if (isset($myProduct) && optional($myProduct->manufacturer)->id == $manufacturer->id) selected @endif>
            {{ $manufacturer->name }}
        </option>
    @endforeach
@else
    <option disabled>Manufacturer Not available...</option>
@endif



                                </select>
                                <!--end::Input-->
                                @error('manufacturer_id')
                                    <span class="text-danger">Manufacturer Required</span>
                                @enderror


                                <!--end::Input group-->

                                <!--begin::Button-->
                                <a href="{{ route('add.manufacturer') }}" class="btn btn-light-primary btn-sm mb-10 mt-3">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new Manufacturer
                                </a>
                                <!--end::Button-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class=" form-label">Manufacturer Code</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="manufacturer_code" class="form-control mb-2"
                                        placeholder="Manufacturer Code..." value="{{ $myProduct->manufacturer_code ?? ""}}">
                                    <!--end::Input-->

                                    @error('manufacturer_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Category & tags-->
                       
                    </div>
                    <!--end::Aside column-->

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
                            role="tablist">
                            <!--begin:::Tab item-->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab">Product
                                    Details</a>
                            </li>
                            <!--end:::Tab item-->

                        

                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">

                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Product Details</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="required form-label">SKU</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="sku" class="form-control mb-2"
                                                    placeholder="Product SKU" value="{{ old('sku',$product->Sku) }}">
                                                <!--end::Input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">A product sku is required and recommended to
                                                    be unique.</div>
                                                <!--end::Description-->
                                                @error('sku')
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
                                                <label class="required form-label"> Name</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="name" class="form-control mb-2"
                                                    placeholder="Product name" value="{{ old('name',$product->Name)}}">
                                                <!--end::Input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">A product name is required and recommended to
                                                    be unique.</div>
                                                <!--end::Description-->
                                                @error('name')
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
                                                <label class="required form-label"> Price</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" id="price" name="price"
                                                    class="form-control mb-2" placeholder="Product price"
                                                    value="{{ $product->UnitPrice }}">
                                                <!--end::Input-->
                                                @error('price')
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
                                                <label class="required form-label"> Cost</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" id="cost" name="cost"
                                                    class="form-control mb-2" placeholder="Product cost"
                                                    value="{{ $product->PurchaseCost }}">
                                                <!--end::Input-->
                                                @error('cost')
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
                                                <label class="required form-label"> Profit</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" id="profit" name="profit"
                                                    class="form-control mb-2" placeholder="Product profit"
                                                    value="{{ old('profit',$myProduct->profit ?? '')  }}" readonly>
                                                <!--end::Input-->

                                                @error('profit')
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
                                                <label class=" form-label"> Pack</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" id="pack" name="pack"
                                                    class="form-control mb-2" placeholder="Product pack"
                                                    value="{{ old('pack',$myProduct->pack ?? '') }}">
                                                <!--end::Input-->

                                                @error('pack')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                 

                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                 
                                </div>
                            </div>
                            <!--end::Tab pane-->


                        </div>
                        <!--end::Tab content-->

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('products') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">
                                Cancel
                            </a>
                            <!--end::Button-->

                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
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
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // Function to calculate and update profit percentage
            function calculateProfitPercentage() {
                // Get the price and cost values
                var price = parseFloat($('#price').val()) || 0;
                var cost = parseFloat($('#cost').val()) || 0;

                // Calculate the profit percentage
                var profitPercentage = (price - cost) / price * 100;

                // Update the profit input field
                $('#profit').val(profitPercentage.toFixed(2) + '%');
            }

            // Add event listeners to price and cost inputs
            $('#price, #cost').on('input', function() {
                calculateProfitPercentage();
            });
        });
    </script>
@endpush
