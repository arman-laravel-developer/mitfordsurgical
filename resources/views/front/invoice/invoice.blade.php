<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family:'Arial', sans-serif;
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
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #f2f2f2;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: center;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            text-align: center;
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
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
            text-align: center;
        }
        .note, .policy {
            font-size: 13px;
            color: #555;
            text-align: left;
            margin-top: 20px;
            margin-left: 37px;
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
        .signature-section {
            margin-top: 80px;
        }
        .signature {
            width: 30%;
            display: inline-block;
            text-align: center;
            margin-left: 2%;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table>
        <tr class="top">
            <td colspan="5">
                <table>
                    <tr>
                        <td class="logo">
                            <img src="{{$imageSrc}}" alt="" style="width: 25%;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="text-center">
            <td colspan="5"><h2><strong>INVOICE</strong></h2></td>
        </tr>
        <tr class="information">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            <strong>Bill To:</strong><br>
                            {{formatBanglish($order->name)}}<br>
                            Address: {{formatBanglish($order->address)}}<br>
                            Email: {{$order->email ? $order->email : 'N/A'}}<br>
                            Mobile: {{$order->mobile}}
                        </td>
                        <td class="text-right">
                            <strong>From:</strong><br>
                            {{route('home')}}<br>
                            Address: {{$generalSettingView->address}}<br>
                            Email: {{$generalSettingView->email}}<br>
                            Mobile: {{$generalSettingView->mobile}}<br>
                            Order ID: #{{$order->order_code}}<br>
                            Order Date: {{$order->created_at->format('d-m-Y')}}<br>
                            Payment Method: {{$order->payment_method == 'cod' ? 'Cash On Delivery' : ''}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>S.N</td>
            <td>Product Name</td>
            <td>QTY</td>
            <td>Unit Price</td>
            <td>Total</td>
        </tr>
        @foreach($order->orderDetails as $orderDetail)
        <tr class="item">
            <td>{{$loop->iteration}}</td>
            <td>
                {{$orderDetail->product->name}}<br>
                @if($orderDetail->variant_id != null)
                    <span style="font-size: 80%">{{$orderDetail->variant->variant}}</span>
                @endif
            </td>
            <td>{{$orderDetail->qty}}</td>
            <td>Tk. {{$orderDetail->price}}</td>
            <td>Tk. {{$orderDetail->price * $orderDetail->qty}}</td>
        </tr>
        @endforeach
    </table>
    <div style="padding:0 1rem;">
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
                @php
                    $totalFinal = $order->grand_total + $order->shipping_cost;
                @endphp
                <td>
                    <table class="text-right sm-padding small strong">
                        <tbody>
                        <tr>
                            <td class="gry-color text-left">Sub Total</td>
                            <td class="text-right">Tk. {{number_format($order->grand_total,2)}}</td>
                        </tr>
                        <tr>
                            <td class="gry-color text-left">Shipping Cost</td>

                            <td class="text-right">
                                <span>Tk. {{number_format($order->shipping_cost,2)}}</span>
                            </td>

                        </tr>
                        <tr class="border-bottom">
                            <td class="gry-color text-left">Coupon Discount</td>
                            <td class="text-right">Tk. 0.00</td>
                        </tr>
                        <tr>
                            <th class="text-left strong">Grand Total</th>
                            <th class="text-right">Tk. {{number_format($totalFinal, 2)}}</th>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <p class="bold">In Words: {{ convert_number($totalFinal) }} Taka Only.</p>
    <footer>
        <div class="signature-section">
            <div class="signature">
                <div class="signature-line"></div>
                <p>Prepared by</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>Verified by</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p>Authorised Signatory</p>
            </div>
        </div>
        <p class="policy">
            <strong>Return Policy:</strong> Dispure delivered project will be entertained to return within 72 hours from the date of delivery.<br>
            <strong>Declaration:</strong> We declare that this invoice shows the actual price of the goods described and the all particulars are true and currect.<br>
            <strong>Note:</strong> Above Mentioned products would be entertained to return within 10 days from the date of delivery..
        </p>
    </footer>
</div>
</body>
</html>
