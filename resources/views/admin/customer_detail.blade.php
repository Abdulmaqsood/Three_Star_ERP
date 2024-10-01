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
                        Customer Details </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('customers') }}" class="text-muted text-hover-primary">
                                Customers </a>
                        </li>
                        <li class="breadcrumb-item text-dark">
                            Customer Details </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                    {{-- <a href="#" class="btn bg-body btn-color-gray-700 btn-active-primary me-4" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_invite_friends">
                        Invite Friends
                    </a> --}}

                    <a href="{{ route('edit.customer', $user->Id) }}" class="btn btn-primary">
                        Edit Customer </a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class=" container-fluid ">
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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">

                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body pt-15">
                                <!--begin::Summary-->
                                <div class="d-flex flex-center flex-column mb-5">
                                    {{-- <!--begin::Avatar-->
                                    <div class="symbol symbol-150px symbol-circle mb-7">
                                        <img src="{{ asset('storage/userImages/' . $user->image) }}" alt="image">
                                    </div>
                                    <!--end::Avatar--> --}}

                                    <!--begin::Name-->
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                        {{ $user->DisplayName ?? ' ' }} </a>
                                    <!--end::Name-->

                                    <!--begin::Email-->
                                    <a href="#" class="fs-5 fw-semibold text-muted text-hover-primary mb-6">
                                        {{ $user->PrimaryEmailAddr->Address ?? '' }} </a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Summary-->

                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold">
                                        Details
                                    </div>

                                    {{-- <!--begin::Badge-->
                                    <div class="badge badge-light-info d-inline">Premium user</div>
                                    <!--begin::Badge--> --}}
                                </div>
                                <!--end::Details toggle-->

                                <div class="separator separator-dashed my-3"></div>

                                <!--begin::Details content-->
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Account ID</div>
                                    <div class="text-gray-600">ID-{{ $user->Id }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Billing Email</div>
                                    <div class="text-gray-600"><a href="#"
                                            class="text-gray-600 text-hover-primary">{{ $user->PrimaryEmailAddr->Address ?? '' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Phone Number</div>
                                    <div class="text-gray-600"><a href="#"
                                            class="text-gray-600 text-hover-primary">{{ $user->PrimaryPhone->FreeFormNumber ?? '' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Mobile Number</div>
                                    <div class="text-gray-600"><a href="#"
                                            class="text-gray-600 text-hover-primary">{{ $user->Mobile->FreeFormNumber ?? '' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Company</div>
                                    <div class="text-gray-600"><a href="#"
                                            class="text-gray-600 text-hover-primary">{{ $user->CompanyName ?? '' }}</a>
                                    </div>
                                    <!--begin::Details item-->
                                    @if ($user->BillAddr)
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5"> Address</div>
                                        <div class="text-gray-600">{{ $user->BillAddr->Line1 }}
                                            ,{{ $user->BillAddr->City }},{{ $user->BillAddr->Country }}
                                        </div>
                                    @endif
                                    <!--begin::Details item-->
                                    {{-- <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Language</div>
                                    <div class="text-gray-600">English</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Latest Transaction</div>
                                    <div class="text-gray-600"><a href="../sales/details.html"
                                            class="text-gray-600 text-hover-primary">#14534</a> </div>
                                    <!--begin::Details item--> --}}
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                        {{-- <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Address Book</h2>
                                </div>
                                <!--end::Card title-->


                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div id="kt_ecommerce_customer_addresses" class="card-body pt-0 pb-5">
                                <div class="accordion accordion-icon-toggle" id="kt_ecommerce_customer_addresses_accordion">
                                    <!--begin::Addresses-->
                                    <!--begin::Address-->
                                    <div class="py-0">
                                        <!--begin::Header-->
                                        <div class="py-3 d-flex flex-stack flex-wrap">
                                            <!--begin::Toggle-->
                                            <div class="accordion-header d-flex align-items-center collapsible rotate collapsed"
                                                data-bs-toggle="collapse" href="#kt_ecommerce_customer_addresses_1"
                                                role="button" aria-expanded="false"
                                                aria-controls="kt_customer_view_payment_method_1">
                                                <!--begin::Arrow-->
                                                <div class="accordion-icon me-3">
                                                    <i class="ki-duotone ki-right fs-4"></i>
                                                </div>
                                                <!--end::Arrow-->

                                                <!--begin::Summary-->
                                                <div class="me-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold">
                                                            {{ $user->Title ?? '' }} </div>
                                                    </div>
                                                    <div class="text-muted">{{ $user->BillAddr->Line1 ?? '' }}</div>
                                                </div>
                                                <!--end::Summary-->
                                            </div>
                                            <!--end::Toggle-->


                                        </div>
                                        <!--end::Header-->

                                        <!--begin::Body-->
                                        <div id="kt_ecommerce_customer_addresses_1" class="fs-6 ps-9 collapse"
                                            data-bs-parent="#kt_ecommerce_customer_addresses_accordion" style="">
                                            <!--begin::Details-->
                                            <div class="d-flex flex-column pb-5">
                                                <div class="fw-bold text-gray-600">
                                                    {{ $user->Title ?? '' }} </div>
                                                <div class="text-muted">
                                                    {{ $user->BillAddr->Line1 ?? '' }},
                                                    {{ $user->BillAddr->Line2 ?? '' }}<br>
                                                    {{ $user->BillAddr->City ?? '' }},<br>
                                                    {{ $user->BillAddr->province ?? '' }} </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Address-->



                                    <!--end::Addresses-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card--> --}}
                          <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Related Invoices</h2>
                                </div>
                                <!--end::Card title-->

                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">

                                <a href="{{ route('show.customer.invoices', $user->Id) }}"
                                    class="btn btn-primary w-100 d-flex justify-content-between align-items-center">
                                    Invoices
                                    <span>
                                        <i class="ki-duotone ki-abstract-28 fs-2x">
                                            <i class="path1"></i>
                                            <i class="path2"></i>
                                        </i>
                                    </span>
                                </a>

                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                        <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Favourite Products</h2>
                                </div>
                                <!--end::Card title-->

                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">

                                <a href="{{ route('all.assigned.products', $user->Id) }}"
                                    class="btn btn-primary w-100 d-flex justify-content-between align-items-center">
                                    Products
                                    <span>
                                        <i class="ki-duotone ki-briefcase fs-2x">
                                            <i class="path1"></i>
                                            <i class="path2"></i>
                                        </i>
                                    </span>
                                </a>

                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->

                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8"
                            role="tablist">
                            <!--begin:::Tab item-->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_ecommerce_customer_general" aria-selected="true" role="tab">General
                                    Settings</a>
                            </li>
                            <!--end:::Tab item-->
                            {{-- <!--begin:::Tab item-->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                    href="#kt_ecommerce_customer_overview" aria-selected="false" role="tab"
                                    tabindex="-1">Products</a>
                            </li>
                            <!--end:::Tab item--> --}}



                            {{-- <!--begin:::Tab item-->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                    href="#kt_ecommerce_customer_advanced" aria-selected="false" role="tab"
                                    tabindex="-1">Advanced Settings</a>
                            </li>
                            <!--end:::Tab item--> --}}
                        </ul>
                        <!--end:::Tabs-->

                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_customer_overview" role="tabpanel">
                                {{-- <div class="row row-cols-1 row-cols-md-2 mb-6 mb-xl-9">
                                    <div class="col">
                                        <!--begin::Card-->
                                        <div class="card pt-4 h-md-100 mb-6 mb-md-0">
                                            <!--begin::Card header-->
                                            <div class="card-header border-0">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <h2 class="fw-bold">Reward Points</h2>
                                                </div>
                                                <!--end::Card title-->
                                            </div>
                                            <!--end::Card header-->

                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="fw-bold fs-2">
                                                    <div class="d-flex">
                                                        <i class="ki-duotone ki-heart text-info fs-2x"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                        <div class="ms-2">
                                                            4,571 <span class="text-muted fs-4 fw-semibold">Points
                                                                earned</span>
                                                        </div>
                                                    </div>
                                                    <div class="fs-7 fw-normal text-muted">Earn reward points with every
                                                        purchase.</div>
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>

                                    <div class="col">
                                        <!--begin::Reward Tier-->
                                        <a href="#" class="card bg-info hoverable h-md-100">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <i class="ki-duotone ki-award text-white fs-3x ms-n1"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i>
                                                <div class="text-white fw-bold fs-2 mt-5">
                                                    Premium Member
                                                </div>

                                                <div class="fw-semibold text-white">
                                                    Tier Milestone Reached
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Reward Tier-->
                                    </div>
                                </div> --}}



                            </div>
                            <!--end:::Tab pane-->

                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade active show" id="kt_ecommerce_customer_general" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Profile</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Form-->
                                        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                                            id="kt_ecommerce_customer_profile">
                                            {{-- <!--begin::Input group-->
                                            <div class="mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span>Update Avatar</span>

                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Allowed file types: png, jpg, jpeg."
                                                        data-bs-original-title="Allowed file types: png, jpg, jpeg."
                                                        data-kt-initialized="1">
                                                        <i class="ki-duotone ki-information fs-7"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i> </span>
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Image input wrapper-->
                                                <div class="mt-1">
                                                    <!--begin::Image input placeholder-->
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url({{ asset('storage/userImages/' . $user->image) }});
                                                        }

                                                        [data-bs-theme="dark"] .image-input-placeholder {
                                                            background-image: url('../../../assets/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                    <!--end::Image input placeholder-->

                                                    <!--begin::Image input-->
                                                    <div class="image-input image-input-outline image-input-placeholder"
                                                        data-kt-image-input="true">
                                                        <!--begin::Preview existing avatar-->
                                                        <div class="image-input-wrapper w-125px h-125px"
                                                            style="background-image: url({{ asset('storage/userImages/' . $user->image) }});">
                                                        </div>
                                                        <!--end::Preview existing avatar-->

                                                        <!--begin::Edit-->
                                                        <label
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                            aria-label="Change avatar"
                                                            data-bs-original-title="Change avatar"
                                                            data-kt-initialized="1">
                                                            <i class="ki-duotone ki-pencil fs-7"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                            <!--begin::Inputs-->
                                                            <input type="file" name="image"
                                                                accept=".png, .jpg, .jpeg">
                                                            <input type="hidden" name="avatar_remove">
                                                            <!--end::Inputs-->
                                                        </label>
                                                        <!--end::Edit-->

                                                        <!--begin::Cancel-->
                                                        <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                            aria-label="Cancel avatar"
                                                            data-bs-original-title="Cancel avatar"
                                                            data-kt-initialized="1">
                                                            <i class="ki-duotone ki-cross fs-2"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                        <!--end::Cancel-->

                                                        <!--begin::Remove-->
                                                        <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                            aria-label="Remove avatar"
                                                            data-bs-original-title="Remove avatar"
                                                            data-kt-initialized="1">
                                                            <i class="ki-duotone ki-cross fs-2"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                        <!--end::Remove-->
                                                    </div>
                                                    <!--end::Image input-->
                                                </div>
                                                <!--end::Image input wrapper-->
                                            </div>
                                            <!--end::Input group--> --}}

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Title</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="name" value="{{ $user->Title }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Display Name</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="" value="{{ $user->DisplayName }}"
                                                    disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Suffix </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="" value="{{ $user->Suffix }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Fax </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name=""
                                                    value="{{ $user->Fax->FreeFormNumber ?? '' }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Business Number</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name=""
                                                    value="{{ $user->BusinessNumber ?? '' }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            {{-- <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Payment Method</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name=""
                                                    value="{{ $user->PaymentMethodRef ?? '' }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group--> --}}
                                            {{-- <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Name on print on
                                                    cheque</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name="" value="{{ $user->cheque_print_name }}"
                                                    disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group--> --}}
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Website</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name=""
                                                    value="{{ $user->WebAddr->URI ?? '' }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 ">Other</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="" name=""
                                                    value="{{ $user->AlternatePhone->FreeFormNumber ?? '' }}" disabled>

                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->



                                            {{-- <div class="d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <button type="submit" id="kt_ecommerce_customer_profile_submit"
                                                    class="btn btn-light-primary">
                                                    <span class="indicator-label">
                                                        Save
                                                    </span>
                                                    <span class="indicator-progress">
                                                        Please wait... <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                </button>
                                                <!--end::Button-->
                                            </div> --}}
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->

                                {{-- // address book --}}

                            </div>
                            <!--end:::Tab pane-->
                            {{-- <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Related Products</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar my-2">
                                        <a href="{{ route('add.customer.product', $user->Id) }}"
                                            class="btn btn-sm btn-flex btn-light-primary">
                                            <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> Assign product
                                        </a>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table-->
                                    <div id="kt_table_customers_payment_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5 dataTable no-footer"
                                                id="kt_table_customers_payment">
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                    <tr class="text-start text-muted text-uppercase gs-0">
                                                        <th class="min-w-100px sorting" tabindex="0"
                                                            aria-controls="kt_table_customers_payment" rowspan="1"
                                                            colspan="1"
                                                            aria-label="order No.: activate to sort column ascending"
                                                            style="width: 100px;">ID No.</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="kt_table_customers_payment" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Status: activate to sort column ascending"
                                                            style="width: 81.8438px;">Products</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="kt_table_customers_payment" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Amount: activate to sort column ascending"
                                                            style="width: 78.8594px;">Amount</th>
                                                        <th class="min-w-100px sorting" tabindex="0"
                                                            aria-controls="kt_table_customers_payment" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Rewards: activate to sort column ascending"
                                                            style="width: 100px;">Assigned Amount</th>
                                                        <th class="min-w-100px sorting_disabled" rowspan="1"
                                                            colspan="1" aria-label="Date" style="width: 100px;">
                                                            Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    @foreach ($user->customerProducts as $product)
                                                        <tr class="odd">
                                                            <td>
                                                                <a href="#"
                                                                    class="text-gray-600 text-hover-primary mb-1">#{{ $product->Id }}</a>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge badge-light-success">{{ $product->product->name }}</span>
                                                            </td>
                                                            <td>
                                                                {{ $product->product->price }}</td>
                                                            <td>
                                                                120 </td>
                                                            <td>
                                                                {{ $product->created_at }} </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div
                                                class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                            </div>
                                            <div
                                                class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                    id="kt_table_customers_payment_paginate">
                                                    <ul class="pagination">
                                                        <li class="paginate_button page-item previous disabled"
                                                            id="kt_table_customers_payment_previous"><a href="#"
                                                                aria-controls="kt_table_customers_payment" data-dt-idx="0"
                                                                tabindex="0" class="page-link"><i
                                                                    class="previous"></i></a></li>
                                                        <li class="paginate_button page-item active"><a href="#"
                                                                aria-controls="kt_table_customers_payment" data-dt-idx="1"
                                                                tabindex="0" class="page-link">1</a></li>
                                                        <li class="paginate_button page-item "><a href="#"
                                                                aria-controls="kt_table_customers_payment" data-dt-idx="2"
                                                                tabindex="0" class="page-link">2</a></li>
                                                        <li class="paginate_button page-item next"
                                                            id="kt_table_customers_payment_next"><a href="#"
                                                                aria-controls="kt_table_customers_payment" data-dt-idx="3"
                                                                tabindex="0" class="page-link"><i
                                                                    class="next"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                                
                            </div>
                            <!--end::Card--> --}}
                            {{-- <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_customer_advanced" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Security Details</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5"
                                                id="kt_table_users_login_session">
                                                <!--begin::Table body-->
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td>+6141 234 567</td>
                                                        <td class="text-end">
                                                            <button type="button"
                                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_update_phone">
                                                                <i class="ki-duotone ki-pencil fs-3"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </button>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Password</td>
                                                        <td>******</td>
                                                        <td class="text-end">
                                                            <button type="button"
                                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_update_password">
                                                                <i class="ki-duotone ki-pencil fs-3"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">Two Step Authentication</h2>

                                            <div class="fs-6 fw-semibold text-muted">Keep your account extra secure with a
                                                second authentication step.</div>
                                        </div>
                                        <!--end::Card title-->

                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Add-->
                                            <button type="button" class="btn btn-light-primary btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="ki-duotone ki-fingerprint-scanning fs-3"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span><span class="path4"></span><span
                                                        class="path5"></span></i> Add Authentication Step
                                            </button>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_add_auth_app">
                                                        Use authenticator app
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_add_one_time_password">
                                                        Enable one-time password
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                            <!--end::Add-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body pb-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Content-->
                                            <div class="d-flex flex-column">
                                                <span>SMS</span>
                                                <span class="text-muted fs-6">+6141 234 567</span>
                                            </div>
                                            <!--end::Content-->

                                            <!--begin::Action-->
                                            <div class="d-flex justify-content-end align-items-center">
                                                <!--begin::Button-->
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_add_one_time_password">
                                                    <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span
                                                            class="path2"></span></i> </button>
                                                <!--end::Button-->

                                                <!--begin::Button-->
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                    id="kt_users_delete_two_step">
                                                    <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span
                                                            class="path2"></span><span class="path3"></span><span
                                                            class="path4"></span><span class="path5"></span></i>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Item-->

                                        <!--begin:Separator-->
                                        <div class="separator separator-dashed my-5"></div>
                                        <!--end:Separator-->

                                        <!--begin::Disclaimer-->
                                        <div class="text-gray-600">
                                            If you lose your mobile device or security key, you can <a href="#"
                                                class="me-1">generate a backup code</a> to sign in to your account.
                                        </div>
                                        <!--end::Disclaimer-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->

                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2 class="fw-bold mb-0">Payment Methods</h2>
                                        </div>
                                        <!--end::Card title-->

                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <a href="#" class="btn btn-sm btn-flex btn-light-primary"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                <i class="ki-duotone ki-plus-square fs-3"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i> Add new method
                                            </a>
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div id="kt_customer_view_payment_method" class="card-body pt-0">
                                        <div class="accordion accordion-icon-toggle"
                                            id="kt_customer_view_payment_method_accordion">
                                            <!--begin::Option-->
                                            <div class="py-0" data-kt-customer-payment-method="row">
                                                <!--begin::Header-->
                                                <div class="py-3 d-flex flex-stack flex-wrap">
                                                    <!--begin::Toggle-->
                                                    <div class="accordion-header d-flex align-items-center "
                                                        data-bs-toggle="collapse"
                                                        href="#kt_customer_view_payment_method_1" role="button"
                                                        aria-expanded="false"
                                                        aria-controls="kt_customer_view_payment_method_1">
                                                        <!--begin::Arrow-->
                                                        <div class="accordion-icon me-2">
                                                            <i class="ki-duotone ki-right fs-4"></i>
                                                        </div>
                                                        <!--end::Arrow-->

                                                        <!--begin::Logo-->
                                                        <img src="../../../assets/media/svg/card-logos/mastercard.svg"
                                                            class="w-40px me-3" alt="">
                                                        <!--end::Logo-->

                                                        <!--begin::Summary-->
                                                        <div class="me-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="text-gray-800 fw-bold">
                                                                    Mastercard </div>

                                                                <div class="badge badge-light-primary ms-5">Primary</div>
                                                            </div>
                                                            <div class="text-muted">Expires Dec 2024</div>
                                                        </div>
                                                        <!--end::Summary-->
                                                    </div>
                                                    <!--end::Toggle-->

                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex my-3 ms-9">
                                                        <!--begin::Edit-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                aria-label="Edit" data-bs-original-title="Edit"
                                                                data-kt-initialized="1">
                                                                <i class="ki-duotone ki-pencil fs-3"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </span>
                                                        </a>
                                                        <!--end::Edit-->

                                                        <!--begin::Delete-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="tooltip"
                                                            data-kt-customer-payment-method="delete" aria-label="Delete"
                                                            data-bs-original-title="Delete" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-trash fs-3"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                        </a>
                                                        <!--end::Delete-->

                                                        <!--begin::More-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                                            data-bs-toggle="tooltip" data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end" aria-label="More Options"
                                                            data-bs-original-title="More Options" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-setting-3 fs-3"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                        </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-payment-mehtod-action="set_as_primary">
                                                                    Set as Primary
                                                                </a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::More-->
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Header-->

                                                <!--begin::Body-->
                                                <div id="kt_customer_view_payment_method_1"
                                                    class="collapse show fs-6 ps-10"
                                                    data-bs-parent="#kt_customer_view_payment_method_accordion">
                                                    <!--begin::Details-->
                                                    <div class="d-flex flex-wrap py-5">
                                                        <!--begin::Col-->
                                                        <div class="flex-equal me-5">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Name
                                                                        </td>
                                                                        <td class="text-gray-800">Emma Smith</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Number
                                                                        </td>
                                                                        <td class="text-gray-800">**** 8371</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Expires
                                                                        </td>
                                                                        <td class="text-gray-800">12/2024</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Type
                                                                        </td>
                                                                        <td class="text-gray-800">Mastercard credit card
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Issuer
                                                                        </td>
                                                                        <td class="text-gray-800">VICBANK</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">ID</td>
                                                                        <td class="text-gray-800">id_4325df90sdf8</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="flex-equal ">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Billing
                                                                            address</td>
                                                                        <td class="text-gray-800">AU</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Phone
                                                                        </td>
                                                                        <td class="text-gray-800">No phone provided</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Email
                                                                        </td>
                                                                        <td class="text-gray-800"><a href="#"
                                                                                class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Origin
                                                                        </td>
                                                                        <td class="text-gray-800">Australia <div
                                                                                class="symbol symbol-20px symbol-circle ms-2">
                                                                                <img
                                                                                    src="../../../assets/media/flags/australia.svg">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">CVC
                                                                            check</td>
                                                                        <td class="text-gray-800">Passed <i
                                                                                class="ki-duotone ki-check-circle fs-2 text-success"><span
                                                                                    class="path1"></span><span
                                                                                    class="path2"></span></i></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Option-->

                                            <div class="separator separator-dashed"></div> <!--begin::Option-->
                                            <div class="py-0" data-kt-customer-payment-method="row">
                                                <!--begin::Header-->
                                                <div class="py-3 d-flex flex-stack flex-wrap">
                                                    <!--begin::Toggle-->
                                                    <div class="accordion-header d-flex align-items-center collapsed"
                                                        data-bs-toggle="collapse"
                                                        href="#kt_customer_view_payment_method_2" role="button"
                                                        aria-expanded="false"
                                                        aria-controls="kt_customer_view_payment_method_2">
                                                        <!--begin::Arrow-->
                                                        <div class="accordion-icon me-2">
                                                            <i class="ki-duotone ki-right fs-4"></i>
                                                        </div>
                                                        <!--end::Arrow-->

                                                        <!--begin::Logo-->
                                                        <img src="../../../assets/media/svg/card-logos/visa.svg"
                                                            class="w-40px me-3" alt="">
                                                        <!--end::Logo-->

                                                        <!--begin::Summary-->
                                                        <div class="me-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="text-gray-800 fw-bold">
                                                                    Visa </div>

                                                            </div>
                                                            <div class="text-muted">Expires Feb 2022</div>
                                                        </div>
                                                        <!--end::Summary-->
                                                    </div>
                                                    <!--end::Toggle-->

                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex my-3 ms-9">
                                                        <!--begin::Edit-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                aria-label="Edit" data-bs-original-title="Edit"
                                                                data-kt-initialized="1">
                                                                <i class="ki-duotone ki-pencil fs-3"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </span>
                                                        </a>
                                                        <!--end::Edit-->

                                                        <!--begin::Delete-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="tooltip"
                                                            data-kt-customer-payment-method="delete" aria-label="Delete"
                                                            data-bs-original-title="Delete" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-trash fs-3"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                        </a>
                                                        <!--end::Delete-->

                                                        <!--begin::More-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                                            data-bs-toggle="tooltip" data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end" aria-label="More Options"
                                                            data-bs-original-title="More Options" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-setting-3 fs-3"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                        </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-payment-mehtod-action="set_as_primary">
                                                                    Set as Primary
                                                                </a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::More-->
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Header-->

                                                <!--begin::Body-->
                                                <div id="kt_customer_view_payment_method_2" class="collapse  fs-6 ps-10"
                                                    data-bs-parent="#kt_customer_view_payment_method_accordion">
                                                    <!--begin::Details-->
                                                    <div class="d-flex flex-wrap py-5">
                                                        <!--begin::Col-->
                                                        <div class="flex-equal me-5">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Name
                                                                        </td>
                                                                        <td class="text-gray-800">Melody Macy</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Number
                                                                        </td>
                                                                        <td class="text-gray-800">**** 8472</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Expires
                                                                        </td>
                                                                        <td class="text-gray-800">02/2022</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Type
                                                                        </td>
                                                                        <td class="text-gray-800">Visa credit card</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Issuer
                                                                        </td>
                                                                        <td class="text-gray-800">ENBANK</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">ID</td>
                                                                        <td class="text-gray-800">id_w2r84jdy723</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="flex-equal ">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Billing
                                                                            address</td>
                                                                        <td class="text-gray-800">UK</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Phone
                                                                        </td>
                                                                        <td class="text-gray-800">No phone provided</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Email
                                                                        </td>
                                                                        <td class="text-gray-800"><a href="#"
                                                                                class="text-gray-900 text-hover-primary">melody@altbox.com</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Origin
                                                                        </td>
                                                                        <td class="text-gray-800">United Kingdom <div
                                                                                class="symbol symbol-20px symbol-circle ms-2">
                                                                                <img
                                                                                    src="../../../assets/media/flags/united-kingdom.svg">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">CVC
                                                                            check</td>
                                                                        <td class="text-gray-800">Passed <i
                                                                                class="ki-duotone ki-check fs-2 text-success"></i>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Option-->

                                            <div class="separator separator-dashed"></div> <!--begin::Option-->
                                            <div class="py-0" data-kt-customer-payment-method="row">
                                                <!--begin::Header-->
                                                <div class="py-3 d-flex flex-stack flex-wrap">
                                                    <!--begin::Toggle-->
                                                    <div class="accordion-header d-flex align-items-center collapsed"
                                                        data-bs-toggle="collapse"
                                                        href="#kt_customer_view_payment_method_3" role="button"
                                                        aria-expanded="false"
                                                        aria-controls="kt_customer_view_payment_method_3">
                                                        <!--begin::Arrow-->
                                                        <div class="accordion-icon me-2">
                                                            <i class="ki-duotone ki-right fs-4"></i>
                                                        </div>
                                                        <!--end::Arrow-->

                                                        <!--begin::Logo-->
                                                        <img src="../../../assets/media/svg/card-logos/american-express.svg"
                                                            class="w-40px me-3" alt="">
                                                        <!--end::Logo-->

                                                        <!--begin::Summary-->
                                                        <div class="me-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="text-gray-800 fw-bold">
                                                                    American Express </div>

                                                                <div class="badge badge-light-danger ms-5">Expired</div>
                                                            </div>
                                                            <div class="text-muted">Expires Aug 2021</div>
                                                        </div>
                                                        <!--end::Summary-->
                                                    </div>
                                                    <!--end::Toggle-->

                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex my-3 ms-9">
                                                        <!--begin::Edit-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                            <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                                aria-label="Edit" data-bs-original-title="Edit"
                                                                data-kt-initialized="1">
                                                                <i class="ki-duotone ki-pencil fs-3"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i> </span>
                                                        </a>
                                                        <!--end::Edit-->

                                                        <!--begin::Delete-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                                            data-bs-toggle="tooltip"
                                                            data-kt-customer-payment-method="delete" aria-label="Delete"
                                                            data-bs-original-title="Delete" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-trash fs-3"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                        </a>
                                                        <!--end::Delete-->

                                                        <!--begin::More-->
                                                        <a href="#"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                                            data-bs-toggle="tooltip" data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end" aria-label="More Options"
                                                            data-bs-original-title="More Options" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-setting-3 fs-3"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                        </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold w-150px py-3"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-payment-mehtod-action="set_as_primary">
                                                                    Set as Primary
                                                                </a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::More-->
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Header-->

                                                <!--begin::Body-->
                                                <div id="kt_customer_view_payment_method_3" class="collapse  fs-6 ps-10"
                                                    data-bs-parent="#kt_customer_view_payment_method_accordion">
                                                    <!--begin::Details-->
                                                    <div class="d-flex flex-wrap py-5">
                                                        <!--begin::Col-->
                                                        <div class="flex-equal me-5">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Name
                                                                        </td>
                                                                        <td class="text-gray-800">Max Smith</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Number
                                                                        </td>
                                                                        <td class="text-gray-800">**** 1125</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Expires
                                                                        </td>
                                                                        <td class="text-gray-800">08/2021</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Type
                                                                        </td>
                                                                        <td class="text-gray-800">American express credit
                                                                            card</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Issuer
                                                                        </td>
                                                                        <td class="text-gray-800">USABANK</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">ID</td>
                                                                        <td class="text-gray-800">id_89457jcje63</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="flex-equal ">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Billing
                                                                            address</td>
                                                                        <td class="text-gray-800">US</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Phone
                                                                        </td>
                                                                        <td class="text-gray-800">No phone provided</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Email
                                                                        </td>
                                                                        <td class="text-gray-800"><a href="#"
                                                                                class="text-gray-900 text-hover-primary">max@kt.com</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Origin
                                                                        </td>
                                                                        <td class="text-gray-800">United States of America
                                                                            <div
                                                                                class="symbol symbol-20px symbol-circle ms-2">
                                                                                <img
                                                                                    src="../../../assets/media/flags/united-states.svg">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">CVC
                                                                            check</td>
                                                                        <td class="text-gray-800">Failed <i
                                                                                class="ki-duotone ki-cross fs-2 text-danger"><span
                                                                                    class="path1"></span><span
                                                                                    class="path2"></span></i></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Option-->

                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane--> --}}
                        </div>
                        <!--end:::Tab content-->

                    </div>
                    <!--end::Content-->

                </div>
                <!--end::Layout-->
                {{-- <!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>Related Products</h2>
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar my-2">
            <a href="{{ route('add.customer.product') }}"
                class="btn btn-sm btn-flex btn-light-primary">
                <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span
                        class="path2"></span><span class="path3"></span></i> Assign product
            </a>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0 pb-5">
        <!--begin::Table-->
        <div id="kt_table_customers_payment_wrapper"
            class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed gy-5 dataTable no-footer"
                    id="kt_table_customers_payment">
                    <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                        <tr class="text-start text-muted text-uppercase gs-0">
                            <th class="min-w-100px sorting" tabindex="0"
                                aria-controls="kt_table_customers_payment" rowspan="1"
                                colspan="1"
                                aria-label="order No.: activate to sort column ascending"
                                style="width: 100px;">ID No.</th>
                            <th class="sorting" tabindex="0"
                                aria-controls="kt_table_customers_payment" rowspan="1"
                                colspan="1"
                                aria-label="Status: activate to sort column ascending"
                                style="width: 81.8438px;">Products</th>
                            <th class="sorting" tabindex="0"
                                aria-controls="kt_table_customers_payment" rowspan="1"
                                colspan="1"
                                aria-label="Amount: activate to sort column ascending"
                                style="width: 78.8594px;">Amount</th>
                            <th class="min-w-100px sorting" tabindex="0"
                                aria-controls="kt_table_customers_payment" rowspan="1"
                                colspan="1"
                                aria-label="Rewards: activate to sort column ascending"
                                style="width: 100px;">Assigned Amount</th>
                            <th class="min-w-100px sorting_disabled" rowspan="1"
                                colspan="1" aria-label="Date" style="width: 100px;">
                                Date</th>
                        </tr>
                    </thead>
                    <tbody class="fs-6 fw-semibold text-gray-600">
                        @foreach ($user->products as $product)
                            <tr class="odd">
                                <td>
                                    <a href="#"
                                        class="text-gray-600 text-hover-primary mb-1">#{{ $product->Id }}</a>
                                </td>
                                <td>
                                    <span
                                        class="badge badge-light-success">{{ $product->name }}</span>
                                </td>
                                <td>
                                    {{ $product->price }}</td>
                                <td>
                                    {{$product->assign_price}} </td>
                                <td>
                                    {{ $product->created_at }} </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div
                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                </div>
                <div
                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    <div class="dataTables_paginate paging_simple_numbers"
                        id="kt_table_customers_payment_paginate">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous disabled"
                                id="kt_table_customers_payment_previous"><a href="#"
                                    aria-controls="kt_table_customers_payment" data-dt-idx="0"
                                    tabindex="0" class="page-link"><i
                                        class="previous"></i></a></li>
                            <li class="paginate_button page-item active"><a href="#"
                                    aria-controls="kt_table_customers_payment" data-dt-idx="1"
                                    tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#"
                                    aria-controls="kt_table_customers_payment" data-dt-idx="2"
                                    tabindex="0" class="page-link">2</a></li>
                            <li class="paginate_button page-item next"
                                id="kt_table_customers_payment_next"><a href="#"
                                    aria-controls="kt_table_customers_payment" data-dt-idx="3"
                                    tabindex="0" class="page-link"><i
                                        class="next"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
    
</div>
<!--end::Card--> --}}
                <!--begin::Modals-->
                <!--begin::Modal - New Address-->
                <div class="modal fade" id="kt_modal_update_address" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                action="{{ route('update.customerAddress', $user->Id) }}" method="POST">
                                @csrf
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_address_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Update Address</h2>
                                    <!--end::Modal title-->

                                    <!--begin::Close-->
                                    <div id="kt_modal_update_address_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7"
                                        id="kt_modal_update_address_scroll" data-kt-scroll="true"
                                        data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_update_address_header"
                                        data-kt-scroll-wrappers="#kt_modal_update_address_scroll"
                                        data-kt-scroll-offset="300px" style="max-height: 168px;">
                                        <!--begin::Billing toggle-->
                                        <div class="fw-bold fs-3 rotate collapsible collapsed mb-7"
                                            data-bs-toggle="collapse" href="#kt_modal_update_address_billing_info"
                                            role="button" aria-expanded="false"
                                            aria-controls="kt_modal_update_address_billing_info">
                                            Information
                                            <span class="ms-2 rotate-180">
                                                <i class="ki-duotone ki-down fs-3"></i> </span>
                                        </div>
                                        <!--end::Billing toggle-->

                                        <!--begin::Billing form-->
                                        <div id="kt_modal_update_address_billing_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Address Line 1</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="address1" value="101, Collins Street">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Address Line 2</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="address2">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">City / Town</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="city" value="Melbourne">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row g-9 mb-7">
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">State / Province</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder=""
                                                        name="state" value="Victoria">
                                                    <!--end::Input-->
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Post Code</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder=""
                                                        name="postcode" value="3000">
                                                    <!--end::Input-->
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span class="required">Country</span>


                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Country of origination"
                                                        data-bs-original-title="Country of origination"
                                                        data-kt-initialized="1">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i></span> </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <select name="country" aria-label="Select a Country"
                                                    data-control="select2" data-placeholder="Select a Country..."
                                                    data-dropdown-parent="#kt_modal_update_address"
                                                    class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                                    data-select2-id="select2-data-7-6x4s" tabindex="-1"
                                                    aria-hidden="true" data-kt-initialized="1">
                                                    <option value="">Select a Country...</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Aland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU" selected=""
                                                        data-select2-id="select2-data-9-oqie">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="KR">South Korea</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Vietnam</option>
                                                    <option value="VI">Virgin Islands</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select><span
                                                    class="select2 select2-container select2-container--bootstrap5"
                                                    dir="ltr" data-select2-id="select2-data-8-2i0g"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-country-gp-container"
                                                            aria-controls="select2-country-gp-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-country-gp-container" role="textbox"
                                                                aria-readonly="true"
                                                                title="Australia">Australia</span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <div class="me-5">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold">Use as a billing address?</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <div class="fs-7 fw-semibold text-muted">If you need more info,
                                                            please check budget planning</div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Switch-->
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input" name="billing" type="checkbox"
                                                            value="1" id="kt_modal_update_address_billing"
                                                            checked="checked">
                                                        <!--end::Input-->

                                                        <!--begin::Label-->
                                                        <span class="form-check-label fw-semibold text-muted"
                                                            for="kt_modal_update_address_billing">
                                                            Yes
                                                        </span>
                                                        <!--end::Label-->
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                                <!--begin::Wrapper-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Billing form-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->

                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_update_address_cancel"
                                        class="btn btn-light me-3">
                                        Discard
                                    </button>
                                    <!--end::Button-->

                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_update_address_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
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
                <!--end::Modal - New Address--><!--begin::Modal - Update password-->
                <div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Password</h2>
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
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_update_password_form"
                                    class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">

                                    <!--begin::Input group--->
                                    <div class="fv-row mb-10 fv-plugins-icon-container">
                                        <label class="required form-label fs-6 mb-2">Current Password</label>

                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="" name="current_password" autocomplete="off">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group--->

                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
                                        <!--begin::Wrapper-->
                                        <div class="mb-1">
                                            <!--begin::Label-->
                                            <label class="form-label fw-semibold fs-6 mb-2">
                                                New Password
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input wrapper-->
                                            <div class="position-relative mb-3">
                                                <input class="form-control form-control-lg form-control-solid"
                                                    type="password" placeholder="" name="new_password"
                                                    autocomplete="off">

                                                <span
                                                    class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                    data-kt-password-meter-control="visibility">
                                                    <i class="ki-duotone ki-eye-slash fs-1"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span><span class="path4"></span></i> <i
                                                        class="ki-duotone ki-eye d-none fs-1"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i> </span>
                                            </div>
                                            <!--end::Input wrapper-->

                                            <!--begin::Meter-->
                                            <div class="d-flex align-items-center mb-3"
                                                data-kt-password-meter-control="highlight">
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                </div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                </div>
                                            </div>
                                            <!--end::Meter-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Hint-->
                                        <div class="text-muted">
                                            Use 8 or more characters with a mix of letters, numbers &amp; symbols.
                                        </div>
                                        <!--end::Hint-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group--->

                                    <!--begin::Input group--->
                                    <div class="fv-row mb-10 fv-plugins-icon-container">
                                        <label class="form-label fw-semibold fs-6 mb-2">Confirm New Password</label>

                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="" name="confirm_password" autocomplete="off">
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group--->

                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
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
                <!--end::Modal - Update password--><!--begin::Modal - Update email-->
                <div class="modal fade" id="kt_modal_update_phone" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Phone Number</h2>
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
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_update_phone_form"
                                    class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                    <!--begin::Notice-->

                                    <!--begin::Notice-->
                                    <div
                                        class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-information fs-2tx text-primary me-4"><span
                                                class="path1"></span><span class="path2"></span><span
                                                class="path3"></span></i> <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1 ">
                                            <!--begin::Content-->
                                            <div class=" fw-semibold">

                                                <div class="fs-6 text-gray-700 ">Please note that a valid phone number may
                                                    be required for order or shipping rescheduling.</div>
                                            </div>
                                            <!--end::Content-->

                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Notice-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Phone</span>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder=""
                                            name="profile_phone" value="+6141 234 567">
                                        <!--end::Input-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
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
                <!--end::Modal - Update email--><!--begin::Modal - New Address-->
                {{-- <div class="modal fade" id="kt_modal_add_address" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                                id="kt_modal_add_address_form">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_address_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Add New Address</h2>
                                    <!--end::Modal title-->

                                    <!--begin::Close-->
                                    <div id="kt_modal_add_address_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_address_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_address_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_address_scroll"
                                        data-kt-scroll-offset="300px" style="max-height: 168px;">
                                        <!--begin::Billing toggle-->
                                        <div class="fw-bold fs-3 rotate collapsible collapsed mb-7"
                                            data-bs-toggle="collapse" href="#kt_modal_add_address_billing_info"
                                            role="button" aria-expanded="false"
                                            aria-controls="kt_modal_add_address_billing_info">
                                            Shipping Information
                                            <span class="ms-2 rotate-180">
                                                <i class="ki-duotone ki-down fs-3"></i> </span>
                                        </div>
                                        <!--end::Billing toggle-->

                                        <!--begin::Billing form-->
                                        <div id="kt_modal_add_address_billing_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Address Name</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="name" value="">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Address Line 1</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="address1" value="">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Address Line 2</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="address2">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">City / Town</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="city" value="">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row g-9 mb-7">
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">State / Province</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder=""
                                                        name="state" value="">
                                                    <!--end::Input-->
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2 required">Post Code</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder=""
                                                        name="postcode" value="">
                                                    <!--end::Input-->
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span class="required">Country</span>

                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Country of origination"
                                                        data-bs-original-title="Country of origination"
                                                        data-kt-initialized="1">
                                                        <i class="ki-duotone ki-information fs-7"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i> </span>
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <select name="country" aria-label="Select a Country"
                                                    data-control="select2" data-placeholder="Select a Country..."
                                                    data-dropdown-parent="#kt_modal_add_address"
                                                    class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                                    data-select2-id="select2-data-10-3kvq" tabindex="-1"
                                                    aria-hidden="true" data-kt-initialized="1">
                                                    <option value="" data-select2-id="select2-data-12-v5w4">Select
                                                        a Country...</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Aland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="KR">South Korea</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Vietnam</option>
                                                    <option value="VI">Virgin Islands</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select><span
                                                    class="select2 select2-container select2-container--bootstrap5"
                                                    dir="ltr" data-select2-id="select2-data-11-hs2e"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-country-48-container"
                                                            aria-controls="select2-country-48-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-country-48-container" role="textbox"
                                                                aria-readonly="true" title="Select a Country..."><span
                                                                    class="select2-selection__placeholder">Select a
                                                                    Country...</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <div class="me-5">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold">Use as a billing address?</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <div class="fs-7 fw-semibold text-muted">If you need more info,
                                                            please check budget planning</div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Switch-->
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input" name="billing" type="checkbox"
                                                            value="1" id="kt_modal_add_address_billing"
                                                            checked="checked">
                                                        <!--end::Input-->

                                                        <!--begin::Label-->
                                                        <span class="form-check-label fw-semibold text-muted"
                                                            for="kt_modal_add_address_billing">
                                                            Yes
                                                        </span>
                                                        <!--end::Label-->
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                                <!--begin::Wrapper-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Billing form-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->

                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_add_address_cancel"
                                        class="btn btn-light me-3">
                                        Discard
                                    </button>
                                    <!--end::Button-->

                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_address_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
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
                </div> --}}
                <!--end::Modal - New Address--><!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_auth_app" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Add Authenticator App</h2>
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
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Content-->
                                <div class="fw-bold d-flex flex-column justify-content-center mb-5">
                                    <!--begin::Label-->
                                    <div class="text-center mb-5" data-kt-add-auth-action="qr-code-label">
                                        Download the <a href="#">Authenticator app</a>, add a new account, then scan
                                        this barcode to set up your account.
                                    </div>
                                    <div class="text-center mb-5 d-none" data-kt-add-auth-action="text-code-label">
                                        Download the <a href="#">Authenticator app</a>, add a new account, then
                                        enter this code to set up your account.
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::QR code-->
                                    <div class="d-flex flex-center" data-kt-add-auth-action="qr-code">
                                        <img src="../../../assets/media/misc/qr.png" alt="Scan this QR code">
                                    </div>
                                    <!--end::QR code-->

                                    <!--begin::Text code-->
                                    <div class="border rounded p-5 d-flex flex-center d-none"
                                        data-kt-add-auth-action="text-code">
                                        <div class="fs-1">gi2kdnb54is709j</div>
                                    </div>
                                    <!--end::Text code-->
                                </div>
                                <!--end::Content-->

                                <!--begin::Action-->
                                <div class="d-flex flex-center">
                                    <div class="btn btn-light-primary" data-kt-add-auth-action="text-code-button">Enter
                                        code manually</div>
                                    <div class="btn btn-light-primary d-none" data-kt-add-auth-action="qr-code-button">
                                        Scan barcode instead</div>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Add task--><!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_one_time_password" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Enable One Time Password</h2>
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
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                    id="kt_modal_add_one_time_password_form">
                                    <!--begin::Label-->
                                    <div class="fw-bold mb-9">
                                        Enter the new phone number to receive an SMS to when you log in.
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Mobile number</span>

                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                aria-label="A valid mobile number is required to receive the one-time password to validate your account login."
                                                data-bs-original-title="A valid mobile number is required to receive the one-time password to validate your account login."
                                                data-kt-initialized="1">
                                                <i class="ki-duotone ki-information fs-7"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i> </span>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                            name="otp_mobile_number" placeholder="+6123 456 789" value="">
                                        <!--end::Input-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Separator-->
                                    <div class="separator saperator-dashed my-5"></div>
                                    <!--end::Separator-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Email</span>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="email" class="form-control form-control-solid" name="otp_email"
                                            value="smith@kpmg.com" readonly="">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Confirm password</span>
                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="password" class="form-control form-control-solid"
                                            name="otp_confirm_password" value="">
                                        <!--end::Input-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-kt-users-modal-action="cancel">
                                            Cancel
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
                <!--end::Modal - Add task--><!--end::Modals-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@push('custom-scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#kt_modal_update_address_form').modal('show');
            });
        </script>
    @endif
    <script src="{{ asset('assets/js/custom/apps/ecommerce/customers/details/add-address.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/customers/details/update-address.js') }}"></script>
    {{-- <script src="../../../assets/js/custom/apps/ecommerce/customers/details/transaction-history.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/add-auth-app.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/add-address.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/add-one-time-password.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/update-password.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/update-phone.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/update-address.js"></script>
    <script src="../../../assets/js/custom/apps/ecommerce/customers/details/update-profile.js"></script> --}}
@endpush
