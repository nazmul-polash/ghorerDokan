@extends('backend.layouts.template')

@section('title')
   Coupon
@endsection
@section('style')
   <style>
      label.error {
         color: red;
         font-style: italic;
         font-weight: 800;
      }
   </style>
@endsection
@section('content')
   <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
         <h4>Coupon</h4>
         <p class="mg-b-0">All Coupon </p>
      </div>
      <div style="position: absolute; right:2%">
         <a href="" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal"
            data-target="#couponCreate">Create Coupon <i class="fa fa-plus"></i></a>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered table-striped yajra-datatable">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Coupon Code</th>
                     <th>Valid Date</th>
                     <th>Type</th>
                     <th>Amount</th>
                     <th>Created By</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <!-- Ware House create modal -->
   <div id="couponCreate" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Create Coupon</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:createCoupon();" method="POST" enctype="multipart/form-data" id="couponForm">
                  @csrf
                  <div class="row mg-t-40 validation_message">
                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Coupon Code:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="coupon_code" class="form-control" placeholder="Enter Code">
                              @error('coupon_code')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Valid Date:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="date" name="valid_date" class="form-control" placeholder="Enter Date">
                              @error('valid_date')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Coupon Type :</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <select name="type" id="" class="form-control">
                                 <option value="" selected disabled>Select</option>
                                 <option value="0">Fixed</option>
                                 <option value="1">Percentage</option>
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
                              <input type="number" name="coupon_amount" class="form-control" placeholder="Enter Amount">
                              @error('coupon_amount')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Status:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <select name="is_active" id="" class="form-control">
                                 <option value="" selected disabled>select</option>
                                 <option value="1">Active</option>
                                 <option value="0">In-active</option>
                              </select>
                              @error('is_active')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="mg-t-20">
                           <div style=float:inline-end>
                              <button type="submit"
                                 class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                                 Submit</button>
                              <button type="button"
                                 class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                                 data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!--Coupon update modal -->
   <div id="updateCouponModal" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Coupon</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" id="bodyContentForm">
               

            </div>
         </div>
      </div>
   </div>
@endsection

@push('script')
   <script src="{{ asset('backend/app/jquery-validation/js/jquery.validate.min.js') }}"></script>
   <!-- dataTable -->
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('coupon.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'coupon_code',
                  name: 'coupon_code'
               },
               {
                  data: 'valid_date',
                  name: 'valid_date'
               },
               {
                  data: 'type',
                  name: 'type'
               },
               {
                  data: 'coupon_amount',
                  name: 'coupon_amount'
               },
               {
                  data: 'created_by',
                  name: 'created_by'
               },
               {
                  data: 'status',
                  name: 'status'
               },
               {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
               },
            ]
         });
      });
   </script>
   <!--jquery validator -->
   <script>
      $("#couponForm").validate({
         rules: {
            coupon_code: 'required',
            valid_date: 'required',
            type: 'required',
            coupon_amount: 'required',
            is_active: 'required',
         },
         messages: {
            coupon_code: 'Please enter your code',
            valid_date: 'Plesas enter valid date',
            type: 'Select your type',
            coupon_amount: 'Enter your amount',
            is_active: 'Please select active or inactive',
         },
      });
   </script>

   <!-- coupon Create -->
   <script>
      function createCoupon() {
         var form = $('#couponForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('coupon.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $('#couponCreate').modal('toggle');
                  toastr.success(response.message);
                  $(form)[0].reset();
               } else {
                  $('#couponCreate').modal('toggle');
                  toastr.error(response.message);
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $(form)[0].reset();
               }

            },

         });
      }
   </script>
   <!-- coupon update -->
   <script>
      function updateCoupon() {
         var form = $('#couponUpdateForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('coupon.update') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $('#updateCouponModal').modal('toggle');
                  toastr.success(response.message);
                  $(form)[0].reset();
               } else {
                  $('#updateCouponModal').modal('toggle');
                  toastr.error(response.message);
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $(form)[0].reset();
               }

            },

         });
      }
   </script>

   <!-- coupon edit -->
   <script>
      function updateBtn(id) {
         $.ajax({
            type: 'get',
            url: `{{ route('coupon.edit', ['id' => ':id']) }}`.replace(':id', id),
            success: function(response) {
               $('#bodyContentForm').html(response);
               // if (response.success) {
                  // $('#coupon_id').val(response.coupon.id);
                  // $('#couponCode').val(response.coupon.coupon_code);
                  // $('#couponDate').val(response.coupon.valid_date);
                  // $('#couponType').val(response.coupon.type);
                  // $('#couponAmount').val(response.coupon.coupon_amount);
                  // $('#status').val(response.coupon.is_active);
                  // $('#status option:eq(response.cat.is_active)').prop('selected', true);
               // }
            }
         });

      }
   </script>
@endpush
