<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();

        //dd($product_categories);
        return view('frontend.index',compact('product_categories'));
    }

    public function product($slug)
    {
        $product = Product::with('media','category','tags','reviews')->withAvg('reviews','rating')->whereSlug($slug)->active()->hasQuantity()->ActiveCategory()->firstOrFail();

        $relatedProducts = Product::with('firstMedia')->whereHas('category', function ($query) use($product) {
            $query->whereId($product->product_category_id);
            $query->whereStatus(true);
        })->inRandomOrder()->active()->hasQuantity()->take(4)->get();

        return view('frontend.product',compact('product','relatedProducts'));
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }


    public function shop()
    {
        return view('frontend.shop');
    }
}
