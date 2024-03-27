@extends('backend.layouts.template')

@section('title')
   Sub Category || Create
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
         <h4>Sub Category</h4>
         <p class="mg-b-0">Create Sub Category</p>
      </div>
      <div class="float-right">
         <div> </div>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="row row-sm mg-t-20">
         <div class="col-lg-12">
            <div class="card bd-0 shadow-base">

               <div class="pd-l-25 pd-r-15 pd-b-25">
                  <div id="ch5" class="">
                     <form action="javascript:createCategory();" method="POST" enctype="multipart/form-data"
                        id="categoryForm">
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
                                 <label class="col-sm-4 form-control-label"> Select Parent Category</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select name="parent_id" class="form-control" id="">
                                       <option value="0" selected disabled>Select Parent</option>
                                       @foreach ($sub_cat as $cat )
                                          <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                       @endforeach
                                    </select>
                                    @error('slug')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="row mg-t-20">
                                 <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                                    Title:</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="meta_title" class="form-control"
                                       placeholder="Enter meta title">
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

                              <div class="row mg-t-30">
                                 <div class="col-sm-8 mg-l-auto">
                                    <div class="">
                                       <button type="submit" class="btn btn-info float-right">Submit</button>
                                    </div>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('script')
   <script src="{{ asset('backend/app/jquery-validation/js/jquery.validate.min.js') }}"></script>
   <!--jquery validator -->
   <script>
      $("#categoryForm").validate({
         rules: {
            category_name: 'required',
            meta_title: 'required',
            meta_description: 'required',
            meta_keyword: 'required',
            is_active: 'required',
         },
         messages: {
            category_name: 'Please enter your category name',
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
            url: "{{ route('sub_category.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  toastr.success(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('sub_category.index') }}';
                  }, 1000);
               } else {
                  window.location.reload();
               }

            },

         });
      }
   </script>
@endpush
