<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Three Star</title>
    <meta charset="utf-8" />
    <meta name="description" content="Three Star" />
    <meta name="keywords" content="Three Star" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="ThreeStar" />
    <meta property="og:site_name" content="Three Star" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logo.webp') }}" />
    @stack('custom-css')
   
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .bg-danger-primary {
            background-color: #f5c6cb;
            /* Example light red */
            color: #721c24;
            /* Example dark red text */
        }
    </style>


</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-fixed aside-default-enabled">
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
    <script>
        // Show the loading spinner when the page starts loading
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('loadingSpinner').style.display = 'block';
        });

        // Hide the loading spinner when the page has fully loaded
        window.addEventListener('load', function() {
            document.getElementById('loadingSpinner').style.display = 'none';
        });

        // Show spinner on any link click or form submission
        document.querySelectorAll('a, form').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('loadingSpinner').style.display = 'block';
            });
        });
    </script>

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!-- Loading Spinner (Initially hidden) -->
            <div id="loadingSpinner"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.7); z-index: 9999; text-align: center; padding-top: 200px;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            @include('sweetalert::sweetalert')


            @include('layout.admin.sidebar')
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('layout.admin.header')

                @yield('content')

                @include('layout.admin.footer')
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    @include('layout.admin.drawers')
    @include('layout.admin.toolbars')
    @include('layout.admin.modals')






    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->


    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->

    @stack('custom-scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->





    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/select-location.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/custom/apps/calendar/calendar.js') }}"></script>






</body>
<!--end::Body-->


</html>
