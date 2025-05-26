@extends('admin.layouts.master')
@push('title')
    Dashboard
@endpush
@section('content')
    
@endsection
@push('script')
   <!-- Apex Chart js -->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <!-- Projects Analytics Dashboard App js -->
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
@endpush