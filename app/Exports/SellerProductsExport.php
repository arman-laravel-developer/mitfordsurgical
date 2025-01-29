<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;

class SellerProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch products and calculate total stock value
        $sellerId = Session::get('seller_id');
        return Product::where('user_id', $sellerId)->select('name','num_of_sale', 'stock', 'sell_price')
            ->get()
            ->map(function($product) {
                return [
                    'name' => $product->name,
                    'num_of_sale' => $product->num_of_sale,
                    'stock' => $product->stock,
                    'sell_price' => $product->sell_price,
                    'total_stock_value' => $product->stock * $product->sell_price
                ];
            });
    }

    // Add headings to the export file
    public function headings(): array
    {
        return [
            'Product Name',
            'Num Of Sale',
            'Total Stock',
            'Unit Price',
            'Total Stock Value'
        ];
    }
}


