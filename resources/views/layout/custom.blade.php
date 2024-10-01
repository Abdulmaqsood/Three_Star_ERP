<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Three Star</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords"
        content="Craft, bootstrap, bootstrap 5, admin themes, dark mode, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" href="{{ asset('assets/media/logo.webp') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->


    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->


    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto bg-white w-xl-600px positon-xl-relative">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Header-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">
                        <!--begin::Logo-->
                        <a href="#" class="py-2 py-lg-20">
                            <img alt="Logo" src="{{asset('assets/media/logo.webp')}}"
                                class="h-60px h-lg-70px" />
                        </a>
                        <!--end::Logo-->

                        <!--begin::Title-->
                        <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 text-primary pb-md-10">
                            Welcome to Three Star
                        </h1>
                        <!--end::Title-->

                        {{-- <!--begin::Description-->
                        <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                            Plan your blog post by choosing a topic creating <br />
                            an outline and checking facts
                        </p>
                        <!--end::Description--> --}}
                    </div>
                    <!--end::Header-->

                    <!--begin::Illustration-->
                    <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url(../../assets/media/illustrations/sigma-1/17.png)">
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--begin::Aside-->

            @yield('content')
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->




    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->


    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->




</body>
<!--end::Body-->


</html>
