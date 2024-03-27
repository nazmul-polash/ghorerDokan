<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('backend.pages.product.index');
    }

    public function create(){
        return view('backend.pages.product.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|min:3|string',
            'product_model' => 'required',
            'quantity' => 'required|numeric',
            'product_price' => 'required|numeric',
            'percentage_value' => 'sometimes',
            'product_image' =>  'required|image|mimes:jpeg,jpg|max:2048',
            'product_description' => 'required|string',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        


        dd($request->all());
    }
}
