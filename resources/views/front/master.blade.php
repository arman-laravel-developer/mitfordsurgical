<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="{{asset('/')}}front/assets/images/favicon/6.png" type="image/x-icon">
    <title>On-demand last-mile delivery</title>

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
<div class="fullpage-loader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<!-- Loader End -->

<!-- Header Start -->
<header class="pb-0 fixed-header">
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
                            <div class="location-box">
                                <button class="btn location-button" data-bs-toggle="modal"
                                        data-bs-target="#locationModal">
                                        <span class="location-arrow">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                    <span class="locat-name">Your Location</span>
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </div>

                            <div class="search-box">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="I'm searching for...">
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
                                    <input type="text" class="form-control search-type" placeholder="Search here..">
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
                                    <a href="contact-us.html" class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="phone-call"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>24/7 Delivery</h6>
                                            <h5>+91 888 104 2340</h5>
                                        </div>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <a href="wishlist.html" class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="heart"></i>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <button type="button" class="btn p-0 position-relative header-wishlist" onclick="openCart()">
                                            <i data-feather="shopping-cart"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge">2
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                        </button>

{{--                                        <div class="onhover-div">--}}
{{--                                            <ul class="cart-list">--}}
{{--                                                <li class="product-box-contain">--}}
{{--                                                    <div class="drop-cart">--}}
{{--                                                        <a href="product-left-thumbnail.html" class="drop-image">--}}
{{--                                                            <img src="{{asset('/')}}front/assets/images/vegetable/product/1.png"--}}
{{--                                                                 class="blur-up lazyload" alt="">--}}
{{--                                                        </a>--}}

{{--                                                        <div class="drop-contain">--}}
{{--                                                            <a href="product-left-thumbnail.html">--}}
{{--                                                                <h5>Fantasy Crunchy Choco Chip Cookies</h5>--}}
{{--                                                            </a>--}}
{{--                                                            <h6><span>1 x</span> $80.58</h6>--}}
{{--                                                            <button class="close-button close_button">--}}
{{--                                                                <i class="fa-solid fa-xmark"></i>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}

{{--                                                <li class="product-box-contain">--}}
{{--                                                    <div class="drop-cart">--}}
{{--                                                        <a href="product-left-thumbnail.html" class="drop-image">--}}
{{--                                                            <img src="{{asset('/')}}front/assets/images/vegetable/product/2.png"--}}
{{--                                                                 class="blur-up lazyload" alt="">--}}
{{--                                                        </a>--}}

{{--                                                        <div class="drop-contain">--}}
{{--                                                            <a href="product-left-thumbnail.html">--}}
{{--                                                                <h5>Peanut Butter Bite Premium Butter Cookies 600 g--}}
{{--                                                                </h5>--}}
{{--                                                            </a>--}}
{{--                                                            <h6><span>1 x</span> $25.68</h6>--}}
{{--                                                            <button class="close-button close_button">--}}
{{--                                                                <i class="fa-solid fa-xmark"></i>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}

{{--                                            <div class="price-box">--}}
{{--                                                <h5>Total :</h5>--}}
{{--                                                <h4 class="theme-color fw-bold">$106.58</h4>--}}
{{--                                            </div>--}}

{{--                                            <div class="button-group">--}}
{{--                                                <a href="cart.html" class="btn btn-sm cart-button">View Cart</a>--}}
{{--                                                <a href="checkout.html" class="btn btn-sm cart-button theme-bg-color--}}
{{--                                                    text-white">Checkout</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </li>
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
                                                <a href="login.html">Log In</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="sign-up.html">Register</a>
                                            </li>

                                            <li class="product-box-contain">
                                                <a href="forgot.html">Forgot Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
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
<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="active">
            <a href="index.html">
                <i data-feather="home" style="color: white"></i>
                <span>Home</span>
            </a>
        </li>


        <li class="mobile-category">
            <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                <span class=" navbar-toggler-icon-2">
                <i data-feather="list" style="color: white"></i>
                <span>Category</span>
            </span>
            </a>
        </li>

        <li>
            <a href="search.html" class="search-box">
                <i data-feather="search" style="color: white"></i>
                <span>Search</span>
            </a>
        </li>

        <li>
            <a href="wishlist.html" class="notifi-wishlist">
                <i data-feather="heart" style="color: white"></i>
                <span>My Wish</span>
            </a>
        </li>

        <li style="position: relative;">
            <a href="javascript:void(0)" onclick="openCart()" style="position: relative;">
                <i data-feather="shopping-cart" style="color: white;"></i>
                <span>Cart</span>
                <!-- Badge -->
                <span class="badge rounded-pill bg-danger position-absolute top-0 translate-middle" style="left: 90%!important;">
            5
        </span>
            </a>
        </li>
    </ul>
</div>
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
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <div class="theme-logo">
                                <a href="index.html">
                                    <img src="{{asset('/')}}front/assets/images/logo/5.png" class="blur-up lazyload" alt="" style="width: 100%">
                                </a>
                            </div>

                            <div class="footer-logo-contain">
                                <p>We are a friendly bar serving a variety of cocktails, wines and beers. Our bar is a
                                    perfect place for a couple.</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-2 col-sm-3">
                        <div class="footer-title">
                            <h4>Useful Links</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="index.html" class="text-content">Home</a>
                                </li>
                                <li>
                                    <a href="shop-left-sidebar.html" class="text-content">Products</a>
                                </li>
                                <li>
                                    <a href="about-us.html" class="text-content">About Us</a>
                                </li>
                                <li>
                                    <a href="contact-us.html" class="text-content">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-2 col-sm-3">
                        <div class="footer-title">
                            <h4>Help Center</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="user-dashboard.html" class="text-content">Your Account</a>
                                </li>
                                <li>
                                    <a href="order-tracking.html" class="text-content">Track Order</a>
                                </li>
                                <li>
                                    <a href="faq.html" class="text-content">FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Contact Us</h4>
                        </div>

                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <i data-feather="phone"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Hotline 24/7 :</h6>
                                            <h5>+91 888 104 2340</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="footer-number">
                                        <i data-feather="mail"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Email Address :</h6>
                                            <h5>fastkart@hotmail.com</h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content">©2022 Fastkart All rights reserved</h6>
                </div>

                <div class="payment">
                    <img src="{{asset('/')}}front/assets/images/payment/1.png" class="blur-up lazyload" alt="">
                </div>

                <div class="social-link">
                    <h6 class="text-content">Stay connected :</h6>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://in.pinterest.com/" target="_blank">
                                <i class="fa-brands fa-pinterest-p"></i>
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
<div class="modal fade theme-modal view-modal" id="view" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header p-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row g-sm-4 g-2">
                    <div class="col-lg-6">
                        <div class="slider-image">
                            <img src="{{asset('/')}}front/assets/images/product/category/1.jpg" class="img-fluid blur-up lazyload"
                                 alt="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-sidebar-modal">
                            <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                            <h4 class="price">$36.99</h4>
                            <div class="product-rating">
                                <ul class="rating">
                                    <li>
                                        <i data-feather="star" class="fill"></i>
                                    </li>
                                    <li>
                                        <i data-feather="star" class="fill"></i>
                                    </li>
                                    <li>
                                        <i data-feather="star" class="fill"></i>
                                    </li>
                                    <li>
                                        <i data-feather="star" class="fill"></i>
                                    </li>
                                    <li>
                                        <i data-feather="star"></i>
                                    </li>
                                </ul>
                                <span class="ms-2">8 Reviews</span>
                                <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                            </div>

                            <div class="product-detail">
                                <h4>Product Details :</h4>
                                <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                    Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                    Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                    muffin I love carrot cake sugar plum dessert bonbon.</p>
                            </div>

                            <ul class="brand-list">
                                <li>
                                    <div class="brand-box">
                                        <h5>Brand Name:</h5>
                                        <h6>Black Forest</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="brand-box">
                                        <h5>Product Code:</h5>
                                        <h6>W0690034</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="brand-box">
                                        <h5>Product Type:</h5>
                                        <h6>White Cream Cake</h6>
                                    </div>
                                </li>
                            </ul>

                            <div class="select-size">
                                <h4>Cake Size :</h4>
                                <select class="form-select select-form-size">
                                    <option selected>Select Size</option>
                                    <option value="1.2">1/2 KG</option>
                                    <option value="0">1 KG</option>
                                    <option value="1.5">1/5 KG</option>
                                    <option value="red">Red Roses</option>
                                    <option value="pink">With Pink Roses</option>
                                </select>
                            </div>

                            <div class="modal-button">
                                <button onclick="location.href = 'cart.html';"
                                        class="btn btn-md add-cart-button icon">Add
                                    To Cart</button>
                                <button onclick="location.href = 'product-left.html';"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                    View More Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        <span class="d-block fw-bold text-warning" style="font-size: 85%;">8 ITEMS</span>
        <span class="d-block fw-bold text-secondary" style="font-size: 83%;">৳ 5,577</span>
    </div>
</div>
<!-- Shopping Bag Section End -->

<!-- Hidden Slide-in Cart -->
<div id="cart-container" class="cart-container shadow">
    <div class="cart-header d-flex justify-content-between align-items-center p-3 bg-light">
        <h5 class="fw-bold mb-0">8 ITEMS</h5>
        <button class="btn btn-close" onclick="closeCart()">Close</button>
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
        <div class="cart-item" id="item-1">
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
        <button class="btn btn-danger w-100 fw-bold">Place Order <span>৳ 5,577</span></button>
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

<!-- theme setting js -->
<script src="{{asset('/')}}front/assets/js/theme-setting.js"></script>

<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


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
        "positionClass": "toast-top-right",
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
