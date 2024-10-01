@extends('layout.master')

@section('content')
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">All Favourites Products</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary"> Dashboard </a> </li>
                        {{-- <li class="breadcrumb-item text-muted"> <a href="{{route('products')}}"
                                class="text-muted text-hover-primary"> Store Management </a> </li> --}}
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('products') }}"
                                class="text-muted text-hover-primary">All Favourites Products</a> </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->
                {{-- <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1"> <a href="#"
                        class="btn bg-body btn-color-gray-700 btn-active-primary me-4" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_invite_friends"> Invite Friends </a> <a href="#"
                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project"
                        id="kt_toolbar_primary_button"> New Project </a> </div>
                <!--end::Actions--> --}}
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
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1"> <i
                                    class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span
                                        class="path1"></span><span class="path2"></span></i> <input type="text"
                                    data-kt-ecommerce-product-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" id="productFilter"
                                    placeholder="Search Product">
                            </div>
                            <!--end::Search-->
                            {{-- <a href="{{url()->previous()}}" class="btn btn-primary ">Go Back</a> --}}

                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            {{-- <div class="w-100 mw-150px">
                            <!--begin::Select2--> <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status" data-select2-id="select2-data-7-dd2o" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                <option data-select2-id="select2-data-9-bevt"></option>
                                <option value="all">All</option>
                                <option value="published">Published</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="inactive">Inactive</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-0xqa" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-e0az-container" aria-controls="select2-e0az-container"><span class="select2-selection__rendered" id="select2-e0az-container" role="textbox" aria-readonly="true" title="Status"><span class="select2-selection__placeholder">Status</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <!--end::Select2-->
                        </div> --}}
                            {{-- <a href="{{ route('export.assignProducts') }}" class="btn btn-primary">
                            Download File </a>
                            <!--begin::Add product--> <a href="{{ route('add.customer.product') }}" class="btn btn-primary">
                                Assign
                                Product </a>
                            <!--end::Add product--> --}}


                        </div>
                        <!--end::Card toolbar-->
                    </div>

                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div id="kt_assign_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                    id="kt_assign_products_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="" style="width: 29.8906px;">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_assign_products_table .form-check-input"
                                                        value="1">
                                                </div>
                                            </th>
                                            <th class="min-w-200px sorting" tabindex="0"
                                                aria-controls="kt_assign_products_table" rowspan="1" colspan="1"
                                                aria-label="Products: activate to sort column ascending"
                                                style="width: 200px;">Products</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_assign_products_table" rowspan="1" colspan="1"
                                                aria-label="Amount: activate to sort column ascending"
                                                style="width: 100px;">
                                                Amount</th>
                                            <th class="text-end min-w-70px sorting" tabindex="0"
                                                aria-controls="kt_assign_products_table" rowspan="1" colspan="1"
                                                aria-label="Assigned Amount: activate to sort column ascending"
                                                style="width: 85.9844px;">Assigned Amount</th>
                                            <th class="text-end min-w-70px sorting" tabindex="0"
                                                aria-controls="kt_assign_products_table" rowspan="1" colspan="1"
                                                aria-label="Profit: activate to sort column ascending"
                                                style="width: 85.9844px;">Profit</th>
                                            {{-- <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_assign_products_table" rowspan="1" colspan="1"
                                                aria-label="Customer: activate to sort column ascending"
                                                style="width: 100px;">
                                                Customer</th> --}}
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_assign_products_table" rowspan="1" colspan="1"
                                                aria-label="Date: activate to sort column ascending"
                                                style="width: 100px;">
                                                Date</th>
                                            <th class="text-end min-w-70px sorting_disabled" rowspan="1"
                                                colspan="1" aria-label="Actions" style="width: 101.875px;">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @if ($products)
                                            @foreach ($products as $product)
                                            @php
                                                $productDetail = App\Models\Product::where('quickbook_id',$product->product_id)->first();
                                            @endphp
                                                <tr class="even">
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            {{-- <!--begin::Thumbnail--> <a
                                                                href="{{ route('edit.customer.product', $product->user->id) }}"
                                                                class="symbol symbol-50px"> <span class="symbol-label"
                                                                    style="background-image:url({{ asset('storage/productImages/' . $product->product->image) }});"></span>
                                                            </a>
                                                            <!--end::Thumbnail--> --}}
                                                            <div class="ms-5">
                                                                <!--begin::Title--> 
                                                                <a href="{{ route('edit.customer.product', ['customer' => $customerId, 'product' => $product->product_id]) }}"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">
                                                                    {{ $productDetail->name }}
                                                                </a>

                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0"> <span
                                                            class="fw-bold">{{ $productDetail->price }}</span> </td>
                                                    <td class="text-end pe-0" data-order="31"> <span
                                                            class="fw-bold ms-3">{{ $product->assign_price }}</span> </td>
                                                    <td class="text-end pe-0" data-order="31"> <span
                                                            class="fw-bold ms-3">{{ $product->profit }}</span> </td>
                                                    {{-- <td class="text-end pe-0">{{ $product->first_name }}
                                                        {{ $product->last_name }}</td> --}}
                                                    <td class="text-end pe-0">{{ $product->created_at }}</td>
                                                    <td class="text-end"> <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                            Actions <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3"> <a
                                                                    href="{{ route('edit.customer.product',['customer' => $customerId, 'product' => $product->product_id]) }}"
                                                                    class="menu-link px-3"> Edit </a> </div>
                                                            <!--end::Menu item-->

                                                            <!-- Example form using DELETE method -->
                                                            <form id="deleteForm{{ $product->product_id }}"
                                                                action="{{ route('delete.customer.product', ['customer' => $customerId, 'product' => $product->product_id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3"> <a href="#"
                                                                        onclick="event.preventDefault(); document.getElementById('deleteForm{{ $product->product_id }}').submit();"
                                                                        class="menu-link px-3"> Delete
                                                                    </a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </form>
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="row">
                                <div
                                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                    <div class="dataTables_length" id="kt_ecommerce_products_table_length"><label><select
                                                name="kt_ecommerce_products_table_length"
                                                aria-controls="kt_ecommerce_products_table"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select></label></div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                        id="kt_ecommerce_products_table_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="kt_ecommerce_products_table_previous"><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="0"
                                                    tabindex="0" class="page-link"><i class="previous"></i></a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="1"
                                                    tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="2"
                                                    tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="3"
                                                    tabindex="0" class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="4"
                                                    tabindex="0" class="page-link">4</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="5"
                                                    tabindex="0" class="page-link">5</a></li>
                                            <li class="paginate_button page-item next"
                                                id="kt_ecommerce_products_table_next"><a href="#"
                                                    aria-controls="kt_ecommerce_products_table" data-dt-idx="6"
                                                    tabindex="0" class="page-link"><i class="next"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Modal - Adjust Balance-->
                    <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Export Products</h2>
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
                                        action="{{ route('import.products') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!--begin::Image input-->
                                        <!--begin::Label-->
                                        <label class="required form-label"> Product File</label>
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
                <!--end::Products-->
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
                $('#kt_modal_export_users').modal('show');

            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#kt_assign_products_table')) {
                // DataTable initialization
                var dataTable = $('#kt_assign_products_table').DataTable({
                    "paging": true,
                    "info": false
                });

                // Customer Name filtering
                $('#customerFilter').on('keyup', function() {
                    dataTable.columns(4).search(this.value).draw();
                });

                // Product Name filtering
                $('#productFilter').on('keyup', function() {
                    dataTable.columns(1).search(this.value).draw();
                });
            }
        });
    </script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
@endpush
