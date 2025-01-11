@extends('front.master')

@section('title')
    {{$generalSettingView->site_name}} - {{translate('Category products')}}
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-2" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 0!important;">
                            <h2>{{$category->getTranslation('category_name')}}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    @if($category->parentCategory)
                                        <li class="breadcrumb-item">
                                            <a href="{{route('category.product', ['id' => $category->parentCategory->id,'slug' => $category->parentCategory->slug])}}">{{$category->parentCategory->getTranslation('category_name')}}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">{{$category->getTranslation('category_name')}}</li>
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">{{$category->getTranslation('category_name')}}</li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            @if(count($category_products) > 0)
            <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 section-b-space">
                @foreach($category_products as $index => $category_product)
                <div class="product-box-4 wow fadeInUp" data-wow-delay="{{ 0.05 * ($index + 1) }}s">
                    <div class="product-image">
                        <a href="{{route('product.detail', ['id' => $category_product->id, 'slug' => $category_product->slug])}}">
                            <img src="{{asset($category_product->thumbnail_img)}}" class="img-fluid" alt="">
                        </a>
                    </div>

                    <div class="product-detail">
                        <a href="{{route('product.detail', ['id' => $category_product->id, 'slug' => $category_product->slug])}}">
                            <h5 class="name">{{$category_product->getTranslation('name')}}</h5>
                        </a>
                        <h5 class="price theme-color">&#2547;{{discounted_price($category_product)}}@if(discounted_active($category_product)) <del>&#2547;{{number_format($category_product->sell_price,2)}}</del> @endif</h5>
                        <form id="cartForm{{$category_product->id}}" action="{{route('cart.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Your existing form fields -->
                            <div class="price-qty">
                                <div class="counter-number">
                                    <div class="counter">
                                        <div class="qty-left-minus" data-type="minus" data-field="">
                                            <i class="fa-solid fa-minus"></i>
                                        </div>
                                        <input class="form-control input-number qty-input" @if($category_product->minimum_purchase_qty > $category_product->stock) disabled @endif oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text"
                                               name="quantity" max="{{$category_product->stock}}" min="{{$category_product->minimum_purchase_qty}}" value="{{$category_product->minimum_purchase_qty}}">
                                        <div class="qty-right-plus" data-type="plus" data-field="">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($category_product->minimum_purchase_qty <= $category_product->stock)
                                    <input type="hidden" name="price" value="{{discounted_price($category_product)}}">
                                    <input type="hidden" name="product_id" value="{{$category_product->id}}">
                                    @if($category_product->is_variant == 1)
                                        @php
                                            $variant = \App\Models\Variant::where('product_id', $category_product->id)->first();
                                        @endphp
                                        <input type="hidden" name="size_id" value="{{$variant->size_id}}">
                                        <input type="hidden" name="color_id" value="{{$variant->color_id}}">
                                        <input type="hidden" name="variant_id" value="{{$variant->id}}">
                                    @endif
                                    <button class="buy-button buy-button-2 btn btn-cart add-to-cart-btn" id="addToCartButtonHome{{$category_product->id}}" type="submit">
                                        <i class="fa fa-cart-plus icli text-white m-0"></i>
                                    </button>
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
            @else
                <h4 class="text-center opacity-50 mt-5">No item found</h4>
            @endif
        </div>
        <!-- Breadcrumb Section End -->
    </div>
@endsection
