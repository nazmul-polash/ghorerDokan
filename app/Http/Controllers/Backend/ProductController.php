<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\PickupPoint;
use App\Models\ProductCategory;
use App\Models\ProductMultipleImage;
use App\Models\SubCategory;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return DataTables::of($data)->addIndexColumn()
                

                ->addColumn('thumbnail', function ($row) {
                    $image = asset('uploads/product/'.$row->thumbnail);
                    $img = "<img src=\"$image\" alt=\"\" style=\"width:30px;height:30px;\">";
                    return $img;
                })
                ->addColumn('category', function ($row) {
                    return $row->category->category_name;
                })
                ->addColumn('code', function ($row) {
                    return $row->product_code;
                })
                ->addColumn('product_model', function ($row) {
                    return $row->product_model;
                })
                ->addColumn('stock_quantity', function ($row) {
                    return $row->stock_quantity;
                })
                ->addColumn('price', function ($row) {
                    return $row->selling_price;
                })
                ->addColumn('is_active', function ($row) {
                    if($row->is_active == 1){
                        return "<span class=\"badge badge-primary\">Active</span>";
                    }else{
                        return "<span class=\"badge badge-danger\">Inactive</span>";
                    }
                })
                ->addColumn('created_by', function ($row) {
                    $name = auth()->user()->name;
                    return $name;
                })
                ->addColumn('action', function ($row) {
                    $update =  '<a href="' . route('child_category.edit', $row->id) . '" class="btn btn-primary btn-sm" style="color:white;"> <i class="fa fa-edit"></i></a>';
                    
                    $delete =  '<button data-target="' . route('child_category.delete', $row->id) . '" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update . " " . $delete;
                })
                ->rawColumns(['thumbnail','category','code','product_model','stock_quantity','price','is_active','','created_by', 'action'])
                ->make(true);
        }
        return view('backend.pages.product.index');
    }

    public function create()
    {
        $category       = ProductCategory::orderBy('id', 'desc')->get();
        $brands         = Brand::orderBy('id', 'desc')->get();
        $pickupPoints   = PickupPoint::orderBy('id', 'desc')->get();
        $wareHouses     = WareHouse::orderBy('id', 'desc')->get();
        return view('backend.pages.product.create', compact('category', 'brands', 'pickupPoints', 'wareHouses'));
    }

    public function getSubCategory(Request $request)
    {
        $subCat = SubCategory::where('parent_id', $request->id)->get();
        return view('backend.pages.product.ajax.sub_cat', compact('subCat'));
    }
    public function getChildCategory(Request $request)
    {
        $childCat = ChildCategory::where('sub_category_id', $request->id)->get();
        return view('backend.pages.product.ajax.child_cat', compact('childCat'));
    }

    public function store(Request $request)
    {
      
        DB::beginTransaction();
        try {
            if ($request->hasFile('thumbnail')) {
                $file       = $request->file('thumbnail');
                $extenstion = $file->getClientOriginalExtension();
                $filename   = Str::random(8).time() . '.' . $extenstion;
                $file->move('uploads/product/', $filename);
            }

            $product = new Product();
            $product->category_id        = $request->category_id;
            $product->sub_category_id    = $request->sub_category_id ?? null;
            $product->child_category_id  = $request->child_category_id ?? null;
            $product->brand_id           = $request->brand_id;
            $product->product_name       = $request->product_name;
            $product->slug               = Str::slug($request->product_name, '-');;
            $product->product_code       = $request->product_code;
            $product->product_model      = $request->product_model;
            $product->product_unit       = $request->product_unit;
            $product->pickup_point_id    = $request->pickup_point_id;
            $product->product_video      = $request->product_video;
            $product->stock_quantity     = $request->stock_quantity;
            $product->purchase_price     = $request->purchase_price;
            $product->selling_price      = $request->selling_price;
            $product->discount_price     = $request->discount_price;
            $product->product_tags       = $request->product_tags;
            $product->product_color      = $request->product_color;
            $product->product_size       = $request->product_size;
            $product->description        = $request->description;

            $product->thumbnail          = $filename ?? null;

            $product->feature            = $request->feature;
            $product->today_deal         = $request->today_deal;
            $product->is_active          = $request->status;
            $product->created_by          = Auth::user()->id;

            $product->save();

            if ($files = $request->file('images')) {
                
                foreach ($files as $multiFile) {
                    $image = $multiFile->getClientOriginalExtension();
                    $imageName = Str::random(8).time() . '-' . $image;
                    $multiFile->move('uploads/product/multiple_image', $imageName);
                   
                    $multipleImage = new ProductMultipleImage();
                    $multipleImage->product_id  = $product->id;
                    $multipleImage->images      = $imageName;
                    $multipleImage->save();
                }
            }
            DB::commit();
            return back()->with(['success' => true, 'message' => 'Product create successfully', 'type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            // Log::error('Transaction failed: ' . $th->getMessage());
            return back()->with(['error' => true, 'message' => 'Product create failed', 'type' => 'error']);
        }
    }
}
