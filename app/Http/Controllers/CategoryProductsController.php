<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{
    public function index($id)
    {
        $category = Category::find($id);
        return view('front.pages.category-products', compact('category'));
    }
}
