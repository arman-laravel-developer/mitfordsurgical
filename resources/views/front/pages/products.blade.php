@extends('front.master')

@section('title')
    {{$generalSettingView->site_name}} - {{translate('All Products')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-2" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0!important;">
                            <h2>{{translate('All Products')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{translate('All Products')}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container all-products">
            @if(count($products) > 0)
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
                                <h5 class="price theme-color">&#2547;{{discounted_price($product)}}@if(discounted_active($product)) <del>&#2547;{{number_format($product->sell_price,2)}}</del> @endif</h5>
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
                <div id="scroll-target"></div> <!-- Target for detecting scroll -->
            @else
                <h4 class="text-center opacity-50 mt-5">{{translate('No item found')}}</h4>
            @endif
        </div>
        <!-- Breadcrumb Section End -->
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
                    url: '{{ route("products.all") }}' + '?page=' + page, // Use the updated page variable
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
@endsection

