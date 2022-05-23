<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta name="description" content="@yield('description', config('app.description'))"/>
        <meta name="keywords" content="@yield('keywords', config('app.keywords'))"/>
        <meta name="copyright" content="{{ config('app.name') }}">
        <meta name="author" content="{{ config('app.name') }}"/>
        <meta name="application-name" content="@yield('title', config('app.name'))">
        <!--GEO Tags-->
        <meta name="DC.title" content="@yield('title', config('app.name'))"/>
        <meta name="geo.region" content="BD-DAC"/>
        <meta name="geo.placename" content="Dhaka"/>
        <meta name="geo.position" content="23.8103; 90.4125"/>
        <meta name="ICBM" content="23.8103,  90.4125"/>
        <!--Facebook Tags-->
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="{{ request()->fullUrl() }}"/>
        <meta property="og:title" content="@yield('title', config('app.name'))"/>
        <meta property="og:description" content="@yield('description', config('app.description'))"/>
        <meta property="og:image" content="{{ request()->root() }}/images/TODO.png"/>
        <meta property="article:author" content="https://www.facebook.com/TODO"/>
        <meta property="og:locale" content="en_UK"/>
        <!--Twitter Tags-->
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:site" content="{{ '@' . config('app.name') }}"/>
        <meta name="twitter:title" content="@yield('title', config('app.name'))"/>
        <meta name="twitter:description" content="@yield('description', config('app.description'))"/>
        <meta name="twitter:image" content="{{ request()->root() }}/images/TODO.png"/>


        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/font-awesome/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-4.min.css">
        {{-- <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/select2.min.css"> --}}
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/theme.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <style>
            .blood-group:hover{
                color: rgb(119, 12, 96) !important;
                transition: .9s all;
            }
            .custom-link{
                color:#cae7ff !important;
            }
            .custom-link:hover{
                transition: all .9s;
                color:#ffffff !important;
            }

            .custom-link-active{
                color: cornsilk !important;
            }

            .hoverable-card:hover{
                background: cornsilk;
            }

            .hover-zoom {
                margin: 0;
                height: 180px;
                width: 100%;
                transition: all 0.3s ease-in-out;
                background-size: 150%;
                background-position: center;
                background-repeat: no-repeat;
                background-color: gray;
                position: relative;
            }

            .hover-zoom:hover {
                background-size: 100%;
            }

            .myaccordion {
                box-shadow: 0 0 1px rgba(0,0,0,0.1);
                }

                .myaccordion .card,
                .myaccordion .card:last-child .card-header {
                border: none;
                }

                .myaccordion .card-header {
                border-bottom-color: #EDEFF0;
                background: transparent;
                }

                .myaccordion .fa-stack {
                font-size: 12px;
                }

                .myaccordion .btn {
                width: 100%;
                font-weight: bold;
                color: #004987;
                padding: 0;
                }

                .myaccordion .btn-link:hover,
                .myaccordion .btn-link:focus {
                text-decoration: none;
                }

                .myaccordion li + li {
                margin-top: 10px;
                }

                .social-link {
                    width: 30px;
                    height: 30px;
                    border: 1px solid #ddd;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: rgb(26, 22, 22);
                    border-radius: 50%;
                    transition: all 0.3s;
                    font-size: 0.9rem;
                }

                .social-link:hover, .social-link:focus {
                    background: rgb(158, 158, 158);
                    text-decoration: none;
                    color: #555;
                }
        </style>

        @livewireStyles
    </head>
    <body class="hold-transition layout-top-nav layout-navbar-fixed" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif,Roboto">
    <div class="wrapper">
        <div class="content-wrapper" style="background: #eee;">



            @livewire('navigation-menu')



            <!-- Page Content -->
            @yield('content')

        </div>

        <!-- Main Footer -->
        <footer class="main-footer bg-gradient-gray border-top-0 p-0">
            <div class="container-fluid bg-gradient-gray border-buttom-0">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('home') }}" class="navbar-brand ml-3 mb-0">
                            <img src="{{ asset('frontend') }}/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image  img-circle img-size-50 elevation-3"
                                 style="opacity: .8;height: 20px;">

                        </a>
                    </div>
                    <div class="col-md-6 text-center">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('about_us') }}">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('contact_us') }}">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Donate</a>
                            </li>
                            @guest
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
                            </li>
                            @endguest
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('blog') }}">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('support') }}" class="btn btn-link text-lime">Gent Instant Support in your area</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-gradient-gray">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="card-header border-bottom-0">
                            <h4 class="m-0">Contact Us</h4>
                            <ul class="mb-0 mt-2 ml-0 list-unstyled">
                                <li class="text-white">Khilket , Nikonjo-2</li>
                                <li class="text-white">Dhaka 1207</li>
                                <li class="text-white">Bangladesh</li>
                                <li class="text-white"><b>Hotline : </b>+88018123456789</li>
                                <li class="text-white"><b>E-mail :  </b>abb@gmail.com</li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card-header border-bottom-0">
                            <h4 class="m-0">Donation</h4>
                            <p>Donating blood is a win-win for everyone involved. Receivers get a vital substance and donors get to burn calories, lower their risk of cancer and keep their heart healthy. All this while laying back and taking a relaxing 45-60 minutes to do a good deed and save lives!</p>
                            <span><i class="fab fa-cc-visa" style="font-size: 34px;"></i></span>
                            <span><i class="fab fa-cc-mastercard" style="font-size: 34px;"></i></span>
                            <span><i class="fab fa-cc-paypal" style="font-size: 34px;"></i></span>
                            <span><i class="fab fa-cc-stripe" style="font-size: 34px;"></i></span>
                            <span><i class="fab fa-cc-amex" style="font-size: 34px;"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card-header border-bottom-0">
                            <h4 class="m-0">Feedback</h4>
                            @livewire('feedback')
                        </div>
                        <div class="card-header border-bottom-0">
                            <h4 class="m-0">Repoarts</h4>
                            @livewire('report')
                        </div>
                    </div>
                </div>
            </div>
            <!-- To the right -->
            <div class="float-right mr-3 d-sm-inline mt-3">
                <div class="social d-flex">
                    <a href="#" class="social-link mr-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link mr-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link mr-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Default to the left -->
            <div class="float-md-left ml-4 py-3">
                <a href="{{ route('terms') }}" class="text-white">Terms & Condition</a>
                 |
                 <a href="{{ route('privacy') }}" class="text-white">Privacy & Policy</a>
            </div>

            <div class="py-md-3 py-1 ml-3 text-center">
                <strong class="">Copyright &copy; {{date('Y')}} <a href="{{ route('home') }}" class="text-red">Blood Bank</a>.</strong> All rights reserved.

            </div>
        </footer>

    </div>










        @stack('modals')

        <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/sweetalert2.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/toastr.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/jquery.overlayScrollbars.js"></script>
        {{-- <script src="{{ asset('frontend') }}/assets/js/select2.full.min.js"></script> --}}
        <!-- AdminLTE App -->
        <script src="{{ asset('frontend') }}/assets/js/theme.min.js"></script>
        <script src="{{ asset('frontend') }}/assets/js/demo.js"></script>
        <script>
            $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
                 $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
            });

        </script>
        @stack('js')
        @if (session()->has('status'))
            <script>
                $(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('status') }}'
                    });
                });

            </script>
        @endif

        @if (session()->has('wrong'))
            <script>
                $(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'error',
                        title: '{{ session('wrong') }}'
                    });
                });

            </script>
        @endif

        @if ($errors->any())

            @foreach ($errors->all() as $error)
                <script>
                    $(function() {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'center',
                            showConfirmButton: false,
                            timer: 5000
                        });
                        Toast.fire({
                            icon: 'error',
                            title: '{{ $error }}'
                        });
                    });

                </script>
            @endforeach

        @endif


        @livewireScripts
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script> --}}
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
    </body>
</html>
