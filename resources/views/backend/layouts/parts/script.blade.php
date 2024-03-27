<script src="{{ asset('backend/app') }}/lib/jquery/jquery.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="{{ asset('backend/app') }}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/moment/min/moment.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/peity/jquery.peity.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/rickshaw/vendor/d3.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/rickshaw/vendor/d3.layout.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/rickshaw/rickshaw.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/jquery.flot/jquery.flot.js"></script>
<script src="{{ asset('backend/app') }}/lib/jquery.flot/jquery.flot.resize.js"></script>
<script src="{{ asset('backend/app') }}/lib/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/echarts/echarts.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/select2/js/select2.full.min.js"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyAq8o5-8Y5pudbJMJtDFzb8aHiWJufa5fg"></script>
<script src="{{ asset('backend/app') }}/lib/gmaps/gmaps.min.js"></script>
<script src="{{ asset('backend/app') }}/lib/select2/js/select2.min.js"></script>
<!--toastr js-->
<script src="{{ asset('backend/app/toastr/toastr.min.js') }}"></script>
<!--sweet alert js-->
<script src="{{ asset('backend/app/sweet-alert/sweetalert2@11.js') }}"></script>

<!-- dataTable script  -->
<script src="{{ asset('backend/app/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/app/lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>


<script src="{{ asset('backend/app') }}/js/bracket.js"></script>
<script src="{{ asset('backend/app') }}/js/map.shiftworker.js"></script>
<script src="{{ asset('backend/app') }}/js/ResizeSensor.js"></script>
<script src="{{ asset('backend/app') }}/js/dashboard.js"></script>


<script>
   $(function() {
      'use strict'

      // FOR DEMO ONLY
      // menu collapsed by default during first page load or refresh with screen
      // having a size between 992px and 1299px. This is intended on this page only
      // for better viewing of widgets demo.
      $(window).resize(function() {
         minimizeMenu();
      });

      minimizeMenu();

      function minimizeMenu() {
         if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)')
            .matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
         } else if (window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
         }
      }
   });
</script>


<!-- sweet alert-->
<script>
   $(document).on("click", "#delete", function(e) {
      e.preventDefault();
      var link = $(this).attr('data-target');
      Swal.fire({
         title: "Are you sure?",
         text: "You won't be able to revert this!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Yes, delete it!"
      }).then((result) => {
         if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
               title: "Deleted!",
               text: "Your file has been deleted.",
               icon: "success"
            });
         }
      });
   })
</script>

<!--toastr message-->
@if (Session::has('message'))
   <script>
      toastr.options = {
         'progressBar': true,
         'closeButton': true,
      }
      var type = "{{ Session::get('type', 'info') }}"

      switch (type) {
         case 'info':
            toastr.info("{{ Session::get('message') }}")
            break;
         case 'success':
            toastr.success("{{ Session::get('message') }}")
            break;
         case 'warning':
            toastr.warning("{{ Session::get('message') }}")
            break;
         case 'error':
            toastr.error("{{ Session::get('message') }}")
            break;
      }
   </script>
@endif
