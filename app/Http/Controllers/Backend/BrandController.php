<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Brand::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('brand_logo', function ($row) {
                    $logo = '<img src="'.asset('uploads/brand/'.$row->brand_logo).'" width="30">';
                    return $logo;
                })
                ->addColumn('brand_name', function ($row) {
                    return $row->brand_name;
                })
                ->addColumn('created_by', function ($row) {
                    $name = auth()->user()->name;
                    return $name;
                })
                ->addColumn('status', function ($row) {
                    if($row->is_active == 1){
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $update =  '<a class="btn btn-primary btn-sm" style="color:white;" data-toggle="modal" data-target="#updateBrandModal"  onclick="updateBtn('.$row->id.')"> <i class="fa fa-edit"></i></a>';
                    
                    $delete =  '<button data-target="' . route('brand.delete', $row->id) . '" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update . " " . $delete;
                })
                ->rawColumns(['brand_logo', 'brand_name', 'created_by','status', 'action'])
                ->make(true);
        }
        return view('backend.pages.brand.index');
    }

   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name'    => 'required|unique:brands',
            'is_active'     => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('brand_logo')){
            $file       = $request->file('brand_logo');
            $extenstion = $file->getClientOriginalExtension();
            $filename   = time().'.'.$extenstion;
            $file->move('uploads/brand/', $filename);
        }else{
            return response()->json(['error' => true, 'message' => 'Brand create failed', 'type' => 'error']);
        }

        $brand              = new Brand();
        $brand->brand_name  = $request->brand_name;
        $brand->brand_logo  = $filename;
        $brand->slug        = Str::slug($request->brand_name, '-');
        $brand->created_by  = Auth::user()->id;
        $brand->is_active   = $request->is_active;
        $brand->save();

        return response()->json(['success' => true, 'message' => 'Brand create successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $brand = Brand::where('id',$id)->first();
        $html = view('backend.pages.brand.edit', compact('brand'))->render();
        return response()->json(['success'=> true, 'html'=>$html]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name'    => 'required',
            'is_active'     => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $brand = Brand::where('id',$request->brandID)->first();

        if ($request->has('brand_logo')) {
            if(file_exists('uploads/brand/'.$brand->brand_logo)){
                unlink('uploads/brand/'.$brand->brand_logo);
            }

            $file       = $request->file('brand_logo');
            $extenstion = $file->getClientOriginalExtension();
            $filename   = time().'.'.$extenstion;
            $file->move('uploads/brand/', $filename);
        }

        
        $brand->brand_name  = $request->brand_name;
        $brand->brand_logo  = $filename ?? $brand->brand_logo;
        $brand->slug        = Str::slug($request->brand_name, '-');
        $brand->update_by   = Auth::user()->id;
        $brand->is_active   = $request->is_active;
        $brand->save();

        return response()->json(['success' => true, 'message' => 'Brand update successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $brand = Brand::where('id',$id)->first();
        if(file_exists('uploads/brand/'.$brand->brand_logo)){
            unlink('uploads/brand/'.$brand->brand_logo);
        }
        $brand->delete();
        return redirect()->back();
    }
}
