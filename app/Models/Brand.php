<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Brand extends Model
{
    use HasFactory;
    protected $with = ['brand_translations'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang ?: (Session::get('locale') ?: env('DEFAULT_LANGUAGE'));
        $brand_translation = $this->brand_translations->where('lang', $lang)->first();
        return $brand_translation ? $brand_translation->$field : $this->$field;
    }

    public function brand_translations(){
        return $this->hasMany(BrandTranslation::class);
    }
}
