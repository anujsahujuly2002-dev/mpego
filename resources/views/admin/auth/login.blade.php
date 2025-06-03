<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{asset('assets/js/config.js')}}"></script>

    {{-- toaster Css --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
    <!-- Vendor css -->
    <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="loading d-none"></div>
    <div class="auth-bg d-flex min-vh-100">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xxl-3 col-lg-5 col-md-6">
                {{-- <a href="{{route('admin.login')}}" class="auth-brand d-flex justify-content-center mb-2">
                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="dark logo" height="26" class="logo-dark">
                    <img src="{{asset('assets/images/logo.png')}}" alt="logo light" height="26" class="logo-light">
                </a> --}}

                {{-- <p class="fw-semibold mb-4 text-center text-muted fs-15">Admin Panel</p> --}}

                <div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

                    <h4 class="fw-semibold mb-3 fs-18">Log in to your account</h4>

                    <form id="loginForm" class="text-start mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email Or Phone</label>
                            <input type="email" id="email" name="email_or_phone" class="form-control" placeholder="Enter your email or phone" autocomplete="off">
                            <div class="invalid-feedback email_or_phone-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                            <div class="invalid-feedback password-error"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check">
                                {{-- <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label> --}}
                            </div>
                            <a href="javascript:void()" class="text-muted border-bottom border-dashed">Forget Password</a>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary fw-semibold" type="submit">Login</button>
                        </div>
                    </form>
                </div>
                <p class="mt-4 text-center mb-0">
                    <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}}
                </p>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <!-- Custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('assets/js/custom/common.js')}}"></script>
     {{-- @include('admin.layouts.toastr') --}}
    <script>
        loginForm.onsubmit = async (e)=>{
            e.preventDefault();
            makePostRequest("{{route('admin.do.login')}}",loginForm,'loginForm');
        }
    </script>

</body>

</html>
