<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


        <title>{{ config('app.name', 'VetPartners') }}</title>

        <meta name="description" content="Complaint Form">
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


        <link rel="stylesheet" id="css-main" href="{{ asset('css/dashmix.css') }}">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" />
        <!-- END Plugins -->


        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/xinspire.css') }}">
        <link rel="stylesheet" id="css-custom" href="{{ asset('css/custom.css') }}">
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-G98990XJNN"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-G98990XJNN');
        </script>
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="main-content-boxed">

            <!-- Header -->
            @include('layouts.partials.public_header')
            <!-- END Header -->

            <!-- Banner -->
            @yield('banner')
            <!-- END Banner -->

            <!-- Main Container -->
            <main id="main-container" class="container mb-5">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            @include('layouts.partials.footer')
            <!-- END Footer -->

        </div>
        <!-- END Page Container -->

        @include('modals/small')
        @include('modals/big')

        <!-- Dashmix Core JS -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/dashmix.app.js') }}"></script>
        <script src="{{ asset('js/flatpickr.min.js') }}"></script>

        <!-- Slick Slider -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
        <script>jQuery(function(){Dashmix.helpers('slick');});</script>
        <script>
            $(document).ready(function () {

                // LINE SCROLL
                $('.page-scroll').on('click', function(e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $(this).offset().top - 100
                    }, 600);
                 })
                $('.header-scroll').on('click', function(e) {
                    $('html, body').animate({
                        scrollTop: $('#Available-Nominations').offset().top - 180
                    }, 600);
                })

                let dateOfIncidentDate        = $("#date_of_incident").val();
                let dateOfClientComplaintDate = $("#date_of_client_complaint").val();
                let dateCompletedDate         = $("#date_completed").val();

                $(function () {

                    dateOfIncident = {
                        dateFormat: "d/m/Y",
                    };

                    if (dateOfIncidentDate !== '') {
                        dateOfIncident.defaultDate = dateOfIncidentDate;
                    }

                    $("#date_of_incident").flatpickr(dateOfIncident);

                    dateConfiguration = {
                        dateFormat: "d/m/Y",
                    };

                    $("#date_of_client_complaint").flatpickr(dateConfiguration);

                    if($('#date_completed').length){

                        if (dateCompletedDate !== '') {
                            dateConfiguration.defaultDate = dateCompletedDate;
                        }

                        $("#date_completed").flatpickr(dateConfiguration);
                    }

                });
            });
        </script>

        <!-- Laravel Scaffolding JS -->

        @yield('js_after')
    </body>
</html>
