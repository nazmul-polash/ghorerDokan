@extends('backend.layouts.template')

@section('title')
   Ware Hosue
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
         <h4>Ware House</h4>
         <p class="mg-b-0">All Ware House </p>
      </div>
      <div style="position: absolute; right:2%">
         <a href="" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal"
            data-target="#wareHouseCreate">Create Ware House <i class="fa fa-plus"></i></a>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered table-striped yajra-datatable">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Phone</th>
                     <th>Address</th>
                     <th>Status</th>
                     <th>Created By</th>
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
   <div id="wareHouseCreate" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Create Ware House</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:createWareHouse();" method="POST" enctype="multipart/form-data"
                  id="wareHouseForm">
                  @csrf
                  <div class="row mg-t-40 validation_message">
                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Ware House
                              Name:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="warehouse_name" class="form-control" placeholder="Enter Name">
                              @error('warehouse_name')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Address:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="warehouse_address" class="form-control"
                                 placeholder="Enter Address">
                              @error('warehouse_address')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Phone Number:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="warehouse_phone" class="form-control"
                                 placeholder="Enter Phone Number">
                              @error('warehouse_phone')
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

   <!--Ware House update modal -->
   <div id="updateWareHouseModal" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Ware House</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:updateWareHouse();" method="POST" enctype="multipart/form-data"
                  id="wareHouseUpdateForm">
                  @csrf
                  <input type="hidden" name="warehouseID" id="WHid">
                  <div class="row mg-t-40 validation_message">
                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Ware House
                              Name:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="warehouse_name" class="form-control" id="WHname">
                              @error('warehouse_name')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Address:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="warehouse_address" class="form-control" id="WHaddress">
                              @error('warehouse_address')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Phone
                              Number:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="warehouse_phone" class="form-control" id="WHphone">
                              @error('warehouse_phone')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Status:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <select name="is_active" id="status" class="form-control">
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
@endsection

@push('script')
   <script src="{{ asset('backend/app/jquery-validation/js/jquery.validate.min.js') }}"></script>
   <!-- dataTable -->
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('warehouse.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'warehouse_name',
                  name: 'warehouse_name'
               },
               {
                  data: 'warehouse_phone',
                  name: 'warehouse_phone'
               },
               {
                  data: 'warehouse_address',
                  name: 'warehouse_address'
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
      $("#wareHouseForm").validate({
         rules: {
            warehoue_name: 'required',
            warehoue_address: 'required',
            warehoue_phone: 'required',
            is_active: 'required',
         },
         messages: {
            warehoue_name: 'Please enter your ware house name',
            warehoue_address: 'Plesas enter house address',
            warehoue_phone: 'Enter ware house phone number',
            is_active: 'Please select active or inactive',
         },
      });
   </script>

   <!-- warehouse Create -->
   <script>
      function createWareHouse() {
         var form = $('#wareHouseForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('warehouse.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  toastr.success(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('warehouse.index') }}';
                  }, 1000);
               } else {
                  toastr.error(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('warehouse.index') }}';
                  }, 1000);
                  //   window.location.reload();
               }

            },

         });
      }
   </script>
   <!-- warehouse update -->
   <script>
      function updateWareHouse() {
         var form = $('#wareHouseUpdateForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('warehouse.update') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  toastr.success(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('warehouse.index') }}';
                  }, 1000);
               } else {
                  toastr.error(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('warehouse.index') }}';
                  }, 1000);
                  //   window.location.reload();
               }

            },

         });
      }
   </script>

<!-- warehouse edit -->
   <script>
      function updateBtn(id) {
         $.ajax({
            type: 'get',
            url: `{{ route('warehouse.edit', ['id' => ':id']) }}`.replace(':id', id),
            success: function(response) {
               if (response.success) {
                  $('#WHid').val(response.warehouse.id);
                  $('#WHname').val(response.warehouse.warehouse_name);
                  $('#WHaddress').val(response.warehouse.warehouse_address);
                  $('#WHphone').val(response.warehouse.warehouse_phone);
                  $('#status').val(response.warehouse.is_active);
                  $('#status option:eq(response.cat.is_active)').prop('selected', true);
               }
            }
         });

      }
   </script>
@endpush
