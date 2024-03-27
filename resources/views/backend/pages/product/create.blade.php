@extends('backend.layouts.template')

@section('title')
   Dashboard
@endsection
@section('style')
   <link rel="stylesheet" href="{{ asset('backend/app') }}/image_uploader/image-uploader.min.css">

   <style>
      .steps-wrapper {
         display: flex;
         overflow: hidden;
      }

      .stpes {
         min-width: 100%;
         overflow-x: hidden;

      }

      .next {
         margin-right: 15px;
      }
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
      <div class="row row-sm mg-t-20">
         <div class="col-lg-12">
            <div class="card bd-0 shadow-base">

               <div class="pd-l-25 pd-r-15 pd-b-25">
                  <div id="ch5" class="">
                     <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
                        id="addProductForm">
                        @csrf
                        <div class="row mg-t-40">
                           <div class="col-xl-12 mg-t-20 mg-xl-t-0">
                              {{-- @if ($errors->any())
                                 <div class="alert alert-danger">
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @endif --}}
                              <div class="steps-wrapper">
                                 <div class="stpes" id="step-1">
                                    <div class="row">
                                       <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product
                                          Name:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <input type="text" name="product_name" class="form-control"
                                             placeholder="Enter product name">
                                             @error('product_name') <span class="text-danger">{{ $message  }}</span> @enderror
                                       </div>
                                    </div>
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product
                                          Model:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <input type="text" name="product_model" class="form-control"
                                             placeholder="Enter model">
                                             @error('product_model') <span class="text-danger">{{ $message }}</span> @enderror
                                       </div>
                                    </div>
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product
                                          Quantity:</label>
                                       <div class="row wrap">
                                          <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                             <button type="button" class="mt-2" id="minus" style="border:none"><i
                                                   class="fa fa-minus"></i></button>
                                          </div>
                                          <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                             <input type="number" name="quantity" id="mainInput" class="form-control"
                                                value="1">
                                                @error('quantity') <span class="text-danger">{{ $message  }}</span> @enderror
                                          </div>
                                          <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                             <button type="button" class="mt-2" style="border:none" id="plus"><i
                                                   class="fa fa-plus"></i></button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product
                                          Price:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <input type="number" name="product_price" class="form-control" id="price"
                                             placeholder="Enter price">
                                             @error('product_price') <span class="text-danger">{{ $message  }}</span> @enderror <br>
                                          <label for="">Offer</label>
                                          <div class="br-toggle br-toggle-rounded br-toggle-primary" style="top:8px">
                                             <div class="br-toggle-switch"></div>
                                          </div>
                                          <div class="row" id="showOffer" style="display: none">
                                             <div class="col-sm-6">
                                                <input type="number" name="percentage_value" class="form-control"
                                                   placeholder="Enter percentage" id="percentage">
                                             </div>
                                             <div class="col-sm-6">
                                                <input type="number" name="total_price" class="form-control"
                                                   id="total_price" readonly>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row mg-t-30">
                                       <div class="col-sm-8 mg-l-auto">
                                          <div class="form-layout-footer">
                                             <button type="button" class="btn btn-info float-right next">Next</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="stpes" id="step-2">
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>
                                          Product
                                          Image:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <input type="file" name="product_image" class="form-control"
                                             placeholder="Enter product image">
                                             @error('product_image') <span class="text-danger">{{ $message  }}</span> @enderror
                                       </div>
                                    </div>
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"> Product Multiple Image:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <div class="input-images"></div>
                                       </div>
                                    </div>
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"> More Item:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <div class="row ">

                                             <div class="col-sm-5">
                                                <input type="text" name="desc_1[]" class="form-control">
                                             </div>
                                             <div class="col-sm-5">
                                                <input type="text" name="desc_2[]" class="form-control">
                                             </div>
                                             <div class="col-sm-2">
                                                <div class="cngCls">
                                                   <button type="button" class="btn btn-primary "
                                                      onclick="addMore()"><i class="fa fa-plus"></i></button>
                                                </div>
                                             </div>

                                          </div>

                                          <div id="addMore">
                                             <div class="row mg-t-10 default" style="display: none;">

                                                <div class="col-sm-5">
                                                   <input type="text" name="desc_1[]" class="form-control">
                                                </div>
                                                <div class="col-sm-5">
                                                   <input type="text" name="desc_2[]" class="form-control">
                                                </div>
                                                <div class="col-sm-2">
                                                   <div>
                                                      <button type="button" class="btn btn-danger"
                                                         onclick="closeBtn(this)"><i class="fa fa-trash"></i></button>
                                                   </div>
                                                </div>

                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row mg-t-30">
                                       <div class="col-sm-8 mg-l-auto">
                                          <div class="form-layout-footer">
                                             <button type="button" class="btn btn-info previous">Previous</button>
                                             <button type="button" class="btn btn-info float-right next">Next</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="stpes" id="step-3">
                                    <div class="row mg-t-20">
                                       <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>
                                          Product
                                          Description:</label>
                                       <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                          <textarea rows="2" name="product_description" class="form-control" placeholder="Enter description"></textarea>
                                          @error('product_description') <span class="text-danger">{{ $message  }}</span> @enderror
                                       </div>
                                    </div>
                                    <div class="row mg-t-30">
                                       <div class="col-sm-8 mg-l-auto">
                                          <div class="form-layout-footer">
                                             <button type="button" class="btn btn-info previous">Previous</button>
                                             <button type="submit" class="btn btn-info float-right">Submit</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                           </div><!-- col-6 -->
                        </div>
                     </form>
                  </div>
               </div>
            </div><!-- card -->


         </div>
      </div>
   </div>
@endsection

@push('script')
   <!--image uploader package -->
   <script src="{{ asset('backend/app') }}/image_uploader/image-uploader.min.js"></script>
   <script>
      $('.input-images').imageUploader({
         maxFiles: 3
      });
   </script>

   <!-- miltiple input field -->
   <script>
      function addMore() {
         // var defaultDiv = document.querySelector('.default');
         // var cloneDiv = defaultDiv.cloneNode(defaultDiv)
         // defaultDiv.style.display = '';
         // var moreItemDiv = document.getElementById('addMore');
         // moreItemDiv.appendChild(cloneDiv);
         var container = $('#addMore');
         var item = container.find('.default').clone();
         //   item.('div.cngCls').remove();
         // var $input = $('<input type="button" value="new button" />');
         //    $input.appendTo(item);
         item.removeClass('default');
         item.appendTo(container).show();
      }

      function closeBtn(button) {
         $(button).parent().parent().parent().remove();
      }
   </script>
   <!-- next previous page -->
   {{-- <script>
      $('#steps').css('display', 'none');
      $('#step-1').css('display', 'block');
      function run(hideTab, showTab){
         if(hideTab < showTab){
          var currentTab = 0;
          x = $('#step-'+hideTab);
          y = $(x).find('input');
          for(i= 0; i< y.length; i++){
            if(y[i].value == ''){
               $(y[i]).css('background', 'red');
               return false;
            }
          }
         }
         $('#step-'+hideTab).css('display', 'none');
         $('step-'+showTab).css('display', 'block');
      }
   </script> --}}

   <!-- next previous page -->
   <script>
      $('.next').click(function() {
         var scrollWidth = $('.stpes').width();
         var wrapperPos = $('.steps-wrapper').scrollLeft();
         $('.steps-wrapper').animate({
            scrollLeft: wrapperPos + scrollWidth
         }, 200);
      })

      $('.previous').click(function() {
         var scrollWidth = $('.stpes').width();
         var wrapperPos = $('.steps-wrapper').scrollLeft();
         $('.steps-wrapper').animate({
            scrollLeft: wrapperPos - scrollWidth
         }, 200);
      })
   </script>

   <!-- quantity plus minus -->
   <script>
      $('#plus').click(function() {
         $('#minus').prop('disabled', false);
         var input = $(this).closest('.wrap').find('#mainInput');
         input.val(+input.val() + 1);
      })

      $('#minus').click(function() {
         var input = $(this).closest('.wrap').find('#mainInput');
         if (input.val() > 1) {
            input.val(+input.val() - 1);
         }
         if (input.val() == 1) {
            $('#minus').prop('disabled', true);
         }
      })
   </script>

   <!-- percentage calculate -->
   <script>
      // Reusable helper functions
      const calculateSale = (listPrice, discount) => {
         listPrice = parseFloat(listPrice);
         discount = parseFloat(discount);
         return (listPrice - (listPrice * discount / 100)).toFixed(2);
      }
      const $list = $('input[name="product_price"]'),
         $disc = $('input[name="percentage_value"]'),
         $sale = $('input[name="total_price"]');
      $list.add($disc).on('input', () => {
         let sale = $list.val();
         if ($disc.val().length) {
            sale = calculateSale($list.val(), $disc.val());
         }
         $sale.val(sale);
      });
   </script>


   <!-- offer show hide button -->
   <script>
      $(function() {
         $('.br-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('on');
            if ($(this).hasClass('on')) {
               $('#showOffer').show();
               console.log('show');
            } else {
               $('#showOffer').hide();
            }
         })
      })
   </script>


   {{-- <script>
      $(document).ready(function() {
         $('#percentage').on('input', function() {
            var inputValue = $(this).val();
            $('#total_price').val(inputValue);
         });
      });
   </script> --}}
@endpush
