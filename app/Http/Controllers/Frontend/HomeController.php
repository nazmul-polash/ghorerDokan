<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('is_active', 1)->get();

        $products = [
            'bestsellers' => Product::where('is_bestseller', 1)->get(),
            'new_arrivals' => Product::where('is_new_arrival', 1)->get(),
            'top_rated' => Product::where('is_top_rated', 1)->get(),
        ];



        return view('frontend.pages.home', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
