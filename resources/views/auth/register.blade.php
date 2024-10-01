{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layout.custom')

@section('content')
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10 p-lg-15 mx-auto">

                <!--begin::Form-->
                <form class="form w-100" action="{{ route('register') }}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-10 text-center">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">
                            Create an Account
                        </h1>
                        <!--end::Title-->

                        <!--begin::Link-->
                        <div class="text-gray-400 fw-semibold fs-4">
                            Already have an account?

                            <a href="{{ route('login') }}" class="link-primary fw-bold">
                                Sign in here
                            </a>
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Action-->
                    <button type="button" class="btn btn-light-primary fw-bold w-100 mb-10">
                        <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}"
                            class="h-20px me-3" />
                        Sign in with Google
                    </button>
                    <!--end::Action-->

                    <!--begin::Separator-->
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-semibold text-gray-400 fs-7 mx-2">OR</span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <!--end::Separator-->

                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <label class="form-label fw-bold text-dark fs-6"> Name</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                placeholder="Enter Name here..." name="name" autocomplete="off" />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bold text-dark fs-6">Email</label>
                        <input class="form-control form-control-lg form-control-solid" type="email" placeholder="Enter email here..."
                            name="email" autocomplete="off" />
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-bold text-dark fs-6">
                                Password
                            </label>
                            <!--end::Label-->

                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    placeholder="" name="password" autocomplete="off" />

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-2"></i> <i
                                        class="ki-duotone ki-eye fs-2 d-none"></i> </span>
                            </div>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                            <!--end::Input wrapper-->

                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                </div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                </div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                </div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Hint-->
                        <div class="text-muted">
                            Use 8 or more characters with a mix of letters, numbers & symbols.
                        </div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group--->

                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <label class="form-label fw-bold text-dark fs-6">Confirm Password</label>
                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder=""
                            name="password_confirmation" autocomplete="off" />
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <!--end::Input group-->

                    {{-- <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1" />
                            <span class="form-check-label fw-semibold text-gray-700 fs-6">
                                I Agree <a href="#" class="ms-1 link-primary">Terms and conditions</a>.
                            </span>
                        </label>
                    </div>
                    <!--end::Input group--> --}}

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->


    </div>
    <!--end::Body-->
@endsection
