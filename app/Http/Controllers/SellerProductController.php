<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTranslation;
use App\Models\Size;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Session;

class SellerProductController extends Controller
{
    public function index()
    {
        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        $categories_dropdown = "<option selected disabled> Select Category </option>";
        foreach ($categories as $cat)
        {
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->category_name." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat)
            {
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;---".$sub_cat->category_name." </option>";
            }
        }
        $brands = Brand::latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        return view('front.seller.product.index', compact('categories', 'categories_dropdown', 'brands', 'colors', 'sizes'));
    }

    public function getImageUrl($request)
    {
        $image = $request->file('thumbnail_img');
        $imageName = time() . '-' . 'product-image' . '.' . $image->getClientOriginalExtension();
        $directory = 'product-images/';
        // Ensure directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }
        $imagePath = $directory . $imageName;

        // Resize image without changing dimensions and reduce file size
        $img = Image::make($image->getRealPath());
        $img->resize(1080, 1080);

        // Save the resized image
        $img->save($imagePath);

        return $imagePath;
    }
    public function getPdfUrl($request)
    {
        $image = $request->file('pdf');
        $imageName = time() . '-' . 'product-pdf' . '.' . $image->getClientOriginalExtension();
        $directory = 'product-pdfs/';
        $image->move($directory,$imageName);
        $imagePath = $directory.$imageName;
        return $imagePath;
    }

    public function getMetaImageUrl($request)
    {
        $image = $request->file('meta_image');
        $imageName = time() . '-' . 'meta-image' . '.' . $image->getClientOriginalExtension();
        $directory = 'meta-images/';
        // Ensure directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }
        $imagePath = $directory . $imageName;

        // Resize image without changing dimensions and reduce file size
        $img = Image::make($image->getRealPath());
        $img->resize(1080, 1080);

        // Save the resized image
        $img->save($imagePath);

        return $imagePath;
    }

    public function getOtherImage($otherImage)
    {
        $uniqueId = uniqid();
        $otherImageName = $uniqueId . '-' . 'product-other-images' . '.' . $otherImage->getClientOriginalExtension();
        $directory = 'product-other-images/';
        // Ensure directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }
        $imagePath = $directory . $otherImageName;

        // Resize image without changing dimensions and reduce file size
        $img = Image::make($otherImage->getRealPath());
        $img->resize(1080, 1080);

        // Save the resized image
        $img->save($imagePath);

        return $imagePath;
    }

    public function getVariantImage($variantImage)
    {
        $uniqueId = uniqid();
        $variantImageName = $uniqueId . '-' . 'product-variant-images' . '.' . $variantImage->getClientOriginalExtension();
        $directory = 'product-variant-images/';
        // Ensure directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }
        $imagePath = $directory . $variantImageName;

        // Resize image without changing dimensions and reduce file size
        $img = Image::make($variantImage->getRealPath());
        $img->resize(1080, 1080);

        // Save the resized image
        $img->save($imagePath);

        return $imagePath;
    }

    public function create(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->added_by = 'seller';
        $product->user_id = Session::get('seller_id');
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->unit = $request->unit;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->stock = $request->stock;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->minimum_purchase_qty = $request->minimum_purchase_qty;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        // Separate the start and end dates
        $dates = explode(' - ', $request->discount_date_range);
        // Assign the dates to variables
        $start_date = $dates[0];
        $end_date = $dates[1];
        $start_date_format = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
        $end_date_format = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
        $product->start_date = $start_date_format;
        $product->end_date = $end_date_format;
        $product->num_of_sale = 0;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->tags = $request->tags;
        if ($request->is_variant == 'yes')
        {
            $product->is_variant = 1;
        }
        else
        {
            $product->is_variant = 2;
        }
        if ($request->is_featured == 1)
        {
            $product->is_featured = $request->is_featured;
        }
        else
        {
            $product->is_featured = 2;
        }
        if ($request->cash_on_delivery == 1)
        {
            $product->cash_on_delivery = $request->cash_on_delivery;
        }
        else
        {
            $product->cash_on_delivery = 2;
        }
        if ($request->is_short_description == 1)
        {
            $product->is_short_description = 1;
        }
        else
        {
            $product->is_short_description = 2;
        }
        if ($request->file('thumbnail_img'))
        {
            $product->thumbnail_img = $this->getImageUrl($request);
        }
        if ($request->file('pdf'))
        {
            $product->pdf = $this->getPdfUrl($request);
        }
        if ($request->file('meta_image'))
        {
            $product->meta_image = $this->getMetaImageUrl($request);
        }
        $product->status = 2;
        $product->save();

        if ($request->file('galleryImages'))
        {
            foreach ($request->file('galleryImages') as $otherImage)
            {
                $detail = new ProductImage();
                $detail->product_id = $product->id;
                $detail->gellery_image = $this->getOtherImage($otherImage);
                $detail->save();
            }
        }

        if ($request->is_variant == 'yes')
        {
            $colors = $request->input('color_id') ?: [null]; // Handle the case where no colors are selected
            $sizes = $request->input('size_id') ?: [null];  // Handle the case where no sizes are selected
            // Process the variant combinations
            foreach ($colors as $colorId) {
                foreach ($sizes as $sizeId) {
                    // Construct the variant name key
                    if ($colorId == null)
                    {
                        $variantNameKey = 'variant_name_' . $sizeId;
                        $variantPriceKey = 'variant_price_' . $sizeId;
                        $variantQtyKey = 'variant_qty_' . $sizeId;
                        $variantImageKey = 'variant_image_' .$sizeId;
                    }
                    elseif ($sizeId == null)
                    {
                        $variantNameKey = 'variant_name_' . $colorId;
                        $variantPriceKey = 'variant_price_' . $colorId;
                        $variantQtyKey = 'variant_qty_' . $colorId;
                        $variantImageKey = 'variant_image_' . $colorId;
                    }
                    else
                    {
                        $variantNameKey = 'variant_name_' . $colorId . ($sizeId ? '_' . $sizeId : '');
                        $variantPriceKey = 'variant_price_' . $colorId . ($sizeId ? '_' . $sizeId : '');
                        $variantQtyKey = 'variant_qty_' . $colorId . ($sizeId ? '_' . $sizeId : '');
                        $variantImageKey = 'variant_image_' . $colorId . ($sizeId ? '_' . $sizeId : '');
                    }

                    // Create the variant
                    $variant = new Variant();
                    $variant->product_id = $product->id;
                    $variant->color_id = $colorId;
                    $variant->size_id = $sizeId;
                    $variant->variant = $request->input($variantNameKey);
                    $variant->price = $request->input($variantPriceKey);
                    $variant->qty = $request->input($variantQtyKey);
                    if ($request->file($variantImageKey))
                    {
                        $variant->image = $this->getVariantImage($request->file($variantImageKey));
                    }

                    $variant->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Product Add Successfull');
    }

    public function manage()
    {
        $products = Product::where('user_id', Session::get('seller_id'))->latest()->paginate(10);
        return view('front.seller.product.manage', compact('products'));
    }

    public function edit(Request $request, $id)
    {
        $lang = $request->lang;
        $product = Product::with('variants')->find($id);

        $categories = Category::where(['parent_id' => 0])->where('status', 1)->get();
        $categories_dropdown = "<option selected disabled>Select Category</option>";
        foreach ($categories as $category)
        {
            if ($category->id == $product->category_id)
            {
                $selected = "selected";
            }
            else
            {
                $selected = "";
            }
            $categories_dropdown .="<option value='".$category->id."' ".$selected.">".$category->category_name."</option>";
            $sub_categories = Category::where(['parent_id' => $category->id])->get();
            foreach ($sub_categories as $sub_category)
            {
                if ($sub_category->id == $product->category_id)
                {
                    $selected = "selected";
                }
                else
                {
                    $selected = "";
                }
                $categories_dropdown .="<option value='".$sub_category->id."' ".$selected.">&nbsp;&nbsp;---".$sub_category->category_name."</option>";
            }
        }
        $brands = Brand::latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        $selectedColorIds = $product->variants->pluck('color_id')->toArray();
        $selectedSizeIds = $product->variants->pluck('size_id')->toArray();
        $product = Product::find($id);
        return view('front.seller.product.edit', compact('product', 'lang' ,'categories_dropdown', 'brands', 'colors', 'sizes', 'selectedColorIds', 'selectedSizeIds'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->lang == 'en')
        {
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->unit = $request->unit;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->stock = $request->stock;
            $product->cost_price = $request->cost_price;
            $product->sell_price = $request->sell_price;
            $product->minimum_purchase_qty = $request->minimum_purchase_qty;
            $product->discount = $request->discount;
            $product->discount_type = $request->discount_type;
            // Separate the start and end dates
            $dates = explode(' - ', $request->discount_date_range);
            // Assign the dates to variables
            $start_date = $dates[0];
            $end_date = $dates[1];
            $start_date_format = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
            $end_date_format = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
            $product->start_date = $start_date_format;
            $product->end_date = $end_date_format;
            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->tags = $request->tags;
            if ($request->is_variant == 'yes')
            {
                $product->is_variant = 1;
            }
            else
            {
                $product->is_variant = 2;
            }
            if ($request->is_featured == 1)
            {
                $product->is_featured = $request->is_featured;
            }
            else
            {
                $product->is_featured = 2;
            }
            if ($request->cash_on_delivery == 1)
            {
                $product->cash_on_delivery = $request->cash_on_delivery;
            }
            else
            {
                $product->cash_on_delivery = 2;
            }
            if ($request->is_short_description == 1)
            {
                $product->is_short_description = 1;
            }
            else
            {
                $product->is_short_description = 2;
            }
            if ($request->file('thumbnail_img'))
            {
                if (file_exists($product->thumbnail_img))
                {
                    unlink($product->thumbnail_img);
                }
                $thumbnailImgUrl = $this->getImageUrl($request);
            }
            else
            {
                $thumbnailImgUrl = $product->thumbnail_img;
            }
            $product->thumbnail_img = $thumbnailImgUrl;

            if ($request->file('pdf'))
            {
                if (file_exists($product->pdf))
                {
                    unlink($product->pdf);
                }
                $pdfUrl = $this->getPdfUrl($request);
            }
            else
            {
                $pdfUrl = $product->pdf;
            }
            $product->pdf = $pdfUrl;

            if ($request->file('meta_image'))
            {
                if (file_exists($product->meta_image))
                {
                    unlink($product->meta_image);
                }
                $metaImageUrl = $this->getMetaImageUrl($request);
            }
            else
            {
                $metaImageUrl = $product->meta_image;
            }
            $product->meta_image = $metaImageUrl;
            $product->save();

            if ($request->file('galleryImages'))
            {
                $otherImages = ProductImage::where('product_id', $product->id)->get();
                foreach ($otherImages as $otherImage)
                {
                    if (file_exists($otherImage->gallery_image))
                    {
                        unlink($otherImage->gallery_image);
                    }
                    $otherImage->delete();
                }
                foreach ($request->file('galleryImages') as $otherImage)
                {
                    $detail = new ProductImage();
                    $detail->product_id = $product->id;
                    $detail->gellery_image = $this->getOtherImage($otherImage);
                    $detail->save();
                }
            }

            // Fetch existing variants and index them by color_id and size_id
            $existingVariants = $product->variants()->get()->keyBy(function($item) {
                return ($item->color_id ?? 'null') . '_' . ($item->size_id ?? 'null');
            });

            // Prepare new variants for insertion
            $newVariants = [];

            // Handle color_id and size_id inputs
            $colorIds = $request->input('color_id', [null]);
            $sizeIds = $request->input('size_id', [null]);

            // Flatten the size_ids in case of multiple sizes
            if (!is_array($sizeIds)) {
                $sizeIds = [$sizeIds];
            }

            foreach ($colorIds as $colorId) {
                foreach ($sizeIds as $sizeId) {

                    $variantKey = $colorId . '_' . $sizeId;
                    if ($colorId == null)
                    {
                        $variantName = $request->input("variant_name_{$sizeId}");
                        $variantPrice = $request->input("variant_price_{$sizeId}");
                        $variantQty = $request->input("variant_qty_{$sizeId}");
                        $variantImage = $request->file("variant_image_{$sizeId}");
                        $variantImageEx = $request->hasFile("variant_image_{$sizeId}");
                    }
                    elseif ($sizeId == null)
                    {
                        $variantName = $request->input("variant_name_{$colorId}");
                        $variantPrice = $request->input("variant_price_{$colorId}");
                        $variantQty = $request->input("variant_qty_{$colorId}");
                        $variantImage = $request->file("variant_image_{$colorId}");
                        $variantImageEx = $request->hasFile("variant_image_{$colorId}");
                    }
                    else
                    {
                        $variantName = $request->input("variant_name_{$colorId}_{$sizeId}");
                        $variantPrice = $request->input("variant_price_{$colorId}_{$sizeId}");
                        $variantQty = $request->input("variant_qty_{$colorId}_{$sizeId}");
                        $variantImage = $request->file("variant_image_{$colorId}_{$sizeId}");
                        $variantImageEx = $request->hasFile("variant_image_{$colorId}_{$sizeId}");
                    }

                    // Check if the variant already exists
                    if (isset($existingVariants[$variantKey])) {
                        // Update existing variant
                        $variant = $existingVariants[$variantKey];
                        $variant->variant = $variantName;
                        $variant->price = $variantPrice;
                        $variant->qty = $variantQty;

                        // Handle image upload if a new image is provided
                        if ($variantImageEx) {
                            // Delete the old image file if it exists
                            if (file_exists($variant->image)) {
                                unlink($variant->image);
                            }
                            // Save new image
                            $variant->image = $this->getVariantImage($variantImage);
                        }

                        $variant->save();
                        // Remove from existing variants to avoid deletion
                        unset($existingVariants[$variantKey]);
                    } else {
                        // Create new variant
                        $newVariants[] = [
                            'product_id' => $product->id,
                            'color_id' => $colorId !== 'null' ? $colorId : null,
                            'size_id' => $sizeId !== 'null' ? $sizeId : null,
                            'variant' => $variantName,
                            'price' => $variantPrice,
                            'qty' => $variantQty,
                            'image' => $variantImageEx
                                ? $this->getVariantImage($variantImage)
                                : null,
                        ];
                    }
                }
            }

            // Insert new variants
            if (!empty($newVariants)) {
                Variant::insert($newVariants);
            }

            // Delete any variants that were not included in the request
            foreach ($existingVariants as $variant) {
                // Delete the old image file if it exists
                if (file_exists($variant->image)) {
                    unlink($variant->image);
                }
                $variant->delete();
            }


            if ($request->is_variant == 'no')
            {
                $existingVariantsDelete = $product->variants()->get();
                foreach ($existingVariantsDelete as $item)
                {
                    if (file_exists($item->image))
                    {
                        unlink($item->image);
                    }
                    $item->delete();
                }
            }

            $product_translation = ProductTranslation::firstOrNew(['lang' => $request->lang, 'product_id' => $product->id]);
            $product_translation->name = $request->name;
            $product_translation->unit = $request->unit;
            $product_translation->description = $request->description;
            $product_translation->short_description = $request->short_description;
            $product_translation->save();
        }
        else
        {
            $product_translation = ProductTranslation::firstOrNew(['lang' => $request->lang, 'product_id' => $product->id]);
            $product_translation->name = $request->name;
            $product_translation->unit = $request->unit;
            $product_translation->description = $request->description;
            $product_translation->short_description = $request->short_description;
            $product_translation->save();
        }

        return redirect()->back()->with('success', 'Product update successfull');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->meta_image)
        {
            if (file_exists($product->meta_image))
            {
                unlink($product->meta_image);
            }
        }
        if ($product->thumbnail_img)
        {
            if (file_exists($product->thumbnail_img))
            {
                unlink($product->thumbnail_img);
            }
        }
        if ($product->variants)
        {
            foreach ($product->variants as $variant)
            {
                if (file_exists($variant->image))
                {
                    unlink($variant->image);
                }
                $variant->delete();
            }
        }
        if ($product->otherImages)
        {
            foreach ($product->otherImages as $otherImage)
            {
                if (file_exists($otherImage->gellery_image))
                {
                    unlink($otherImage->gellery_image);
                }

                $otherImage->delete();
            }
        }
        $product->delete();

        return redirect()->back()->with('success', 'Product delete successfull');
    }
}
