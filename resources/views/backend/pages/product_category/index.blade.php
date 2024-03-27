@extends('backend.layouts.template')

@section('title')
   Product || Category
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
         <h4>Category</h4>
         <p class="mg-b-0">All Category </p>
      </div>
      {{-- <div class="float-right">
         <div>
            <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category <i class="fa fa-plus"></i></a>
         </div>
         
      </div> --}}

      <div style="position: absolute; right:2%">
         <a href="" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal"
            data-target="#createCatModal">Create Category <i class="fa fa-plus"></i></a>
      </div>
   </div>

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered yajra-datatable table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Category Name</th>
                     <th>Slug</th>
                     <th>Meta Title</th>
                     <th>Meta Keyword</th>
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

   <!-- create modal -->
   <div id="createCatModal" class="modal fade">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Create Catgegory</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:createCategory();" method="POST" enctype="multipart/form-data" id="categoryForm">
                  {{-- <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"> --}}
                  @csrf
                  <div class="row mg-t-40 validation_message">
                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Category
                              Name:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="category_name" class="form-control"
                                 placeholder="Enter product category">
                              @error('category_name')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                              Title:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="meta_title" class="form-control" placeholder="Enter meta title">
                              @error('meta_title')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"> Meta Description:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="meta_description" class="form-control"
                                 placeholder="Enter meta description">
                              @error('meta_description')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                              Keyword:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="meta_keyword" class="form-control"
                                 placeholder="Enter meta keyword">
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
                              @error('meta_keyword')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="mg-t-20">
                           <div style=float:inline-end>
                              <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"> Submit</button>
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
      </div><!-- modal-dialog -->
   </div>
   <!-- update modal -->
   <div id="updateCatModal" class="modal fade">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
               <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Catgegory</h6>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="javascript:updateCategory();" method="POST" enctype="multipart/form-data" id="updateForm">
                  {{-- <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"> --}}
                  @csrf
                  <input type="hidden" name="cat_id" id="catID">
                  <div class="row mg-t-40 validation_message">
                     <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                        <div class="row">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Category
                              Name:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="category_name" class="form-control"
                                 id="cat_name" >
                              @error('category_name')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                              Title:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="meta_title" class="form-control" id="meraTitle">
                              @error('meta_title')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"> Meta Description:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="meta_description" class="form-control"
                                 id="metaDesc">
                              @error('meta_description')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="row mg-t-20">
                           <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                              Keyword:</label>
                           <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="meta_keyword" class="form-control"
                                 id="metaKeyword">
                              @error('meta_keyword')
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
                              @error('meta_keyword')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>

                        <div class="mg-t-20">
                           <div style=float:inline-end>
                              <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"> Submit</button>
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
      </div><!-- modal-dialog -->
   </div>
@endsection

@push('script')
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('category.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'category_name',
                  name: 'category_name'
               },
               {
                  data: 'slug',
                  name: 'slug'
               },
               {
                  data: 'meta_title',
                  name: 'meta_title'
               },
               {
                  data: 'meta_keyword',
                  name: 'meta_keyword'
               },
               {
                  data: 'created_by',
                  name: 'created_by'
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

<script src="{{ asset('backend/app/jquery-validation/js/jquery.validate.min.js') }}"></script>
<!--jquery validator -->
<script>
   $("#categoryForm").validate({
      rules: {
         category_name: 'required',
         slug: 'required',
         meta_title: 'required',
         meta_description: 'required',
         meta_keyword: 'required',
         is_active: 'required',
      },
      messages: {
         category_name: 'Please enter your category name',
         slug: 'Please enter your slug',
         meta_title: 'Please enter your meta title',
         meta_description: 'Please enter your meta description',
         meta_keyword: 'Please enter your meta keyword',
         is_active: 'Please select active or inactive',
      },
   });
</script>

<!--create category -->
<script>
   function createCategory() {
      var form = $("#categoryForm");
      var formData = new FormData(form[0]);

      $.ajax({
         url: "{{ route('category.store') }}",
         type: "POST",
         data: formData,
         processData: false,
         contentType: false,
         success: function(response) {
            if (response.success) {
               toastr.success(response.message);
               setTimeout(function() {
                  window.location.href = '{{ route('category.index') }}';
               }, 1000);
            } else {
               window.location.reload();
            }

         },

      });
   }
</script>

<!--update category modal open -->
<script>
   function updateBtn(id) {
      $.ajax({
         type:'get',
         url: `{{ route('category.edit', ['id' => ':id']) }}`.replace(':id', id),
         success:function(response){
            if(response.success){
               $('#catID').val(response.cat.id);
               $('#cat_name').val(response.cat.category_name);
               $('#meraTitle').val(response.cat.meta_title);
               $('#metaDesc').val(response.cat.meta_description);
               $('#metaKeyword').val(response.cat.meta_keyword);
               $('#status').val(response.cat.is_active);
               $('#status option:eq(response.cat.is_active)').prop('selected', true);
            }
         }
      });
   }
</script>

<script>
   function updateCategory() {
      var form = $("#updateForm");
      var formData = new FormData(form[0]);

      $.ajax({
         url: "{{ route('category.update') }}",
         type: "POST",
         data: formData,
         processData: false,
         contentType: false,
         success: function(response) {
            if (response.success) {
               toastr.success(response.message);
               setTimeout(function() {
                  window.location.href = '{{ route('category.index') }}';
               }, 1000);
            } else {
               window.location.reload();
            }

         },

      });
   }
</script>
@endpush
