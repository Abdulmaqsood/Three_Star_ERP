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
                        Categories </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary"> Dashboard </a> </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('categories') }}"
                                class="text-muted text-hover-primary"> Store Management </a> </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('categories') }}"
                                class="text-muted text-hover-primary"> Categories </a> </li>
                        <li class="breadcrumb-item text-dark"> All Categories </li>
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
            <div class="container-fluid ">
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
                <!--begin::Category-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" id="search-category" data-kt-ecommerce-category-filter="search"
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Search Category">
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Add customer-->
                            <a href="{{ route('add.category') }}" class="btn btn-primary">
                                Add Category
                            </a>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <!--begin::Table-->
                        <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                @if ($categories)
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                        id="kt_ecommerce_category_table">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2">
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                            data-kt-check-target="#kt_table_users .form-check-input"
                                                            value="1" />
                                                    </div>
                                                </th>
                                                <th>Category</th>
                                                {{-- <th class="min-w-125px">Category Description</th> --}}
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600" id="category-table-body">
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td class="d-flex align-items-center">

                                                        <!--begin::User details-->
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ route('edit.category', $category->id) }}"
                                                                class="text-gray-800 text-hover-primary mb-1">{{ $category->name }}</a>

                                                        </div>
                                                        <!--begin::User details-->
                                                    </td>


                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                            Actions
                                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="{{ route('edit.category', $category->id) }}"
                                                                    class="menu-link px-3">
                                                                    Edit
                                                                </a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="{{ route('delete.category', $category->id) }}"
                                                                    class="menu-link px-3">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                @else
                                <div class="shadow-sm p-3 mb-5 bg-white rounded text-center">No Data Found</div>
                                @endif
                            </div>
                            <div class="row">
                                <div
                                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                    <div class="dataTables_length" id="kt_ecommerce_category_table_length">
                                        <label><select name="kt_ecommerce_category_table_length"
                                                aria-controls="kt_ecommerce_category_table"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select></label>
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                        id="kt_ecommerce_category_table_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="kt_ecommerce_category_table_previous"><a href="#"
                                                    aria-controls="kt_ecommerce_category_table" data-dt-idx="0"
                                                    tabindex="0" class="page-link"><i class="previous"></i></a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="kt_ecommerce_category_table" data-dt-idx="1"
                                                    tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_category_table" data-dt-idx="2"
                                                    tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item next"
                                                id="kt_ecommerce_category_table_next"><a href="#"
                                                    aria-controls="kt_ecommerce_category_table" data-dt-idx="3"
                                                    tabindex="0" class="page-link"><i class="next"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search-category').on('keyup', function() {
                var searchValue = $(this).val().toLowerCase();

                $('#category-table-body tr').each(function() {
                    var categoryName = $(this).find('td a').text().toLowerCase();
                    if (categoryName.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endsection
