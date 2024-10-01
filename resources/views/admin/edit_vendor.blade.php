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
                        Edit Vendor </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="../../../index.html" class="text-muted text-hover-primary">
                                Home </a>
                        </li>

                        <li class="breadcrumb-item text-muted">
                            Store Management </li>
                        <li class="breadcrumb-item text-muted">
                            Vendor & Manufacturer </li>

                        <li class="breadcrumb-item text-dark">
                            Edit Vendor </li>

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
                {{-- <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"> --}}
                <form action="{{ route('update.vendor', $vendor->id) }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Image</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                <style>
                                    .image-input-placeholder {
                                        background-image: url({{ asset('storage/vendorImages/' . $vendor->image) }});
                                    }

                                    [data-bs-theme="dark"] .image-input-placeholder {
                                        background-image: url('../../../assets/media/svg/files/blank-image-dark.svg');
                                    }
                                </style>
                                <!--end::Image input placeholder-->

                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                    data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::Preview existing avatar-->

                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        aria-label="Change avatar" data-bs-original-title="Change avatar"
                                        data-kt-initialized="1">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                                class="path2"></span></i> <!--end::Icon-->

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="avatar_remove">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
                                        data-kt-initialized="1">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </span>
                                    <!--end::Cancel-->

                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        aria-label="Remove avatar" data-bs-original-title="Remove avatar"
                                        data-kt-initialized="1">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the Vendor image image. Only *.png, *.jpg and *.jpeg
                                    image files are accepted</div>
                                <!--end::Description-->
                            </div>

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        <!--begin::Status-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Status</h2>
                                </div>
                                <!--end::Card title-->

                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px"
                                        id="kt_ecommerce_add_category_status"></div>
                                </div>
                                <!--begin::Card toolbar-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select2-->
                                <select class="form-select mb-2 select2-hidden-accessible" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select an option"
                                    id="kt_ecommerce_add_category_status_select"
                                    data-select2-id="select2-data-kt_ecommerce_add_category_status_select" tabindex="-1"
                                    aria-hidden="true" data-kt-initialized="1">
                                    <option></option>
                                    <option value="published" selected="" data-select2-id="select2-data-8-mr9b">Published
                                    </option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="unpublished">Unpublished</option>
                                </select><span class="select2 select2-container select2-container--bootstrap5"
                                    dir="ltr" data-select2-id="select2-data-7-i8km" style="width: 100%;"><span
                                        class="selection"><span
                                            class="select2-selection select2-selection--single form-select mb-2"
                                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false"
                                            aria-labelledby="select2-kt_ecommerce_add_category_status_select-container"
                                            aria-controls="select2-kt_ecommerce_add_category_status_select-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-kt_ecommerce_add_category_status_select-container"
                                                role="textbox" aria-readonly="true"
                                                title="Published">Published</span><span class="select2-selection__arrow"
                                                role="presentation"><b role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category status.</div>
                                <!--end::Description-->

                                <!--begin::Datepicker-->
                                <div class="d-none mt-10">
                                    <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select
                                        publishing date and time</label>
                                    <input class="form-control flatpickr-input"
                                        id="kt_ecommerce_add_category_status_datepicker"
                                        placeholder="Pick date &amp; time" type="text" readonly="readonly">
                                </div>
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Status-->
                        <!--begin::Template settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Store Template</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select store template-->
                                <label for="kt_ecommerce_add_category_store_template" class="form-label">Select a store
                                    template</label>
                                <!--end::Select store template-->

                                <!--begin::Select2-->
                                <select class="form-select mb-2 select2-hidden-accessible" data-control="select2"
                                    data-hide-search="true" data-placeholder="Select an option"
                                    id="kt_ecommerce_add_category_store_template"
                                    data-select2-id="select2-data-kt_ecommerce_add_category_store_template" tabindex="-1"
                                    aria-hidden="true" data-kt-initialized="1">
                                    <option></option>
                                    <option value="default" selected="" data-select2-id="select2-data-10-ungh">Default
                                        template</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="office">Office stationary</option>
                                    <option value="fashion">Fashion</option>
                                </select><span class="select2 select2-container select2-container--bootstrap5"
                                    dir="ltr" data-select2-id="select2-data-9-ljhz" style="width: 100%;"><span
                                        class="selection"><span
                                            class="select2-selection select2-selection--single form-select mb-2"
                                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false"
                                            aria-labelledby="select2-kt_ecommerce_add_category_store_template-container"
                                            aria-controls="select2-kt_ecommerce_add_category_store_template-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-kt_ecommerce_add_category_store_template-container"
                                                role="textbox" aria-readonly="true" title="Default template">Default
                                                template</span><span class="select2-selection__arrow"
                                                role="presentation"><b role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                <!--end::Select2-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Assign a template from your current theme to define how the
                                    category products are displayed.</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Template settings-->
                    </div>
                    <!--end::Aside column--> --}}

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
                                    <label class="required form-label"> Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="name" class="form-control mb-2" placeholder="Vendor name"
                                        value="{{ $vendor->name }}">
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
                                        placeholder="Vendor email" value="{{ $vendor->email }}">
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
                                    <label class=" form-label"> Address</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="address" class="form-control mb-2"
                                        placeholder="Vendor address" value="{{ $vendor->address }}">
                                    <!--end::Input-->

                                    @error('address')
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
                            {{-- <!--begin::Button-->
                            <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                Cancel
                            </a>
                            <!--end::Button--> --}}

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
