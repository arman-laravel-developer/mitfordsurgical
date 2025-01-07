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
                                                @foreach($product->otherImages as $otherImage)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset($otherImage->gellery_image) }}" id="img-1"
                                                             data-zoom-image="{{ asset($otherImage->gellery_image) }}" class="
                                                        img-fluid image_zoom_cls-{{$otherImage->id}} blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="left-slider-image left-slider no-arrow slick-top">
                                                @foreach($product->otherImages as $otherImage)
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
                                    <div class="price-rating">
                                        <h3 class="theme-color price">&#2547; {{$product->sell_price}}</h3>
{{--                                        <h3 class="theme-color price">$49.50 <del class="text-content">$58.46</del> <span--}}
{{--                                                class="offer theme-color">(8% off)</span></h3>--}}
                                        <div class="product-rating custom-rate">
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
                                            <span class="review">23 Customer Review</span>
                                        </div>
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
                                        <button class="btn btn-md bg-dark cart-button text-white btn-cart" onclick="openCart()">{{translate('Add To Cart')}}</button>
                                        @else
                                            <button class="btn btn-md bg-danger cart-button text-white w-100" disabled>{{translate('Out Of Stock')}}</button>
                                        @endif
                                    </div>

                                    <div class="pickup-box">
                                        <div class="product-title">
                                            <h4>{{translate('Description')}}</h4>
                                        </div>

                                        <div class="pickup-detail">
                                            <p>{!! $product->getTranslation('description') !!}</p>
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
