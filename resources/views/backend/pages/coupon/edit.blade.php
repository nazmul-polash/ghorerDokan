<form action="javascript:updateCoupon();" method="POST" enctype="multipart/form-data" id="couponUpdateForm">
   @csrf
   <input type="hidden" name="couponID" id="coupon_id" value="{{ $data->id }}">
   <div class="row mg-t-40 validation_message">
      <div class="col-xl-12 mg-t-20 mg-xl-t-0">
         <div class="row">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Coupon
               Code:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="text" name="coupon_code" class="form-control" id="couponCode"
                  value="{{ $data->coupon_code }}">
               @error('coupon_code')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Valid Date:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="date" name="valid_date" class="form-control" value="{{ $data->valid_date }}">
               @error('valid_date')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Coupon Type
               :</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <select name="type" id="couponType" class="form-control">
                  <option value="" selected disabled>Select</option>
                  <option value="0" @if($data->type == 0) selected @endif>Fixed</option>
                  <option value="1" @if($data->type == 1) selected @endif>Percentage</option>
               </select>
               @error('type')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>


         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Coupon
               Amount:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="number" name="coupon_amount" class="form-control" value="{{ $data->coupon_amount }}">
               @error('coupon_amount')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Status:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <select name="is_active" id="status" class="form-control">
                  <option value="" selected disabled>select</option>
                  <option value="1" @if($data->is_active == 1) selected @endif>Active</option>
                  <option value="0" @if($data->is_active == 0) selected @endif>In-active</option>
               </select>
               @error('is_active')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="mg-t-20">
            <div style=float:inline-end>
               <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                  Submit</button>
               <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                  data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</form>
