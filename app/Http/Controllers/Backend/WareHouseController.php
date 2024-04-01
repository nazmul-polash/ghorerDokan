<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WareHouseController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = WareHouse::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('warehouse_name', function ($row) {
                    return $row->warehouse_name;
                })
                ->addColumn('warehouse_phone', function ($row) {
                    return $row->warehouse_phone;
                })
                ->addColumn('warehouse_address', function ($row) {
                    return $row->warehouse_address;
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
                    $update =  '<a class="btn btn-primary btn-sm" style="color:white;" data-toggle="modal" data-target="#updateWareHouseModal"  onclick="updateBtn('.$row->id.')"> <i class="fa fa-edit"></i></a>';
                    
                    $delete =  '<button data-target="' . route('warehouse.delete', $row->id) . '" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update . " " . $delete;
                })
                ->rawColumns(['warehouse_name', 'warehouse_phone','warehouse_address', 'created_by','status', 'action'])
                ->make(true);
        }
        return view('backend.pages.warehouse.index');
    }

   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse_name'    => 'required|unique:ware_houses',
            'warehouse_address' => 'required',
            'warehouse_phone'   => 'required|unique:ware_houses',
            'is_active'         => 'required',
        ]);
        if ($validator->fails()) {
           
            return response()->json(['error' => true, 'message' => 'Something is wrong', 'type' => 'error']);
        }

        $warehouse = new WareHouse();

        $warehouse->warehouse_name      = $request->warehouse_name;
        $warehouse->warehouse_address   = $request->warehouse_address;
        $warehouse->warehouse_phone     = $request->warehouse_phone;
        $warehouse->created_by          = Auth::user()->id;
        $warehouse->is_active           = $request->is_active;
        $warehouse->save();

        return response()->json(['success' => true, 'message' => 'Ware House create successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $warehouse = WareHouse::where('id',$id)->first();
        return response()->json(['success'=> true, 'warehouse'=>$warehouse]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse_name'    => 'required',
            'warehouse_address' => 'required',
            'warehouse_phone'   => 'required',
            'is_active'         => 'required',
        ]);
        if ($validator->fails()) {
           
            return response()->json(['error' => true, 'message' => 'Your update failed', 'type' => 'error']);
        }

        $warehouse = WareHouse::where('id',$request->warehouseID)->first();

        $warehouse->warehouse_name      = $request->warehouse_name;
        $warehouse->warehouse_address   = $request->warehouse_address;
        $warehouse->warehouse_phone     = $request->warehouse_phone;
        $warehouse->created_by          = Auth::user()->id;
        $warehouse->is_active           = $request->is_active;
        $warehouse->save();

        return response()->json(['success' => true, 'message' => 'Ware House update successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $warehouse = WareHouse::where('id',$id)->delete();
        return redirect()->back();
    }
}
