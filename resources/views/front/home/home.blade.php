@extends('front.master')

@section('title')
    Home | {{$generalSettingView->site_name}}
@endsection

@section('body')
    <div class="content-col">
        <div class="section-b-space" style="padding-bottom: 0px">
            <!-- Swiper Container -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <a href="">
                            <div class="banner-contain ">
                                <img src="{{ asset('/') }}front/assets/images/slider/1.jpg" class="d-block w-100 bg-img blur-up lazyload" alt="Slide 1">
                            </div>
                        </a>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <a href="">
                            <div class="banner-contain ">
                                <img src="{{ asset('/') }}front/assets/images/slider/2.jpg" class="d-block w-100 bg-img blur-up lazyload" alt="Slide 2">
                            </div>
                        </a>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <a href="">
                            <div class="banner-contain ">
                                <img src="{{ asset('/') }}front/assets/images/slider/3.jpg" class="d-block w-100 bg-img blur-up lazyload" alt="Slide 3">
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Swiper Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Swiper Navigation -->
                {{--                        <div class="swiper-button-next"></div>--}}
                {{--                        <div class="swiper-button-prev"></div>--}}
            </div>
        </div>
        <!-- Category Section Start -->
        <section class="section-b-space">
            <div class="container">
                <div class="title">
                    <h2>Popular Categories</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="category-slider arrow-slider">
                            <div>
                                <div class="shop-category-box border-0 wow fadeIn">
                                    <a href="shop-left-sidebar.html" class="circle-1">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/1.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Oils, Refined & Ghee</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.05s">
                                    <a href="shop-left-sidebar.html" class="circle-2">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/2.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Rice, Flour & Grains</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.1s">
                                    <a href="shop-left-sidebar.html" class="circle-3">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/3.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Food Cupboard</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.15s">
                                    <a href="shop-left-sidebar.html" class="circle-4">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/4.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Dals & Pulses</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.2s">
                                    <a href="shop-left-sidebar.html" class="circle-4">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/5.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Drinks & Beverages</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.25s">
                                    <a href="shop-left-sidebar.html" class="circle-1">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/6.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Fresh Fruits & Vegetables</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.3s">
                                    <a href="shop-left-sidebar.html" class="circle-2">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/7.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Ready to eat Meals</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.35s">
                                    <a href="shop-left-sidebar.html" class="circle-3">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/8.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Instant Mixes</h6>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="shop-category-box border-0 wow fadeIn" data-wow-delay="0.4s">
                                    <a href="shop-left-sidebar.html" class="circle-4">
                                        <img src="{{asset('/')}}front/assets/images/veg-3/category/2.png" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>Rice, Flour & Grains</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Section End -->


        <div class="title d-block">
            <h2 class="text-theme font-sm">Food Cupboard</h2>
            <p>A virtual assistant collects the products from your list</p>
        </div>

        <div
            class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/1.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Muffets & Tuffets Whole Wheat Bread 400 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/2.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fresh Bread and Pastry Flour 200 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/3.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Peanut Butter Bite Premium Butter Cookies 600 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/4.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                SnackAmor Combo Pack of Jowar Stick and Jowar Chips
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/5.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Yumitos Chilli Sprinkled Potato Chips 100 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/6.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fantasy Crunchy Choco Chip Cookies
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/7.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fresh Bread and Pastry Flour 200 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/8.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Milky Silicone Heart Chocolate Mould ( Pack of 1 )
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/9.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">chocolate-chip-cookies 250 g</h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/10.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Cupcake Holder for Birthday and Wedding Party 100 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/5.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Yumitos Chilli Sprinkled Potato Chips 100 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/6.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fantasy Crunchy Choco Chip Cookies
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="title d-block">
            <h2 class="text-theme font-sm">Food Cupboard</h2>
            <p>A virtual assistant collects the products from your list</p>
        </div>

        <div
            class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/1.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Muffets & Tuffets Whole Wheat Bread 400 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/2.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fresh Bread and Pastry Flour 200 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/3.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Peanut Butter Bite Premium Butter Cookies 600 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>

                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/4.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                SnackAmor Combo Pack of Jowar Stick and Jowar Chips
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/5.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Yumitos Chilli Sprinkled Potato Chips 100 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/6.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fantasy Crunchy Choco Chip Cookies
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/7.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fresh Bread and Pastry Flour 200 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/8.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Milky Silicone Heart Chocolate Mould ( Pack of 1 )
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/9.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">chocolate-chip-cookies 250 g</h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/10.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Cupcake Holder for Birthday and Wedding Party 100 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/5.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Yumitos Chilli Sprinkled Potato Chips 100 g
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                            <img src="{{asset('/')}}front/assets/images/cake/product/6.png"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <ul class="product-option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                <a href="compare.html">
                                    <i data-feather="refresh-cw"></i>
                                </a>
                            </li>

                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="wishlist.html" class="notifi-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-detail position-relative">
                        <a href="product-left-thumbnail.html">
                            <h6 class="name">
                                Fantasy Crunchy Choco Chip Cookies
                            </h6>
                        </a>

                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                        <h6 class="price theme-color">$ 80.00</h6>

                        <div class="add-to-cart-btn-2 addtocart_btn">
                            <button class="btn addcart-button btn buy-button"><i
                                    class="fa-solid fa-plus"></i></button>
                            <div class="cart_qty qty-box-2 qty-box-3">
                                <div class="input-group">
                                    <button type="button" class="qty-left-minus" data-type="minus"
                                            data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <button type="button" class="qty-right-plus" data-type="plus"
                                            data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
