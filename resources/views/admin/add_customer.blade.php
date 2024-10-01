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
                        Add Customer </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                                Home </a>
                        </li>

                        <li class="breadcrumb-item text-muted">
                            Customers </li>



                        <li class="breadcrumb-item text-dark">
                            Add Customer </li>

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
            <div class=" container-fluid ">
                <!--begin::Form-->
                <form action="{{ route('store.customer') }}" method="POST"
                    class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                    enctype="multipart/form-data">
                    @csrf
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Category & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Payment Detail</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <!--begin::Label-->
                                <label class=" form-label">Payment Method</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <select name="payment_method_id" data-placeholder="Select a Payment Method..."
                                    class="form-select form-select-solid fw-bold ">
                                    @if ($payments)
                                        <option value="">Select Payment Method...
                                        </option>
                                        @foreach ($payments as $payment)
                                            <option value="{{ $payment->Id }}"
                                                {{ old('payment_method_id') == $payment->Id ? 'selected' : '' }}>
                                                {{ $payment->Name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option disabled>Payment Method Not available...
                                        </option>
                                    @endif


                                </select>
                                <!--end::Input-->
                                @error('payment_method_id')
                                    <span class="text-danger">Payment Method Required</span>
                                @enderror


                                <!--end::Input group-->

                                <!--begin::Button-->
                                <a href="{{ route('add.paymentMethods') }}" class="btn btn-light-primary btn-sm mb-10 mt-3">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new Payment Method
                                </a>
                                <!--end::Button-->
                                <!--begin::Label-->
                                <label class=" form-label">Terms</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <select name="term_id" data-placeholder="Select a Terms..."
                                    class="form-select form-select-solid fw-bold">
                                    @if ($terms)
                                        <option value="">Select Terms...
                                        </option>
                                        @foreach ($terms as $term)
                                            <option value="{{ $term->Id }}"
                                                {{ old('term_id') == $term->Id ? 'selected' : '' }}>
                                                {{ $term->Name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option disabled>Payment Method Not available...
                                        </option>
                                    @endif
                                </select>

                                <!--end::Input-->
                                @error('terms')
                                    <span class="text-danger">Terms Required</span>
                                @enderror


                                <!--end::Input group-->

                                {{-- <!--begin::Button-->
                                <a href="{{ route('add.manufacturer') }}" class="btn btn-light-primary btn-sm mb-10 mt-3">
                                    <i class="ki-duotone ki-plus fs-2"></i> Create new Manufacturer
                                </a>
                                <!--end::Button--> --}}

                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Category & tags-->
                        <!--begin::Category & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Additional Info</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class=" form-label">Business Number</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="business_number" class="form-control mb-2"
                                        placeholder="Business Number..." value="{{ old('business_number') }}">
                                    <!--end::Input-->

                                    @error('business_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class=" form-label">Notes</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <textarea name="notes" class="form-control mb-2" placeholder="Notes..." value="{{old('notes')}}"></textarea>
                                    <!--end::Input-->
                                    @error('notes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->



                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Category & tags-->
                    </div>
                    <!--end::Aside column-->

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
                            role="tablist">
                            <!--begin:::Tab item-->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab">Customer
                                    Details</a>
                            </li>
                            <!--end:::Tab item-->

                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">

                                    <!--begin::General options-->
                                    <div class="card card-flush py-5">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Name & Contact</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class=" form-label"> Title</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="title" class="form-control mb-2"
                                                    placeholder="Enter title..." value="{{ old('title') }}">
                                                <!--end::Input-->
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                                <span class="text-warning fw-bold"> * Title must be shorter than 16
                                                    characters</span>
                                            </div>
                                            <!--end::Input group-->
                                            <div class="row row-cols-1 row-cols-md-1 ">

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required form-label"> Display Name</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="display_name"
                                                            class="form-control mb-2" placeholder="Display name"
                                                            value="{{ old('display_name') }}">
                                                        <!--end::Input-->
                                                        @error('display_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row row-cols-1 row-cols-md-1 ">

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label"> Company Name</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="company_name"
                                                            class="form-control mb-2" placeholder="Company name"
                                                            value="{{ old('company_name') }}">
                                                        <!--end::Input-->
                                                        @error('company_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row row-cols-1 row-cols-md-2 ">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label">First Name</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="first_name" class="form-control mb-2"
                                                            placeholder="First Name..." value="{{ old('first_name') }}">
                                                        <!--end::Input-->

                                                        @error('first_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label">Middle Name</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="middle_name"
                                                            class="form-control mb-2" placeholder="Middle Name..."
                                                            value="{{ old('middle_name') }}">
                                                        <!--end::Input-->


                                                        @error('middle_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row row-cols-1 row-cols-md-2 ">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label">Last Name</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="last_name" class="form-control mb-2"
                                                            placeholder="Middle Name..." value="{{ old('last_name') }}">
                                                        <!--end::Input-->


                                                        @error('last_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label">Email </label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="email" name="email" class="form-control mb-2"
                                                            placeholder="Email..." value="{{ old('email') }}">
                                                        <!--end::Input-->


                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row row-cols-1 row-cols-md-2 ">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label">Phone Number </label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="tel" name="phone_number"
                                                            class="form-control mb-2" placeholder="Phone Number..."
                                                            value="{{ old('phone_number') }}">
                                                        <!--end::Input-->


                                                        @error('phone_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label">Mobile Number </label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="tel" name="mobile_number"
                                                            class="form-control mb-2" placeholder="Phone Number..."
                                                            value="{{ old('mobile_number') }}">
                                                        <!--end::Input-->


                                                        @error('mobile_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                          
                                            <div class="row row-cols-1 row-cols-md-2 ">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label"> Suffix</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="suffix" class="form-control mb-2"
                                                            placeholder="Suffix " value="{{ old('suffix') }}">
                                                        <!--end::Input-->
                                                        @error('suffix')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label"> Fax</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="fax" class="form-control mb-2"
                                                            placeholder="Fax..." value="{{ old('fax') }}">
                                                        <!--end::Input-->

                                                        @error('fax')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row row-cols-1 row-cols-md-2 ">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label"> Other</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="other" class="form-control mb-2"
                                                            placeholder="Other... " value="{{ old('other') }}">
                                                        <!--end::Input-->
                                                        @error('other')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class=" form-label"> Website</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <input type="text" name="website" class="form-control mb-2"
                                                            placeholder="Website..." value="{{ old('website') }}">
                                                        <!--end::Input-->

                                                        @error('website')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>


                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->

                                </div>
                            </div>
                            <!--end::Tab pane-->

                        </div>
                        <!--end::Tab content-->


                        <div class="d-flex flex-column flex-row-fluid gap-7  w-lg-100 gap-lg-12">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Billing Address</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row row-cols-1 row-cols-md-2 ">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Street Address 1</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="address_1" class="form-control mb-2"
                                                    placeholder="Addres 1..." value="{{ old('address_1') }}">
                                                <!--end::Input-->

                                                @error('address_1')
                                                    <span class="text-danger">Address Required</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Street Address 2</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="address_2" class="form-control mb-2"
                                                    placeholder="Street Address 2..." value="{{ old('address_2') }}">
                                                <!--end::Input-->


                                                @error('address_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 ">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">City </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="city" class="form-control mb-2"
                                                    placeholder="City ..." value="{{ old('city') }}">
                                                <!--end::Input-->

                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Province</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="state" class="form-control mb-2"
                                                    placeholder="State..." value="{{ old('state') }}">
                                                <!--end::Input-->


                                                @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 ">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Postal Code</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="zipCode" class="form-control mb-2"
                                                    placeholder="Zip Code..." value="{{ old('zipCode') }}">
                                                <!--end::Input-->

                                                @error('zipCode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Country </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="country" class="form-control mb-2"
                                                    placeholder="Country..." value="{{ old('country') ?? 'Canada' }}">
                                                <!--end::Input-->


                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <!--begin::Input group-->
                                    <div class="d-flex align-items-center justify-content-start mb-7">
                                        <!--begin::Input-->
                                        <input type="checkbox" name="shippingSame" id="shippingSame" class="me-2">
                                        <!--end::Input-->

                                        <!--begin::Label-->
                                        <label for="shippingSame" class="form-label mb-0">Shipping Address Same as Billing
                                            Address</label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Input group-->


                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <div id="shippingAddressDiv" class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Shipping Address</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row row-cols-1 row-cols-md-2 ">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Street Address 1</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="shippingAddress_1" class="form-control mb-2"
                                                    placeholder="Addres 1..." value="{{ old('shippingAddress_1') }}">
                                                <!--end::Input-->

                                                @error('shippingAddress_1')
                                                    <span class="text-danger">Shipping Address Required</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Street Address 2</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="shippingAddress_2" class="form-control mb-2"
                                                    placeholder="Street Address 2..."
                                                    value="{{ old('shippingAddress_2') }}">
                                                <!--end::Input-->


                                                @error('shippingAddress_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 ">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">City </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="shippingCity" class="form-control mb-2"
                                                    placeholder="City ..." value="{{ old('shippingCity') }}">
                                                <!--end::Input-->

                                                @error('shippingCity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">State</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="shippingState" class="form-control mb-2"
                                                    placeholder="State..." value="{{ old('shippingState') }}">
                                                <!--end::Input-->


                                                @error('shippingState')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row row-cols-1 row-cols-md-2 ">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Zip Code</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="shippingZipCode" class="form-control mb-2"
                                                    placeholder="Zip Code..." value="{{ old('shippingZipCode') }}">
                                                <!--end::Input-->

                                                @error('shippingZipCode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class=" form-label">Country </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input type="text" name="shippingCountry" class="form-control mb-2"
                                                    placeholder="Country..." value="{{ old('shippingCountry') }}">
                                                <!--end::Input-->


                                                @error('shippingCountry')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <div class="d-flex justify-content-end">


                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Save Changes
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                    <!--end::Main column-->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // Function to toggle the visibility of the Shipping Address section
            function toggleShippingAddress() {
                if ($('#shippingSame').is(':checked')) {
                    $('#shippingAddressDiv').hide(); // Hide the shipping address section
                } else {
                    $('#shippingAddressDiv').show(); // Show the shipping address section
                }
            }

            // Initially hide or show the shipping address section based on the checkbox state
            toggleShippingAddress();

            // Add event listener to the checkbox
            $('#shippingSame').change(function() {
                toggleShippingAddress();
            });
        });
    </script>
@endpush
