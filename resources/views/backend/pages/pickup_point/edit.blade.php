<form action="javascript:updatePickupPoint();" method="POST" enctype="multipart/form-data" id="pickupPointUpdateForm">
   @csrf
   <input type="hidden" name="pickupPointID" value="{{ $data->id }}">
   <div class="row mg-t-40 validation_message">
      <div class="col-xl-12 mg-t-20 mg-xl-t-0">
         <div class="row">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Pickup Point Name:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="text" name="pickup_point_name" class="form-control"
                  value="{{ $data->pickup_point_name }}">
               @error('pickup_point_name')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Pickup Point Address:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="text" name="pickup_point_address" class="form-control"
                  value="{{ $data->pickup_point_address }}">
               @error('pickup_point_address')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Pickup Point Phone :</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="text" name="pickup_point_phone" class="form-control"
                  value="{{ $data->pickup_point_phone }}">
               @error('pickup_point_phone')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label">Another Phone
               :</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="text" name="pickup_point_phone_2" class="form-control"
                  value="{{ $data->pickup_point_phone_2 }}">
               @error('pickup_point_phone_2')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Status:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <select name="is_active" id="" class="form-control">
                  <option value="" selected disabled>select</option>
                  <option value="1" @if ($data->is_active == 1) selected @endif>Active</option>
                  <option value="0" @if ($data->is_active == 0) selected @endif>In-active</option>
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
