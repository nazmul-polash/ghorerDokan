<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\PickupPoint;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('backend.pages.product.index');
    }

    public function create(){
        $category       = ProductCategory::orderBy('id','desc')->get();
        $brands         = Brand::orderBy('id', 'desc')->get();
        $pickupPoints   = PickupPoint::orderBy('id', 'desc')->get();
        $wareHouses     = WareHouse::orderBy('id','desc')->get();
        return view('backend.pages.product.create',compact('category','brands','pickupPoints','wareHouses'));
    }

    public function getSubCategory(Request $request){
        $subCat = SubCategory::where('parent_id',$request->id)->get();
        return view('backend.pages.product.ajax.sub_cat',compact('subCat'));
    }
    public function getChildCategory(Request $request){
        $childCat = ChildCategory::where('sub_category_id',$request->id)->get();
        return view('backend.pages.product.ajax.child_cat',compact('childCat'));
    }

    public function store(Request $request){

        dd($request->all());
    }


}
