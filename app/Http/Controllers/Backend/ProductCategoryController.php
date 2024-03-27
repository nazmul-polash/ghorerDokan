<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class ProductCategoryController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = ProductCategory::orderBy('id', 'desc')->get();
            return DataTables::of($data)->addIndexColumn()
              
                ->addColumn('created_by',function($row){
                    $name = auth()->user()->name;
                    return $name;
                })
                ->addColumn('action', function($row){
                    $update =  '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#updateCatModal" onclick="updateBtn('.$row->id.')"> <i class="fa fa-edit"></i></button>';
                    $delete =  '<button data-target="'.route('category.delete',$row->id).'" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update." ".$delete;
                })
                ->rawColumns(['created_by','action'])
                ->make(true);
            }
            return view('backend.pages.product_category.index');
    }

    public function test(Request $request){
        if ($request->ajax()) {
            $data = ProductCategory::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return $row->category_name;
                })
                ->addColumn('parent_id', function($row){
                    if($row->parant_id == 0){
                        $sub = '<span class="alert alert-primary">sub-Category</span>';
                    }else{
                        $sub = '<span class="alert alert-primary">Main Category</span>';
                    }
                    return $sub;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['name','parent_id','action'])
                ->make(true);
        }
        return view('backend.pages.product_category.test');
    }
    // public function create(){
    //     // $category = ProductCategory::where('parent_id', 0)->get();
    //     return view('backend.pages.product_category.create');
    // }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'category_name' => 'required|unique:product_categories',
            'parent_id' => 'sometimes',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'is_active' => 'required',
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $category                      = new ProductCategory();
        $category->category_name       = $request->category_name;
        $category->slug                = Str::slug($request->category_name, '-');
        // $category->parent_id           = $request->parent_id ?? 0;
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true,'message'=> 'Category create successfylly', 'type' => 'success']);
    }

    public function edit($id){
        $cat = ProductCategory::where('id', $id)->first();
        return response()->json(['success' => true, 'cat'=> $cat]);
    }

    public function update(Request $request){
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
        $category = ProductCategory::where('id',$request->cat_id)->first();
        $category->category_name       = $request->category_name;
        $category->slug                = Str::slug($request->category_name, '-');
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true,'message'=> 'Category update successfylly', 'type' => 'success']);
    }
    
    public function delete($id){
        $cat = ProductCategory::where('id', $id)->delete();
        return redirect()->back();
        
    }
   
}
