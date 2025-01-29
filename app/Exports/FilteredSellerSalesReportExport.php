<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Str;
use Session;

class FilteredSellerSalesReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $order_status;
    protected $start_date;
    protected $end_date;

    // Accept filters through the constructor
    public function __construct($order_status, $start_date, $end_date)
    {
        $this->order_status = $order_status;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $sellerId = Session::get('seller_id');
        // Fetch order and calculate the total
        $query = Order::whereHas('orderDetails.product', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        });

        if ($this->order_status) {
            $query->where('order_status', $this->order_status);
        }

        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->startOfDay();
            $end_date = Carbon::parse($this->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $orders = $query->get()->map(function ($order) {
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
