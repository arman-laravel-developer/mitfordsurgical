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
                        <h5 class="price theme-color">&#2547;{{discounted_price($featuredProduct)}}@if(discounted_active($featuredProduct)) <del class="text-danger">&#2547;{{number_format($featuredProduct->sell_price,2)}}</del> @endif</h5>
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
            <div class="title d-block">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var page = 2; // Start from the second page as the first is already loaded
            var isLoading = false; // Prevent multiple AJAX requests at once

            $(window).on('scroll', function() {
                // Check if the user has scrolled near the bottom of the page
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
                    if (!isLoading) { // Only load if not already in the middle of loading
                        loadMoreProducts();
                    }
                }
            });

            function loadMoreProducts() {
                isLoading = true; // Set loading flag to true
                $.ajax({
                    url: '{{ route("home") }}' + '?page=' + page, // Use the updated page variable
                    type: 'GET',
                    beforeSend: function() {
                        $('#scroll-target').html('<div class="text-center opacity-50 mt-3 mb-3">{{translate('Loading more products')}}...</div>'); // Display loading message
                    },
                    success: function(data) {
                        if (data.html) {
                            $('.all-products .row').append(data.html); // Append new news items to the row
                            page++; // Increment page number for the next request
                            isLoading = false; // Reset loading flag
                            $('#scroll-target').html(''); // Remove loading message
                        } else {
                            $('#scroll-target').html('<div class="text-center opacity-50 mt-3 mb-3">{{translate('No more products to load')}}.</div>'); // Display end message
                            isLoading = true; // Prevent further requests since no more data
                        }
                    },
                    error: function() {
                        alert('Failed to load more products. Please try again.');
                        isLoading = false; // Reset loading flag on error
                    }
                });
            }
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
