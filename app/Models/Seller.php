<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'seller_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
