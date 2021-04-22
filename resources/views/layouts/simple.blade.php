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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('css/dashmix.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/xinspire.css') }}">
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
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="row no-gutters justify-content-center bg-body-dark">
                    <div class="hero-static col-sm-12 col-md-10 col-xl-8 d-flex align-items-center p-2 px-sm-0">
                        <!-- Sign In Block -->
                        <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url({{ asset('media/images/main-cover.jpg') }});">
                            <div class="row no-gutters">
                                <div class="col-md-6 order-md-1 bg-white">
                                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">

                                        <!-- Header -->
                                        <div class="mb-3 d-block text-center">
                                            @include('layouts.partials.logo')
                                        </div>
                                        <!-- END Header -->

                                        @yield('content')
                                    </div>
                                </div>
                                <div class="col-md-6 order-md-0 bg-primary-dark-op d-flex align-items-center">
                                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                        <div class="media">
                                           <!--  <a class="img-link mr-3" href="javascript:void(0)">
                                                <img class="img-avatar img-avatar-thumb" src="{{ asset('media/avatars/avatar16.jpg') }}" alt="">
                                            </a> -->
                                            <div class="media-body">
                                                <p class="text-white font-w600 mb-1">
                                                    Please use the form to lodge any formal complaints. If the complaint is of an urgent nature please flag you have submitted this to your regional manager
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        @include('modals/small')
        @include('modals/big')

        <!-- Dashmix Core JS -->
        <script src="{{ asset('js/dashmix.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->

        @yield('js_after')
    </body>
</html>
