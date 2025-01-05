<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lang', 'product_id', 'description', 'short_description', 'unit'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
