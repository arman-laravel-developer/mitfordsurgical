@extends('admin.master')
@section('title')
    Order show | {{env('APP_NAME')}}
@endsection

@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Order details</li>
                    </ol>
                </div>
                <h4 class="page-title">Order Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Invoice Logo-->
                    <div class="clearfix">
                        <div class="float-end">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{route('order-payment-status.update')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <label for="">Payment Status</label>
                                        <select name="payment_status" id="payment_status" class="form-control" @if($order->order_status == 'cancel') disabled @endif onchange="this.form.submit()">
                                            <option value="" selected disabled>Select payment status</option>
                                            <option value="pending" {{$order->payment_status == 'pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="paid" {{$order->payment_status == 'paid' ? 'selected' : ''}}>Paid</option>
                                            <option value="un_paid" {{$order->payment_status == 'un_paid' ? 'selected' : ''}}>Un-paid</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{route('order-status.update')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <label for="">Order Status</label>
                                        <select name="order_status" id="order_status" class="form-control" @if($order->order_status == 'cancel') disabled @elseif($order->order_status == 'delivered') disabled @endif onchange="this.form.submit()">
                                            <option value="" selected disabled>Select order status</option>
                                            <option value="pending" {{$order->order_status == 'pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="confirmed" {{$order->order_status == 'confirmed' ? 'selected' : ''}}>Confirmed</option>
                                            <option value="proccessing" {{$order->order_status == 'proccessing' ? 'selected' : ''}}>Proccessing</option>
                                            <option value="shipped" {{$order->order_status == 'shipped' ? 'selected' : ''}}>Shipped</option>
                                            <option value="delivered" {{$order->order_status == 'delivered' ? 'selected' : ''}}>Delivered</option>
                                            <option value="cancel" {{$order->order_status == 'cancel' ? 'selected' : ''}}>Canceled</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Detail-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="float-start mt-3">
                                <p style="margin-bottom: 0.2em"><strong>To:</strong></p>
                                <p style="margin-bottom: 0.2em"><strong>Name: {{$order->name}}</strong></p>
                                <p style="margin-bottom: 0.2em"><strong>Address:</strong> {{$order->address}}</p>
                                {{--                                <p style="margin-bottom: 0.2em"><strong>City:</strong> {{$order->district->name}}</p>--}}
                                <p style="margin-bottom: 0.2em"><strong>Contact Number:</strong> {{$order->mobile}}</p>
                                <p style="margin-bottom: 0.2em"><strong>Email:</strong> {{$order->email}}</p>
                            </div>

                        </div><!-- end col -->
                        <div class="col-sm-4 offset-sm-2">
                            <div class="mt-3 float-sm-end">
                                <p class="font-13" style="margin-bottom: 0.2em"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{$order->created_at->format('d M Y H:i:s')}}</p>
                                <p class="font-13" style="margin-bottom: 0.2em"><strong>Order Status: </strong>
                                    @if($order->order_status == 'pending')
                                        <span class="badge bg-danger float-end">Pending</span>
                                    @elseif($order->order_status == 'confirmed')
                                        <span class="badge bg-success float-end">Confirmed</span>
                                    @elseif($order->order_status == 'delivered')
                                        <span class="badge bg-success float-end">Delivered</span>
                                    @elseif($order->order_status == 'cancel')
                                        <span class="badge bg-danger float-end">Canceled</span>
                                    @elseif($order->order_status == 'shipped')
                                        <span class="badge bg-primary float-end">shipped</span>
                                    @else
                                        <span class="badge bg-warning float-end">Proccessing</span>
                                    @endif
                                </p>
                                <p class="font-13" style="margin-bottom: 0.2em"><strong>Order Code: </strong> <span class="float-end">#{{$order->order_code}}</span></p>
                                <p class="font-13" style="margin-bottom: 0.2em"><strong>Payment Status: </strong>
                                    @if($order->payment_status == 'pending')
                                        <span class="badge bg-danger float-end">Pending</span>
                                    @elseif($order->payment_status == 'paid')
                                        <span class="badge bg-success float-end">Paid</span>
                                    @else
                                        <span class="badge bg-warning float-end">Un-paid</span>
                                    @endif
                                </p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped dt-responsive nowrap w-100 mt-4">
                                    <thead>
                                    <tr>
                                        <th>Img</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Variant</th>
                                        <th>Unit Cost</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $totalWithoutDiscount = 0;
                                        $totalDiscount = 0;
                                    @endphp
                                    @foreach($order->orderDetails as $orderDetail)
                                        @php
                                            $product = \App\Models\Product::find($orderDetail->product_id);
                                            $originalPrice = $product->sell_price;
                                            $discountAmount = 0;

                                            if ($product->discount > 0) {
                                                if ($product->discount_type == 2) {
                                                    $discountAmount = $originalPrice * ($product->discount / 100);
                                                } else {
                                                    $discountAmount = $product->discount;
                                                }
                                            }

                                            $discountedPrice = $originalPrice - $discountAmount;
                                            $amountWithoutDiscount = $originalPrice * $orderDetail->qty;
                                            $amountWithDiscount = $discountedPrice * $orderDetail->qty;

                                            $totalWithoutDiscount += $amountWithoutDiscount;
                                            $totalDiscount += $discountAmount * $orderDetail->qty;
                                        @endphp
                                        <tr>
                                            <td>
                                                <img src="{{ asset($orderDetail->product->thumbnail_img) }}" alt="" style="height: 45px">
                                            </td>
                                            <td>
                                                <b>{{ $orderDetail->product->category->category_name }}</b> <br>
                                                {{ $orderDetail->product->name }} <br>
                                                @if($orderDetail->product->added_by == 'seller')
                                                    @php
                                                    $shop = \App\Models\Shop::where('seller_id',$orderDetail->product->user_id)->first();
                                                    @endphp
                                                Shop Name: {{$shop->shop_name}}
                                                @endif
                                            </td>
                                            <td>{{ $orderDetail->qty }}</td>
                                            <td>
                                                {{ $orderDetail->size_id ? $orderDetail->size->name : '' }}
                                                {{ $orderDetail->size_id && $orderDetail->color_id ? ' / ' : '' }}
                                                {{ $orderDetail->color_id ? $orderDetail->color->name : '' }}
                                            </td>
                                            <td>
                                                @if($discountAmount > 0)
                                                    <del class="text-danger">&#2547; {{ number_format($originalPrice, 2) }}</del><br>
                                                @endif
                                                &#2547; {{ number_format($discountedPrice, 2) }}
                                            </td>
                                            <td class="text-end">
                                                @if($discountAmount > 0)
                                                    <del class="text-danger">&#2547; {{ number_format($amountWithoutDiscount, 2) }}</del><br>
                                                @endif
                                                &#2547; {{ number_format($amountWithDiscount, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-3"></div>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            @php
                                $grandTotal = $totalWithoutDiscount - $totalDiscount + $order->shipping_cost - $order->coupon_discount;
                            @endphp
                            <div class="float-end mt-3 mt-sm-0">
                                <p><b>Sub-total:</b> <span class="float-end">&#2547; {{ number_format($totalWithoutDiscount, 2) }}</span></p>
                                <p><b>Shipping cost:</b>
                                    <span class="float-end">&#2547; {{ $order->shipping_cost > 0 ? number_format($order->shipping_cost, 2) : 'Free' }}</span>
                                </p>
                                <p><b>Discount:</b> <span class="float-end">&#2547; {{ number_format($totalDiscount, 2) }}</span></p>
                                <p><b>Discount:</b> <span class="float-end">&#2547; {{ number_format(round($order->coupon_discount), 2) }}</span></p>
                                <hr>
                                <p><b>Grand Total:</b> <span class="float-end">&#2547; {{ number_format(round($grandTotal), 2) }}</span></p>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class="d-print-none mt-4">
                        <div class="text-end">
                            <a href="{{route('invoice.show', ['id' => $order->id, 'code' => $order->order_code])}}" target="_blank" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print</a>
                            <a href="#" class="btn btn-info" onclick="event.preventDefault(); document.getElementById('invoiceDownload').submit();"><i class="mdi mdi-download"></i> Download</a>
                            <form action="{{route('invoice.download', ['id' => $order->id])}}" method="POST" id="invoiceDownload">
                                @csrf
                            </form>

                        </div>
                    </div>
                    <!-- end buttons -->

                </div> <!-- end card-body-->
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

@endsection
