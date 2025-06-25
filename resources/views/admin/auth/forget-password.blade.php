<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Forget Password | {{env('APP_NAME')}}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

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

<body class="h-100">
    <div class="auth-bg d-flex min-vh-100">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xxl-3 col-lg-5 col-md-6">
                {{-- <a href="index.html" class="auth-brand d-flex justify-content-center mb-2">
                    <img src="assets/images/logo-dark.png" alt="dark logo" height="26" class="logo-dark">
                    <img src="assets/images/logo.png" alt="logo light" height="26" class="logo-light">
                </a> --}}

                <div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

                    <h4 class="fw-semibold mb-2 fs-20">Change Password</h4>

                    {{-- <p class="text-muted mb-2">Please create your new password.</p>
                    <p class="mb-4">Need password suggestion ? <a href="#!" class="link-dark fw-semibold text-decoration-underline">Suggestion</a></p> --}}
                    <form id="forgetPassword" class="text-start mb-3">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="token" value="{{$token}}">
                            <label class="form-label" for="new_password">New Password </label>
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password">
                            <div class="invalid-feedback new_password-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                            <div class="invalid-feedback confirm_password-error"></div>
                        </div>
                        <div class="mb-2 d-grid">
                            <button class="btn btn-primary fw-semibold" type="submit">Create New Password</button>
                        </div>
                    </form>

                    <p class="text-muted fs-14 mb-0">
                        Back To <a href="{{route('admin.login')}}" class="fw-semibold text-danger ms-1">Login !</a>
                    </p>
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
        forgetPassword.onsubmit = async (e)=>{
            e.preventDefault();
            makePostRequest("{{route('admin.change.password')}}",forgetPassword,'forgetPassword');
        }
    </script>

</body>

</html>
