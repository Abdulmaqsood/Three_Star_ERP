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
                        Add Vendor </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary"> Dashboard </a> </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('categories') }}"
                                class="text-muted text-hover-primary"> Store Management </a> </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('vendors') }}"
                                class="text-muted text-hover-primary"> Vendors </a> </li>
                        <li class="breadcrumb-item text-dark"> Add Vendor </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                  
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
                {{-- <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"> --}}
                <form action="{{ route('store.vendor') }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Details</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label"> Display Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control mb-2" placeholder="Vendor name"
                                        value="{{old('name')}}">
                                    <!--end::Input-->

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
                                    <label class=" form-label"> Email</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="email" name="email" class="form-control mb-2"
                                        placeholder="Vendor email" value="{{old('email')}}">
                                    <!--end::Input-->
                                    @error('email')
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
                                    <label class=" form-label">Contact # </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="phone_number" class="form-control mb-2"
                                        placeholder="Vendor contact number" value="{{old('phone_number')}}">
                                    <!--end::Input-->

                                    @error('phone_number')
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

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{URL::previous()}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                Cancel
                            </a>
                            <!--end::Button-->

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
