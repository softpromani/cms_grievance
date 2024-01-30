<!--
Template Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/vuexy_admin
Renew Support: https://1.envato.market/vuexy_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
<!-- BEGIN: Head-->

<head>
    @include('frontend.layout.head')
    @yield('style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover"
    data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    @include('frontend.layout.user_header')
    <!-- END: Header-->
    @include('frontend.layout.user_menu')

    <!-- Content -->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            {{-- <div class="content-header row">
    </div> --}}
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- END: Content-->
    <!-- BEGIN: Footer-->
    @include('frontend.layout.footer')
    <!-- END: Footer-->

    <!-- BEGIN: script-->
    @include('frontend.layout.foot')

    <!-- END: script-->
    @yield('script')

</body>
<!-- END: Body-->
