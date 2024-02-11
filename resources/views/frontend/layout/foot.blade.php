 <!-- BEGIN: Vendor JS-->
 <script src="{{ asset('app-assets/vendors/js/vendors.min.js')}}"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
  <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="{{ asset('app-assets/js/core/app-menu.min.js')}}"></script>
 <script src="{{ asset('app-assets/js/core/app.min.js')}}"></script>
 <script src="{{ asset('app-assets/js/scripts/customizer.min.js')}}"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 {{-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.min.js')}}"></script> --}}
 <!-- END: Page JS-->



<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
 <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
 <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/forms/cleave/cleave.min.js')}}"></script> --}}
 {{-- <script src="{{ asset('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js')}}"></script> --}}
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Page JS-->
 <script src="{{ asset('app-assets/js/scripts/pages/app-user-list.js')}}"></script>
 <!-- END: Page JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
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
    // success message popup notification

    @if (session()->has('success'))
        toastr['success']("{{ session()->get('success') }}", 'success!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
    // info message popup notification
    @if (session()->has('info'))
        toastr['info']("{{ session()->get('info') }}", 'info!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
    // warning message popup notification
    @if (session()->has('warning'))
        toastr['warning']("{{ session()->get('warning') }}", 'Warning!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
    // error message popup notification
    @if (session()->has('error'))
        toastr['error']("{{ session()->get('error') }}", 'Error!', {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    @endif
 </script>
