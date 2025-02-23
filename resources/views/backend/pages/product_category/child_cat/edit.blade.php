@php
   use App\Models\SubCategory;
@endphp
@extends('backend.layouts.template')

@section('title')
  Child Category || Create
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
         <h4>Child Category</h4>
         <p class="mg-b-0">Edit Child Category</p>
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
                     <form action="javascript:updateChildCategory();" method="POST" enctype="multipart/form-data"
                        id="updatechildCatForm">
                        @csrf
                        <input type="hidden" name="childCatID" value="{{ @$childCat->id }}">
                        <div class="row mg-t-40 validation_message">
                           <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                              <div class="row">
                                 <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Category
                                    Name:</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="child_category_name" class="form-control" value="{{ @$childCat->child_category_name }}">
                                    @error('child_category_name')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="row mg-t-20">
                                 <label class="col-sm-4 form-control-label"> Select Sub Category</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <select name="sub_category_id" class="form-control" id="">
                                       <option value="0" selected disabled>Select Parent</option>
                                       @foreach ($mainCat as $cat)
                                          @php
                                             $subCat = SubCategory::where('parent_id', $cat->id)->get();
                                          @endphp
                                           <option value="{{ $cat->id }}" disabled style="color:orange">{{ $cat->category_name }}</option>
                                          @foreach ($subCat as $sub )
                                          <option value="{{ $sub->id }}" @if($sub->id == @$childCat->id) selected @endif >__{{ $sub->sub_category_name }}</option>
                                          @endforeach
                                         
                                       @endforeach
                                    </select>
                                    @error('sub_category_id')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="row mg-t-20">
                                 <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                                    Title:</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="meta_title" class="form-control"value="{{ @$childCat->meta_title }}">
                                    @error('meta_title')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="row mg-t-20">
                                 <label class="col-sm-4 form-control-label"> Meta Description:</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="meta_description" class="form-control" value="{{ @$childCat->meta_description}}">
                                    @error('meta_description')
                                       <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="row mg-t-20">
                                 <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Meta
                                    Keyword:</label>
                                 <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                    <input type="text" name="meta_keyword" class="form-control" value="{{ @$childCat->meta_keyword }}">
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
                                       <option value="1" @if(@$childCat->is_active == 1) selected @endif>Active</option>
                                       <option value="0" @if(@$childCat->is_active == 0) selected @endif>In-active</option>
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
      $("#updateSubCatForm").validate({
         rules: {
            child_category_name: 'required',
            sub_category_id: 'required',
            meta_title: 'required',
            meta_description: 'required',
            meta_keyword: 'required',
            is_active: 'required',
         },
         messages: {
            sub_category_name: 'Please enter your category name',
            sub_category_id: 'Please select child category name',
            meta_title: 'Please enter your meta title',
            meta_description: 'Please enter your meta description',
            meta_keyword: 'Please enter your meta keyword',
            is_active: 'Please select active or inactive',
         },
      });
   </script>

   <!--create category -->
   <script>
      function updateChildCategory() {
         var form = $("#updatechildCatForm");
         var formData = new FormData(form[0]);

         $.ajax({
            url: "{{ route('child_category.update') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               if (response.success) {
                  toastr.success(response.message);
                  setTimeout(function() {
                     window.location.href = '{{ route('child_category.index') }}';
                  }, 1000);
               } else {
                  window.location.reload();
               }

            },

         });
      }
   </script>
@endpush
