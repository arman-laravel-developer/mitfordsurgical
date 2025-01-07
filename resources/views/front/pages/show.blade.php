@extends('front.master')

@section('title')
    {{$generalSettingView->site_name}} - {{translate('Product Detail')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section" style="padding-top: 1%!important;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0!important;">
                            <h2>{{translate('Product Detail')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{$product->getTranslation('name')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->
        <!-- Product Left Sidebar Start -->
        <section class="product-section">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 wow fadeInUp">
                        <div class="row g-4">
                            <div class="col-xl-6 wow fadeInUp">
                                <div class="product-left-box">
                                    <div class="row g-sm-4 g-2">
                                        <div class="col-12">
                                            <div class="product-main no-arrow">
                                                @foreach($product->otherImages as $index => $otherImage)
                                                    <div>
                                                        <div class="slider-image">
                                                            <img src="{{ asset($otherImage->gellery_image) }}" id="img-1"
                                                                 data-zoom-image="{{ asset($otherImage->gellery_image) }}" class="
                                                        img-fluid image_zoom_cls-{{$index}} blur-up lazyload" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="left-slider-image left-slider no-arrow slick-top">
                                                @foreach($product->otherImages as $index => $otherImage)
                                                    <div>
                                                        <div class="sidebar-image">
                                                            <img src="{{ asset($otherImage->gellery_image) }}"
                                                                 class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-6 wow fadeInUp">
                                <div class="right-box-contain">
                                    <h2 class="name">{{$product->getTranslation('name')}}</h2>
                                    <p>
                                        <a href="{{ route('category.product', ['id' => $product->category_id, 'slug' => $product->category->slug]) }}">{{$product->category->getTranslation('category_name')}}</a></p>
                                    <div class="price-rating">
                                        <h5 class="price theme-color">&#2547;{{discounted_price($product)}}@if(discounted_active($product)) <del>&#2547;{{number_format($product->sell_price,2)}}</del> @endif</h5>
                                    </div>

                                    <div class="product-package">
                                        @if($product->is_variant == 1)
                                            @if($product->variants->where('color_id', '!=', null)->unique('color_id')->count() > 0)
                                        <div class="product-title">
                                            <h4>{{translate('Color')}} </h4>
                                        </div>

                                        <ul class="color circle select-package">
                                            @foreach($product->variants->where('color_id', '!=', null)->unique('color_id') as $variant)
                                            <li class="form-check">
                                                <input class="form-check-input" {{ $loop->first ? 'checked' : '' }} type="radio" value="{{$variant->color_id}}" name="color_id"
                                                       id="color-{{$variant->color_id}}">
                                                <label class="form-check-label" for="color-{{$variant->color_id}}">
                                                    <span style="background-color: {{$variant->color->color_code}};"></span>
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                            @endif
                                        @endif

                                        @if($product->variants->where('size_id', '!=', null)->unique('size_id')->count() > 0)
                                        <div class="product-title">
                                            <h4>{{translate('Size')}} </h4>
                                            <ul class="circle select-package">
                                                @foreach($product->variants->where('size_id', '!=', null)->unique('size_id') as $variant)
                                                <li class="form-check">
                                                    <input class="form-check-input" {{ $loop->first ? 'checked' : '' }} type="radio" value="{{$variant->size_id}}" name="size_id" id="size-{{$variant->size_id}}">
                                                    <label class="form-check-label" for="size-{{$variant->size_id}}">
                                                        <span>{{$variant->size->name}}</span>
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                            @endif
                                    </div>



                                    <div class="note-box product-package">
                                        <div class="counter-number">
                                            <div class="counter">
                                                <div class="qty-left-minus" data-type="minus" data-field="">
                                                    <i class="fa-solid fa-minus"></i>
                                                </div>
                                                <input class="form-control input-number qty-input" style="width: 38%!important;" @if($product->minimum_purchase_qty > $product->stock) disabled @endif oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text"
                                                       name="quantity" max="{{$product->stock}}" min="{{$product->minimum_purchase_qty}}" value="{{$product->minimum_purchase_qty}}">
                                                <div class="qty-right-plus" data-type="plus" data-field="">
                                                    <i class="fa-solid fa-plus"></i>
                                                </div>
                                            </div>
                                        </div>

                                        @if($product->minimum_purchase_qty < $product->stock)
                                        <button class="btn btn-md bg-dark cart-button text-white btn-cart w-100" onclick="openCart()">{{translate('Add To Cart')}}</button>
                                        @else
                                            <button class="btn btn-md bg-danger cart-button text-white w-100" disabled>{{translate('Out Of Stock')}}</button>
                                        @endif
                                    </div>
                                    <div class="pickup-box">
                                        <div class="product-title">
                                            <h4>Product Information</h4>
                                        </div>

                                        <div class="pickup-detail">
                                            <h4 class="text-content">{!! $product->getTranslation('short_description') !!}</h4>
                                        </div>
                                    </div>
                                    <div class="payment-option">
                                        <div class="product-title">
                                            <h4>Guaranteed Safe Checkout</h4>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                         class="blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                         class="blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                         class="blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                         class="blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                         class="blur-up lazyload" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeInUp">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab">{{translate('Description')}}</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                            data-bs-target="#info" type="button" role="tab">Video</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="care-tab" data-bs-toggle="tab"
                                            data-bs-target="#care" type="button" role="tab">PDF</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab">Review</button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="product-description">
                                        <div class="nav-desh">
                                            <p>{!! $product->getTranslation('description') !!}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="info" role="tabpanel">
                                    <div class="table-responsive">
                                        <div class="video-container">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/_22tvB_lL8w"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="care" role="tabpanel">
                                    <div class="information-box" style="text-align: center;">
                                        <a href="javascript:void(0)" download class="btn btn-danger" style="display: inline-block; margin: 20px auto; background-color: red; color: white">
                                            Download Now
                                        </a>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="review" role="tabpanel">
                                    <div class="review-box">
                                        <div class="row">
                                            <div class="col-xl-5">
                                                <div class="product-rating-box">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="product-main-rating">
                                                                <h2>3.40
                                                                    <i data-feather="star"></i>
                                                                </h2>

                                                                <h5>5 Overall Rating</h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <ul class="product-rating-list">
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>5<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar"
                                                                                 style="width: 40%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">2</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>4<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar"
                                                                                 style="width: 20%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">1</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>3<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar"
                                                                                 style="width: 0%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">0</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>2<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar"
                                                                                 style="width: 20%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">1</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>1<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar"
                                                                                 style="width: 20%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">1</h5>
                                                                    </div>
                                                                </li>

                                                            </ul>

                                                            <div class="review-title-2">
                                                                <h4 class="fw-bold">Review this product</h4>
                                                                <p>Let other customers know what you think</p>
                                                                <button class="btn" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#writereview">Write a
                                                                    review</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-7">
                                                <div class="review-people">
                                                    <ul class="review-list">
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                             src="../assets/images/review/1.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a
                                                                            href="javascript:void(0)"
                                                                            class="name">Jack Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep 2023
                                                                                06:40:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>Avoid this product. The quality is
                                                                            terrible, and
                                                                            it started falling apart almost
                                                                            immediately. I
                                                                            wish I had read more reviews before
                                                                            buying.
                                                                            Lesson learned.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                             src="../assets/images/review/2.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a
                                                                            href="javascript:void(0)"
                                                                            class="name">Jessica
                                                                            Miller</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep 2023
                                                                                06:34:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                               class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                               class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                               class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                               class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i
                                                                                                data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>Honestly, I regret buying this item. The
                                                                            quality
                                                                            is subpar, and it feels like a waste of
                                                                            money. I
                                                                            wouldn't recommend it to anyone.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                             src="../assets/images/review/3.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a
                                                                            href="javascript:void(0)"
                                                                            class="name">Rome Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep 2023
                                                                                06:18:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>I am extremely satisfied with this
                                                                            purchase. The
                                                                            item arrived promptly, and the quality
                                                                            is
                                                                            exceptional. It's evident that the
                                                                            makers paid
                                                                            attention to detail. Overall, a
                                                                            fantastic buy!
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                             src="../assets/images/review/4.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a
                                                                            href="javascript:void(0)"
                                                                            class="name">Sarah
                                                                            Davis</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep 2023
                                                                                05:58:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>I am genuinely delighted with this item.
                                                                            It's a
                                                                            total winner! The quality is superb, and
                                                                            it has
                                                                            added so much convenience to my daily
                                                                            routine.
                                                                            Highly satisfied customer!</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                             src="../assets/images/review/5.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a
                                                                            href="javascript:void(0)"
                                                                            class="name">John Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep 2023
                                                                                05:22:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                           class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>Very impressed with this purchase. The
                                                                            item is of
                                                                            excellent quality, and it has exceeded
                                                                            my
                                                                            expectations.</p>
                                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Left Sidebar End -->

        <!-- Related Product Section Start -->
        <section class="product-list-section section-b-space">
            <div class="container">
                <div class="title">
                    <h2>{{translate('Related Products')}}</h2>
                    <span class="title-leaf">
                </span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="slider-6_1 product-wrapper">
                            @foreach($relatedProducts as $index => $relatedProduct)
                                <div class="product-box-4 wow fadeInUp" data-wow-delay="{{ 0.05 * ($index + 1) }}s">
                                    <div class="product-image">
                                        <a href="{{route('product.detail', ['id' => $relatedProduct->id, 'slug' => $relatedProduct->slug])}}">
                                            <img src="{{asset($relatedProduct->thumbnail_img)}}" class="img-fluid" alt="">
                                        </a>
                                    </div>

                                    <div class="product-detail">
                                        <a href="{{route('product.detail', ['id' => $relatedProduct->id, 'slug' => $relatedProduct->slug])}}">
                                            <h5 class="name">{{$relatedProduct->getTranslation('name')}}</h5>
                                        </a>
                                        <h5 class="price theme-color">&#2547;{{$relatedProduct->sell_price}}</h5>
                                        <div class="price-qty">
                                            <div class="counter-number">
                                                <div class="counter">
                                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </div>
                                                    <input class="form-control input-number qty-input" @if($relatedProduct->minimum_purchase_qty > $relatedProduct->stock) disabled @endif oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text"
                                                           name="quantity" max="{{$relatedProduct->stock}}" min="{{$relatedProduct->minimum_purchase_qty}}" value="{{$relatedProduct->minimum_purchase_qty}}">
                                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($relatedProduct->minimum_purchase_qty < $relatedProduct->stock)
                                                <button class="buy-button buy-button-2 btn btn-cart add-to-cart-btn" style="right: 5%;">
                                                    <i class="fa fa-cart-plus icli text-white m-0"></i>
                                                </button>
                                            @else
                                                <button class="buy-button buy-button-2 btn btn-out-of-stock out-of-stock-btn" style="background-color: red; right: 5%;" title="Out of stock">
                                                    <i class="fa fa-times icli text-white m-0"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related Product Section End -->
    </div>
@endsection
