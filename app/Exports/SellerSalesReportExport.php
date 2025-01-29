<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;

class SellerSalesReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $sellerId = Session::get('seller_id');
        // Fetch order and calculate the total
        $orders = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->select('order_code', 'total_qty','shipping_cost','coupon_discount','payment_method', 'grand_total', 'created_at', 'order_status', 'payment_status')
            ->get()
            ->map(function ($order) {
                return [
                    'order_code' => $order->order_code,
                    'num_of_qty' => $order->total_qty,
                    'order_total' => $order->grand_total+$order->shipping_cost-$order->coupon_discount,
                    'order_date' => $order->created_at->format('d/m/Y'),
                    'order_status' => Str::ucfirst($order->order_status),
                    'payment_method' => $order->payment_method == 'cod' ? 'Cash on delivery' : Str::ucfirst($order->payment_method),
                    'payment_status' => Str::ucfirst($order->payment_status)
                ];
            });

        // Calculate the total order amount
        $totalOrderAmount = $orders->sum('order_total');

        // Append the total as the last row
        $orders->push([
            'order_code' => 'Total',
            'num_of_qty' => '',
            'order_total' => $totalOrderAmount,
            'order_date' => '',
            'order_status' => '',
            'payment_method' => '',
            'payment_status' => ''
        ]);

        return $orders;
    }

    // Add headings to the export file
    public function headings(): array
    {
        return [
            'Order Code',
            'Num of Qty',
            'Order Total',
            'Order Date',
            'Order Status',
            'Payment Method',
            'Payment Status'
        ];
    }
}
