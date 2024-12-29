@extends('front.master')

@section('title')
    {{$generalSettingView->site_name}} - {{translate('Category products')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>{{$category->category_name}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    @if($category->parentCategory)
                                        <li class="breadcrumb-item">
                                            <a href="{{route('category.product', ['id' => $category->parentCategory->id,'slug' => $category->parentCategory->slug])}}">{{$category->parentCategory->category_name}}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{$category->category_name}}</li>
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">{{$category->category_name}}</li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
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
        <!-- Breadcrumb Section End -->
    </div>
@endsection
