@extends('backend.layouts.template')

@section('title')
   Dashboard
@endsection
@section('style')
   <link rel="stylesheet" href="{{ asset('backend/app') }}/image_uploader/image-uploader.min.css">
   <link href="{{ asset('backend/app') }}/lib/summernote/summernote-bs4.css" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('backend/app') }}/image_uploader/image-uploader.min.css">
   <link href="{{ asset('backend/app') }}/lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

   <style>

   </style>
@endsection

@section('content')
   <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
         <h4>Product Create</h4>
         <p class="mg-b-0">Create your product here</p>
      </div>
   </div>
   <div class="br-pagebody">
      {{-- <div class="row">
         <div class="col-md-8">
            <div class="br-section-wrapper">
               <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
                  @csrf
                  <div class="form-layout form-layout-1">
                     <div class="row mg-b-25">
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_name" value="John Paul"
                                 placeholder="Enter product name">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_code" value="McDoe"
                                 placeholder="Enter code">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Unit: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_unit" value=""
                                 placeholder="Enter unit">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Model: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_model" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Tags: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_tags" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_color" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_size" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Purchese Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="purchase_price" value=""
                                 placeholder="Enter purchase price">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="selling_price" value=""
                                 placeholder="Enter selling price">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="discount_price" value=""
                                 placeholder="Enter discount price">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Stock Quantity: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="stock_quantity" value=""
                                 placeholder="Enter quantity">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Ware House: <span class="tx-danger">*</span></label>
                              <select class="form-control select2" data-placeholder="Choose ware house">
                                 <option label="Choose country"></option>
                                 <option value="USA">House 1</option>
                                 <option value="USA">House 2</option>
                                 <option value="USA">House 3</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Vidoe: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_video" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>
                        <div class="col-lg-8">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Mail Address: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="address" value="Market St. San Francisco"
                                 placeholder="Enter address">
                           </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-12">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                              <textarea name="description" id="summernote" class="form-control" cols="30" rows="10"></textarea>
      
                           </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-4">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                              <select class="form-control select2" data-placeholder="Choose country">
                                 <option label="Choose country"></option>
                                 <option value="USA">United States of America</option>
                                 <option value="UK">United Kingdom</option>
                                 <option value="China">China</option>
                                 <option value="Japan">Japan</option>
                              </select>
                           </div>
                        </div>
                     </div>
      
                     <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info">Submit Form</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-4">

            <div class="br-section-wrapper"></div>
         </div>
      </div> --}}

      <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="addProductForm">
         <div class="row row-sm mg-t-20">
            @csrf
            <div class="col-lg-8">
               <div class="card mg-b-10">
                  <div class="card-header tx-medium bd-0 tx-white bg-info" style="padding: 5px 5px">Category</div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-4">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                              <select name="category_id" class="form-control select2" onchange="getSubCat(this);"
                                 id="category">
                                 <option label="Choose country"></option>
                                 @foreach ($category as $main)
                                    <option value="{{ $main->id }}">{{ $main->category_name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                              <select name="sub_category_id" class="form-control select2" disabled id="subCategory"
                                 onchange="getChildCat(this)"></select>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Child Category:</label>
                              <select name="child_category_id" class="form-control select2" id="childCategory"
                                 disabled></select>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                              <select name="brand_id" class="form-control select2">
                                 <option label="Choose country"></option>
                                 @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>


               <div class="card">
                  <div class="card-header tx-medium bd-0 tx-white bg-info" style="padding: 5px 5px">Details</div>
                  <div class="card-body">
                     <div class="row mg-b-20">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_name"
                                 placeholder="Enter product name">
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_code" value="McDoe"
                                 placeholder="Enter code">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-control-label">Product Model: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_model" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-control-label">Product Unit: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_unit" value=""
                                 placeholder="Enter unit">
                           </div>
                        </div>
                     </div>

                     <div class="row mg-b-20">
                        <div class="col-lg-6">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Pickup Point: </label>
                              <select name="pickup_point_id" class="form-control select2">
                                 <option label="Choose country"></option>
                                 @foreach ($pickupPoints as $data)
                                    <option value="{{ $data->id }}">{{ $data->pickup_point_name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Ware House: <span class="tx-danger">*</span></label>
                              <select class="form-control select2" data-placeholder="Choose ware house">
                                 <option label="Choose country"></option>
                                 @foreach ($wareHouses as $data)
                                    <option value="{{ $data->id }}">{{ $data->warehouse_name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-control-label">Product Vidoe: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_video" value=""
                                 placeholder="Enter model">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-control-label">Stock Quantity: <span class="tx-danger">*</span></label>
                              <div class="d-flex qty">
                                 <button type="button" class="btn btn-default" id="minus"><i
                                       class="fa fa-minus"></i></button>
                                 <input class="form-control" type="number" id="mainInput" name="stock_quantity"
                                    value="1">
                                 <button type="button" class="btn btn-default" id="plus"><i
                                       class="fa fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row mg-b-20">
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Purchese Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="purchase_price" value=""
                                 placeholder="Enter purchase price">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="selling_price" value=""
                                 placeholder="Enter selling price">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="discount_price" value=""
                                 placeholder="Enter discount price">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Tags: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_tags" data-role="tagsinput">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_color" data-role="tagsinput">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_size"data-role="tagsinput">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                              <textarea name="description" id="summernote" class="form-control" cols="30" rows="10"></textarea>

                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
               <div class="card ">
                  <div class="card-header tx-medium bd-0 tx-white bg-purple" style="padding: 5px 5px;"> Product
                     Additional Part </div>
                  <div class="card-body">
                     <div class="form-group">
                        <label class="form-control-label">Product Thamnail</label>
                        <input type="file" name="thumbnail" class="form-control dropify" data-height="100">
                     </div>
                     <div class="form-group">
                        <label class="form-control-label">Product Multipel Image</label>
                        <div class="input-images"></div>
                     </div>

                     <div class="form-group">
                        <label class="form-control-label">Product Feature</label><br>
                        <div class="br-toggle br-toggle-success off" id="productFeatureToggle">
                            <div class="br-toggle-switch"></div>
                        </div>
                        <input type="hidden" name="feature" id="productFeatureValue" value="0">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label">Today Deal</label><br>
                        <div class="br-toggle br-toggle-success off" id="todayDealToggle">
                            <div class="br-toggle-switch"></div>
                        </div>
                        <input type="hidden" name="today_deal" id="todayDealValue" value="0">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label">Product Status</label><br>
                        <div class="br-toggle br-toggle-success off" id="productStatusToggle">
                            <div class="br-toggle-switch"></div>
                        </div>
                        <input type="hidden" name="status" id="productStatusValue" value="0">
                    </div>

                     <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info">Submit Form</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                     </div>

                  </div>
               </div>
            </div>
         </div>

      </form>

   </div>
@endsection

@push('script')
   <script src="{{ asset('backend/app') }}/lib/summernote/summernote-bs4.min.js"></script>
   <script src="{{ asset('backend/app') }}/image_uploader/image-uploader.min.js"></script>
   <script src="{{ asset('backend/app') }}/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
   <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

   <!-- stock quantity plus and minus-->
   <script>
      $('#plus').click(function() {
         $('#minus').prop('disabled', false)
         var input = $(this).closest('.qty').find('#mainInput');
         input.val(+input.val() + 1)
      })
      $('#minus').click(function() {
         var input = $(this).closest('.qty').find('#mainInput');
         if (input.val() > 1) {
            input.val(+input.val() - 1)
         }
         if (input.val() == 1) {
            $('#minus').prop('disabled', true)
         }
      })
   </script>



   <!-- get sub category js-->
   <script>
      function getSubCat(id) {
         var value = id.value;
         $.ajax({
            type: 'get',
            url: '{{ route('get.subcategory') }}',
            data: {
               id: value,
            },
            success: function(response) {
               $('#subCategory').prop("disabled", false);
               $('#subCategory').html(response);
            }
         });
      }

      function getChildCat(id) {
         var value = id.value;
         $.ajax({
            type: 'get',
            url: '{{ route('get.child.category') }}',
            data: {
               id: value,
            },
            success: function(response) {
               $('#childCategory').prop("disabled", false);
               $('#childCategory').html(response);
            }
         });
      }
   </script>


   <!-- summer note-->
   <script>
      $('#summernote').summernote({
         height: 150,
         tooltip: false
      })
   </script>
   <!-- dropify js-->
   <script>
      $('.dropify').dropify();
   </script>
   <!-- image uploader-->
   <script>
      $('.input-images').imageUploader({
         maxFiles: 10
      });
   </script>
   <!-- Button toggle js-->
   <script>
      $('.br-toggle').on('click', function(e) {
          e.preventDefault();
          $(this).toggleClass('on');
          var toggleId = $(this).attr('id');
          var valueFieldId = toggleId.replace('Toggle', 'Value');
          var value = $('#' + valueFieldId).val();
          value = value === '0' ? '1' : '0';
          $('#' + valueFieldId).val(value);
      });
  </script>
@endpush
