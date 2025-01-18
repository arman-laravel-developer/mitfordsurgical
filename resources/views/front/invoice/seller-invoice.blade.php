<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{route('home')}}-{{$order->order_code}}-Invoice</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family:'Roboto Light', sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
        }
        .invoice-box {
            background-color: #fff;
        }
        .invoice-box table {
            width: 100%;
            line-height: 24px;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 2px;
            vertical-align: top;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 30px;
            line-height: 20px;
            width: 50%;
        }
        .invoice-box table tr.heading td {
            background: #f2f2f2;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: left;
            font-size: 12px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            text-align: left;
            /* Add specific widths */
        }
        .invoice-box table tr.item td:nth-child(1) {
            width: 5%; /* Adjust based on your design */
        }

        .invoice-box table tr.item td:nth-child(2) {
            width: 50%;
        }

        .invoice-box table tr.item td:nth-child(3) {
            width: 15%;
        }

        .invoice-box table tr.item td:nth-child(4) {
            width: 10%;
        }

        .invoice-box table tr.item td:nth-child(5) {
            width: 10%;
        }

        .invoice-box table tr.item td:nth-child(6) {
            width: 10%;
            text-align: right; /* Right align for total column */
        }
        .invoice-box table tr.total td:nth-child(5) {
            font-weight: bold;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
        }
        .logo span {
            color: red;
        }
        .footer {
            position: absolute;
            bottom: 3%;
            text-align: left;
        }
        .policy {
            font-size: 10px;
            color: #555;
            text-align: left;
            margin-top: 20px;
            background: #f2f2f2;
            padding: 10px;
            width: 90%;
        }
        .text-right {
            text-align: right!important;
        }
        .text-left {
            text-align: left!important;
        }
        .text-center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto;
        }

        .signature-table td {
            width: 33.33%; /* Each cell takes up one-third of the table's width */
        }

        .signature p {
            margin-top: 10px; /* Space between the line and text */
            margin-bottom: 0;
            font-size: 10px;
        }

    </style>
</head>
<body>
<div class="invoice-box">
    <div>
        <img src="{{$imageSrc}}" alt="" style="width: 25%;">
    </div>
    <div class="text-center">
        <h2><strong>INVOICE</strong></h2>
    </div>
    <table>
        <tr class="information">
            <td colspan="6">
                <table>
                    <tr>
                        <td>
                            <strong>From:</strong><br>
                            {{route('home')}}<br>
                            Address: {{$generalSettingView->address}}<br>
                            Email: {{$generalSettingView->email}}<br>
                            Mobile: {{$generalSettingView->mobile}}<br>
                        </td>
                        <td class="text-right">
                            <strong>Bill To:</strong><br>
                            {{$order->name}}<br>
                            Address: {{$order->address}}<br>
                            @if($order->email != null)
                            Email: {{$order->email}}<br>
                            @endif
                            Mobile: {{$order->mobile}}<br>
                            Order ID: #{{$order->order_code}}<br>
                            Order Date: {{$order->created_at->format('d-m-Y')}}<br>
                            Payment Method: {{$order->payment_method == 'cod' ? 'Cash On Delivery' : ''}}<br>
                            @if($order->order_note !=null)
                            Note: {{$order->order_note}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>S.N</td>
            <td>Product Name</td>
            <td>Variant</td>
            <td>QTY</td>
            <td>Unit Price</td>
            <td style="text-align: right;">Total</td>
        </tr>
        @php
            $totalPrice = 0;
            $totalQty = 0;
        @endphp
        @foreach($order->orderDetails as $index => $orderDetail)
            @if($orderDetail->product->user_id == Session::get('seller_id'))
        <tr class="item">
            <td>@if($index == 0){{$index + 1}}@else {{$index}} @endif</td>
            <td>
                {{$orderDetail->product->name}}
            </td>
            <td>
                @if($orderDetail->variant_id != null)
                    <span style="font-size: 80%">{{$orderDetail->variant->variant}}</span>
                @else
                    <span style="font-size: 80%">N/A</span>
                @endif
            </td>
            <td>{{$orderDetail->qty}}</td>
            <td>&#2547; {{number_format($orderDetail->price,0)}}</td>
            <td>&#2547; {{number_format($orderDetail->price * $orderDetail->qty,2)}}</td>
        </tr>
                @php
                    // Calculate the total price and quantity for matched products
                    $totalPrice += $orderDetail->price * $orderDetail->qty;
                    $totalQty += $orderDetail->qty;
                @endphp
            @endif
        @endforeach
    </table>
    <div style="padding:0;">
        <table class="text-right sm-padding small strong">
            <thead>
            <tr>
                <th width="60%"></th>
                <th width="40%"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-left">
{{--                    @if($order->payment_status == 'paid')--}}
{{--                        <div class="total-in-words" style="margin-top: 0 !important;">--}}
{{--                            <img src="{{$paidImageSrc}}" alt="" style="height: 100px">--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="total-in-words" style="margin-top: 0 !important;">--}}
{{--                            <img src="{{$unpaidImageSrc}}" alt="" style="height: 100px">--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </td>
                <td>
                    <table class="text-left sm-padding small strong">
                        <tbody>
                        <tr>
                            <td class="gry-color text-left">Sub Total</td>
                            <td class="text-right">&#2547; {{number_format($totalPrice,2)}}</td>
                        </tr>
                        <tr>
                            <td class="gry-color text-left">Shipping Cost</td>

                            <td class="text-right">
                                <span>&#2547; 0.00</span>
                            </td>

                        </tr>
                        <tr class="border-bottom">
                            <td class="gry-color text-left">Coupon Discount</td>
                            <td class="text-right">&#2547; 0.00</td>
                        </tr>
                        <tr>
                            <th class="text-left strong">Grand Total</th>
                            <td class="text-right">&#2547; <strong>{{number_format($totalPrice, 2)}}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<p class="bold">In Words: {{ convert_number($totalPrice) }} Taka Only.</p>
<div class="footer">
    <table class="signature-table" style="width: 100%; margin-right: 10%; text-align: center;">
        <tr>
            <td>
                <div class="signature-line"></div>
                <p>Prepared by</p>
            </td>
            <td>
                <div class="signature-line"></div>
                <p>Verified by</p>
            </td>
            <td>
                <div class="signature-line"></div>
                <p>Authorised Signatory</p>
            </td>
        </tr>
    </table>
    <p class="policy">
        <strong>Return Policy:</strong> Dispure delivered project will be entertained to return within 72 hours from the date of delivery.<br>
        <strong>Declaration:</strong> We declare that this invoice shows the actual price of the goods described and the all particulars are true and currect.<br>
        <strong>Note:</strong> Above Mentioned products would be entertained to return within 10 days from the date of delivery.
    </p>
</div>
</body>
</html>
