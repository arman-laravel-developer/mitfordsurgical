<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.index', compact('categories'));
    }

    public function getImageUrl($request)
    {
        $slug = Str::slug($request->category_name);
        $image = $request->file('image');
        $imageName = $slug.'-'.time().'.'.$image->getClientOriginalExtension();
        $directory = 'category-images/';
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }
        $imagePath = $directory . $imageName;

        // Resize image without changing dimensions and reduce file size
        $img = Image::make($image->getRealPath());
        $img->resize(97, 86);

        // Save the resized image
        $img->save($imagePath);
        return $imagePath;
    }

    public function create(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'parent_id' => 'required',
            'description' => 'required'
        ]);
        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->description = $request->description;
        if ($request->file('image'))
        {
            $category->image = $this->getImageUrl($request);
        }
        if ($request->status == 1)
        {
            $category->status = $request->status;
        }
        else
        {
            $category->status = 2;
        }
        if ($request->display_status == 1)
        {
            $category->display_status = $request->display_status;
        }
        else
        {
            $category->display_status = 2;
        }
        if ($request->featured == 1)
        {
            $category->featured = $request->featured;
        }
        else
        {
            $category->featured = 2;
        }
        $category->save();
        return redirect()->back()->with('success', 'Category Added Successfully');
    }

    public function manage()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('admin.category.manage', compact('categories'));
    }

    public function edit(Request $request,$id)
    {
        $lang = $request->lang;
        $category = Category::find($id);
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.edit', compact('category', 'categories', 'lang'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($request->lang == 'en')
        {
            $category->parent_id = $request->parent_id;
            $category->category_name = $request->category_name;
            $category->slug = Str::slug($request->category_name);
            $category->description = $request->description;
            if ($request->file('image'))
            {
                if (file_exists($category->image))
                {
                    unlink($category->image);
                }

                $imageUrl = $this->getImageUrl($request);
            }
            else
            {
                $imageUrl = $category->image;
            }
            $category->image = $imageUrl;
            if ($request->display_status == 1)
            {
                $category->display_status = $request->display_status;
            }
            else
            {
                $category->display_status = 2;
            }
            if ($request->status == 1)
            {
                $category->status = $request->status;
            }
            else
            {
                $category->status = 2;
            }
            if ($request->featured == 1)
            {
                $category->featured = $request->featured;
            }
            else
            {
                $category->featured = 2;
            }
            $category->save();
            $category_translation = CategoryTranslation::firstOrNew(['lang' => $request->lang, 'category_id' => $category->id]);
            $category_translation->category_name = $request->category_name;
            $category_translation->save();
        }
        else
        {
            $category_translation = CategoryTranslation::firstOrNew(['lang' => $request->lang, 'category_id' => $category->id]);
            $category_translation->category_name = $request->category_name;
            $category_translation->save();
        }
        return redirect()->route('category.manage')->with('success', 'Category update successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $subCategories = Category::where('parent_id', $category->id)->get();
//        dd($category->news);
        foreach ($subCategories as $item)
        {
            if (file_exists($item->image))
            {
                unlink($item->image);
            }
            $item->delete();
        }
        if (file_exists($category->image))
        {
            unlink($category->image);
        }
        $category->delete();
        Alert::success('Category delete Successfully', '');
        return redirect()->back();
    }
}
