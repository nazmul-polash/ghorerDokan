<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = ProductCategory::where('parent_id', '!=', 0 )->get();
            return DataTables::of($data)->addIndexColumn()
                
                ->addColumn('created_by',function($row){
                    $name = auth()->user()->name;
                    return $name;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['created_by','action'])
                ->make(true);
            }
        return view('backend.pages.product_category.sub_cat.index');
    }

    public function create(){
        $sub_cat = ProductCategory::where('parent_id', 0)->get();
        return view('backend.pages.product_category.sub_cat.create', compact('sub_cat'));
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
            'parent_id' => 'sometimes',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category                      = new ProductCategory();
        $category->category_name       = $request->category_name;
        $category->slug                = Str::slug($request->category_name, '-');
        $category->parent_id           = $request->parent_id ?? 0;
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true,'message'=> 'Category create successfylly', 'type' => 'success']);
    }


}
