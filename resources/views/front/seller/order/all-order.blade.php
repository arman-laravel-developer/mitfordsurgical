@extends('front.seller.master.master')

@section('seller.title')
    Seller All Orders | {{$generalSettingView->site_name}}
@endsection

@section('seller.body')
    <div class="dashboard-order mt-3">
        <div class="title">
            <h2>All Orders</h2>
            <span class="title-leaf title-leaf-gray"></span>
        </div>

        <div class="order-tab dashboard-bg-box">
            <div class="table-responsive">
                <table class="table order-table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">Order ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Status</th>
                        <th scope="col">Order Total</th>
                        <th scope="col">Download</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="text-center">
                            <td class="product-image">
                                {{$order->order_code}}
                                <button class="copy-btn" onclick="copyToClipboard('{{$order->order_code}}')">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </td>
                            <td>
                                @php
                                    $totalPrice = 0;
                                    $totalQty = 0;
                                @endphp
                                @foreach($order->orderDetails as $orderDetail)
                                    @if($orderDetail->product->user_id == Session::get('seller_id'))
                                        <h6>{{ $orderDetail->product->name }}</h6>
                                        @php
                                            // Calculate the total price and quantity for matched products
                                            $totalPrice += $orderDetail->price * $orderDetail->qty;
                                            $totalQty += $orderDetail->qty;
                                        @endphp
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <h6>{{ $totalQty }}</h6>
                            </td>
                            <td>
                                @if($order->order_status == 'pending')
                                    <label class="danger">Pending</label>
                                @elseif($order->order_status == 'confirmed')
                                    <label class="success">Confirmed</label>
                                @elseif($order->order_status == 'proccessing')
                                    <label class="success">Processing</label>
                                @elseif($order->order_status == 'shipped')
                                    <label class="success">Shipped</label>
                                @elseif($order->order_status == 'delivered')
                                    <label class="success">Delivered</label>
                                @else
                                    <label class="danger">Canceled</label>
                                @endif
                            </td>
                            <td>
                                <h6>&#2547; {{ $totalPrice }}</h6>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="text-success" onclick="event.preventDefault();document.getElementById('downloadInvoice').submit();"><i class="fa fa-download"></i></a>
                                <form action="{{route('seller.invoice-download', ['id' => $order->id])}}" id="downloadInvoice" method="POST">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links('vendor.pagination.seller-pagination') }}
        </div>
    </div>
@endsection
