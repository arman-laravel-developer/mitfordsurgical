<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{
    public function index($id)
    {
        $category = Category::with('descendants')->find($id);
        $categoryIds = $category->descendants->pluck('id')->toArray();
        $categoryIds[] = $id;
        $category_products = Product::whereIn('category_id', $categoryIds)->where('status', 1)->paginate(20);
        return view('front.pages.category-products', compact('category', 'category_products'));
    }
}
