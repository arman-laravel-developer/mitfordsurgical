@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - {{translate('About Us')}}
@endsection

@section('seo')
    <meta name="description" content="Learn more about {{$generalSettingView->site_name}}. About Us">
    <meta name="keywords" content="{{$generalSettingView->site_name}}, About Us, Contact Us, About Us, Privacy Policy">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{request()->url()}}">

    <!-- Open Graph (OG) Meta Tags for Social Media -->
    <meta property="og:title" content="About Us - {{$generalSettingView->site_name}}">
    <meta property="og:description" content="Learn more about About Us at {{$generalSettingView->site_name}}.">
    <meta property="og:image" content="{{asset($generalSettingView->header_logo)}}">
    <meta property="og:url" content="{{request()->url()}}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{$generalSettingView->site_name}}">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="About Us - {{$generalSettingView->site_name}}">
    <meta name="twitter:description" content="Find out more about About Us at {{$generalSettingView->site_name}}.">
    <meta name="twitter:image" content="{{asset($generalSettingView->header_logo)}}">
    <meta name="twitter:site" content="@mitfordsurgical">
    <meta name="twitter:creator" content="@mitfordsurgical">
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0;">
                            <h2>{{translate('About Us')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{translate('About Us')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Fresh Vegetable Section Start -->
        <section class="fresh-vegetable-section">
            <div class="container">
                <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
                    <div class="col-xl-6 col-12">
                        <div class="row g-sm-4 g-2">
                            <div class="col-12">
                                <div class="fresh-image-2">
                                    <div>
                                        <img src="{{asset('/')}}front/assets/images/inner-page/about-us/1.jpg"
                                             class="bg-img blur-up lazyload" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-12">
                        <div class="fresh-contain p-center-left">
                            <div>
                                <div class="review-title">
                                    <h4>{{translate('About Us')}}</h4>
                                    <h2>We make Organic Food In Market</h2>
                                </div>

                                <div class="delivery-list">
                                    <p class="text-content">Just a few seconds to measure your body temperature. Up to 5
                                        users! The battery lasts up to 2 years. There are many variations of passages of
                                        Lorem Ipsum available.We started in 2019 and haven't stopped smashing it since. A
                                        global brand that doesn't sleep, we are 24/7 and always bringing something new with
                                        over 100 new products dropping on the monthly, bringing you the latest looks for
                                        less.</p>

                                    <ul class="delivery-box">
                                        <li>
                                            <div class="delivery-box">
                                                <div class="delivery-icon">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/delivery.svg" class="blur-up lazyload" alt="">
                                                </div>

                                                <div class="delivery-detail">
                                                    <h5 class="text">Free delivery for all orders</h5>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="delivery-box">
                                                <div class="delivery-icon">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/leaf.svg" class="blur-up lazyload" alt="">
                                                </div>

                                                <div class="delivery-detail">
                                                    <h5 class="text">Only fresh foods</h5>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="delivery-box">
                                                <div class="delivery-icon">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/delivery.svg" class="blur-up lazyload" alt="">
                                                </div>

                                                <div class="delivery-detail">
                                                    <h5 class="text">Free delivery for all orders</h5>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="delivery-box">
                                                <div class="delivery-icon">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/leaf.svg" class="blur-up lazyload" alt="">
                                                </div>

                                                <div class="delivery-detail">
                                                    <h5 class="text">Only fresh foods</h5>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Fresh Vegetable Section End -->

        <!-- Client Section Start -->
        <section class="client-section section-lg-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="about-us-title text-center">
                            <h4>{{translate('What We Do')}}</h4>
                            <h2 class="center">We are Trusted by Clients</h2>
                        </div>

                        <div class="slider-3_1 product-wrapper">
                            <div>
                                <div class="clint-contain">
                                    <div class="client-icon">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/work.svg" class="blur-up lazyload" alt="">
                                    </div>
                                    <h2>10</h2>
                                    <h4>Business Years</h4>
                                    <p>A coffee shop is a small business that sells coffee, pastries, and other morning
                                        goods. There are many different types of coffee shops around the world.</p>
                                </div>
                            </div>

                            <div>
                                <div class="clint-contain">
                                    <div class="client-icon">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/buy.svg" class="blur-up lazyload" alt="">
                                    </div>
                                    <h2>80 K+</h2>
                                    <h4>Products Sales</h4>
                                    <p>Some coffee shops have a seating area, while some just have a spot to order and then
                                        go somewhere else to sit down. The coffee shop that I am going to.</p>
                                </div>
                            </div>

                            <div>
                                <div class="clint-contain">
                                    <div class="client-icon">
                                        <img src="https://themes.pixelstrap.com/fastkart/assets/svg/3/user.svg" class="blur-up lazyload" alt="">
                                    </div>
                                    <h2>90%</h2>
                                    <h4>Happy Customers</h4>
                                    <p>My goal for this coffee shop is to be able to get a coffee and get on with my day.
                                        It's a Thursday morning and I am rushing between meetings.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Client Section End -->

        <!-- Team Section Start -->
        <section class="team-section section-lg-space">
            <div class="container-fluid-lg">
                <div class="about-us-title text-center">
                    <h4 class="text-content">{{translate('Our Creative Team')}}</h4>
                    <h2 class="center">{{$generalSettingView->site_name}} {{translate('team member')}}</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="slider-user product-wrapper">
                            <div>
                                <div class="team-box">
                                    <div class="team-image">
                                        <img src="{{asset('/')}}front/assets/images/inner-page/user/1.jpg" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </div>

                                    <div class="team-name">
                                        <h3>Anna Baranov</h3>
                                        <h5>Marketing</h5>
                                        <p>cheeseburger airedale mozzarella the big cheese fondue.</p>
                                        <ul class="team-media">
                                            <li>
                                                <a href="https://www.facebook.com/" class="fb-bg">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://in.pinterest.com/" class="pint-bg">
                                                    <i class="fa-brands fa-pinterest-p"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://twitter.com/" class="twitter-bg">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://www.instagram.com/" class="insta-bg">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="team-box">
                                    <div class="team-image">
                                        <img src="{{asset('/')}}front/assets/images/inner-page/user/2.jpg" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </div>

                                    <div class="team-name">
                                        <h3>Anna Baranov</h3>
                                        <h5>Marketing</h5>
                                        <p>cheese on toast mozzarella bavarian bergkase smelly cheese cheesy feet.</p>
                                        <ul class="team-media">
                                            <li>
                                                <a href="https://www.facebook.com/" class="fb-bg">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://in.pinterest.com/" class="pint-bg">
                                                    <i class="fa-brands fa-pinterest-p"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://twitter.com/" class="twitter-bg">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://www.instagram.com/" class="insta-bg">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="team-box">
                                    <div class="team-image">
                                        <img src="{{asset('/')}}front/assets/images/inner-page/user/3.jpg" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </div>

                                    <div class="team-name">
                                        <h3>Anna Baranov</h3>
                                        <h5>Marketing</h5>
                                        <p>camembert de normandie. Bocconcini rubber cheese fromage frais port-salut.</p>
                                        <ul class="team-media">
                                            <li>
                                                <a href="https://www.facebook.com/" class="fb-bg">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://in.pinterest.com/" class="pint-bg">
                                                    <i class="fa-brands fa-pinterest-p"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://twitter.com/" class="twitter-bg">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://www.instagram.com/" class="insta-bg">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="team-box">
                                    <div class="team-image">
                                        <img src="{{asset('/')}}front/assets/images/inner-page/user/4.jpg" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </div>

                                    <div class="team-name">
                                        <h3>Anna Baranov</h3>
                                        <h5>Marketing</h5>
                                        <p>Fondue stinking bishop goat. Macaroni cheese croque monsieur cottage cheese.</p>
                                        <ul class="team-media">
                                            <li>
                                                <a href="https://www.facebook.com/" class="fb-bg">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://in.pinterest.com/" class="pint-bg">
                                                    <i class="fa-brands fa-pinterest-p"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://twitter.com/" class="twitter-bg">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://www.instagram.com/" class="insta-bg">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="team-box">
                                    <div class="team-image">
                                        <img src="{{asset('/')}}front/assets/images/inner-page/user/1.jpg" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </div>

                                    <div class="team-name">
                                        <h3>Anna Baranov</h3>
                                        <h5>Marketing</h5>
                                        <p>squirty cheese cheddar macaroni cheese airedale cheese triangles.</p>
                                        <ul class="team-media">
                                            <li>
                                                <a href="https://www.facebook.com/" class="fb-bg">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://in.pinterest.com/" class="pint-bg">
                                                    <i class="fa-brands fa-pinterest-p"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://twitter.com/" class="twitter-bg">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="https://www.instagram.com/" class="insta-bg">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team Section End -->
    </div>
@endsection
