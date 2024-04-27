@extends('backend.layouts.template')

@section('title')
   Dashboard
@endsection

@section('content')
   <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
         <h4>Product</h4>
         <p class="mg-b-0">All products </p>
      </div>
      <div style="position: absolute; right:2%">
         <a href="{{ route('product.create') }}" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium">Add New <i
               class="fa fa-plus"></i></a>
      </div>

   </div>
   <div class="br-pagebody">
      <div class="row row-sm mg-t-20">
         <div class="col-lg-12">
            <div class="card bd-0 shadow-base">

               <div class="pd-l-25 pd-r-15 pd-b-25 br-section-wrapper">
                  
               </div>
            </div><!-- card -->


         </div>
      </div>
   </div>
@endsection
