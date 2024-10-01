@extends('layout.master')

@section('content')
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">All Favourites </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('dashboard') }}"
                                class="text-muted text-hover-primary"> Dashboard </a> </li>
                        {{-- <li class="breadcrumb-item text-muted"> <a href="{{route('products')}}"
                                class="text-muted text-hover-primary"> Store Management </a> </li> --}}
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('products') }}"
                                class="text-muted text-hover-primary">All Favourites </a> </li>
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
                                    class="form-control form-control-solid w-250px ps-12" id="productFilter"  placeholder="Search Customer">
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
            
                    </div>

                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div id="kt_assign_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-striped fs-6 gy-5" id="kt_assign_products_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2" style="width: 30px;">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                           data-kt-check-target="#kt_assign_products_table .form-check-input" value="1">
                                                </div>
                                            </th>
                                            <th class="min-w-100px text-center" style="width: 150px;">Customer</th>
                                            <th class="min-w-70px text-center" style="width: 150px;">Favourite Products</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @if ($customers)
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" name="selected_customers[]" value="{{ $customer->Id }}">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ $customer->DisplayName }}</td>
                                                    <td class="text-center">
                                                        <a href="{{route('all.assigned.products',$customer->Id)}}" class="btn btn-primary btn-sm">Favourite Products</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">No customers found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                
                            </div>
                      
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
