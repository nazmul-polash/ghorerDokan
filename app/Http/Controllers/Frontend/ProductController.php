<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function quick_shop(Request $request)
    {
        $product = Product::where([
            'id' => $request->id,
            'is_active' => 1,
        ])->first();

        $html = view('frontend.pages.product.render.quick_shop',compact('product'))->render();
        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }

    public function product_details($id){
        return view('frontend.pages.product.details');
    }
}
