<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@stack('title') | {{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Theme Config Js -->
        <script src="{{asset('assets/js/config.js')}}"></script>

        <!-- Vendor css -->
        <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

        {{-- toaster Css --}}
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
         <!-- gridjs css -->
        <link rel="stylesheet" href="{{asset('assets/vendor/gridjs/theme/mermaid.min.css')}}">
    </head>
    <body>
        <div class="loading d-none"></div>
        <!-- Begin page -->
        <div class="wrapper">