@extends('front.master')

@section('title')
    {{translate('Order Confirmation')}} | {{$generalSettingView->site_name}}
@endsection

@section('body')
    <div class="content-col">
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain breadcrumb-order">
                        <div class="order-box">
                            <div class="order-image">
                                <div class="checkmark">
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                        </path>
                                    </svg>
                                    <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                        </path>
                                    </svg>
                                    <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <div class="order-contain">
                                <h3 class="theme-color">{{translate('Order Success')}}</h3>
                                <h5 class="text-content">{{translate('Payment Is Successfully And Your Order Is On The Way')}}</h5>
                                <h6>{{translate('Order Code')}}: {{$order->order_code}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-9 col-lg-8">
                    <div class="cart-table order-table order-table-2">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                @foreach($order->orderDetails as $orderDetail)
                                <tr>
                                    <td class="product-detail">
                                        <div class="product border-0">
                                            <a href="{{route('product.detail', ['id' => $orderDetail->product_id, 'slug' => $orderDetail->product->slug])}}" class="product-image" target="_blank">
                                                <img src="{{asset($orderDetail->product->thumbnail_img)}}"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <div class="product-detail">
                                                <ul>
                                                    <li class="name">
                                                        <a href="{{route('product.detail', ['id' => $orderDetail->product_id, 'slug' => $orderDetail->product->slug])}}" target="_blank">{{$orderDetail->product->getTranslation('name')}}</a>
                                                    </li>
                                                    @if($orderDetail->product->added_by == 'admin')
                                                        <li class="text-content">{{translate('Sold By')}}: In house</li>
                                                    @else
                                                        <li class="text-content">{{translate('Sold By')}}: Fresho</li>
                                                    @endif
                                                    @if($orderDetail->product->is_variant == 1)
                                                    <li class="text-content">Variant - {{$orderDetail->variant->variant}}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="price">
                                        <h4 class="table-title text-content">{{translate('Price')}}</h4>
                                        <h6 class="theme-color">&#2547; {{number_format($orderDetail->price)}}</h6>
                                    </td>

                                    <td class="quantity">
                                        <h4 class="table-title text-content">{{translate('Qty')}}</h4>
                                        <h4 class="text-title">{{$orderDetail->qty}}</h4>
                                    </td>

                                    <td class="subtotal">
                                        <h4 class="table-title text-content">{{translate('Total')}}</h4>
                                        <h5>&#2547; {{number_format($orderDetail->price * $orderDetail->qty)}}</h5>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-lg-4">
                    <div class="row g-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header">
                                    <h3>{{translate('Price Details')}}</h3>
                                    <h5 class="ms-auto theme-color">({{$order->total_qty}} {{translate('Items')}})</h5>
                                </div>

                                <ul class="summery-contain">
                                    <li>
                                        <h4>{{translate('SubTotal')}}</h4>
                                        <h4 class="price">&#2547;{{number_format($order->grand_total)}}</h4>
                                    </li>

                                    <li>
                                        <h4>{{translate('Shipping Cost')}}</h4>
                                        <h4 class="price theme-color">&#2547;{{number_format($order->shipping_cost)}}</h4>
                                    </li>

{{--                                    <li>--}}
{{--                                        <h4>Coupon Discount</h4>--}}
{{--                                        <h4 class="price text-danger">$6.27</h4>--}}
{{--                                    </li>--}}
                                </ul>

                                <ul class="summery-total">
                                    <li class="list-total">
                                        <h4>{{translate('Total (BDT)')}}</h4>
                                        <h4 class="price">&#2547;{{number_format($order->grand_total+$order->shipping_cost)}}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>{{translate('Shipping Address')}}</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <li class="d-block">
                                        <h4>{{$order->address}}</h4>
                                    </li>

                                    <li class="pb-0">
                                        <h4>{{translate('Expected Date Of Delivery')}}:</h4>
                                        <h4 class="price theme-color">
                                            <form id="orderForm" action="{{route('show.track-result')}}" method="GET">
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" value="{{$order->order_code}}" name="order_code" id="order-id" placeholder="">
                                                    <button style="border: none" class="text-danger" type="submit">{{translate('Track Order')}}</button>
                                                </div>
                                            </form>
                                        </h4>
                                    </li>
                                </ul>

                                @php
                                    // Assuming $order and $orderDetail are already retrieved Eloquent models
                                $orderCreatedAt = $order->created_at; // Eloquent date attribute, typically a Carbon instance


                                // Calculate the estimated delivery date
                                $estimatedDeliveryDate = \Carbon\Carbon::parse($orderCreatedAt)->addDays(3);

                                // Format the date to the desired format (e.g., 'Y-m-d')
                                $formattedDeliveryDate = $estimatedDeliveryDate->format('M d, Y');
                                @endphp

                                <ul class="summery-total">
                                    <li class="list-total border-top-0 pt-2">
                                        <h4 class="fw-bold">{{$formattedDeliveryDate}}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>{{translate('Payment Method')}}</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <li class="d-block pt-0">
                                        <p class="text-content">@if($order->payment_method == 'cod') {{translate('Cash On Delivery')}} @endif</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="summery-box">
                                <div class="summery-header d-block">
                                    <h3>{{translate('My Download')}}</h3>
                                </div>

                                <ul class="summery-contain pb-0 border-bottom-0">
                                    <a href="{{route('products.all')}}" class="text-danger">{{translate('Continue to shopping')}}</a>
                                    <a href="javascript:void(0)" class="text-success" onclick="event.preventDefault();document.getElementById('downloadInvoice').submit();">{{translate('Download')}}</a>
                                    <form action="{{route('invoice.download', ['id' => $order->id])}}" id="downloadInvoice" method="POST">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
    </div>
@endsection
