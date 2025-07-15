<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


        <title>{{ config('app.name', 'VetPartners') }}</title>

        <meta name="description" content="RMA&reg; - The Art of Executive Search &amp; Executive Recrutment">
        <meta name="author" content="dushan887mob3">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')


        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" id="css-main" href="{{ asset('css/dashmix.css') }}">


        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/xinspire.css') }}">
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PGF8FVXP');</script>
        <!-- End Google Tag Manager -->
        <script>
            var csrfToken = document.head.querySelector('meta[name="csrf-token"]');
        </script>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGF8FVXP"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-narrow side-trans-enabled page-header-dark">


            <!-- Sidebar -->
            @include('layouts.partials.sidebar')
            <!-- END Sidebar -->

            <!-- Header -->
            @include('layouts.partials.header')
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
{{--            @include('layouts.partials.footer')--}}
            <!-- END Footer -->

        </div>
        <!-- END Page Container -->

        @include('modals/small')
        @include('modals/big')

        <!-- Dashmix Core JS -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/dashmix.app.js') }}"></script>
        <script src="{{ asset('js/flatpickr.min.js') }}"></script>

        @if (!isset($readonly) || $readonly !== 'readonly')
            <script>
                $(document).ready(function () {

                    let dateOfIncidentDate        = $("#date_of_incident").val();
                    let dateOfClientComplaintDate = $("#date_of_client_complaint").val();

                    $(function () {

                        let dateOfIncident = {
                            dateFormat: "d/m/Y",
                        };

                        if (dateOfIncidentDate !== '') {
                            dateOfIncident.defaultDate = dateOfIncidentDate;
                        }

                        $("#date_of_incident").flatpickr(dateOfIncident);

                        $("#date_to_respond_to_the_client").flatpickr({
                            dateFormat: "d/m/Y",
                        })

                        let dateConfiguration = {
                            dateFormat: "d/m/Y",
                        };

                        $("#date_of_client_complaint").flatpickr(dateConfiguration);

                    });
                });
            </script>
        @endif
        <script>
            $(document).ready(function () {
                let dateCompletedDate = $("#date_completed").val();

                if($('#date_completed').length)
                {
                    let dateConfiguration = {
                        dateFormat: "d/m/Y",
                    };

                    if (dateCompletedDate !== '') {
                        dateConfiguration.defaultDate = dateCompletedDate;
                    }

                    $("#date_completed").flatpickr({
                         dateFormat: "d/m/Y",
                    });
                }
            });
        </script>
        <!-- Laravel Scaffolding JS -->

        @yield('js_after')
    </body>
</html>
