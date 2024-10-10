@extends('layout.master')
@push('custom-css')
    <style>
        /* Larger Checkbox and Label */
        .larger-checkbox {
            width: 1.5em;
            height: 1.5em;
        }

        .larger-text {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .product-item {
            align-items: center;
        }

        .form-control-plaintext {
            border: none;
            background-color: transparent;
        }

        #loading-spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            /* Ensure it appears above other elements */
        }

        .loader {
            width: 15px;
            aspect-ratio: 1;
            border-radius: 50%;
            animation: l5 1s infinite linear alternate;
        }

        @keyframes l5 {
            0% {
                box-shadow: 20px 0 #000, -20px 0 #0002;
                background: #000
            }

            33% {
                box-shadow: 20px 0 #000, -20px 0 #0002;
                background: #0002
            }

            66% {
                box-shadow: 20px 0 #0002, -20px 0 #000;
                background: #0002
            }

            100% {
                box-shadow: 20px 0 #0002, -20px 0 #000;
                background: #000
            }
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
                        Customers List </h1>
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
                            All Customers </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

                {{-- <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                    <a href="#" class="btn bg-body btn-color-gray-700 btn-active-primary me-4" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_invite_friends">
                        Invite Friends
                    </a>

                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_project" id="kt_toolbar_primary_button">
                        New Project </a>
                </div>
                <!--end::Actions--> --}}
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column" id="kt_post">
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
                @if (session('error'))
                    <!--begin::Alert-->
                    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Search Customers">
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                                <div class="card-toolbar">
                                    <!--begin::Add customer-->
                                    <a href="{{ route('add.customer') }}" class="btn btn-primary">
                                        Add Customer
                                    </a>
                                    <!--end::Add customer-->
                                    <div id="loading-spinner" class="loader" style="display: none;"></div>

                                </div>
                                <!--end::Card toolbar-->
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
                                    <th class="min-w-125px">Display Name</th>
                                    {{-- <th class="min-w-125px">Firstname</th> --}}
                                    <th class="min-w-125px">Email</th>
                                    {{-- <th class="min-w-125px">Lastname</th> --}}
                                    <th class="min-w-125px">Phone #</th>
                                    {{-- <th class="min-w-125px">Payment Method</th> --}}
                                    {{-- <th class="min-w-125px">Company</th> --}}
                                    {{-- <th class="min-w-125px">Status</th> --}}
                                    <th class="min-w-125px">Invoice</th>
                                    <th class="min-w-125px">Favourite</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @if (!empty($users) && count($users) > 0)
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $user->Id }}" />
                                                </div>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <!--begin::User details-->
                                                <div class="d-flex flex-column "
                                                    style="padding-top: 1.85rem; padding-bottom: 1.25rem; ">
                                                    <a href="{{ route('show.customer', $user->Id) }}"
                                                        class="text-gray-800 text-hover-primary mb-1">{{ $user->DisplayName ?? '' }}</a>
                                                </div>
                                                <!--end::User details-->
                                            </td>
                                            {{-- <td>{{ $user->GivenName ?? '' }}</td> --}}
                                            <td>{{ $user->PrimaryEmailAddr->Address ?? '' }}</td>
                                            {{-- <td>{{ $user->FamilyName }}</td> --}}
                                            <td>{{ $user->PrimaryPhone->FreeFormNumber ?? '' }}</td>
                                            {{-- <td>{{ $user->payment_method->method ?? '' }}</td> --}}
                                            {{-- <td>{{ $user->CompanyName ?? '' }}</td>
                                            <td>
                                                @if ($user->Active == true)
                                                    <span class="badge bg-secondary">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">InActive</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('add.invoice', ['customer' => $user->Id]) }}"
                                                    class="btn btn-primary">
                                                    Create Invoice
                                                </a>

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_scrollable_{{ $user->Id }}">
                                                    Add to Favourite
                                                </button>
                                            </td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('edit.customer', $user->Id) }}"
                                                            class="menu-link px-3">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    {{-- <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('delete.customer', $user->Id) }}"
                                                    class="menu-link px-3">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item--> --}}
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @empty
                                        <p>No Users found.</p>
                                    @endforelse
                                @else
                                    <p>No Customer Found</p>
                                @endif

                            </tbody>
                        </table>
                        <!--end::Table-->
                        <!-- Modals for each user -->
                        @if (!empty($users) && count($users) > 0)
                            @foreach ($users as $user)
                                <div class="modal bg-body fade" tabindex="-1"
                                    id="kt_modal_scrollable_{{ $user->Id }}">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <form action="{{ route('store.customer.product') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="customer_id" value="{{ $user->Id }}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="assignProductsModalLabel">
                                                        Assign Favourite Products to {{ $user->DisplayName }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    @if (session('modal') == $user->Id)
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger" id="error-alert">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <!-- Search bar -->
                                                    <div class="mb-3 position-relative">
                                                        <input type="text" data-user-id="{{ $user->Id }}"
                                                            class="search-input form-control"
                                                            placeholder="Search products..."
                                                            id="search-input-{{ $user->Id }}"
                                                            style="padding-right: 30px;">
                                                        <!-- Add padding to make space for the clear button -->
                                                        <span class="clear-input fs-2"
                                                            style="cursor: pointer; position:absolute; right:10px; top:5px; display: none;">&times;</span>
                                                    </div>


                                                    <!-- Product table -->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Select</th>
                                                                    <th scope="col">Product Name</th>
                                                                    <th scope="col">SKU</th>
                                                                    <th scope="col">Manufacturer Code</th>
                                                                    <th scope="col">Pack</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col">Cost</th>
                                                                    <th scope="col">Assign Price</th>
                                                                    <th scope="col">Profit</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (!empty($products) && count($products) > 0)
                                                                    @forelse ($products as $product)
                                                                        @php
                                                                            $assignedProduct = App\Models\CustomerProduct::where(
                                                                                'customer_id',
                                                                                $user->Id,
                                                                            )
                                                                                ->where('product_id', $product->Id)
                                                                                ->first();
                                                                        @endphp
                                                                        {{-- @php
                                                                    $isChecked = in_array(
                                                                        $product->Id,
                                                                        $assignedProductIds,
                                                                    )
                                                                        ? 'checked'
                                                                        : '';
                                                                    $isDisabled = in_array(
                                                                        $product->id,
                                                                        $assignedProductIds,
                                                                    )
                                                                        ? ''
                                                                        : 'disabled';
                                                                    $assignedProduct = \App\Models\CustomerProduct::where(
                                                                        'customer_id',
                                                                        $user->id,
                                                                    )->where('product_id', $product->id) ->first();
                                                                    $assignedPrice = $assignedProduct ? $assignedProduct->assign_price: null; 
                                                                    @endphp --}}
                                                                        <tr data-product-name="{{ $product->Name }}">
                                                                            <td>
                                                                                <div class="form-check">
                                                                                    <input
                                                                                        class="form-check-input larger-checkbox product-checkbox-{{ $user->Id }}"
                                                                                        type="checkbox" name="products[]"
                                                                                        value="{{ $product->Id }}"
                                                                                        id="product{{ $product->Id }}_{{ $user->Id }}"
                                                                                        @if ($assignedProduct) checked @endif>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <label class="form-check-label larger-text"
                                                                                    for="product{{ $product->Id }}_{{ $user->Id }}">
                                                                                    {{ $product->Name }}
                                                                                </label>
                                                                            </td>

                                                                            <td>
                                                                                <input type="text"
                                                                                    id="sku{{ $product->Id }}"
                                                                                    class="form-control form-control-sm larger-text"
                                                                                    value="{{ $product->Sku }}" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text"
                                                                                    id="manufacturerCode{{ $product->Id }}"
                                                                                    class="form-control form-control-sm larger-text"
                                                                                    value="{{ $assignedProduct->manufacturer_code ?? null }}"
                                                                                    readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text"
                                                                                    name="quantity[{{ $product->Id }}]"
                                                                                    id="quantity{{ $product->Id }}_{{ $user->Id }}"
                                                                                    class="form-control form-control-sm larger-text assign-price-input"
                                                                                    placeholder="Pack"
                                                                                    {{-- @if ($isDisabled)
                                                                                disabled
                                                                            @endif --}}
                                                                                    value="{{ $assignedProduct->quantity  ?? '' }}"
                                                                                    readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text"
                                                                                    id="productPrice{{ $product->Id }}"
                                                                                    class="form-control form-control-sm larger-text"
                                                                                    value="{{ $product->UnitPrice ?? '' }}"
                                                                                    readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text"
                                                                                    id="productCost{{ $product->Id }}"
                                                                                    class="form-control form-control-sm larger-text"
                                                                                    value="{{ $product->PurchaseCost ?? '' }}"
                                                                                    readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text"
                                                                                    name="assignedPrice[{{ $product->Id }}]"
                                                                                    id="assignedPrice{{ $product->Id }}_{{ $user->Id }}"
                                                                                    class="form-control form-control-sm larger-text assign-price-input"
                                                                                    placeholder="Assign price"
                                                                                    @if ($assignedProduct) value="{{ $assignedProduct->assign_price ?? '' }}" @else disabled  @endif >
                                                                            </td>
                                                                            <td>
                                                                                <input type="text"
                                                                                    name="profit[{{ $product->Id }}]"
                                                                                    id="profit{{ $product->Id }}_{{ $user->Id }}"
                                                                                    class="form-control form-control-sm larger-text"
                                                                                    placeholder="Profit"  @if ($assignedProduct) value="{{ $assignedProduct->profit ?? '' }}"   @endif readonly>
                                                                            </td>

                                                                        </tr>
                                                                    @empty
                                                                        <p>No Products Found</p>
                                                                    @endforelse
                                                                @else
                                                                    <p>No Products Found</p>
                                                                @endif

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="button_{{ $user->Id }}" disabled>Add
                                                        to
                                                        favourite</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif



                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

                <!--begin::Modals-->
                <!--begin::Modal - Customers - Add-->
                <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                                id="kt_modal_add_customer_form" data-kt-redirect="list.html">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_customer_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Add a Customer</h2>
                                    <!--end::Modal title-->

                                    <!--begin::Close-->
                                    <div id="kt_modal_add_customer_close"
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
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                        data-kt-scroll-offset="300px" style="max-height: 140px;">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="name" value="Sean Bean">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span class="required">Email</span>

                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    aria-label="Email address must be active"
                                                    data-bs-original-title="Email address must be active"
                                                    data-kt-initialized="1">
                                                    <i class="ki-duotone ki-information fs-7"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i> </span>
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid" placeholder=""
                                                name="email" value="sean@dellito.com">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-15">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Description</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="description">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Billing toggle-->
                                        <div class="fw-bold fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                                            href="#kt_modal_add_customer_billing_info" role="button"
                                            aria-expanded="false" aria-controls="kt_customer_view_details">
                                            Shipping Information
                                            <span class="ms-2 rotate-180">
                                                <i class="ki-duotone ki-down fs-3"></i> </span>
                                        </div>
                                        <!--end::Billing toggle-->

                                        <!--begin::Billing form-->
                                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold mb-2">Address Line 1</label>
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
                                                    name="address2" value="">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold mb-2">Town</label>
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
                                                    <label class="required fs-6 fw-semibold mb-2">State / Province</label>
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
                                                    <label class="required fs-6 fw-semibold mb-2">Post Code</label>
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
                                                        <i class="ki-duotone ki-information fs-7"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i> </span>
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <select name="country" aria-label="Select a Country"
                                                    data-control="select2" data-placeholder="Select a Country..."
                                                    data-dropdown-parent="#kt_modal_add_customer"
                                                    class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                                    data-select2-id="select2-data-10-0jpn" tabindex="-1"
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
                                                    <option value="US" selected=""
                                                        data-select2-id="select2-data-12-fwu8">United States</option>
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
                                                    dir="ltr" data-select2-id="select2-data-11-5z5m"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-country-j2-container"
                                                            aria-controls="select2-country-j2-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-country-j2-container" role="textbox"
                                                                aria-readonly="true" title="United States">United
                                                                States</span><span class="select2-selection__arrow"
                                                                role="presentation"><b
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
                                                        <label class="fs-6 fw-semibold">Use as a billing adderess?</label>
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
                                                            value="1" id="kt_modal_add_customer_billing"
                                                            checked="checked">
                                                        <!--end::Input-->

                                                        <!--begin::Label-->
                                                        <span class="form-check-label fw-semibold text-muted"
                                                            for="kt_modal_add_customer_billing">
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
                                    <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">
                                        Discard
                                    </button>
                                    <!--end::Button-->

                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
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
                <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Export Customers</h2>
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
                                <form id="kt_modal_export_users_form" class="form"
                                    action="{{ route('import.customers') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!--begin::Image input-->
                                    <!--begin::Label-->
                                    <label class="required form-label"> Customer File</label>
                                    <!--end::Label-->

                                    <!--begin::Image input-->
                                    <div class=" mb-3">
                                        <!--begin::Label-->
                                        <label class=" btn-active-color-primary w-25px h-25px bg-body shadow">

                                            <!--begin::Inputs-->
                                            <input type="file" name="file">
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->


                                    </div>
                                    <!--end::Image input-->


                                    <!--end::Card body-->

                                    <br>

                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <!--begin::Actions-->
                                    <div class="text-center mt-3">
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
                <!--end::Modal - New Card-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to handle enabling/disabling inputs based on checkbox status
            function toggleInputs(productId, userId, isChecked) {
                const assignedPriceInput = $('#assignedPrice' + productId + '_' + userId);
                // const packInput = $('#quantity' + productId + '_' + userId);
                const actionButton = $('#button_' + userId);

                if (isChecked) {
                    assignedPriceInput.prop('disabled', false);
                    actionButton.prop('disabled', false);
                    // packInput.prop('disabled', false);
                } else {
                    assignedPriceInput.prop('disabled', true).val('');
                    // packInput.prop('disabled', true);
                }

                // Check if any checkbox is checked, then enable/disable action button
                const anyChecked = $(`.product-checkbox-${userId}:checked`).length > 0;
                actionButton.prop('disabled', !anyChecked);
            }

            // Checkbox change event
            $('input[type="checkbox"]').on('change', function() {
                const productId = $(this).val();
                const userId = $(this).closest('.modal').attr('id').split('_').pop();
                toggleInputs(productId, userId, $(this).is(':checked'));
            });

            // Before form submission, disable all unchecked products to prevent them from being submitted
            $('form').on('submit', function() {
                $(this).find('input[type="checkbox"]:not(:checked)').each(function() {
                    const productId = $(this).val();
                    const userId = $(this).closest('.modal').attr('id').split('_').pop();

                    // Disable the corresponding inputs for unchecked products
                    $('#assignedPrice' + productId + '_' + userId).prop('disabled', true);
                    // $('#quantity' + productId + '_' + userId).prop('disabled', true);
                    $('#profit' + productId + '_' + userId).prop('disabled', true);
                });
            });
        });
        $(document).ready(function() {
            // Event listener for the search input
            $('.search-input').on('input', function() {
                var searchTerm = $(this).val().toLowerCase();
                var userId = $(this).data('user-id');
                $(`#kt_modal_scrollable_${userId} tbody tr`).each(function() {
                    var productName = $(this).data('product-name').toLowerCase();
                    if (productName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.search-input').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent form submission
                }
            });
        });

        $(document).ready(function() {
            // Function to calculate and update profit
            function calculateProfit(productId, userId) {
                // Get the product cost and assigned price elements
                const productCost = parseFloat($(`#productCost${productId}`).val()) || 0;
                const assignedPrice = parseFloat($(`#assignedPrice${productId}_${userId}`).val()) || 0;

                // Calculate the profit percentage
                let profitPercentage = 0;
                if (productCost > 0) {
                    profitPercentage = ((assignedPrice - productCost) / productCost) * 100;
                }

                // Update the profit input field with percentage sign
                $(`#profit${productId}_${userId}`).val(profitPercentage.toFixed(2) + '%');
            }
            // Add event listeners to all assigned price inputs
            $(document).on('input', '.assign-price-input', function() {
                // Extract product ID and user ID from the input ID
                const ids = $(this).attr('id').match(/(\d+)_(\d+)/);
                const productId = ids[1];
                const userId = ids[2];
                calculateProfit(productId, userId);
            });
        });

        $(document).ready(function() {
            $('input[type="checkbox"]').on('change', function() {
                var productId = $(this).val();
                var userId = $(this).closest('.modal').attr('id').split('_')
                    .pop(); // Extract user ID from modal ID

                var assignedPriceInput = $('#assignedPrice' + productId + '_' + userId);
                // var packInput = $('#quantity' + productId + '_' + userId);
                var actionButton = $('#button_' + userId);

                if ($(this).is(':checked')) {
                    assignedPriceInput.prop('disabled', false);
                    actionButton.prop('disabled', false);
                    // packInput.prop('disabled', false);
                } else {
                    assignedPriceInput.prop('disabled', true).val('');
                    actionButton.prop('disabled', true);
                    // packInput.prop('disabled', true);

                }
            });
        });


        //error show
        $(document).ready(function() {
            var modalId = '{{ session('modal') }}';
            if (modalId) {
                var modalElement = $('#kt_modal_scrollable_' + modalId);
                if (modalElement.length) {
                    var modal = new bootstrap.Modal(modalElement[0]);
                    modal.show();
                }
                // Show the error message and then hide it after 5-10 seconds
                setTimeout(function() {
                    modalElement.find('#error-alert').fadeOut();
                }, 5000); // Change 5000 to 10000 for 10 seconds
            }
        });
        document.getElementById('export-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default anchor behavior

            // Show the loading spinner
            document.getElementById('loading-spinner').style.display = 'block';

            // Optionally, disable the button to prevent multiple clicks
            this.disabled = true;

            // Redirect to the export URL after showing the spinner
            window.location.href = this.href;
        });
    </script>
    <script>
$(document).ready(function() {
    // Function to clear the input, hide the clear button, and show all products
    function clearInput(userId) {
        const input = $('#search-input-' + userId);  // Use jQuery for consistency
        input.val(''); // Clear the text
        input.parent().find('.clear-input').hide(); // Hide the clear button
        input.focus(); // Focus back on the input field

        // Show all products since the search term is cleared
        $(`#kt_modal_scrollable_${userId} tbody tr`).show(); // Show all products
    }

    // Event listener for the search input
    $('.search-input').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        var userId = $(this).data('user-id');
        
        // Filter the products based on the search term
        $(`#kt_modal_scrollable_${userId} tbody tr`).each(function() {
            var productName = $(this).data('product-name').toLowerCase();
            if (productName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Show/hide the clear button based on input length
        const clearBtn = $(this).parent().find('.clear-input');
        if (searchTerm.length > 0) {
            clearBtn.show(); // Show the 'X' button if there is text
        } else {
            clearBtn.hide(); // Hide if the input is empty
        }
    });

    // Handle the click event on the 'X' button
    $('.clear-input').on('click', function() {
        const userId = $(this).siblings('.search-input').data('user-id'); // Get the user ID from the input
        clearInput(userId); // Clear the input and show all products
    });
});
</script>


    <script src="{{ asset('assets/js/custom/apps/ecommerce/customers/listing/listing.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>

    <script src="{{ asset('assets/js/custom/apps/ecommerce/customers/listing/add.js') }}"></script>
    {{-- <script src="../../../assets/js/custom/apps/ecommerce/customers/listing/export.js"></script> --}}
@endpush
