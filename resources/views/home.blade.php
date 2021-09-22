@extends('layouts.public')

@section('banner')
    <div class="position-relative overflow-hidden">
        <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="false" data-arrows="true">
            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url( {{ asset('media/images/ForestHill5.jpg')}} ); height: 80vh; min-height: 500px; background-position: center top !important;">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 ">
                                    <h2 class="text-white display-4"><strong>Complaints Reporting</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Please use the form to lodge any formal complaints. If the complaint is of an urgent nature please flag you have submitted this to your regional manager</p>
                                    <a href="{{ route('complaint-form.create') }}" class="btn btn-hero btn-hero-primary btn-hero-lg m-1">Submit a complaint</a>

                                    <a href="{{ route('login') }}" class="btn btn-hero btn-hero-light btn-hero-lg m-1">View Submitted Complaints</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->

            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url({{ asset('media/images/BetterPets22-flip.jpg')}}); height: 80vh; min-height: 500px; background-position: center  !important;">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 ">
                                    <h2 class="text-white display-4"><strong>Complaints Reporting</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Please use the form to lodge any formal complaints. If the complaint is of an urgent nature please flag you have submitted this to your regional manager</p>
                                     <a href="{{ route('complaint-form.create') }}" class="btn btn-hero btn-hero-primary btn-hero-lg m-1">Submit a complaint</a>
                                    @if (!Auth::check())
                                    <a href="{{ route('login') }}" class="btn btn-hero btn-hero-light btn-hero-lg m-1">View Submitted Complaints</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->

            <!-- slide -->
            <div>
                <div class="bg-image d-flex w-100" style="background-image: url({{ asset('media/images/BexleyVet2018099.jpg')}}); height: 80vh; min-height: 500px; background-position: center  !important;">
                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 ">
                                    <h2 class="text-white display-4"><strong>Complaints Reporting</strong></h2>
                                    <p class="text-white h3" style="opacity: .85;">Please use the form to lodge any formal complaints. If the complaint is of an urgent nature please flag you have submitted this to your regional manager</p>
                                     <a href="{{ route('complaint-form.create') }}" class="btn btn-hero btn-hero-primary btn-hero-lg m-1">Submit a complaint</a>
                                    @if (!Auth::check())
                                    <a href="{{ route('login') }}" class="btn btn-hero btn-hero-light btn-hero-lg m-1">View Submitted Complaints</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slide -->
        </div>

        <div class="ds-seperator">

            <a class="page-scroll fusion-one-page-text-link" href="#">
                <div class="lineholderfirst"></div>
            </a>

            <div class="lineholder">
                <svg version="1.1" class="firstdivider" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0.5px" y="0.5px" width="2560px" height="100px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve">
                    <path class="st0" id="linec1c" d="M1300.8,55.1 M1259.2,48 M1269.8,47.6l10,11.9l10.3-11.9C1290.2,47.7,1269.4,47.6,1269.8,47.6z M1280,34.2c-9.7,0-17.6,7.9-17.6,17.6s7.9,17.6,17.6,17.6s17.6-7.9,17.6-17.6S1289.7,34.2,1280,34.2z" shape-rendering="auto" transform="translate(0.5,0.5)"></path>
                    <path class="st0" id="linec1r" d="M2560,36c0,0-108.5-19-225-19c-282.8,0-413,74-666.5,74c-138.6,0-256.9-17.1-367.7-35.9" shape-rendering="auto" transform="translate(0.5,0.5)"></path>
                    <path class="st0" id="linec1l" d="M1259.2,48C1141.6,27.7,1030.9,7.8,911,7.8C706.2,7.8,484,96,229.5,96C107,96,0,80.5,0,80.5" shape-rendering="auto" transform="translate(0.5,0.5)"></path>
                </svg>

            </div>

        </div>

    </div>
@endsection

@section('content')

    <section>
        <div class="section-wrapper py-5">
            <div class="container-xl pb-4 py-5">
                <div class="row no-gutters">
                    <div class="col-lg-6">
                        <div class="d-block h-100 bg-image" style="background: url({{ asset('media/images/Clayfield5.jpg')}});"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-inner py-4 px-5" style="background: #d8efee">

                            <h2 class="text-primary pt-4">Complaints Management <br /> & Handling</h2>

                            <div class="d-block" style="height: 2px; width: 200px; background:#a5cf4c"></div>
                            <br>

                            <p>Please use the website to lodge any formal complaints and to document the process. This system is designed to ensure complaints are properly recorded, assigned, tracked, and resolved. </p>

                            <ul>
                                <li>If a complaint is of an urgent nature please flag you have submitted this to your regional manager. </li>
                                <li>If you encounter any site issues or require login access please contact IT helpdesk.</li>
                            </ul>
                            <br>

                            <p class="mb-0"><strong>Once you have completed your complaint form a confirmation email will be sent to your email address.</strong></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
