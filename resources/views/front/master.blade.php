<!DOCTYPE html>
@php
    $language = \App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first();
@endphp

@if ($language->rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @else
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        @endif

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{asset($generalSettingView->site_name)}}">
    <meta name="keywords" content="{{asset($generalSettingView->site_name)}}">
    <meta name="author" content="{{asset($generalSettingView->site_name)}}">
    <link rel="icon" href="{{asset($generalSettingView->favicon)}}" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/vendors/bootstrap.css">

    <!-- wow css -->
    <link rel="stylesheet" href="{{asset('/')}}front/assets/css/animate.min.css">


    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/bulk-style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/vendors/animate.css">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{asset('/')}}front/assets/css/style.css">

    <style>
        .shopping-summary {
            position: fixed;
            top: 50%; /* Position in the middle vertically */
            right: 0; /* Align to the right edge */
            transform: translateY(-50%); /* Center alignment */
            width: 6%; /* Set width */
            background-color: #f9f9f9; /* Light background */
            border: 1px solid #ccc; /* Optional border */
            border-radius: 8px; /* Rounded corners */
            z-index: 1000; /* Ensure it's on top */
            overflow: hidden; /* Prevent content overflow */
        }

        .shopping-icon {
            background-color: #6c757d; /* Background for the top section */
            width: 100%;
        }

        .shopping-items {
            width: 100%;
            font-family: Arial, sans-serif;
        }

        /* Cart Icon Summary */
        .cart-summary {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: #f9f9f9;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px 0 0 8px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Slide-in Cart Container */
        .cart-container {
            position: fixed;
            top: 0;
            right: -400px; /* Hidden initially */
            height: 100%;
            width: 400px;
            background-color: #fff;
            transition: right 0.3s ease-in-out;
            z-index: 1050;
            overflow: hidden; /* Hide overflow initially */
            box-shadow: -2px 0 4px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column; /* Stack header, body, and footer vertically */
        }
        @media(max-width: 991px) {
            /* Slide-in Cart Container */
            .cart-container {
                width: 90%;
            }
        }

        .cart-container.open {
            right: 0; /* Slide-in */
        }

        /* Cart Header */
        .cart-header {
            position: sticky;
            top: 0; /* Stick to the top */
            z-index: 1020; /* Ensure it's above the body */
            background: #f9f9f9;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Cart Body */
        .cart-body {
            flex: 1; /* Allow body to take available space */
            max-height: calc(100vh - 150px); /* Subtract header and footer height to make the body scrollable */
            overflow-y: auto; /* Enable vertical scrolling */
            padding: 10px;
            box-sizing: border-box;
        }

        /* Cart Footer */
        .cart-footer {
            background: #fff;
            padding: 10px 15px;
            border-top: 1px solid #ddd;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Cart Footer */
        .cart-footer button{
            background: red;
            color: white;
        }

        /* Cart Item */
        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Quantity Controls */
        .qty-controls {
            display: flex;
            align-items: center;
        }

        .qty-btn {
            background: #f1f1f1;
            border: 1px solid #ccc;
            padding: 5px 10px;
            cursor: pointer;
            margin: 0 5px;
        }

        /* Remove Item Button */
        .remove-item {
            background: transparent;
            border: none;
            color: red;
            cursor: pointer;
            font-size: 18px;
        }


    </style>
</head>

<body class="theme-color-4 bg-gradient-color">

<!-- Loader Start -->
{{--<div class="fullpage-loader">--}}
{{--    <span></span>--}}
{{--    <span></span>--}}
{{--    <span></span>--}}
{{--    <span></span>--}}
{{--    <span></span>--}}
{{--    <span></span>--}}
{{--</div>--}}
<!-- Loader End -->

<!-- Header Start -->
<header class="pb-0 fixed-header">
{{--    <div class="header-top">--}}
{{--        <div class="container-fluid-lg">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xxl-9 col-lg-9 d-lg-block d-none">--}}
{{--                    <div class="header-offer">--}}
{{--                        <div class="notification-slider">--}}
{{--                            <div>--}}
{{--                                <div class="timer-notification">--}}
{{--                                    <h6><strong class="me-1">Welcome to {{$generalSettingView->site_name}}!</strong>Wrap new offers/gift--}}
{{--                                        every single day on Weekends.<strong class="ms-1">New Coupon Code: Fast024--}}
{{--                                        </strong>--}}

{{--                                    </h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div>--}}
{{--                                <div class="timer-notification">--}}
{{--                                    <h6>Something you love is now on sale!--}}
{{--                                        <a href="javascript:void(0)" class="text-white">Buy Now--}}
{{--                                            !</a>--}}
{{--                                    </h6>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                @php--}}
{{--                    if(Session::has('locale')){--}}
{{--                        $locale = Session::get('locale', Config::get('app.locale'));--}}
{{--                    }--}}
{{--                    else{--}}
{{--                        $locale = env('DEFAULT_LANGUAGE');--}}
{{--                    }--}}
{{--                @endphp--}}
{{--                <div class="col-lg-3 col-xxl-3">--}}
{{--                    <ul class="about-list right-nav-about">--}}
{{--                        <li class="right-nav-list">--}}
{{--                            <div class="dropdown theme-form-select">--}}
{{--                                <button class="btn dropdown-toggle" type="button" id="select-language"--}}
{{--                                        data-bs-toggle="dropdown">--}}
{{--                                    <img src="{{ asset('admin/assets/images/flags/'.$locale.'.png') }}"--}}
{{--                                         class="img-fluid blur-up lazyload" alt="">--}}
{{--                                    <span>{{ ucfirst($locale) }}</span>--}}
{{--                                </button>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                    @foreach (\App\Models\Language::all() as $language)--}}
{{--                                        <li>--}}
{{--                                            <a href="javascript:void(0)"--}}
{{--                                               data-locale="{{ $language->code }}"--}}
{{--                                               class="dropdown-item @if($locale == $language->code) active @endif"--}}
{{--                                               onclick="changeLanguage('{{ $language->code }}')">--}}
{{--                                                <img src="{{ asset('admin/assets/images/flags/'.$language->code.'.png') }}" class="mr-2">--}}
{{--                                                <span class="language">{{ $language->name }}</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}

{{--                        <script>--}}
{{--                            function changeLanguage(locale) {--}}
{{--                                fetch("{{ route('language.change') }}", {--}}
{{--                                    method: "POST",--}}
{{--                                    headers: {--}}
{{--                                        "Content-Type": "application/json",--}}
{{--                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"--}}
{{--                                    },--}}
{{--                                    body: JSON.stringify({ locale })--}}
{{--                                })--}}
{{--                                    .then(response => {--}}
{{--                                        if (response.ok) {--}}
{{--                                            location.reload(); // Reload the page to apply the language change--}}
{{--                                        } else {--}}
{{--                                            alert('Failed to change language');--}}
{{--                                        }--}}
{{--                                    })--}}
{{--                                    .catch(error => {--}}
{{--                                        console.error('Error:', error);--}}
{{--                                        alert('An error occurred');--}}
{{--                                    });--}}
{{--                            }--}}
{{--                        </script>--}}
{{--                        <li class="right-nav-list">--}}
{{--                            <div class="dropdown theme-form-select">--}}
{{--                                <button class="btn dropdown-toggle" type="button" id="select-dollar"--}}
{{--                                        data-bs-toggle="dropdown">--}}
{{--                                    <span>USD</span>--}}
{{--                                </button>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-end sm-dropdown-menu">--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" id="aud" href="javascript:void(0)">AUD</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" id="eur" href="javascript:void(0)">EUR</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" id="cny" href="javascript:void(0)">CNY</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="top-nav top-header">
        <div class="container-fluid-xs">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon navbar-toggler-icon-2">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                        </button>

                        <div class="middle-box">
{{--                            <div class="location-box">--}}
{{--                                <button class="btn location-button" data-bs-toggle="modal"--}}
{{--                                        data-bs-target="#locationModal">--}}
{{--                                        <span class="location-arrow">--}}
{{--                                            <i data-feather="map-pin"></i>--}}
{{--                                        </span>--}}
{{--                                    <span class="locat-name">{{translate('Your Location')}}</span>--}}
{{--                                    <i class="fa-solid fa-angle-down"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}

                            <div class="search-box">
                                <div class="input-group">
                                    <input type="search" class="form-control" style="width: 680px !important;" placeholder="{{translate("I'm searching for")}}...">
                                    <button class="btn bg-theme" type="button" id="button-addon2">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="rightside-box">
                            <div class="search-full">
                                <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                    <input type="text" class="form-control search-type" placeholder="{{translate('Search here')}}..">
                                    <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <a href="javascript:void(0)"
                                       class="delivery-login-box @if(Session::get('locale') == 'en') text-primary @endif"
                                       style="cursor: pointer;"
                                       onclick="changeLanguage('en')">
                                        <strong>EN</strong>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <a href="javascript:void(0)"
                                       class="delivery-login-box @if(Session::get('locale') == 'bd') text-primary @endif"
                                       style="cursor: pointer;"
                                       onclick="changeLanguage('bd')">
                                        <strong>বাং</strong>
                                    </a>
                                </li>
                                <script>
                                    function changeLanguage(locale) {
                                        fetch("{{ route('language.change') }}", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            },
                                            body: JSON.stringify({ locale })
                                        })
                                            .then(response => {
                                                if (response.ok) {
                                                    location.reload(); // Reload the page to apply the language change
                                                } else {
                                                    alert('Failed to change language');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                alert('An error occurred');
                                            });
                                    }
                                </script>
                                @if(Session::get('seller_id'))
                                    <li class="right-side onhover-dropdown">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Hello,</h6>
                                                <h5>My Account</h5>
                                            </div>
                                        </div>

                                        <div class="onhover-div onhover-div-login">
                                            <ul class="user-box-name">
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{route('seller.dashboard')}}">{{translate('Dashboard')}}</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="javascript:void(0)" onclick="document.getElementById('logoutFormSeller').submit();">{{translate('Logout')}}</a>
                                                    <form action="{{route('seller.logout')}}" method="POST" id="logoutFormSeller">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    @if(Session::get('customer_id'))
                                        <li class="right-side onhover-dropdown">
                                            <div class="delivery-login-box">
                                                <div class="delivery-icon">
                                                    <i data-feather="user"></i>
                                                </div>
                                                <div class="delivery-detail">
                                                    <h6>Hello,</h6>
                                                    <h5>My Account</h5>
                                                </div>
                                            </div>

                                            <div class="onhover-div onhover-div-login">
                                                <ul class="user-box-name">
                                                    <li class="product-box-contain">
                                                        <i></i>
                                                        <a href="{{route('customer.dashboard')}}">{{translate('Dashboard')}}</a>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit();">{{translate('Logout')}}</a>
                                                        <form action="{{route('customer.logout')}}" method="POST" id="logoutForm">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @else
                                        <li class="right-side">
                                            <a href="{{route('customer.login')}}" class="delivery-login-box @if(Route::is('customer.login')) text-primary @endif" style="cursor: pointer;">
                                                <strong>{{translate('Login')}}</strong>
                                            </a>
                                        </li>
                                        <li class="right-side">
                                            <a href="{{route('customer.register')}}" class="delivery-login-box @if(Route::is('customer.register')) text-primary @endif" style="cursor: pointer;">
                                                <strong>{{translate('Register')}}</strong>
                                            </a>
                                        </li>
                                    @endif
                                @endif
{{--                                <li class="right-side">--}}
{{--                                    <div class="onhover-dropdown header-badge">--}}
{{--                                        <button type="button" class="btn p-0 position-relative header-wishlist" onclick="openCart()">--}}
{{--                                            <i data-feather="shopping-cart"></i>--}}
{{--                                            <span class="position-absolute top-0 start-100 translate-middle badge">2--}}
{{--                                                    <span class="visually-hidden">{{translate('unread messages')}}</span>--}}
{{--                                                </span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="right-side onhover-dropdown">--}}
{{--                                    <div class="delivery-login-box">--}}
{{--                                        <div class="delivery-icon">--}}
{{--                                            <i data-feather="user"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="delivery-detail">--}}
{{--                                            <h6>{{translate('Hello')}},</h6>--}}
{{--                                            <h5>{{translate('My Account')}}</h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="onhover-div onhover-div-login">--}}
{{--                                        <ul class="user-box-name">--}}
{{--                                            @if(Session::get('customer_id'))--}}
{{--                                                <li class="product-box-contain">--}}
{{--                                                    <i></i>--}}
{{--                                                    <a href="{{route('customer.dashboard')}}">{{translate('Dashboard')}}</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="product-box-contain">--}}
{{--                                                    <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">{{translate('Logout')}}</a>--}}
{{--                                                    <form action="{{route('customer.logout')}}" method="POST" id="logoutForm">--}}
{{--                                                        @csrf--}}
{{--                                                    </form>--}}
{{--                                                </li>--}}
{{--                                            @else--}}
{{--                                                <li class="product-box-contain">--}}
{{--                                                    <i></i>--}}
{{--                                                    <a href="{{route('customer.login')}}">{{translate('Log In')}}</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="product-box-contain">--}}
{{--                                                    <a href="{{route('customer.register')}}">{{translate('Register')}}</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="product-box-contain">--}}
{{--                                                    <a href="{{route('forget.password')}}">{{translate('Forgot Password')}}</a>--}}
{{--                                                </li>--}}
{{--                                            @endif--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<!-- mobile fix menu start -->
@include('front.inc.mobile-fix-menu')
<!-- mobile fix menu end -->

<!-- Product Section Start -->
<section class="product-section pt-0">
    <div class="container-fluid p-0">
        <div class="custom-row">
            @include('front.inc.sidebar')


            @yield('body')
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Footer Section Start -->
<footer class="footer-sm">
    <!-- Footer Section Start -->
    <footer class="section-t-space">
        <div class="container-fluid">
            <div class="main-footer" style="padding-top: 2%;">
                <div class="row g-md-4 g-3">
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <div class="theme-logo">
                                <a href="{{route('home')}}">
                                    <img src="{{asset('/')}}front/assets/images/logo/5.png" style="width: 100%;" class="blur-up lazyload" alt="">
                                </a>
                            </div>

                            <div class="footer-logo-contain">
                                <p>We are a friendly bar serving a variety of cocktails, wines and beers. Our bar is a
                                    perfect place for a couple.</p>

                                <ul class="address">
                                    <li>
                                        <i data-feather="home"></i>
                                        <a href="javascript:void(0)">
                                            {{$generalSettingView->address}}
                                        </a>
                                    </li>
                                    <li>
                                        <i data-feather="mail"></i>
                                        <a href="mailto:{{$generalSettingView->email}}">{{$generalSettingView->email}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-3">
                        <div class="footer-title">
                            <h4>{{translate('Useful Links')}}</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="{{route('home')}}" class="text-content">{{translate('Home')}}</a>
                                </li>
                                <li>
                                    <a href="shop-left-sidebar.html" class="text-content">{{translate('Products')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('condition.page')}}" class="text-content">{{translate('Terms & Conditions')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('privacy.page')}}" class="text-content">{{translate('Privacy policies')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('return.page')}}" class="text-content">{{translate('Return and refund policies')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-2 col-sm-3">
                        <div class="footer-title">
                            <h4>{{translate('Help Center')}}</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    @if(Session::get('seller_id'))
                                    <a href="{{route('seller.dashboard')}}" class="text-content">{{translate('Your Account')}}</a>
                                    @else
                                        <a href="{{route('customer.dashboard')}}" class="text-content">{{translate('Your Account')}}</a>
                                    @endif
                                </li>
                                <li>
                                    <a href="order-tracking.html" class="text-content">{{translate('Track Order')}}</a>
                                </li>
                                <li>
                                    <a href="order-tracking.html" class="text-content">{{translate('Become a vendor')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('about.us')}}" class="text-content">{{translate('About Us')}}</a>
                                </li>
                                <li>
                                    <a href="{{route('contact.us')}}" class="text-content">{{translate('Contact Us')}}</a>
                                </li>
                                <li>
                                    <a href="faq.html" class="text-content">{{translate('FAQ')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h4>{{translate('Contact Us')}}</h4>
                        </div>

                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <i data-feather="phone"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">{{translate('Hotline 24/7')}} :</h6>
                                            <h5><a href="tel:{{$generalSettingView->mobile}}">{{$generalSettingView->mobile}}</a></h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="footer-number">
                                        <i data-feather="mail"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">{{translate('Email Address')}} :</h6>
                                            <h5><a href="mailto:{{$generalSettingView->email}}">{{$generalSettingView->email}}</a></h5>
                                        </div>
                                    </div>
                                </li>

                                <li class="social-app mb-0">
                                    <h5 class="mb-2 text-content">{{translate('Become a Vendor')}} :</h5>
                                    <ul>
                                        @if(Session::get('seller_id'))
                                        <li class="mb-0">
                                            <a href="" class="btn btn-md bg-primary text-white">{{translate('Dashboard')}}</a>
                                        </li>
                                        @else
                                        <li class="mb-0">
                                            <a href="{{route('seller.register')}}" class="btn btn-md bg-primary text-white">{{translate('Register')}}</a>
                                        </li>
                                            @if(!Session::get('customer_id'))
                                                <li class="mb-0">
                                                    <a href="{{route('seller.login')}}" class="btn btn-md bg-danger text-white">{{translate('Login')}}</a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content">©{{date('Y')}} {{$generalSettingView->site_name}} {{translate('All rights reserved')}}</h6>
                </div>

                <div class="payment">
                    <img src="{{asset($generalSettingView->payment_method_image)}}" class="blur-up lazyload" alt="">
                </div>

                <div class="social-link">
                    <h6 class="text-content">{{translate('Stay connected')}} :</h6>
                    <ul>
                        <li>
                            <a href="{{$generalSettingView->facebook_url}}" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$generalSettingView->twitter_url}}" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$generalSettingView->instagram_url}}" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$generalSettingView->youtube_url}}" target="_blank">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</footer>
<!-- Footer Section End -->

<!-- Quick View Modal Box Start -->
@include('front.inc.product-view')
<!-- Quick View Modal Box End -->

<!-- Location Modal Start -->
<div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="location-list">
                    <div class="search-input">
                        <input type="search" class="form-control" placeholder="Search Your Area">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <div class="disabled-box">
                        <h6>Select a Location</h6>
                    </div>

                    <ul class="location-select custom-height">
                        @foreach($districts as $district)
                        <li>
                            <a href="javascript:void(0)">
                                <h6>{{$district->name}}</h6>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Location Modal End -->

<!-- Cookie Bar Box Start -->
{{--<div class="cookie-bar-box">--}}
{{--    <div class="cookie-box">--}}
{{--        <div class="cookie-image">--}}
{{--            <img src="{{asset('/')}}front/assets/images/cookie-bar.png" class="blur-up lazyload" alt="">--}}
{{--            <h2>Cookies!</h2>--}}
{{--        </div>--}}

{{--        <div class="cookie-contain">--}}
{{--            <h5 class="text-content">We use cookies to make your experience better</h5>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="button-group">--}}
{{--        <button class="btn privacy-button">Privacy Policy</button>--}}
{{--        <button class="btn ok-button">OK</button>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Cookie Bar Box End -->

<!-- Deal Box Modal Start -->
<div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                    <p class="mt-1 text-content">Recommended deals for you.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="deal-offer-box">
                    <ul class="deal-offer-list">
                        <li class="list-1">
                            <div class="deal-offer-contain">
                                <a href="shop-left-sidebar.html" class="deal-image">
                                    <img src="{{asset('/')}}front/assets/images/vegetable/product/10.png" class="blur-up lazyload"
                                         alt="">
                                </a>

                                <a href="shop-left-sidebar.html" class="deal-contain">
                                    <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                    <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                </a>
                            </div>
                        </li>

                        <li class="list-2">
                            <div class="deal-offer-contain">
                                <a href="shop-left-sidebar.html" class="deal-image">
                                    <img src="{{asset('/')}}front/assets/images/vegetable/product/11.png" class="blur-up lazyload"
                                         alt="">
                                </a>

                                <a href="shop-left-sidebar.html" class="deal-contain">
                                    <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                    <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                </a>
                            </div>
                        </li>

                        <li class="list-3">
                            <div class="deal-offer-contain">
                                <a href="shop-left-sidebar.html" class="deal-image">
                                    <img src="{{asset('/')}}front/assets/images/vegetable/product/12.png" class="blur-up lazyload"
                                         alt="">
                                </a>

                                <a href="shop-left-sidebar.html" class="deal-contain">
                                    <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                    <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                </a>
                            </div>
                        </li>

                        <li class="list-1">
                            <div class="deal-offer-contain">
                                <a href="shop-left-sidebar.html" class="deal-image">
                                    <img src="{{asset('/')}}front/assets/images/vegetable/product/13.png" class="blur-up lazyload"
                                         alt="">
                                </a>

                                <a href="shop-left-sidebar.html" class="deal-contain">
                                    <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                    <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Deal Box Modal End -->

<!-- Tap to top and theme setting button start -->
{{--<div class="theme-option">--}}
{{--    <div class="setting-box">--}}
{{--        <button class="btn setting-button">--}}
{{--            <i class="fa-solid fa-gear"></i>--}}
{{--        </button>--}}

{{--        <div class="theme-setting-2">--}}
{{--            <div class="theme-box">--}}
{{--                <ul>--}}
{{--                    <li>--}}
{{--                        <div class="setting-name">--}}
{{--                            <h4>Color</h4>--}}
{{--                        </div>--}}
{{--                        <div class="theme-setting-button color-picker">--}}
{{--                            <form class="form-control">--}}
{{--                                <label for="colorPick" class="form-label mb-0">Theme Color</label>--}}
{{--                                <input type="color" class="form-control form-control-color" id="colorPick"--}}
{{--                                       value="#6262a6" title="Choose your color">--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <div class="setting-name">--}}
{{--                            <h4>Dark</h4>--}}
{{--                        </div>--}}
{{--                        <div class="theme-setting-button">--}}
{{--                            <button class="btn btn-2 outline" id="darkButton">Dark</button>--}}
{{--                            <button class="btn btn-2 unline" id="lightButton">Light</button>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <div class="setting-name">--}}
{{--                            <h4>RTL</h4>--}}
{{--                        </div>--}}
{{--                        <div class="theme-setting-button rtl">--}}
{{--                            <button class="btn btn-2 rtl-unline">LTR</button>--}}
{{--                            <button class="btn btn-2 rtl-outline">RTL</button>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="back-to-top">--}}
{{--        <a id="back-to-top" href="#">--}}
{{--            <i class="fas fa-chevron-up"></i>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Tap to top and theme setting button end -->

<!-- Shopping Bag Section Start -->
<div class="shopping-summary d-none d-md-flex flex-column align-items-center shadow-sm" onclick="openCart()">
    <div class="shopping-icon bg-secondary p-3 rounded-top d-flex justify-content-center">
        <i data-feather="shopping-bag" class="text-warning" style="width: 37%; height: 16%;"></i>
    </div>
    <div class="shopping-items bg-light text-center px-3 py-2">
        <span class="d-block fw-bold text-warning" style="font-size: 85%;">8 {{translate('ITEMS')}}</span>
        <span class="d-block fw-bold text-secondary" style="font-size: 83%;">৳ 5,577</span>
    </div>
</div>
<!-- Shopping Bag Section End -->



<!-- Hidden Slide-in Cart -->
<div id="cart-container" class="cart-container shadow">
    <div class="cart-header d-flex justify-content-between align-items-center p-3 bg-light">
        <h5 class="fw-bold mb-0">8 {{translate('ITEMS')}}</h5>
        <button class="btn btn-close" onclick="closeCart()">{{translate('Close')}}</button>
    </div>

    <div class="cart-body p-3">
        <!-- Cart Item -->
        <div class="cart-item" id="item-1">
            <div>
                <p class="mb-0 fw-bold">Shape Up Non Fat Milk Powder</p>
                <span class="text-muted">৳ 469 <del>৳ 490</del></span>
            </div>
            <div class="qty-controls">
                <button class="qty-btn" onclick="changeQty('item-1', -1)">-</button>
                <span id="qty-item-1" class="fw-bold">1</span>
                <button class="qty-btn" onclick="changeQty('item-1', 1)">+</button>
            </div>
            <button class="remove-item" onclick="removeItem('item-1')">&times;</button>
        </div>
        <div class="cart-item" id="item-2">
            <div>
                <p class="mb-0 fw-bold">Harpic Liquid Toilet Cleaner</p>
                <span class="text-muted">৳ 263 </span>
            </div>
            <div class="qty-controls">
                <button class="qty-btn" onclick="changeQty('item-2', -1)">-</button>
                <span id="qty-item-2" class="fw-bold">1</span>
                <button class="qty-btn" onclick="changeQty('item-2', 1)">+</button>
            </div>
            <button class="remove-item" onclick="removeItem('item-2')">&times;</button>
        </div>

        <!-- Add more items as needed -->
    </div>

    <div class="cart-footer p-3 border-top">
        <a href="{{route('checkout')}}" class="btn bg-danger text-white w-100 fw-bold">{{translate('Place Order')}} <span>৳ 5,577</span></a>
    </div>
</div>



<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<!-- latest jquery-->
<script src="{{asset('/')}}front/assets/js/jquery-3.6.0.min.js"></script>

<!-- jquery ui-->
<script src="{{asset('/')}}front/assets/js/jquery-ui.min.js"></script>

<!-- Bootstrap js-->
<script src="{{asset('/')}}front/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}front/assets/js/bootstrap/bootstrap-notify.min.js"></script>
<script src="{{asset('/')}}front/assets/js/bootstrap/popper.min.js"></script>

<!-- feather icon js-->
<script src="{{asset('/')}}front/assets/js/feather/feather.min.js"></script>
<script src="{{asset('/')}}front/assets/js/feather/feather-icon.js"></script>

<!-- Lazyload Js -->
<script src="{{asset('/')}}front/assets/js/lazysizes.min.js"></script>

<!-- Delivery Option js -->
<script src="{{asset('/')}}front/assets/js/delivery-option.js"></script>

<!-- Slick js-->
<script src="{{asset('/')}}front/assets/js/slick/slick.js"></script>
<script src="{{asset('/')}}front/assets/js/slick/slick-animation.min.js"></script>
<script src="{{asset('/')}}front/assets/js/slick/custom_slick.js"></script>

<!-- Auto Height Js -->
<script src="{{asset('/')}}front/assets/js/auto-height.js"></script>

<!-- Fly Cart Js -->
<script src="{{asset('/')}}front/assets/js/fly-cart.js"></script>

<!-- Quantity js -->
<script src="{{asset('/')}}front/assets/js/quantity-2.js"></script>

<!-- WOW js -->
<script src="{{asset('/')}}front/assets/js/wow.min.js"></script>
<script src="{{asset('/')}}front/assets/js/custom-wow.js"></script>

<!-- script js -->
<script src="{{asset('/')}}front/assets/js/script.js"></script>

<script src="{{asset('/')}}front/assets/js/fly-cart.js"></script>

<!-- theme setting js -->
<script src="{{asset('/')}}front/assets/js/theme-setting.js"></script>

<!-- Apexcharts Js -->
<script src="{{asset('/')}}front/assets/js/apexchart.js"></script>
<script src="{{asset('/')}}front/assets/js/custom-chart.js"></script>

<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Function to check if the device is mobile
    function isMobile() {
        return window.innerWidth <= 768; // Adjust the width as per your requirement
    }

    // Execute the scripts only if it's not a mobile device
    if (!isMobile()) {
        var script1 = document.createElement('script');
        script1.src = "{{asset('/')}}front/assets/js/jquery.elevatezoom.js";
        document.head.appendChild(script1);

        var script2 = document.createElement('script');
        script2.src = "{{asset('/')}}front/assets/js/zoom-filter.js";
        document.head.appendChild(script2);
    }
</script>



<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Swiper Initialization Script -->
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true, // Infinite loop
        autoplay: {
            delay: 3000, // Auto-slide every 3 seconds
            disableOnInteraction: false, // Continue autoplay after interaction
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true, // Pagination dots are clickable
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@include('flash-toastr::message')

<!-- Feather Icons Script -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace(); // Initialize Feather Icons

    // Open Cart
    function openCart() {
        document.getElementById("cart-container").classList.add("open");
    }

    // Close Cart
    function closeCart() {
        document.getElementById("cart-container").classList.remove("open");
    }

    // Change Item Quantity
    function changeQty(itemId, delta) {
        const qtyElement = document.getElementById(`qty-${itemId}`);
        let currentQty = parseInt(qtyElement.textContent);
        currentQty += delta;
        if (currentQty < 1) currentQty = 1; // Prevent negative quantity
        qtyElement.textContent = currentQty;
    }

    // Remove Item from Cart
    function removeItem(itemId) {
        const itemElement = document.getElementById(itemId);
        itemElement.remove();
    }
</script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
        var passwordInput = document.getElementById('password_confirmation');
        var icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

</script>


<style>
    /* Customize toastr text size */
    #toast-container > .toast {
        font-size: 16px; /* Adjust this to the desired size */
    }
</style>

<script>
    // Toastr configuration options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // Display toastr based on session messages
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @elseif(session('error'))
    toastr.error("{{ session('error') }}");
    @elseif(session('info'))
    toastr.info("{{ session('info') }}");
    @elseif(session('warning'))
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

</body>
</html>
