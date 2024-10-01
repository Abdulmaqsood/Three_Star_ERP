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
                        Users List
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('all.users') }}" class="text-muted text-hover-primary">
                                User Management </a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('all.users') }}" class="text-muted text-hover-primary">
                                Users </a>
                        </li>
                        <li class="breadcrumb-item text-dark">
                            Users List
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->
                {{-- <!--begin::Actions-->
              <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                 <a href="#" class="btn bg-body btn-color-gray-700 btn-active-primary me-4"  data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                 Invite Friends
                 </a>
                 <a href="#" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_project" id="kt_toolbar_primary_button">
                 New Project                </a>
              </div>
              <!--end::Actions--> --}}
            </div>
        </div>
        <!--end::Toolbar-->


        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class=" container-fluid">
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
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span
                                        class="path1"></span><span class="path2"></span></i> <input type="text"
                                    data-kt-customer-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Search Users">
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                {{-- <!--begin::Filter-->
                                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> Filter
                                    </button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                        id="kt-toolbar-filter">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
    
                                        <!--begin::Separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Separator-->
    
                                        <!--begin::Content-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                                <!--end::Label-->
    
                                                <!--begin::Input-->
                                                <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                                    data-kt-select2="true" data-placeholder="Select option"
                                                    data-allow-clear="true" data-kt-customer-table-filter="month"
                                                    data-dropdown-parent="#kt-toolbar-filter"
                                                    data-select2-id="select2-data-7-r8x8" tabindex="-1" aria-hidden="true"
                                                    data-kt-initialized="1">
                                                    <option data-select2-id="select2-data-9-nbe6"></option>
                                                    <option value="aug">August</option>
                                                    <option value="sep">September</option>
                                                    <option value="oct">October</option>
                                                    <option value="nov">November</option>
                                                    <option value="dec">December</option>
                                                </select><span class="select2 select2-container select2-container--bootstrap5"
                                                    dir="ltr" data-select2-id="select2-data-8-v0mn"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-n8dv-container"
                                                            aria-controls="select2-n8dv-container"><span
                                                                class="select2-selection__rendered" id="select2-n8dv-container"
                                                                role="textbox" aria-readonly="true" title="Select option"><span
                                                                    class="select2-selection__placeholder">Select
                                                                    option</span></span><span class="select2-selection__arrow"
                                                                role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
    
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fs-5 fw-semibold mb-3">Payment Type:</label>
                                                <!--end::Label-->
    
                                                <!--begin::Options-->
                                                <div class="d-flex flex-column flex-wrap fw-semibold"
                                                    data-kt-customer-table-filter="payment_type">
                                                    <!--begin::Option-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                            value="all" checked="checked">
                                                        <span class="form-check-label text-gray-600">
                                                            All
                                                        </span>
                                                    </label>
                                                    <!--end::Option-->
    
                                                    <!--begin::Option-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                            value="visa">
                                                        <span class="form-check-label text-gray-600">
                                                            Visa
                                                        </span>
                                                    </label>
                                                    <!--end::Option-->
    
                                                    <!--begin::Option-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                            value="mastercard">
                                                        <span class="form-check-label text-gray-600">
                                                            Mastercard
                                                        </span>
                                                    </label>
                                                    <!--end::Option-->
    
                                                    <!--begin::Option-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                            value="american_express">
                                                        <span class="form-check-label text-gray-600">
                                                            American Express
                                                        </span>
                                                    </label>
                                                    <!--end::Option-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
    
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-customer-table-filter="reset">Reset</button>
    
                                                <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                                    data-kt-customer-table-filter="filter">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Menu 1--> <!--end::Filter--> --}}

                                {{-- <!--begin::Export-->
                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#kt_customers_export_modal">
                                        <i class="ki-duotone ki-exit-up fs-2"><span class="path1"></span><span
                                                class="path2"></span></i> Export
                                    </button>
                                    <!--end::Export--> --}}

                                {{-- <!--begin::Add customer-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_customer">
                                        Add Customer
                                    </button>
                                    <!--end::Add customer--> --}}
                                <!--begin::Add user-->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_add_user">
                                    <i class="ki-duotone ki-plus fs-2"></i> Add User
                                </button>
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->

                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-customer-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2" data-kt-customer-table-select="selected_count"></span> Selected
                                </div>

                                <button type="button" class="btn btn-danger"
                                    data-kt-customer-table-select="delete_selected">
                                    Delete Selected
                                </button>
                            </div>
                            <!--end::Group actions-->
                            <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px" role="document">

                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_user_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">Add User</h2>
                                            <!--end::Modal title-->

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-kt-users-modal-action="close">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->

                                        <!--begin::Modal body-->
                                        <div class="modal-body px-5 my-7">
                                            <!--begin::Form-->
                                            <form id="kt_modal_add_user_form"
                                                class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                                action="{{ route('admin.create') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <!--begin::Scroll-->
                                                <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                    id="kt_modal_add_user_scroll" data-kt-scroll="true"
                                                    data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                                                    data-kt-scroll-offset="300px" style="max-height: 140px;">
                                                    {{-- <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                                                        <!--end::Label-->


                                                        <!--begin::Image placeholder-->
                                                        <style>
                                                            .image-input-placeholder {
                                                                background-image: url('../../../assets/media/svg/files/blank-image.svg');
                                                            }

                                                            [data-bs-theme="dark"] .image-input-placeholder {
                                                                background-image: url('../../../assets/media/svg/files/blank-image-dark.svg');
                                                            }
                                                        </style>
                                                        <!--end::Image placeholder-->
                                                        <!--begin::Image input-->
                                                        <div class="image-input image-input-outline image-input-placeholder"
                                                            data-kt-image-input="true">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-125px h-125px"
                                                                style="background-image: url(../../../assets/media/avatars/300-6.jpg);">
                                                            </div>
                                                            <!--end::Preview existing avatar-->

                                                            <!--begin::Label-->
                                                            <label
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="change"
                                                                data-bs-toggle="tooltip" aria-label="Change avatar"
                                                                data-bs-original-title="Change avatar"
                                                                data-kt-initialized="1">
                                                                <i class="ki-duotone ki-pencil fs-7"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i>
                                                                <!--begin::Inputs-->
                                                                <input type="file" name="image"
                                                                    accept=".png, .jpg, .jpeg">

                                                                <input type="hidden" name="avatar_remove">
                                                                <!--end::Inputs-->
                                                            </label>
                                                            <!--end::Label-->

                                                            <!--begin::Cancel-->
                                                            <span
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="cancel"
                                                                data-bs-toggle="tooltip" aria-label="Cancel avatar"
                                                                data-bs-original-title="Cancel avatar"
                                                                data-kt-initialized="1">
                                                                <i class="ki-duotone ki-cross fs-2"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </span>
                                                            <!--end::Cancel-->

                                                            <!--begin::Remove-->
                                                            <span
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="remove"
                                                                data-bs-toggle="tooltip" aria-label="Remove avatar"
                                                                data-bs-original-title="Remove avatar"
                                                                data-kt-initialized="1">
                                                                <i class="ki-duotone ki-cross fs-2"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </span>
                                                            <!--end::Remove-->
                                                        </div>
                                                        <!--end::Image input-->
                                                        <span class="text-danger" id="avatar-error"></span>

                                                        <!--begin::Hint-->
                                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                                        <!--end::Hint-->
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input group--> --}}

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="name"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="Full name" value="{{old('name')}}">
                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="email" name="email"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="example@domain.com" value="{{old('email')}}">
                                                        <!--end::Input-->
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="mb-5">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-5">Role</label>
                                                        <!--end::Label-->

                                                        <!--begin::Roles-->
                                                        <!--begin::Input row-->
                                                        <div class="d-flex fv-row">
                                                            <!--begin::Radio-->
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <!--begin::Input-->
                                                                <input class="form-check-input me-3" name="role"
                                                                    type="radio" value="super_admin"
                                                                    id="kt_modal_update_role_option_0" checked="checked">
                                                                <!--end::Input-->

                                                                <!--begin::Label-->
                                                                <label class="form-check-label"
                                                                    for="kt_modal_update_role_option_0">
                                                                    <div class="fw-bold text-gray-800">Super Admin</div>
                                                                    <div class="text-gray-600">Have System Access to Modify
                                                                        Anything</div>
                                                                </label>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Radio-->
                                                        </div>
                                                        <!--end::Input row-->

                                                        <div class="separator separator-dashed my-5"></div>
                                                        <!--begin::Input row-->
                                                        <div class="d-flex fv-row">
                                                            <!--begin::Radio-->
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <!--begin::Input-->
                                                                <input class="form-check-input me-3" name="role"
                                                                    type="radio" value="admin"
                                                                    id="kt_modal_update_role_option_1">
                                                                <!--end::Input-->

                                                                <!--begin::Label-->
                                                                <label class="form-check-label"
                                                                    for="kt_modal_update_role_option_1">
                                                                    <div class="fw-bold text-gray-800">Admin</div>
                                                                    <div class="text-gray-600">Have Limited Access in
                                                                        system</div>
                                                                </label>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Radio-->
                                                        </div>
                                                        <!--end::Input row-->
                                                        <div class="separator separator-dashed my-5"></div>

                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <!--begin::Label-->
                                                            <label class="required fw-semibold fs-6 mb-2">Password</label>
                                                            <!--end::Label-->

                                                            <!--begin::Input-->
                                                            <input type="password" name="password"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="********">
                                                            <!--end::Input-->
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                            <!--begin::Label-->
                                                            <label class="required fw-semibold fs-6 mb-2">Password
                                                                Confirmation</label>
                                                            <!--end::Label-->

                                                            <!--begin::Input-->
                                                            <input type="password" name="password_confirmation"
                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                placeholder="********">
                                                            <!--end::Input-->
                                                            <div
                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                            </div>
                                                            @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--end::Roles-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Scroll-->

                                                <!--begin::Actions-->
                                                <div class="text-center pt-10">
                                                    <button type="reset" class="btn btn-light me-3"
                                                        data-kt-users-modal-action="cancel">
                                                        Discard
                                                    </button>

                                                    <button type="submit" class="btn btn-primary"
                                                        data-kt-users-modal-action="submit">
                                                        <span class="indicator-label">
                                                            Submit
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Please wait... <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    {{-- <th class="min-w-125px">Image</th> --}}
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Role</th>
                                    <th class="min-w-125px">Joinned Date</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="text-gray-600 fw-semibold">
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            {{-- <td class="d-flex align-items-center">
                                                <!--begin:: Avatar -->
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="{{ route('admin.view', $user->id) }}">
                                                        <div class="symbol-label">
                                                            <img src="{{ asset('storage/adminImages/' . $user->image) }}"
                                                                alt="User image" class="w-100" />
                                                        </div>

                                                    </a>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('admin.view', $user->id) }}"
                                                        class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                                </div>
                                                <!--begin::User details-->
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('admin.view', $user->id) }}"
                                                    style="color: inherit; text-decoration: none;">
                                                    {{ $user->name }}
                                                </a>

                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->role == 'super_admin')
                                                    Super Admin
                                                @endif
                                                @if ($user->role == 'admin')
                                                    Admin
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at }}</td>

                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-user-id="{{ $user->id }}"
                                                            class="menu-link px-3 edit-user-btn">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.delete', $user->id) }}"
                                                            class="menu-link px-3">
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                            <td></td>

                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        <!--end::Table-->
                        @if ($errors->updateInfo->any())
                            <script>
                                $(document).ready(function() {
                                    $('#kt_modal_update_details').modal('show');
                                });
                            </script>
                        @endif
                        <!--begin::Modal - Update user details-->
                        <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Form-->
                                    <form id="kt_modal_update_user_form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_update_user_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bold">Update User Details</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-kt-users-modal-action="close"> <i
                                                    class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                        class="path2"></span></i> </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body py-10 px-lg-17">
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                                id="kt_modal_update_user_scroll" data-kt-scroll="true"
                                                data-kt-scroll-activate="{default: false, lg: true}"
                                                data-kt-scroll-max-height="auto"
                                                data-kt-scroll-dependencies="#kt_modal_update_user_header"
                                                data-kt-scroll-wrappers="#kt_modal_update_user_scroll"
                                                data-kt-scroll-offset="300px">
                                                <!--begin::User toggle-->
                                                <div class="fw-bolder fs-3 rotate collapsible mb-7"
                                                    data-bs-toggle="collapse" href="#kt_modal_update_user_user_info"
                                                    role="button" aria-expanded="false"
                                                    aria-controls="kt_modal_update_user_user_info"> User Information <span
                                                        class="ms-2 rotate-180"> <i class="ki-duotone ki-down fs-3"></i>
                                                    </span>
                                                </div>
                                                <!--end::User toggle-->
                                                <!--begin::User form-->
                                                <div id="kt_modal_update_user_user_info" class="collapse show">
                                                    {{-- <!--begin::Input group-->
                                                    <div class="mb-7">
                                                        <!--begin::Label--> <label class="fs-6 fw-semibold mb-2">
                                                            <span>Update
                                                                Avatar</span> <span class="ms-1"
                                                                data-bs-toggle="tooltip"
                                                                title="Allowed file types: png, jpg, jpeg."> <i
                                                                    class="ki-duotone ki-information fs-7"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i> </span> </label>
                                                        <!--end::Label-->
                                                        <!--begin::Image input wrapper-->
                                                        <div class="mt-1">
                                                            <!--begin::Image placeholder-->
                                                            <style>
                                                                .image-input-placeholder {
                                                                    background-image: url('../../../assets/media/svg/avatars/blank.svg');
                                                                }

                                                                [data-bs-theme="dark"] .image-input-placeholder {
                                                                    background-image: url('../../../assets/media/svg/avatars/blank-dark.svg');
                                                                }
                                                            </style>
                                                            <!--end::Image placeholder-->
                                                            <!--begin::Image input-->
                                                            <div class="image-input image-input-outline image-input-placeholder"
                                                                data-kt-image-input="true">
                                                                <!--begin::Preview existing avatar-->
                                                                <div class="image-input-wrapper w-125px h-125px"
                                                                    style="" id="userAvatar">
                                                                </div>
                                                                <!--end::Preview existing avatar-->
                                                                <!--begin::Edit--> <label
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="change"
                                                                    data-bs-toggle="tooltip" title="Change avatar"> <i
                                                                        class="ki-duotone ki-pencil fs-7"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span></i>
                                                                    <!--begin::Inputs--> <input type="file"
                                                                        name="image" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="avatar_remove" />
                                                                    <!--end::Inputs-->
                                                                </label>
                                                                <!--end::Edit-->
                                                                <!--begin::Cancel--><span
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="cancel"
                                                                    data-bs-toggle="tooltip" title="Cancel avatar"> <i
                                                                        class="ki-duotone ki-cross fs-2"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span></i>
                                                                </span>
                                                                <!--end::Cancel-->
                                                                <!--begin::Remove--><span
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="remove"
                                                                    data-bs-toggle="tooltip" title="Remove avatar"> <i
                                                                        class="ki-duotone ki-cross fs-2"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span></i>
                                                                </span>
                                                                <!--end::Remove-->
                                                            </div>

                                                            <!--end::Image input-->
                                                        </div>
                                                        <!--end::Image input wrapper-->
                                                    </div>
                                                    <!--end::Input group--> --}}

                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label--> <label
                                                            class="fs-6 fw-semibold mb-2">Name</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input--> <input type="text"
                                                            class="form-control form-control-solid" placeholder=""
                                                            id="name" name="name" value="" />
                                                        <!--end::Input-->
                                                    </div>
                                                    @error('name', 'updateInfo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label--> <label class="fs-6 fw-semibold mb-2">
                                                            <span>Email</span> <span class="ms-1"
                                                                data-bs-toggle="tooltip"
                                                                title="Email address must be active"> <i
                                                                    class="ki-duotone ki-information fs-7"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i> </span> </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input--> <input type="email"
                                                            class="form-control form-control-solid" placeholder=""
                                                            name="email" id="email" value="" />
                                                        <!--end::Input-->
                                                    </div>
                                                    @error('email', 'updateInfo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <!--end::Input group-->

                                                </div>

                                            </div>
                                            <!--end::Scroll-->
                                        </div>
                                        <!--end::Modal body-->
                                        <!--begin::Modal footer-->
                                        <div class="modal-footer flex-center">
                                            <!--begin::Button--> <button type="reset" class="btn btn-light me-3"
                                                data-kt-users-modal-action="cancel"> Discard </button>
                                            <!--end::Button-->
                                            <!--begin::Button--> <button type="submit" class="btn btn-primary"> <span
                                                    class="indicator-label"> Submit </span> <span
                                                    class="indicator-progress">
                                                    Please wait... <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Modal footer-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                            </div>
                        </div>
                        <!--end::Modal - Update user details-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

@endsection
@push('custom-scripts')
    <!--begin::Custom Javascript(used for this page only)-->`
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#kt_modal_add_user').modal('show');
            });
        </script>
    @endif
    @if ($errors->updateInfo->any())
        <script>
            $(document).ready(function() {
                $('#kt_modal_update_details').modal('show');
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.edit-user-btn').on('click', function() {
                var userId = $(this).data('user-id');

                // Fetch user data from the server
                $.ajax({
                    url: '/admin/' + userId + '/users/',
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#userRole').val(response.role);
                        $('#kt_modal_update_user_form').attr('action', '/admin/user/' + userId +
                            '/update');
                        var imageUrl = '{{ asset('storage/adminImages/') }}' + '/' + response
                            .image;
                        $('#userAvatar').css('background-image', 'url(' + imageUrl + ')');
                        $('#kt_modal_update_details').modal('show');
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/view.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/update-details.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-schedule.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-task.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/update-email.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/update-password.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/update-role.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-auth-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-one-time-password.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/customers/listing/listing.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/custom/apps/user-management/users/list/custom-user-add.js') }}"></script> --}}
@endpush
