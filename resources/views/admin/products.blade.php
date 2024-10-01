@extends('layout.master')
@push('custom-css')
    <style>
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
                    <h1 class="text-dark fw-bold my-1 fs-2"> Products </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary"> Dashboard </a> </li>
                        {{-- <li class="breadcrumb-item text-muted"> <a href="{{route('products')}}"
                                class="text-muted text-hover-primary"> Store Management </a> </li> --}}
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('products') }}"
                                class="text-muted text-hover-primary"> Products </a> </li>
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Search Product">
                            </div>
                            <!--end::Search-->
                            <div class="mx-1">
                                <select id="categoryFilter" class="form-select">
                                    <option value="all">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                            <!--begin::Add product--> <a href="{{ route('export.products') }}" class="btn btn-primary">
                                Download File </a>
                            <!--end::Add product-->
                            <!--<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"-->
                            <!--    data-bs-target="#kt_modal_export_users">-->
                            <!--    <i class="ki-duotone ki-exit-up fs-2"><span class="path1"></span><span-->
                            <!--            class="path2"></span></i> Import CSV-->
                            <!--</button>-->
                            <!--begin::Add product--> <a href="{{ route('add.product') }}" class="btn btn-primary"> Add
                                Product </a>
                            <!--end::Add product-->
                            {{-- <!--begin::Add invoice-->
                            <a href="{{ route('quickbooks.products') }}" class="btn btn-primary ms-2" id="export-button">
                                Export to quickbook
                            </a>
                            <!--end::Add customer--> --}}
                            <div id="loading-spinner" class="loader" style="display: none;"></div>
                        </div>
                        <!--end::Card toolbar-->
                    </div>

                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                    id="kt_ecommerce_products_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="" style="width: 29.8906px;">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                        value="1">
                                                </div>
                                            </th>
                                            <th class="min-w-200px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="Product: activate to sort column ascending"
                                                style="width: 200px;">Product</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="SKU: activate to sort column ascending" style="width: 100px;">
                                                SKU</th>
                                            <th class="text-end min-w-70px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="Qty: activate to sort column ascending"
                                                style="width: 85.9844px;">type</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="Price: activate to sort column ascending"
                                                style="width: 100px;">
                                                Price</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="Cost: activate to sort column ascending"
                                                style="width: 100px;">
                                                Cost</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="Profit: activate to sort column ascending"
                                                style="width: 100px;">Profit</th>
                                                 <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_products_table" rowspan="1" colspan="1"
                                                aria-label="Pack: activate to sort column ascending"
                                                style="width: 100px;">Pack</th>

                                            <th class="text-end min-w-70px sorting_disabled" rowspan="1"
                                                colspan="1" aria-label="Actions" style="width: 101.875px;">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @if (!empty($products) && count($products) > 0)
                                            @forelse ($products as $product)
                                                @php
                                                    $myProduct = App\Models\Product::where('quickbook_id', $product->Id)
                                                        ->with('category', 'subCategory', 'vendor', 'manufacturer')
                                                        ->first();
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
                                                          href="{{ route('edit.product', $product->id) }}"
                                                          class="symbol symbol-50px"> <span class="symbol-label"
                                                              style="background-image:url({{ asset('storage/productImages/' . $product->image) }});"></span>
                                                      </a>
                                                      <!--end::Thumbnail--> --}}
                                                            <div class="ms-5">
                                                                <!--begin::Title--> <a
                                                                    href="{{ route('edit.product', $product->Id) }}"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">{{ $product->Name }}</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0"> <span
                                                            class="fw-bold">{{ $product->Sku }}</span> </td>
                                                    <td class="text-end pe-0" data-order="31"> <span
                                                            class="fw-bold ms-3">{{ $product->Type }}</span> </td>
                                                    <td class="text-end pe-0">{{ $product->UnitPrice }}</td>
                                                    <td class="text-end pe-0">{{ $product->PurchaseCost }}</td>
                                                    <td class="text-end pe-0">
                                                        {{ $myProduct->profit ?? '' }}</td>
                                                                                                            <td class="text-end pe-0">{{ $myProduct->pack }}</td>



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
                                                                    href="{{ route('edit.product', $product->Id) }}"
                                                                    class="menu-link px-3"> Edit </a> </div>
                                                            <!--end::Menu item-->
                                                            {{-- <!--begin::Menu item-->
                                                  <div class="menu-item px-3"> <a
                                                          href="{{ route('delete.product', $product->Id) }}"
                                                          class="menu-link px-3"> Delete
                                                      </a>
                                                  </div>
                                                  <!--end::Menu item--> --}}
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                            @empty
                                                <p>No Items found.</p>
                                            @endforelse
                                        @else
                                            <p>No Items found.</p>
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
            // Function to filter products based on selected category
            function filterProductsByCategory(categoryId) {

                $('#kt_ecommerce_products_table tbody tr').each(function() {
                    if (categoryId === 'all' || $(this).attr('data-category-id') == categoryId) {
                        $(this).show(); // Show products matching the category or show all
                    } else {
                        $(this).hide(); // Hide products that do not match the category
                    }
                });
            }

            // Event handler for category selection
            $('#categoryFilter').on('change', function() {
                var categoryId = $(this).val(); // Get the selected category ID
                filterProductsByCategory(categoryId); // Filter products based on the selected category
            });
            // Initially filter products based on the default or initial category filter value
            var initialCategoryId = $('#categoryFilter').val();
            filterProductsByCategory(initialCategoryId);
            // Additional logic to handle "All" category
            $('#categoryFilter').on('change', function() {
                var categoryId = $(this).val(); // Get the selected category ID

                if (categoryId === 'all') {
                    // If "All" is selected, show all products
                    $('#kt_ecommerce_products_table tbody tr').show();
                } else {
                    // Filter products based on the selected category
                    filterProductsByCategory(categoryId);
                }
            });
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
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
@endpush
