<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .filters {
            margin-bottom: 20px;
        }
        .filters p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h1>Sales Report</h1>

<!-- Display filters if available -->
<div class="filters">
    <p><strong>Filters:</strong></p>
    @if ($filters['order_status'])
        <p>Order Status: {{ ucfirst($filters['order_status']) }}</p>
    @endif
    @if ($filters['payment_method'])
        <p>Payment Method: {{$filters['payment_method'] == 'cod' ? 'Cash on delivery' : ucfirst($filters['payment_method']) }}</p>
    @endif
    @if ($filters['payment_status'])
        <p>Payment Status: {{ ucfirst($filters['payment_status']) }}</p>
    @endif
    @if ($filters['start_date'] && $filters['end_date'])
        <p>Date Range: {{ $filters['start_date'] }} to {{ $filters['end_date'] }}</p>
    @endif
</div>

<table>
    <thead>
    <tr>
        <th>Order Code</th>
        <th>Qty</th>
        <th>Order Total</th>
        <th>Order Date</th>
        <th>Order Status</th>
        <th>Payment Method</th>
        <th>Payment Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orders as $order)
        <tr class="{{ $order['order_code'] === 'Total' ? 'total-row' : '' }}">
            <td>{{ $order['order_code'] }}</td>
            <td>{{ $order['num_of_qty'] }}</td>
            <td>&#2547; {{ number_format($order['order_total'], 2) }}</td>
            <td>{{ $order['order_date'] }}</td>
            <td>{{ $order['order_status'] }}</td>
            <td>{{ $order['payment_method'] }}</td>
            <td>{{ $order['payment_status'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
