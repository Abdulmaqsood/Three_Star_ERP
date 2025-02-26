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
                    <h1 class="text-dark fw-bold my-1 fs-2"> Drafts </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary"> Dashboard </a> </li>
                        {{-- <li class="breadcrumb-item text-muted"> <a href="{{route('products')}}"
                                class="text-muted text-hover-primary"> Store Management </a> </li> --}}
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('drafts') }}"
                                class="text-muted text-hover-primary"> Drafts </a> </li>
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
                                    class="form-control form-control-solid w-250px ps-12" placeholder="Search Invoices">
                            </div>
                            <!--end::Search-->
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
                            {{-- <!--begin::Add product--> <a href="{{ route('export.products') }}" class="btn btn-primary"> 
                            Download File </a>
                            <!--end::Add product-->
                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                            <i class="ki-duotone ki-exit-up fs-2"><span class="path1"></span><span class="path2"></span></i>        Export CSV
                        </button> --}}
                            <!--begin::Add product--> <a href="{{ route('add.invoice') }}" class="btn btn-primary"> Add
                                Invoice </a>
                            <!--end::Add product-->
                            {{-- <!--begin::Add invoice-->
                            <a href="{{ route('quickbooks.invoices') }}" class="btn btn-primary ms-2" id="export-button">
                                Export to quickbook
                            </a>
                            <!--end::Add customer--> --}}
                            <div id="loading-spinner" class="loader" style="display: none;"></div>

                        </div>
                        <!--end::Card toolbar-->
                    </div>

                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div id="kt_ecommerce_invoices_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                    id="kt_ecommerce_invoices_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1"
                                                aria-label="">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_ecommerce_invoices_table .form-check-input"
                                                        value="1">
                                                </div>
                                            </th>
                                            <th class="min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_invoices_table" rowspan="1" colspan="1"
                                                aria-label="Invoice Number: activate to sort column ascending"
                                                style="width: 100px;">Invoice #</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_invoices_table" rowspan="1" colspan="1"
                                                aria-label="Customer: activate to sort column ascending"
                                                style="width: 100px;">
                                                Customer</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_invoices_table" rowspan="1" colspan="1"
                                                aria-label="SubTotal: activate to sort column ascending"
                                                style="width: 100px;">SubTotal</th>
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_invoices_table" rowspan="1" colspan="1"
                                                aria-label="Total: activate to sort column ascending"
                                                style="width: 100px;">
                                                Total</th>
                                            {{-- <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_invoices_table" rowspan="1" colspan="1"
                                                aria-label="Description: activate to sort column ascending"
                                                style="width: 100px;">
                                                Description</th> --}}
                                            <th class="text-end min-w-100px sorting" tabindex="0"
                                                aria-controls="kt_ecommerce_invoices_table" rowspan="1" colspan="1"
                                                aria-label="Tax: activate to sort column ascending" style="width: 100px;">
                                                Tax</th>

                                            <th class="text-end min-w-70px sorting_disabled" rowspan="1"
                                                colspan="1" aria-label="Actions" style="width: 101.875px;">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @if (!empty($invoices) && count($invoices) > 0)
                                            @forelse ($invoices as $invoice)
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

                                                            <div class="ms-5">
                                                                <!--begin::Title--> <a href="{{ route('edit.draft.invoice', $invoice->id) }}"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">#{{ $invoice->invoice_number }}</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">
                                                            @foreach ($customers as $customer)
                                                                @if ($customer->Id == $invoice->customer_id)
                                                                    {{ $customer->DisplayName }}
                                                                @endif
                                                            @endforeach
                                                        </span>

                                                    </td>
                                                    <td class="text-end pe-0"> <span
                                                            class="fw-bold ms-3">{{ $invoice->sub_total }}$ </span> </td>
                                                    <td class="text-end pe-0">{{ $invoice->total }}$</td>
                                                    {{-- <td class="text-end pe-0">{{ $invoice->description   ?? "null" }}</td> --}}
                                                    <td class="text-end pe-0">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">{{ $invoice->tax }} $</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <a href="{{ route('edit.draft.invoice', $invoice->id) }}"><i
                                                                class="bi bi-pen fs-2 text-success mx-2"></i></a>
                                                        <form action="{{ route('delete.draft.invoice', $invoice->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                style="border: none; background: none; cursor: pointer; padding: 0;">
                                                                <i class="bi bi-trash fs-2 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>


                                                    {{-- <td class="mt-3 d-flex align-items-center ju
                                            stify-content-center">
                                                       <!--begin::Menu item-->
                                                <a href="{{route('edit.invoice',$invoice->Id)}}" class=" px-3"> <i class="bi bi-pencil-square fs-3"></i> </a>
                                                <a href="{{route('delete.invoice',$invoice->Id)}}" class=" px-3"> <i class="bi bi-trash fs-3"></i> </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <a href="{{route('show.invoice',$invoice->Id)}}"
                                                        class=" px-3"> <i class="bi bi-download fs-3"></i> 
                                                    </a>
                                                <!--end::Menu item-->

                                            </td> --}}
                                                    {{-- <td class="text-end"> <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                            Actions <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                          
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3"> <a
                                                                    href="{{ route('edit.draft.invoice', $invoice->id) }}"
                                                                    class="menu-link px-3"> Edit </a> </div>
                                                                    <form action="{{ route('delete.draft.invoice', $invoice->id) }}" method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="menu-item px-3" style="border: none; background: none; cursor: pointer;">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                            <!--end::Menu item-->
                                                           
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td> --}}
                                                </tr>
                                            @empty
                                                <p>No Drafts Found</p>
                                            @endforelse
                                        @else
                                            <p>No Drafts Found</p>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="row">
                                <div
                                    class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                                    <div class="dataTables_length" id="kt_ecommerce_invoices_table_length"><label><select
                                                name="kt_ecommerce_invoices_table_length"
                                                aria-controls="kt_ecommerce_invoices_table"
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
                                        id="kt_ecommerce_invoices_table_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="kt_ecommerce_invoices_table_previous"><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="0"
                                                    tabindex="0" class="page-link"><i class="previous"></i></a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="1"
                                                    tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="2"
                                                    tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="3"
                                                    tabindex="0" class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="4"
                                                    tabindex="0" class="page-link">4</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="5"
                                                    tabindex="0" class="page-link">5</a></li>
                                            <li class="paginate_button page-item next"
                                                id="kt_ecommerce_invoices_table_next"><a href="#"
                                                    aria-controls="kt_ecommerce_invoices_table" data-dt-idx="6"
                                                    tabindex="0" class="page-link"><i class="next"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->

                </div>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#kt_ecommerce_invoices_table').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search
                "ordering": true, // Enable sorting on columns
                "info": true, // Show table information (e.g., "Showing 1 to 10 of 57 entries")
                "lengthChange": true, // Allow the user to change the number of records shown per page
                "pageLength": 10, // Number of rows to show by default
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    }, // Disable ordering on the checkbox column
                    {
                        "orderable": false,
                        "targets": -1
                    } // Disable ordering on the Actions column
                ]
            });
            $('input[data-kt-ecommerce-product-filter="search"]').on('keyup', function() {
                $('#kt_ecommerce_invoices_table').DataTable().search($(this).val()).draw();
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
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#kt_modal_export_users').modal('show');

            });
        </script>
    @endif
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
@endpush
