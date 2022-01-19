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

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function product()
    {
        return view('frontend.product');
    }

    public function shop()
    {
        return view('frontend.shop');
    }
}
