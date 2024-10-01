@extends('layout.master')

@section('content')
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">
                        Add/Edit Company Details
                    </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Company Details</a>
                        </li>
                        <li class="breadcrumb-item text-dark">Add/Edit Company Detail</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go Back</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container-fluid">
                @if (session('success'))
                <!--begin::Alert-->
                <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span
                            class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Title-->
                        <h4 class="fw-semibold">Success</h4>
                        <!--end::Title-->

                        <!--begin::Content-->
                        <span>{{ session('success') }}</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Close-->
                    <button type="button"
                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                        data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span
                                class="path2"></span></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--end::Alert-->
            @endif
            @if (session('error'))
                <!--begin::Alert-->
                <div class="alert alert-dismissible bg-danger-primary d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span
                            class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Title-->
                        <h4 class="fw-semibold">Error</h4>
                        <!--end::Title-->

                        <!--begin::Content-->
                        <span>{{ session('error') }}</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Close-->
                    <button type="button"
                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                        data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span
                                class="path2"></span></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--end::Alert-->
            @endif
                <form action="{{ isset($company->id) ? route('update.company', $company->id) : route('store.company') }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    @if(isset($company->id))
                        @method('PUT')
                    @endif

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Company Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control mb-2"
                                        placeholder="Company Name" value="{{ old('name', $company->name ?? '') }}">
                                    <!--end::Input-->

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Address</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="address" class="form-control mb-2"
                                        placeholder="Address" value="{{ old('address', $company->address ?? '') }}">
                                    <!--end::Input-->

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Contact Number</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="contact_number" class="form-control mb-2"
                                        placeholder="Contact Number" value="{{ old('contact_number', $company->contact_number ?? '') }}">
                                    <!--end::Input-->

                                    @error('contact_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Email</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="email" name="email" class="form-control mb-2"
                                        placeholder="Email" value="{{ old('email', $company->email ?? '') }}">
                                    <!--end::Input-->

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Registration Number</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="registration_number" class="form-control mb-2"
                                        placeholder="Registration Number" value="{{ old('registration_number', $company->registration_number ?? '') }}">
                                    <!--end::Input-->

                                    @error('registration_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">Business Number</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="business_number" class="form-control mb-2"
                                        placeholder="Business Number" value="{{ old('business_number', $company->business_number ?? '') }}">
                                    <!--end::Input-->

                                    @error('business_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::General options-->

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('dashboard') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
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