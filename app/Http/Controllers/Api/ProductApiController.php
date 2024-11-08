<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function list() {
        $products = Product::paginate(10);
        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }
}
