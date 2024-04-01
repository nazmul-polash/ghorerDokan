<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Coupon::all();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('coupon_code', function ($row) {
                    return $row->coupon_code;
                })
                ->addColumn('valid_date', function ($row) {
                    return date('d-M y',strtotime($row->valid_date));
                })
                ->addColumn('type', function ($row) {
                    
                    if($row->type == 1){
                        return '<span class="badge badge-success">Precentage</span>';
                    }else{
                        return '<span class="badge badge-success">Fixed</span>';
                    }
                })
                ->addColumn('coupon_amount', function ($row) {
                    return $row->coupon_amount;
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
                    $update =  '<a class="btn btn-primary btn-sm" style="color:white;" data-toggle="modal" data-target="#updateCouponModal"  onclick="updateBtn('.$row->id.')"> <i class="fa fa-edit"></i></a>';
                    
                    $delete =  '<button data-target="' . route('coupon.delete', $row->id) . '" type="button" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>';
                    return $update . " " . $delete;
                })
                ->rawColumns(['coupon_code', 'valid_date','type','coupon_amount', 'created_by','status', 'action'])
                ->make(true);
        }
        return view('backend.pages.coupon.index');
    }

   

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code'   => 'required|unique:coupons',
            'valid_date'    => 'required',
            'type'          => 'required',
            'coupon_amount' => 'required',
            'is_active'     => 'required',
        ]);
        if ($validator->fails()) {
           
            return response()->json(['error' => true, 'message' => 'Something is wrong', 'type' => 'error']);
        }

        $data = new Coupon();

        $data->coupon_code      = $request->coupon_code;
        $data->valid_date       = $request->valid_date;
        $data->type             = $request->type;
        $data->coupon_amount    = $request->coupon_amount;
        $data->created_by       = Auth::user()->id;
        $data->is_active        = $request->is_active;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Coupon create successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $data = Coupon::where('id',$id)->first();
        return view('backend.pages.coupon.edit',compact('data'));
        // return response()->json(['success'=> true, 'data'=>$data]);
    }

    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
         'coupon_code'   => 'required',
         'valid_date'    => 'required',
         'type'          => 'required',
         'coupon_amount' => 'required',
         'is_active'     => 'required',
     ]);
     if ($validator->fails()) {
        
         return response()->json(['error' => true, 'message' => 'Something is wrong', 'type' => 'error']);
     }

        $data = Coupon::where('id',$request->couponID)->first();

        $data->coupon_code      = $request->coupon_code;
        $data->valid_date       = $request->valid_date;
        $data->type             = $request->type;
        $data->coupon_amount    = $request->coupon_amount;
        $data->is_active        = $request->is_active;
        $data->created_by       = Auth::user()->id;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Coupon update successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $data = Coupon::where('id',$id)->delete();
        return redirect()->back();
    }
}
