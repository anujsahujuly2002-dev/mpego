@include('admin.layouts.header')
@include('admin.layouts.sidebar')
@include('admin.layouts.top-bar')
<div class="page-content">
@yield('content')
 <!-- Footer Start -->
    <footer class="footer">
        <div class="page-container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}} - By <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Supertek</span>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-md-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
@include('admin.layouts.footer')
@include('admin.layouts.script')