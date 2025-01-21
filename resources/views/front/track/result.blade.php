@extends('front.master')

@section('title')
{{$generalSettingView->site_name}} - Track My Order
@endsection

@section('body')
    <div class="content-col">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain" style="padding: 1%;">
                            <h2>Order Tracking</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('home')}}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Order Tracking</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Search Bar Section Start -->
        <section class="search-section">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-8 mx-auto">
                        <div class="title d-block text-center">
                            <h2>Order Tracking</h2>
                            <span class="title-leaf">
                        </span>
                        </div>

                        <div class="search-box">
                            <form id="orderForm" action="{{route('show.track-result')}}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="order_code" value="{{$order_code}}" id="order-id" placeholder="">
                                    <button class="btn theme-bg-color text-white m-0" type="submit"
                                            id="button-addon1">Tracking</button>
                                </div>

                                <small id="error-message" style="color: red; display: none;">Order Code must be exactly 17 digits.</small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Search Bar Section End -->

        <!-- Order Detail Section Start -->
        <section class="order-detail">
            <div class="container">
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if($order)
                            <div class="row g-sm-4 g-3">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="order-details-contain">
                                        <div class="order-tracking-icon">
                                            <i data-feather="package" class="text-content"></i>
                                        </div>

                                        <div class="order-details-name">
                                            <h5 class="text-content">{{translate('Tracking Code')}}</h5>
                                            <h2 class="theme-color">{{$order_code}}</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-6">
                                    <div class="order-details-contain">
                                        <div class="order-tracking-icon">
                                            <i class="text-content" data-feather="calendar"></i>
                                        </div>

                                        @php
                                            // Assuming $order and $orderDetail are already retrieved Eloquent models
                                        $orderCreatedAt = $order->created_at; // Eloquent date attribute, typically a Carbon instance


                                        // Calculate the estimated delivery date
                                        $estimatedDeliveryDate = \Carbon\Carbon::parse($orderCreatedAt)->addDays(3);

                                        // Format the date to the desired format (e.g., 'Y-m-d')
                                        $formattedDeliveryDate = $estimatedDeliveryDate->format('M d, Y');
                                        @endphp
                                        <div class="order-details-name">
                                            <h5 class="text-content">{{translate('Estimated Delivery Time')}}</h5>
                                            <h4>{{$formattedDeliveryDate}}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-6">
                                    <div class="order-details-contain">
                                        <div class="order-tracking-icon">
                                            <i class="text-content" data-feather="crosshair"></i>
                                        </div>

                                        <div class="order-details-name">
                                            <h5 class="text-content">{{translate('From')}}</h5>
                                            <h4>{{$generalSettingView->address}}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-6">
                                    <div class="order-details-contain">
                                        <div class="order-tracking-icon">
                                            <i class="text-content" data-feather="map-pin"></i>
                                        </div>

                                        <div class="order-details-name">
                                            <h5 class="text-content">Destination</h5>
                                            <h4>{{$order->address}}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 overflow-hidden">
                                    <ol class="progtrckr">
                                        <li class="@if(in_array($order->order_status, ['pending', 'confirmed', 'proccessing', 'shipped', 'delivered'])) progtrckr-done @else progtrckr-todo @endif">
                                            <h5>{{translate('Pending')}}</h5>
                                        </li>
                                        <li class="@if(in_array($order->order_status, ['confirmed', 'proccessing', 'shipped', 'delivered'])) progtrckr-done @else progtrckr-todo @endif">
                                            <h5>{{translate('Confirmed')}}</h5>
                                        </li>
                                        <li class="@if(in_array($order->order_status, ['proccessing', 'shipped', 'delivered'])) progtrckr-done @else progtrckr-todo @endif">
                                            <h5>{{translate('Processing')}}</h5>
                                        </li>
                                        <li class="@if(in_array($order->order_status, ['shipped', 'delivered'])) progtrckr-done @else progtrckr-todo @endif">
                                            <h5>{{translate('Shipped')}}</h5>
                                        </li>
                                        <li class="@if($order->order_status == 'delivered') progtrckr-done @else progtrckr-todo @endif">
                                            <h5>{{translate('Delivered')}}</h5>
                                        </li>
                                        <li class="@if($order->order_status == 'cancel') progtrckr-done @else progtrckr-todo @endif">
                                            <h5>{{translate('Canceled')}}</h5>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        @else
                            <div class="card mt-3">
                                <div class="card-body">
                                    <p class="text-center text-danger" style="font-size: 2em;">{{translate('Order Not Found')}}!</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($order)
                    <div class="row g-sm-4 g-3 mt-3">
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
                                                                    @php
                                                                        $shop = \App\Models\Shop::where('seller_id',$orderDetail->product->user_id)->first();
                                                                    @endphp
                                                                    <li class="text-content">{{translate('Sold By')}}: {{$shop->shop_name}}</li>
                                                                @endif
                                                                @if($orderDetail->product->is_variant == 1)
                                                                    <li class="text-content">Variant - {{$orderDetail->variant->variant}}</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="price">
                                                    <h4 class="table-title text-content">Price</h4>
                                                    <h6 class="theme-color">&#2547; {{number_format($orderDetail->price)}}</h6>
                                                </td>

                                                <td class="quantity">
                                                    <h4 class="table-title text-content">Qty</h4>
                                                    <h4 class="text-title">{{$orderDetail->qty}}</h4>
                                                </td>

                                                <td class="subtotal">
                                                    <h4 class="table-title text-content">Total</h4>
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
                                            <h3>Price Details</h3>
                                            <h5 class="ms-auto theme-color">({{$order->total_qty}} Items)</h5>
                                        </div>

                                        <ul class="summery-contain">
                                            <li>
                                                <h4>SubTotal</h4>
                                                <h4 class="price">&#2547;{{number_format($order->grand_total,2)}}</h4>
                                            </li>

                                            <li>
                                                <h4>Shipping Cost</h4>
                                                <h4 class="price text-primary">+&#2547;{{number_format($order->shipping_cost,2)}}</h4>
                                            </li>
                                            <li>
                                                <h4>{{translate('Coupon Discount')}}</h4>
                                                <h4 class="price text-danger">-&#2547;{{number_format(round($order->coupon_discount),2)}}</h4>
                                            </li>
                                            <li>
                                                <h4>{{translate('Vat/Tax')}}</h4>
                                                <h4 class="price" id="vat">&#2547;0</h4>
                                            </li>
                                        </ul>

                                        <ul class="summery-total">
                                            <li class="list-total">
                                                <h4 class="theme-color">Total (BDT)</h4>
                                                <h4 class="price theme-color">&#2547;{{number_format(round($order->grand_total+$order->shipping_cost-$order->coupon_discount),2)}}</h4>
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
                @endif
            </div>
        </section>
        <!-- Order Detail Section End -->
    </div>

    <script>
        const orderInput = document.getElementById('order-id');
        const form = document.getElementById('orderForm');
        const errorMessage = document.getElementById('error-message');

        orderInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters

            // Ensure the value doesn't exceed 17 numeric characters
            if (value.length > 17) {
                value = value.slice(0, 17);
            }

            // Insert hyphens after 6 and 12 numeric characters
            if (value.length > 6) {
                value = value.replace(/(\d{6})(\d{1,6})/, '$1-$2');
            }
            if (value.length > 12) {
                value = value.replace(/(\d{6})-(\d{6})(\d{1,5})/, '$1-$2-$3');
            }

            e.target.value = value;
        });

        // Form submission validation
        form.addEventListener('submit', function(e) {
            const inputVal = orderInput.value.replace(/\D/g, ''); // Get numeric value only

            // Check if numeric value is exactly 17 digits
            if (inputVal.length !== 17) {
                e.preventDefault(); // Prevent form submission
                errorMessage.style.display = 'block'; // Show error message
            } else {
                errorMessage.style.display = 'none'; // Hide error message if valid
            }
        });
    </script>

@endsection
