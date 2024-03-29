<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ChildCategoryController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = ChildCategory::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('parent_id', function ($row) {
                    return $row->category->category_name;
                })
                ->addColumn('sub_category_name', function ($row) {
                    return $row->subCategory->sub_category_name;
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
                ->rawColumns(['parent_id', 'sub_category_name', 'created_by', 'action'])
                ->make(true);
        }
        return view('backend.pages.product_category.child_cat.index');
    }

    public function create()
    {
        $mainCat = ProductCategory::get();
        return view('backend.pages.product_category.child_cat.create', compact('mainCat'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'child_category_name' => 'required|unique:child_categories',
            'sub_category_id' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'is_active' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subCat = SubCategory::where('id', $request->sub_category_id)->first();
        $parentID = ProductCategory::where('id', $subCat->parent_id)->first();

        $category                      = new ChildCategory();
        $category->child_category_name = $request->child_category_name;
        $category->slug                = Str::slug($request->child_category_name, '-');
        $category->parent_id           = $parentID->id;
        $category->sub_category_id     = $request->sub_category_id;
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true, 'message' => 'Child Category create successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $mainCat = ProductCategory::get();
        $childCat = ChildCategory::where('id',$id)->first();
        return view('backend.pages.product_category.child_cat.edit', compact('mainCat','childCat'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'child_category_name'   => 'required',
            'sub_category_id'       => 'required',
            'meta_title'            => 'required',
            'meta_description'      => 'required',
            'meta_keyword'          => 'required',
            'is_active'             => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subCat = SubCategory::where('id', $request->sub_category_id)->first();
        $parentID = ProductCategory::where('id', $subCat->parent_id)->first();

        $category                      = ChildCategory::where('id',$request->childCatID)->first();
        $category->child_category_name = $request->child_category_name;
        $category->slug                = Str::slug($request->child_category_name, '-');
        $category->parent_id           = $parentID->id;
        $category->sub_category_id     = $request->sub_category_id;
        $category->meta_title          = $request->meta_title;
        $category->meta_description    = $request->meta_description;
        $category->meta_keyword        = $request->meta_keyword;
        $category->is_active           = $request->is_active;
        $category->created_by          = Auth::user()->id;
        $category->save();

        return response()->json(['success' => true, 'message' => 'Child Category update successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $subCat = ChildCategory::where('id', $id)->delete();
        return redirect()->back();
    }
}
