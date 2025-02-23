<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from www.annimexweb.com/items/hema/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 19:36:50 GMT -->
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="description">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Title Of Site -->
        <title>@yield('title')</title>
        <!-- Favicon -->
        @include('frontend.layouts.parts.css')
        @yield('style')
    </head>

    <body class="template-index index-demo1">
        <!--Page Wrapper-->
        <div class="page-wrapper">
            <!--Top Header-->
            @include('frontend.layouts.parts.topbar')
            <!--End Top Header-->
            <!--Header-->
            @include('frontend.layouts.parts.manubar')
            <!--End Header-->

            <!--Mobile Menu-->
            @include('frontend.layouts.parts.mobilemanu')
            <!--End Mobile Menu-->

            <!-- Body Container -->
            <div id="page-content" class="mb-0">

                <!--main content--> 
                @yield('content')

                
            </div>
            <!-- End Body Container -->

            <!--Footer-->
            @include('frontend.layouts.parts.footer')
            <!--End Footer-->

            
            <!--Sticky Menubar Mobile-->
            @include('frontend.layouts.parts.sticky-moblile-manubar')
            <!--End Sticky Menubar Mobile-->

            <!--Scoll Top-->
            <div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
            <!--End Scoll Top-->

            @include('frontend.layouts.parts.modal')

            <!--script-->
            @include('frontend.layouts.parts.script')
            @stack('scripts')
            <!--script end-->
        </div>
        <!--End Page Wrapper-->
    </body>
</html>