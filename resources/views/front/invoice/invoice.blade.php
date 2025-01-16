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
        .note, .policy {
            font-size: 13px;
            color: #555;
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
            margin-top: 50px;
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
                            Md. Habibul Islam<br>
                            Address: Dhanmondi, Dhaka<br>
                            Email: sagar@apcombd.com<br>
                            Mobile: 01709925764
                        </td>
                        <td class="text-right">
                            <strong>From:</strong><br>
                            www.mitfordsurgical.com<br>
                            Address: Dhanmondi, Dhaka<br>
                            Email: sagar@apcombd.com<br>
                            Mobile: 01709925764<br>
                            Order ID: #12546025<br>
                            Order Date: 16-01-2025<br>
                            Payment Method: sslcommerz <br>
                            Delivery Type: Cash On Delivery
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
        <tr class="item">
            <td>01</td>
            <td>Vasofix</td>
            <td>10.50</td>
            <td>&#2547; 55</td>
            <td>&#2547; 577.50</td>
        </tr>
        <tr class="item">
            <td>02</td>
            <td>Vasofix</td>
            <td>10.50</td>
            <td>&#2547; 55</td>
            <td>&#2547; 577.50</td>
        </tr>
        <tr class="item">
            <td>03</td>
            <td>Vasofix</td>
            <td>10.50</td>
            <td>&#2547; 55</td>
            <td>&#2547; 577.50</td>
        </tr>
        <tr class="item">
            <td>04</td>
            <td>Vasofix</td>
            <td>10.50</td>
            <td>&#2547; 55</td>
            <td>&#2547; 577.50</td>
        </tr>
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
                    @if($order->payment_status == 'paid')
                        <div class="total-in-words" style="margin-top: 0 !important;">
                            <img src="{{$paidImageSrc}}" alt="" style="height: 100px">
                        </div>
                    @else
                        <div class="total-in-words" style="margin-top: 0 !important;">
                            <img src="{{$unpaidImageSrc}}" alt="" style="height: 100px">
                        </div>
                    @endif
                </td>
                <td>
                    <table class="text-right sm-padding small strong">
                        <tbody>
                        <tr>
                            <td class="gry-color text-left">Sub Total</td>
                            <td class="text-right">৳ 577.50</td>
                        </tr>
                        <tr>
                            <td class="gry-color text-left">Shipping Cost</td>

                            <td class="text-right">
                                <span>&#2547;0.00</span>
                            </td>

                        </tr>
                        <tr class="border-bottom">
                            <td class="gry-color text-left">Coupon Discount</td>
                            <td class="text-right">&#2547;0.00</td>
                        </tr>
                        <tr>
                            <th class="text-left strong">Grand Total</th>
                            <th class="text-right">&#2547; 577.50</th>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <p class="bold">In Words: Two thousand three hundred ten taka only.</p>
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
</div>
</body>
</html>
