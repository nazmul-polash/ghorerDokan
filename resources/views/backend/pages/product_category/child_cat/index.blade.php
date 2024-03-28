@extends('backend.layouts.template')

@section('title')
   Product || Child-Category
@endsection
@section('content')
   <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
         <h4>Child-Category</h4>
         <p class="mg-b-0">All Child-Category </p>
      </div>
      <div style="position: absolute; right:2%">
         <a href="{{ route('child_category.create') }}" class="btn btn-primary  pd-y-12 pd-x-25 tx-mont tx-medium">Create Child Category <i class="fa fa-plus"></i></a>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered table-striped yajra-datatable">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Category Name</th>
                     <th>Sub Category</th>
                     <th>Parent Category</th>
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
@endsection

@push('script')
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('child_category.index') }}",
            columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex'
               },
               {
                  data: 'child_category_name',
                  name: 'child_category_name'
               },
               {
                  data: 'sub_category_name',
                  name: 'sub_category_name'
               },
              
               {
                  data: 'parent_id',
                  name: 'parent_id'
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
@endpush
