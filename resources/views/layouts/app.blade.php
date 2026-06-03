<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    // Load settings from DB as key => value
    $settings = \App\Models\Settings::pluck('value', 'key')->toArray();
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- Site Icons -->
    <link rel="shortcut icon"
          href="{{ isset($settings['icon']) ? asset('storage/'.$settings['icon']) : asset('images/favicon.ico') }}"
          type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Colors CSS -->
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="{{ asset('css/versions.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Modernizer for Portfolio -->
    <script src="{{ asset('js/modernizer.js') }}"></script>

    @livewireStyles
</head>

<body class="clinic_version">

    <!-- LOADER -->
    <div id="preloader">
        <a href="{{ url('/') }}">
            <img class="preloader" src="{{ asset('images/loaders/heart-loading2.gif') }}" alt="">
        </a>
    </div>
    <!-- END LOADER -->

    <header>
        <div class="header-top wow fadeIn">
            <div class="container">
                <div class="right-header">
                    <div class="header-info">
                        <div class="info-inner">
                            <span class="icontop"><img src="{{ asset('images/phone-icon.png') }}" alt="#"></span>
                            <span class="iconcont">
                                <a href="tel:{{ $settings['phone'] ?? '+885 17 222 333' }}">
                                    {{ $settings['phone'] ?? '+885 17 222 333' }}
                                </a>
                            </span>
                        </div>
                        <div class="info-inner">
                            <span class="icontop"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <span class="iconcont">
                                <a href="mailto:{{ $settings['email'] ?? 'KhmerYerng@org' }}">
                                    {{ $settings['email'] ?? 'KhmerYerng@org' }}
                                </a>
                            </span>
                        </div>
                        <div class="info-inner">
                            <span class="icontop"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            <span class="iconcont">
                                <a href="#">
                                    Daily: {{ $settings['working_horse'] ?? '7:00 AM - 8:00 PM' }}
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom wow fadeIn">
            <div class="container-fluid">
                <nav class="main-menu">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li onclick="check_active('Home')"><a id="Home" href="{{ url('/') }}">Home</a></li>
                            <li onclick="check_active('Services')"><a id="Services" href="{{ url('/services') }}">Services</a></li>
                            <li onclick="check_active('Doctors')"><a id="Doctors" href="{{ url('doctor') }}">Doctors</a></li>
                            <li onclick="check_active('About')"><a id="About" href="{{ url('/about') }}">About us</a></li>
                            <li onclick="check_active('Contact')"><a id="Contact" href="{{ url('contact') }}">Contact</a></li>
                            @auth
                                @if(auth()->user()->is_super_admin)
                                    <li onclick="check_active('admin-area')">
                                        <a id="admin-area" href="{{ route('admin_settings') }}">Admin Area</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <a href="#home" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <footer id="footer" class="footer-area wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo padding">
                        <a href="{{ url('/') }}">
                            <img src="{{ isset($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('images/logo.png') }}" alt="">
                        </a>
                        <p>{{ $settings['description'] ?? 'KhmerYerng' }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-info padding">
                        <h3>CONTACT US</h3>
                        <p><i class="fa fa-map-marker"></i> {{ $settings['address'] ?? 'Phsar Kandal II , Khan Doun Penh , Phnom Penh' }}</p>
                        <p><i class="fa fa-paper-plane"></i> {{ $settings['email'] ?? 'KhmerYerng@org' }}</p>
                        <p><i class="fa fa-phone"></i> {{ $settings['phone'] ?? '+885 17 222 333' }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="copyright-area wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="footer-text">
                        <p>© {{ date('Y') }} <a href="{{ url('') }}" target="_blank">KhmerYerng</a> , Inc</p>
                        <p><a href="{{ route('admin_dashboard') }}">Admin Login</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="social">
                        <ul class="social-links">
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts

    <!-- JS Files -->
    <script src="{{ asset('js/all-in-one.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        function check_active(d) {
            document.getElementById(d)?.classList.add('active');
        }
    </script>
</body>
</html>
