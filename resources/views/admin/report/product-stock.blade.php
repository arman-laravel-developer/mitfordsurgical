<!DOCTYPE html>
<html>
<head>
    <title>Product Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
<h1 style="text-align: center;">Product Report</h1>
<table>
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Num of Sale</th>
        <th>Total Stock</th>
        <th>Unit Price</th>
        <th>Total Stock Value</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['num_of_sale'] }}</td>
            <td>{{ $product['stock'] }}</td>
            <td class="text-right">&#2547; {{ number_format($product['sell_price'], 2) }}</td>
            <td class="text-right">&#2547; {{ number_format($product['total_stock_value'], 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
