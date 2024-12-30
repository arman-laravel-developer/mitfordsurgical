<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use Session;

class Category extends Model
{
    use HasFactory;
    protected $with = ['category_translations'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang ?: (Session::get('locale') ?: env('DEFAULT_LANGUAGE'));
        $category_translation = $this->category_translations->where('lang', $lang)->first();
        return $category_translation ? $category_translation->$field : $this->$field;
    }

    public function category_translations(){
        return $this->hasMany(CategoryTranslation::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function descendants()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('descendants');
    }

    public function descandants()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('descandants');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
