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
                    @foreach($sliders as $slider)
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <a href="">
                            <div class="banner-contain ">
                                <img src="{{ asset($slider->image) }}" class="d-block w-100 bg-img blur-up lazyload" alt="Slide 1">
                            </div>
                        </a>
                    </div>
                    @endforeach
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
                    <h2>{{translate('Popular Categories')}}</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="category-slider arrow-slider">
                            @foreach($homeCategories as $homeCategory)
                            <div>
                                <div class="shop-category-box border-0 wow fadeIn">
                                    <a href="{{ route('category.product', ['id' => $homeCategory->id, 'slug' => $homeCategory->slug]) }}" class="circle-1">
                                        <img src="{{asset($homeCategory->image)}}" class="img-fluid blur-up lazyload"
                                             alt="">
                                    </a>
                                    <div class="category-name">
                                        <h6>{{$homeCategory->category_name}}</h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Section End -->

        <div class="container">
            <div class="title d-block">
                <h2 class="text-theme font-sm text-center">{{translate('Featured Products')}}</h2>
            </div>

            <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
                @foreach($products as $product)
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view"
                           data-name="{{$product->getTranslation('name')}}"
                           data-price="{{$product->sell_price}}"
                           data-image="{{asset($product->thumbnail_img)}}"
                           data-description="{{$product->getTranslation('description')}}">
                            <img src="{{asset($product->thumbnail_img)}}" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view"
                                   data-name="{{$product->getTranslation('name')}}"
                                   data-price="{{$product->sell_price}}"
                                   data-image="{{asset($product->thumbnail_img)}}"
                                   data-description="{{$product->getTranslation('description')}}">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view"
                           data-name="{{$product->getTranslation('name')}}"
                           data-price="{{$product->sell_price}}"
                           data-image="{{asset($product->thumbnail_img)}}"
                           data-description="{{$product->getTranslation('description')}}">
                            <h5 class="name">{{$product->name}}</h5>
                        </a>
{{--                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>--}}
                        <h5 class="price theme-color">&#2547;{{$product->sell_price}}</h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="title d-block">
                <h2 class="text-theme font-sm text-center">{{translate('All Products')}}</h2>
            </div>

            <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
                <div class="product-box-4 wow fadeInUp">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/11.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star" class="fill"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Cucumber</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text" name="quantity"
                                           value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/3.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Potato</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/5.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Baby Chili</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.15s">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/6.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
                        <ul class="rating">
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Broccoli</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/7.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Peru</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.25s">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/9.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Avocado</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/11.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Cucumber</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.35s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/12.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Beetroot</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/13.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
                        <ul class="rating">
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Strawberry</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.45s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/15.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star" class="fill"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Corn</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/17.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
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
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Cabbage</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.55s">
                    <div class="product-image">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/18.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
                        <ul class="rating">
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Ginger</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-box-4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="product-image">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <img src="{{asset('/')}}front/assets/images/veg-3/cate1/1.png" class="img-fluid" alt="">
                        </a>

                        <ul class="option">
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                    <i data-feather="eye"></i>
                                </a>
                            </li>
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                <a href="compare.html">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="product-detail">
                        <ul class="rating">
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star" class="fill"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                            <li>
                                <i data-feather="star"></i>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                            <h5 class="name">Bell pepper</h5>
                        </a>
                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                        <div class="price-qty">
                            <div class="counter-number">
                                <div class="counter">
                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="0">
                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                            <button class="buy-button buy-button-2 btn btn-cart">
                                <i class="fa fa-cart-plus icli text-white m-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var viewModal = document.getElementById('view');
            var productModalName = viewModal.querySelector('.title-name');
            var productModalPrice = viewModal.querySelector('.price');
            var productModalImage = viewModal.querySelector('.slider-image img');
            var productModalDescription = viewModal.querySelector('.product-detail p');

            document.querySelectorAll('a[data-bs-target="#view"]').forEach(function (button) {
                button.addEventListener('click', function () {
                    var productName = button.getAttribute('data-name');
                    var productPrice = button.getAttribute('data-price');
                    var productImage = button.getAttribute('data-image');
                    var productDescription = button.getAttribute('data-description');

                    // Remove inline styles from the description
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = productDescription;
                    tempDiv.querySelectorAll('[style]').forEach(function (element) {
                        element.removeAttribute('style');
                    });

                    // Populate modal content
                    productModalName.textContent = productName;
                    productModalPrice.textContent = `৳${productPrice}`;
                    productModalImage.src = productImage;
                    productModalDescription.innerHTML = tempDiv.innerHTML; // Use sanitized content
                });
            });
        });
    </script>

@endsection
