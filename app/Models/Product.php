<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Product extends Model
{
    use HasFactory;
    protected $with = ['product_translations'];


    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang ?: (Session::get('locale') ?: env('DEFAULT_LANGUAGE'));
        $product_translation = $this->product_translations->where('lang', $lang)->first();
        return $product_translation ? $product_translation->$field : $this->$field;
    }

    public function product_translations(){
        return $this->hasMany(ProductTranslation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function otherImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function firstGalleryImage()
    {
        return $this->hasOne(ProductImage::class)->whereNotNull('gellery_image')->orderBy('id');
    }
}
