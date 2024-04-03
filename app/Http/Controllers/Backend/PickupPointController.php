<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PickupPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PickupPointController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PickupPoint::orderBy('id','desc')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('pickup_point_name', function ($row) {
                    return $row->pickup_point_name;
                })
                ->addColumn('pickup_point_address', function ($row) {
                    return $row->pickup_point_address;
                })
                ->addColumn('pickup_point_phone', function ($row) {
                    return $row->pickup_point_phone;
                })
                ->addColumn('pickup_point_phone_2', function ($row) {
                    return $row->pickup_point_phone_2;
                })
                
                ->addColumn('status', function ($row) {
                    if($row->is_active == 1){
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $update =  '<a class="btn btn-primary btn-sm" style="color:white;" data-toggle="modal" data-target="#updatePickupPointModal"  onclick="updateBtn('.$row->id.')"> <i class="fa fa-edit"></i></a>';
                    
                    $delete =  '<button data-target="' . route('pickup_point.delete', $row->id) . '" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update . " " . $delete;
                })
                ->rawColumns(['pickup_point_name', 'pickup_point_address','pickup_point_phone','pickup_point_phone_2', 'status', 'action'])
                ->make(true);
        }
        return view('backend.pages.pickup_point.index');
    }

   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickup_point_name'     => 'required',
            'pickup_point_address'  => 'required',
            'pickup_point_phone'    => 'required',
            'is_active'             => 'required',
        ]);
        if ($validator->fails()) {
           
            return response()->json(['error' => true, 'message' => 'Something is wrong', 'type' => 'error']);
        }

        $data = new PickupPoint();

        $data->pickup_point_name    = $request->pickup_point_name;
        $data->pickup_point_address = $request->pickup_point_address;
        $data->pickup_point_phone   = $request->pickup_point_phone;
        $data->pickup_point_phone_2 = $request->pickup_point_phone_2;
        $data->is_active            = $request->is_active;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Pickup Point create successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $data = PickupPoint::where('id',$id)->first();
        return view('backend.pages.pickup_point.edit',compact('data'));
    }

    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
         'pickup_point_name'    => 'required',
         'pickup_point_address' => 'required',
         'pickup_point_phone'   => 'required',
         'is_active'            => 'required',
     ]);
     if ($validator->fails()) {
        
         return response()->json(['error' => true, 'message' => 'Something is wrong', 'type' => 'error']);
     }

        $data = PickupPoint::where('id',$request->pickupPointID)->first();

        $data->pickup_point_name    = $request->pickup_point_name;
        $data->pickup_point_address = $request->pickup_point_address;
        $data->pickup_point_phone   = $request->pickup_point_phone;
        $data->pickup_point_phone_2 = $request->pickup_point_phone_2;
        $data->is_active            = $request->is_active;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Pickup Point update successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $data = PickupPoint::where('id',$id)->delete();
        return redirect()->back();
    }
}
