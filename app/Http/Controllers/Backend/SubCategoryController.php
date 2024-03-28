<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = SubCategory::all();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('parent_id',function($row){
                return $row->category->category_name;
            })
                
                ->addColumn('created_by',function($row){
                    $name = auth()->user()->name;
                    return $name;
                })
                ->addColumn('action', function($row){
                    $update =  '<a href="'.route('sub_category.edit',$row->id).'" class="btn btn-primary btn-sm" style="color:white;"> <i class="fa fa-edit"></i></a>';
                    $delete =  '<button data-target="'.route('sub_category.delete',$row->id).'" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update." ".$delete;
                })
                ->rawColumns(['parent_id','created_by','action'])
                ->make(true);
            }
        return view('backend.pages.product_category.sub_cat.index');
    }

    public function create(){
        $mainCat = ProductCategory::get();
        return view('backend.pages.product_category.sub_cat.create', compact('mainCat'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'sub_category_name' => 'required|unique:sub_categories',
            'parent_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category                      = new SubCategory();
        $category->sub_category_name   = $request->sub_category_name;
        $category->slug                = Str::slug($request->sub_category_name, '-');
        $category->parent_id           = $request->parent_id;
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true,'message'=> 'Sub Category create successfylly', 'type' => 'success']);
    }

    public function edit($id){
        $mainCat = ProductCategory::get();
        $subCat = SubCategory::where('id',$id)->first();
        return view('backend.pages.product_category.sub_cat.edit', compact('mainCat','subCat'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'sub_category_name' => 'required',
            'parent_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category                      = SubCategory::where('id',$request->subCatID)->first();
        $category->sub_category_name   = $request->sub_category_name;
        $category->slug                = Str::slug($request->sub_category_name, '-');
        $category->parent_id           = $request->parent_id;
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true,'message'=> 'Sub Category update successfylly', 'type' => 'success']);
    }

    public function delete($id){
        $subCat = SubCategory::where('id',$id)->delete();
        return redirect()->back();
    }

}
