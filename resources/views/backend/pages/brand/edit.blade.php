<form action="javascript:updateBrand();" method="POST" enctype="multipart/form-data" id="updateBrandForm">
   @csrf
   <input type="hidden" name="brandID" value="{{ $brand->id }}">
   <div class="row mg-t-40 validation_message">
      <div class="col-xl-12 mg-t-20 mg-xl-t-0">
         <div class="row">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Brand
               Name:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}">
               @error('brand_name')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Brand Logo:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="file" name="brand_logo" class="dropify" id="updateImg" />
               @error('brand_logo')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>
         <div class="row mg-t-20">
            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Status:</label>
            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <select name="is_active" id="" class="form-control">
                  <option value="" selected disabled>select</option>
                  <option value="1" @if ($brand->is_active == 1) selected @endif>Active</option>
                  <option value="0" @if ($brand->is_active == 0) selected @endif>In-active</option>
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
<!-- dropify js -->
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
    $("#updateImg").attr("data-height", 200);
    $("#updateImg").attr("data-default-file", "{{ asset('uploads/brand/' . $brand->brand_logo) }}");
    $('.dropify').dropify();
</script>
<!-- Brand Create -->
<script>
    function updateBrand() {
       var form = $('#updateBrandForm');
       var formData = new FormData(form[0]);
       $.ajax({
          url: "{{ route('brand.update') }}",
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

