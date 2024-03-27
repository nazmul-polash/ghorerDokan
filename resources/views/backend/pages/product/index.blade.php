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
      <div class="float-right">
        <div>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Create Product <i class="fa fa-plus"></i></a>
        </div>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="row row-sm mg-t-20">
         <div class="col-lg-12">
            <div class="card bd-0 shadow-base">
               
               <div class="pd-l-25 pd-r-15 pd-b-25">
                  <div id="ch5" class="">
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                    <h1>This is the product page</h1>
                  </div>
               </div>
            </div><!-- card -->


         </div>
      </div>
   </div>
@endsection
