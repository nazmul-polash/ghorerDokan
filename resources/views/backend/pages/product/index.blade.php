@extends('backend.layouts.template')


@section('title')
   Dashboard
@endsection

@section('style')
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
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table table-sm table-bordered table-striped yajra-datatable">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Thamnail</th>
                     <th scope="col">Name</th>
                     <th scope="col">Category</th>
                     <th scope="col">Code</th>
                     <th scope="col">Model</th>
                     <th scope="col">Quentity</th>
                     <th scope="col">Price</th>
                     <th scope="col">Status</th>
                     <th scope="col">Created By</th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection

@push('script')
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'thumbnail',
                  name: 'thumbnail'
               },
               {
                  data: 'product_name',
                  name: 'product_name'
               },
              
               {
                  data: 'category',
                  name: 'category'
               },
               {
                  data: 'price',
                  name: 'price'
               },
               {
                  data: 'product_code',
                  name: 'product_code'
               },
               {
                  data: 'product_model',
                  name: 'product_model'
               },
               
               {
                  data: 'stock_quantity',
                  name: 'stock_quantity'
               },
               {
                  data: 'is_active',
                  name: 'is_active'
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
@endpush

