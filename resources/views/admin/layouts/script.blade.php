
        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- gridjs js -->
        <script src="{{asset('assets/vendor/gridjs/gridjs.umd.js')}}"></script>

        {{-- <script src="{{asset('assets/js/components/table-gridjs.js')}}"></script> --}}
        @include('admin.layouts.toastr')
        
        @stack('script')

    </body>

</html>