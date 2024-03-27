@extends('backend.layouts.template')

@section('title')
   Product || Sub-Category
@endsection
@section('content')
   <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
         <h4>Sub-Category</h4>
         <p class="mg-b-0">All Sub-Category </p>
      </div>
      <div>
         <a href="{{ route('sub_category.create') }}" class="btn btn-primary">Create Sub Category <i class="fa fa-plus"></i></a>
      </div>
   </div>
   <div class="br-pagebody">
      <div class="br-section-wrapper">
         <div class="table-wrapper">
            <table class="table nowrap table-bordered yajra-datatable">
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
@endsection

@push('script')
   <script type="text/javascript">
      $(function() {
         var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sub_category.index') }}",
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
@endpush
