 <!-- BEGIN: Vendor JS-->
 <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
 <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <!-- END: Page JS-->

 <script>
     
     $(document).ready(function() {
         if (feather) {
             feather.replace({
                 width: 14,
                 height: 14
             });
         }
     });
 </script>
