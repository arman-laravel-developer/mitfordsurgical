@extends('front.master')

@section('title')
    Home | {{$generalSettingView->site_name}}
@endsection

@section('seo')
    <meta name="description" content="{{optional($generalSettingView->siteSeo->first())->meta_description}}">
    <meta name="keywords" content="{{optional($generalSettingView->siteSeo->first())->keywords}}">
    <!-- Canonical URL -->
    <link rel="canonical" href="{{url('/')}}">

    <!-- Open Graph (OG) Meta Tags for Social Media -->
    <meta property="og:title" content="{{optional($generalSettingView->siteSeo->first())->meta_title}}">
    <meta property="og:description" content="{{optional($generalSettingView->siteSeo->first())->meta_description}}">
    <meta property="og:image" content="{{asset($generalSettingView->siteSeo->first()->meta_image)}}">
    <meta property="og:url" content="{{url('/')}}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{$generalSettingView->site_name}}">
    <meta property="og:locale" content="en_US">
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:secure_url" content="{{asset($generalSettingView->siteSeo->first()->meta_image)}}" />
    <link rel="image_src" href="{{asset($generalSettingView->siteSeo->first()->meta_image)}}" title="{{$generalSettingView->site_name}}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{optional($generalSettingView->siteSeo->first())->meta_title}}">
    <meta name="twitter:description" content="{{optional($generalSettingView->siteSeo->first())->meta_description}}">
    <meta name="twitter:image" content="{{asset($generalSettingView->siteSeo->first()->meta_image)}}">
    <meta name="twitter:site" content="@mitfordsurgical">
    <meta name="twitter:creator" content="@mitfordsurgical">

    <!-- Structured Data (Schema Markup) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Fashionistaa Haven",
      "url": "{{url('/')}}",
      "logo": "{{asset($generalSettingView->header_logo)}}",
      "sameAs": [
        "{{$generalSettingView->facebook_url}}",
        "{{$generalSettingView->instagram_url}}",
        "{{$generalSettingView->twitter_url}}"
      ]
    }
    </script>
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
        <section class="section-b-space" style="padding-bottom: calc(8px + 20*(100vw - 320px)/1600);">
            <div class="container">
                <div class="title" style="margin-bottom: 1%!important;">
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
                                        <div class="category-name">
                                            <h6>{{$homeCategory->category_name}}</h6>
                                        </div>
                                    </a>
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
            <div class="title d-block" style="margin-bottom: 0!important;">
                <h2 class="text-theme font-sm text-center">{{translate('Featured Products')}}</h2>
            </div>
{{--            <form action="{{ route('bkash.pay') }}" method="GET">--}}
{{--                <input type="hidden" name="amount" value="100"> <!-- Replace with dynamic amount -->--}}
{{--                <button type="submit">Pay with bKash</button>--}}
{{--            </form>--}}

            <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
                @foreach($featuredProducts as $index => $featuredProduct)
                <div class="product-box-4 wow fadeInUp" data-wow-delay="{{ 0.05 * ($index + 1) }}s">
                    <div class="product-image">
                        <a href="{{route('product.detail', ['id' => $featuredProduct->id, 'slug' => $featuredProduct->slug])}}">
                            <img src="{{asset($featuredProduct->thumbnail_img)}}" class="img-fluid" alt="">
                        </a>
                    </div>

                    <div class="product-detail">
                        <a href="{{route('product.detail', ['id' => $featuredProduct->id, 'slug' => $featuredProduct->slug])}}">
                            <h5 class="name">{{$featuredProduct->getTranslation('name')}}</h5>
                        </a>
{{--                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>--}}
                        <h5 class="price theme-color">&#2547;{{number_format(discounted_price($featuredProduct))}}@if(discounted_active($featuredProduct)) <del class="text-danger">&#2547;{{number_format($featuredProduct->sell_price,2)}}</del> @endif</h5>
                        <form id="cartForm{{$featuredProduct->id}}" action="{{route('cart.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Your existing form fields -->
                            <div class="price-qty">
                                <div class="counter-number">
                                    <div class="counter">
                                        <div class="qty-left-minus" data-type="minus" data-field="">
                                            <i class="fa-solid fa-minus"></i>
                                        </div>
                                        <input class="form-control input-number qty-input" @if($featuredProduct->minimum_purchase_qty > $featuredProduct->stock) disabled @endif oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text"
                                               name="quantity" max="{{$featuredProduct->stock}}" min="{{$featuredProduct->minimum_purchase_qty}}" value="{{$featuredProduct->minimum_purchase_qty}}">
                                        <div class="qty-right-plus" data-type="plus" data-field="">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($featuredProduct->minimum_purchase_qty <= $featuredProduct->stock)
                                    @php
                                        $variant = null;
                                        if ($featuredProduct->is_variant == 1) {
                                            $variant = \App\Models\Variant::where('product_id', $featuredProduct->id)
                                                                          ->where('qty', '>=', $featuredProduct->minimum_purchase_qty)
                                                                          ->first();

                                            if (!$variant) {
                                                $variants = \App\Models\Variant::where('product_id', $featuredProduct->id)->get();
                                                foreach ($variants as $v) {
                                                    if ($v->qty >= $featuredProduct->minimum_purchase_qty) {
                                                        $variant = $v;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp

                                    @if($featuredProduct->is_variant != 1 || $variant)
                                        <input type="hidden" name="price" value="{{ discounted_price($featuredProduct) }}">
                                        <input type="hidden" name="product_id" value="{{ $featuredProduct->id }}">
                                        @if($variant)
                                            <input type="hidden" name="size_id" value="{{ $variant->size_id }}">
                                            <input type="hidden" name="color_id" value="{{ $variant->color_id }}">
                                            <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                                        @endif
                                        <button class="buy-button buy-button-2 btn btn-cart add-to-cart-btn" id="addToCartButtonHome{{ $featuredProduct->id }}" type="submit">
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
        <div class="container all-products">
            <div class="title d-block" style="margin-bottom: 0!important;">
                <h2 class="text-theme font-sm text-center">{{translate('All Products')}}</h2>
            </div>

            <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
                @foreach($products as $index => $product)
                <div class="product-box-4 wow fadeInUp" data-wow-delay="{{ 0.05 * ($index + 1) }}s">
                    <div class="product-image">
                        <a href="{{route('product.detail', ['id' => $product->id, 'slug' => $product->slug])}}">
                            <img src="{{asset($product->thumbnail_img)}}" class="img-fluid" alt="">
                        </a>
                    </div>

                    <div class="product-detail">
                        <a href="{{route('product.detail', ['id' => $product->id, 'slug' => $product->slug])}}">
                            <h5 class="name">{{$product->getTranslation('name')}}</h5>
                        </a>
                        <h5 class="price theme-color">&#2547;{{number_format(discounted_price($product))}}@if(discounted_active($product)) <del class="text-danger">&#2547;{{number_format($product->sell_price,2)}}</del> @endif</h5>
                        <form id="cartForm{{$product->id}}" action="{{route('cart.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Your existing form fields -->
                            <div class="price-qty">
                                <div class="counter-number">
                                    <div class="counter">
                                        <div class="qty-left-minus" data-type="minus" data-field="">
                                            <i class="fa-solid fa-minus"></i>
                                        </div>
                                        <input class="form-control input-number qty-input" @if($product->minimum_purchase_qty > $product->stock) disabled @endif oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text"
                                               name="quantity" max="{{$product->stock}}" min="{{$product->minimum_purchase_qty}}" value="{{$product->minimum_purchase_qty}}">
                                        <div class="qty-right-plus" data-type="plus" data-field="">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($product->minimum_purchase_qty <= $product->stock)
                                    @php
                                        $variant = null;
                                        if ($product->is_variant == 1) {
                                            $variant = \App\Models\Variant::where('product_id', $product->id)
                                                                          ->where('qty', '>=', $product->minimum_purchase_qty)
                                                                          ->first();

                                            if (!$variant) {
                                                $variants = \App\Models\Variant::where('product_id', $product->id)->get();
                                                foreach ($variants as $v) {
                                                    if ($v->qty >= $product->minimum_purchase_qty) {
                                                        $variant = $v;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp

                                    @if($product->is_variant != 1 || $variant)
                                        <input type="hidden" name="price" value="{{ discounted_price($product) }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @if($variant)
                                            <input type="hidden" name="size_id" value="{{ $variant->size_id }}">
                                            <input type="hidden" name="color_id" value="{{ $variant->color_id }}">
                                            <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                                        @endif
                                        <button class="buy-button buy-button-2 btn btn-cart add-to-cart-btn" id="addToCartButtonHome{{ $product->id }}" type="submit">
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
            <div id="scroll-target"></div>
        </div>

        <section class="newsletter-section" style="padding-top: 0!important;">
            <div class="container">
                <div class="newsletter-box newsletter-box-2">
                    <div class="newsletter-contain py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                    <div class="newsletter-detail">
                                        <h2>Join our newsletter...</h2>
                                        <form action="{{route('subscriber.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-box">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleFormControlInput1"
                                                       placeholder="Enter Your Email" required autocomplete="off">
                                                <i class="fa-solid fa-envelope arrow"></i>
                                                <button type="submit" class="sub-btn  btn-animation">
                                                    <span class="d-sm-block d-none">Subscribe</span>
                                                    <i class="fa-solid fa-arrow-right icon"></i>
                                                </button>
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var page = 2; // Start from the second page as the first is already loaded
            var isLoading = false; // Prevent multiple AJAX requests at once

            // Scroll event to load more products
            $(window).on('scroll', function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
                    if (!isLoading) {
                        loadMoreProducts();
                    }
                }
            });

            function loadMoreProducts() {
                isLoading = true;
                $.ajax({
                    url: '{{ route("home") }}' + '?page=' + page,
                    type: 'GET',
                    beforeSend: function () {
                        $('#scroll-target').html('<div class="text-center opacity-50 mt-3 mb-3">{{translate("Loading more products")}}...</div>');
                    },
                    success: function (data) {
                        if (data.html) {
                            $('.all-products .row').append(data.html);
                            page++;
                            isLoading = false;
                            $('#scroll-target').html('');

                            // Reinitialize event listeners for dynamically added products
                            initializeAddToCartListeners();
                        } else {
                            $('#scroll-target').html('<div class="text-center opacity-50 mt-3 mb-3">{{translate("No more products to load")}}.</div>');
                            isLoading = true;
                        }
                    },
                    error: function () {
                        alert('Failed to load more products. Please try again.');
                        isLoading = false;
                    }
                });
            }

            // Function to initialize add-to-cart button listeners
            function initializeAddToCartListeners() {
                $('form[id^="cartForm"]').off('submit').on('submit', function (e) {
                    e.preventDefault(); // Prevent the default form submission

                    var form = $(this);
                    var formData = new FormData(form[0]);
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
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            animateCount(itemQtyElementMobile, currentItemQty, response.item, 1000); // Duration adjusted
                            animateCount(itemQtyElement, currentItemQty, response.item, 1000); // Duration adjusted
                            animateCount(itemValueElement, currentItemValue, response.total, 1000); // Duration adjusted
                            animateCount(itemQtyInCartElement, currentItemQtyInCart, response.item, 1000); // Duration adjusted
                            animateCount(itemValueInCartElement, currentItemValueInCart, response.total, 1000); // Duration adjusted

                            toastr.success(response.message);
                            resetForm(form);
                            updateCartDropdown();
                        },
                        error: function (xhr, status, error) {
                            alert("An error occurred. Please try again.");
                        }
                    });

                    function resetForm(form) {
                        form.trigger('reset'); // Reset the form fields
                        $('.color-selector, .size-selector').prop('checked', false); // Uncheck radio buttons
                    }

                    function updateCartDropdown() {
                        $.ajax({
                            url: '{{ route('cart.dropdown') }}',
                            method: 'GET',
                            success: function (response) {
                                $('.cart-body').html(response); // Update the cart dropdown HTML
                            },
                            error: function (error) {
                                console.error('Error:', error);
                            }
                        });
                    }

                    // Animation function (count up from current to total)
                    function animateCount(element, startValue, endValue, duration) {
                        let validStartValue = isNaN(startValue) ? 0 : startValue;
                        let validEndValue = isNaN(endValue) ? 0 : endValue;

                        $({ countNum: validStartValue }).animate(
                            { countNum: validEndValue },
                            {
                                duration: duration,
                                easing: 'swing',
                                step: function () {
                                    element.text(Math.ceil(this.countNum));
                                },
                                complete: function () {
                                    element.text(validEndValue);
                                }
                            }
                        );
                    }
                });
            }

            // Initialize listeners for initially loaded products
            initializeAddToCartListeners();
        });
    </script>


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
