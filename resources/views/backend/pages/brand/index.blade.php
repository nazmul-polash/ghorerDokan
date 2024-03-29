@extends('backend.layouts.template')

@section('title')
   Product || Brand
@endsection
@section('style')
   <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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
         <h4>Brand</h4>
         <p class="mg-b-0">All Brand </p>
      </div>
      <div style="position: absolute; right:2%">
         <a href="" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal"
            data-target="#brandCreate">Create Brand <i class="fa fa-plus"></i></a>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered table-striped yajra-datatable">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Brand Logo</th>
                     <th>Brand Name</th>
                     <th>Created By</th>
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

   <!-- Brand create modal -->
   <div id="brandCreate" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Create Brand</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:createBrand();" method="POST" enctype="multipart/form-data" id="BrandForm">
                  @csrf
                  <div class="row mg-t-40 validation_message">
                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Brand
                              Name:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="brand_name" class="form-control" placeholder="Enter Brand">
                              @error('brand_name')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Brand Logo:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="file" name="brand_logo" class="form-control dropify" data-height="100">
                              @error('meta_keyword')
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
   <!-- Brand create modal -->
   <div id="updateBrandModal" class="modal fade">
      <div class="modal-dialog  modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Brand</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="formShow"></div>
               
            </div>
         </div>
      </div>
   </div>
@endsection

@push('script')
   <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
   <script src="{{ asset('backend/app/jquery-validation/js/jquery.validate.min.js') }}"></script>
   <!-- dataTable -->
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('brand.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'brand_logo',
                  name: 'brand_logo'
               },

               {
                  data: 'brand_name',
                  name: 'brand_name'
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
   <!-- dropify js -->

   <script>
      $('.dropify').dropify();
   </script>


   <!--jquery validator -->
   <script>
      $("#BrandForm").validate({
         rules: {
            brand_name: 'required',
            brand_logo: 'required',
            is_active: 'required',
         },
         messages: {
            brand_name: 'Please enter your brand name',
            brand_logo: 'Drag or drop your logo',
            is_active: 'Please select active or inactive',
         },
      });
   </script>

   <!-- Brand Create -->
   <script>
      function createBrand() {
         var form = $('#BrandForm');
         var formData = new FormData(form[0]);
         $.ajax({
            url: "{{ route('brand.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  toastr.success(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('brand.index') }}';
                  }, 1000);
               } else {
                  window.location.reload();
               }

            },

         });
      }
   </script>

   <script>
     function updateBtn(id){
      $.ajax({
         type:'get',
         url: `{{ route('brand.edit', ['id' => ':id']) }}`.replace(':id', id),
         success:function(response){
            if(response.success){
               $('#formShow').html(response.html);
            }
         }
      });
      
     }
   </script>
@endpush
