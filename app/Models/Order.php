<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'city_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
