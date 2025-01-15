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
                                        {{translate('Category')}}: <a href="{{ route('category.product', ['id' => $product->category_id, 'slug' => $product->category->slug]) }}">{{$product->category->getTranslation('category_name')}}</a>&nbsp;&nbsp;
                                        @php
                                            $shop = \App\Models\Shop::find($product->user_id);
                                        @endphp
                                        {{translate('Sold By')}}: @if($product->added_by == 'admin') {{translate('In House Product')}}
                                        @else
                                            <a href="">{{$shop->shop_name}}</a>
                                        @endif
                                    </p>
                                    <div class="price-rating">
                                        <h5 class="price theme-color"><span>Price:</span> &#2547;<span id="price">{{number_format(discounted_price($product),2)}}</span>@if(discounted_active($product)) <del>&#2547;{{number_format($product->sell_price,2)}}</del> @endif</h5>
                                    </div>
                                    <form id="addToCartForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="product-package">
                                            @if($product->is_variant == 1)
                                                @if($product->variants->where('color_id', '!=', null)->unique('color_id')->count() > 0)
                                                    <div class="product-title">
                                                        <h4>{{translate('Color')}} </h4>
                                                    </div>
                                                    <ul class="color circle select-package">
                                                        @foreach($product->variants->where('color_id', '!=', null)->unique('color_id') as $variant)
                                                            <li class="form-check">
                                                                <input class="form-check-input color-selector" type="radio" value="{{$variant->color_id}}" name="color_id" id="color-{{$variant->color_id}}" required>
                                                                <label class="form-check-label" for="color-{{$variant->color_id}}">
                                                                    <span style="background-color: {{$variant->color->color_code}};"></span>
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @if($product->variants->where('size_id', '!=', null)->unique('size_id')->count() > 0)
                                                    <div class="product-title">
                                                        <h4>{{translate('Size')}} </h4>
                                                    </div>
                                                    <ul class="circle select-package">
                                                        @foreach($product->variants->where('size_id', '!=', null)->unique('size_id') as $variant)
                                                            <li class="form-check">
                                                                <input class="form-check-input size-selector" required type="radio" value="{{$variant->size_id}}" name="size_id" id="size-{{$variant->size_id}}">
                                                                <label class="form-check-label" for="size-{{$variant->size_id}}">
                                                                    <span>{{$variant->size->name}}</span>
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endif
                                        </div>
                                        <input type="hidden" name="price" id="priceAdd" value="{{number_format(discounted_price($product),2)}}">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="variant_id" id="variantID" value="">
                                        <div class="note-box product-package">
                                            <div class="counter-number">
                                                <div class="counter">
                                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </div>
                                                    <input class="form-control input-number qty-input" style="width: 38%!important;" @if($product->minimum_purchase_qty > $product->stock) disabled @endif oninput="validateQuantity(this)" type="text" name="quantity" id="qtyInput" max="{{$product->stock}}" min="{{$product->minimum_purchase_qty}}" value="{{$product->minimum_purchase_qty}}" data-available-qty="{{$product->stock}}" required>
                                                    <div class="qty-right-plus" data-type="plus" data-field="">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="messageBox" class="mt-2" style="display:none;"></div>
                                            @if($product->is_variant == 1)
                                                <button class="btn btn-md bg-dark cart-button text-white btn-cart w-100" id="addToCartButton" type="submit" >{{translate('Add To Cart')}}</button>
                                                <button class="btn btn-md bg-danger cart-button text-white w-100" style="display: none" id="outOfStockButton" disabled>{{translate('Out Of Stock')}}</button>
                                            @else
                                                @if($product->minimum_purchase_qty <= $product->stock)
                                                    <button class="btn btn-md bg-dark cart-button text-white btn-cart w-100" id="addToCartButton" type="submit">{{translate('Add To Cart')}}</button>
                                                @else
                                                    <button class="btn btn-md bg-danger cart-button text-white w-100" id="outOfStockButton" disabled>{{translate('Out Of Stock')}}</button>
                                                @endif
                                            @endif
                                        </div>
                                    </form>

                                    <div class="pickup-box">
                                        <div class="product-title">
                                            <h4>Product Information</h4>
                                        </div>

                                        <div class="pickup-detail">
                                            <h4 class="text-content">{{strip_tags($product->getTranslation('short_description'))}}</h4>
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
                                        <a href="{{ asset($product->pdf) }}" download class="btn btn-danger" style="display: inline-block; margin: 20px auto; background-color: red; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
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
                                        <form id="cartForm{{$relatedProduct->id}}" action="{{route('cart.add')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Your existing form fields -->
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
                                                @if($relatedProduct->minimum_purchase_qty <= $relatedProduct->stock)
                                                    @php
                                                        $variant = null;
                                                        if ($relatedProduct->is_variant == 1) {
                                                            $variant = \App\Models\Variant::where('product_id', $relatedProduct->id)
                                                                                          ->where('qty', '>=', $relatedProduct->minimum_purchase_qty)
                                                                                          ->first();

                                                            if (!$variant) {
                                                                $variants = \App\Models\Variant::where('product_id', $relatedProduct->id)->get();
                                                                foreach ($variants as $v) {
                                                                    if ($v->qty >= $relatedProduct->minimum_purchase_qty) {
                                                                        $variant = $v;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp

                                                    @if($relatedProduct->is_variant != 1 || $variant)
                                                        <input type="hidden" name="price" value="{{ discounted_price($relatedProduct) }}">
                                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                                        @if($variant)
                                                            <input type="hidden" name="size_id" value="{{ $variant->size_id }}">
                                                            <input type="hidden" name="color_id" value="{{ $variant->color_id }}">
                                                            <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                                                        @endif
                                                        <button class="buy-button buy-button-2 btn btn-cart add-to-cart-btn" id="addToCartButtonHome{{ $relatedProduct->id }}" type="submit">
                                                            <i class="fa fa-cart-plus icli text-white m-0"></i>
                                                        </button>
                                                    @else
                                                        <button class="buy-button buy-button-2 btn btn-out-of-stock out-of-stock-btn" style="background-color: red" title="Out of stock">
                                                            <i class="fa fa-times icli text-white m-0"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="buy-button buy-button-2 btn btn-out-of-stock out-of-stock-btn" style="background-color: red" title="Out of stock">
                                                        <i class="fa fa-times icli text-white m-0"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </form>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#addToCartForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let formData = new FormData(this);
                let messageBox = $('#messageBox');
                let itemQtyElement = $('#itemQty');
                let itemQtyElementMobile = $('.cart-mobile');
                let itemValueElement = $('#ItemValue');
                let itemQtyInCartElement = $('#itemQtyIncart');
                let itemValueInCartElement = $('#itemValueIncart');

                // Ensure initial values are numbers or set to 0
                let currentItemQty = parseInt(itemQtyElement.text()) || 0;
                let currentItemValue = parseFloat(itemValueElement.text()) || 0;
                let currentItemQtyInCart = parseInt(itemQtyInCartElement.text()) || 0;
                let currentItemValueInCart = parseFloat(itemValueInCartElement.text()) || 0;

                $.ajax({
                    url: '{{ route('cart.add') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            // Animate the UI to show the updated count from the server
                            animateCount(itemQtyElementMobile, currentItemQty, response.item, 1000); // Duration adjusted
                            animateCount(itemQtyElement, currentItemQty, response.item, 1000); // Duration adjusted
                            animateCount(itemValueElement, currentItemValue, response.total, 1000); // Duration adjusted
                            animateCount(itemQtyInCartElement, currentItemQtyInCart, response.item, 1000); // Duration adjusted
                            animateCount(itemValueInCartElement, currentItemValueInCart, response.total, 1000); // Duration adjusted

                            toastr.success(response.message);
                            resetForm('#addToCartForm');
                            // Optionally open the cart
                            // openCart();
                            updateCartDropdown();
                        } else {
                            toastr.error('Failed to add to cart. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        showMessage('An error occurred. Please try again.', 'error');
                    }
                });

                function resetForm(selector) {
                    $(selector).trigger('reset'); // Reset the form fields
                    // Optionally, reset custom elements like color and size selectors if needed
                    $('.color-selector, .size-selector').prop('checked', false); // Uncheck radio buttons
                }

                function showMessage(message, type) {
                    let messageClass = type === 'success' ? 'alert alert-success' : 'alert alert-danger';
                    messageBox.removeClass().addClass(messageClass).text(message).fadeIn();
                    setTimeout(function() {
                        messageBox.fadeOut();
                    }, 3000); // Hide message after 3 seconds
                }

                function updateCartDropdown() {
                    $.ajax({
                        url: '{{ route('cart.dropdown') }}',
                        method: 'GET',
                        success: function(response) {
                            $('.cart-body').html(response); // Update the cart dropdown HTML
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }

                // Animation function (count up from current to total)
                function animateCount(element, startValue, endValue, duration) {
                    // Ensure both values are valid numbers
                    let validStartValue = isNaN(startValue) ? 0 : startValue;
                    let validEndValue = isNaN(endValue) ? 0 : endValue;

                    // Calculate the difference between start and end value
                    let diff = validEndValue - validStartValue;
                    let steps = diff > 1000 ? 100 : 50; // Adjust number of steps for large values
                    let increment = diff / steps; // Calculate the increment value per step

                    $({ countNum: validStartValue }).animate(
                        { countNum: validEndValue },
                        {
                            duration: duration, // Total animation duration
                            easing: 'swing', // Easing function
                            step: function() {
                                // Update the element's text during each step of the animation
                                let newValue = Math.ceil(this.countNum + increment); // Increase the count
                                element.text(newValue);
                                this.countNum = newValue; // Update the current count value
                            },
                            complete: function() {
                                // Ensure the final value is set after animation
                                element.text(validEndValue);
                            }
                        }
                    );
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to fetch the price, stock, and qty for a selected color and size
            function fetchVariantData(colorId, sizeId) {
                var productId = {{ $product->id }}; // Get the product ID

                $.ajax({
                    url: '{{ route('get.variant') }}', // Ensure this route is set up
                    type: 'GET',
                    data: {
                        product_id: productId,
                        color_id: colorId,
                        size_id: sizeId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.variant) {
                            // Update price
                            const basePrice = parseFloat(response.variant.price);
                            const discount = parseFloat({{$product->discount}});
                            const discountType = {{$product->discount_type}};
                            const startDate = new Date('{{$product->start_date}}'); // Parse the start date
                            const endDate = new Date('{{$product->end_date}}'); // Parse the end date
                            const currentDate = new Date(); // Get the current date

                            let finalPrice = basePrice;

                            // Check if the current date is within the discount period
                            if (discount > 0 && currentDate >= startDate && currentDate <= endDate) {
                                if (discountType == 2) {
                                    finalPrice = basePrice - (basePrice * (discount / 100));
                                } else {
                                    finalPrice = basePrice - discount;
                                }
                            }

                            $('#price').text(finalPrice.toFixed(2)); // Update price with 2 decimal places
                            $('#priceAdd').val(finalPrice.toFixed(2)); // Update hidden input with 2 decimal places
                            $('#variantID').val(response.variant.id);
                            var availableQty = response.variant.qty;

                            // Update the max attribute of the quantity input
                            $('#qtyInput').attr('max', availableQty).attr('data-available-qty', availableQty);

                            // Enable or disable the "Add to Cart" button based on stock
                            if (availableQty > 0) {
                                $('#addToCartButton').prop('disabled', false).css('display', 'block');
                                $('#outOfStockButton').css('display', 'none');
                            } else {
                                $('#addToCartButton').prop('disabled', true).css('display', 'none');
                                $('#outOfStockButton').css('display', 'block');
                            }

                            // Validate the current quantity input value
                            validateQuantity(document.getElementById('qtyInput'));
                        }
                    },
                    error: function() {
                        alert('Error fetching variant data');
                    }
                });
            }

            // Listen for changes in the color or size selectors
            $(document).on('change', '.color-selector, .size-selector', function() {
                var colorId = $('input[name="color_id"]:checked').val();
                var sizeId = $('input[name="size_id"]:checked').val();

                // Call fetchVariantData based on selected color or size
                if (colorId && sizeId) {
                    fetchVariantData(colorId, sizeId);
                } else if (colorId) {
                    fetchVariantData(colorId, null);
                } else if (sizeId) {
                    fetchVariantData(null, sizeId);
                }
            });

            // Function to validate and adjust the quantity input value
            function validateQuantity(input) {
                var availableQty = parseInt(input.getAttribute('data-available-qty')); // Get the updated available quantity
                var inputValue = parseInt(input.value); // Get the current input value

                // Adjust the input value if it exceeds the available quantity or falls below the minimum purchase quantity
                if (inputValue > availableQty) {
                    input.value = availableQty;
                } else if (inputValue < {{$product->minimum_purchase_qty}}) {
                    input.value = {{$product->minimum_purchase_qty}};
                }
            }

            // Attach the validateQuantity function to the input event of the qtyInput
            $('#qtyInput').on('input', function() {
                validateQuantity(this);
            });
        });
    </script>

@endsection
