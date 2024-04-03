@extends('backend.layouts.template')

@section('title')
   Pickup Point
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
         <h4>Pickup Point</h4>
         <p class="mg-b-0">All Pickup Point </p>
      </div>
      <div style="position: absolute; right:2%">
         <a href="" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal"
            data-target="#pickupPointCreate">Create Pickup Point <i class="fa fa-plus"></i></a>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered table-striped yajra-datatable">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Pickup Point Name</th>
                     <th>Address</th>
                     <th>Phone</th>
                     <th>Another Phone</th>
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

   <!-- Pickup Point create modal -->
   <div id="pickupPointCreate" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content  bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Create Pickup Point</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:createPickupPoint();" method="POST" enctype="multipart/form-data"
                  id="pickupPointForm">
                  @csrf
                  <div class="row mg-t-40 validation_message">

                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Pickup Point
                              Name:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="pickup_point_name" class="form-control" placeholder="Enter name">
                              @error('pickup_point_name')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Pickup Point
                              Address:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="pickup_point_address" class="form-control"
                                 placeholder="Enter Date">
                              @error('pickup_point_address')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Pickup Point Phone
                              :</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="pickup_point_phone" class="form-control"
                                 placeholder="Enter your phone">
                              @error('pickup_point_phone')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>

                        </div>


                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label">Another Phone :</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="pickup_point_phone_2" class="form-control"
                                 placeholder="Enter Amount">
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

   <!--pickupPoint update modal -->
   <div id="updatePickupPointModal" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Pickup Point</h6>
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
            ajax: "{{ route('pickup_point.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'pickup_point_name',
                  name: 'pickup_point_name'
               },
               {
                  data: 'pickup_point_address',
                  name: 'pickup_point_address'
               },
               {
                  data: 'pickup_point_phone',
                  name: 'pickup_point_phone'
               },
               {
                  data: 'pickup_point_phone_2',
                  name: 'pickup_point_phone_2'
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
            pickup_point_name: 'required',
            pickup_point_address: 'required',
            pickup_point_phone: 'required',
            is_active: 'required',
         },
         messages: {
            pickup_point_name: 'Please enter your name',
            pickup_point_address: 'Plesas enter your address',
            pickup_point_phone: 'Select your phone',
            is_active: 'Please select active or inactive',
         },
      });
   </script>

   <!-- pickup point Create -->
   <script>
      function createPickupPoint() {
         var form = $('#pickupPointForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('pickup_point.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $('#pickupPointCreate').modal('toggle');
                  toastr.success(response.message);
                  $(form)[0].reset();
               } else {
                  $('#pickupPointCreate').modal('toggle');
                  toastr.error(response.message);
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $(form)[0].reset();
               }

            },

         });
      }
   </script>
   <!-- picup point update -->
   <script>
      function updatePickupPoint() {
         var form = $('#pickupPointUpdateForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('pickup_point.update') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  $('.yajra-datatable').DataTable().ajax.reload();
                  $('#updatePickupPointModal').modal('toggle');
                  toastr.success(response.message);
                  $(form)[0].reset();
               } else {
                  $('#updatePickupPointModal').modal('toggle');
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
            url: `{{ route('pickup_point.edit', ['id' => ':id']) }}`.replace(':id', id),
            success: function(response) {
               $('#bodyContentForm').html(response);

            }
         });

      }
   </script>
@endpush
