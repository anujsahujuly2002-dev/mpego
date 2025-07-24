@extends('admin.layouts.master')
@push('title')
    Dashboard
@endpush
@section('content')

                <div class="page-container">

                    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Number of Users</h4>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <div class="text-end">
                                            <h3 class="fw-semibold">{{$toatalUser}}</h3>
                                            {{-- <p class="text-muted mb-0">Since last month</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Number of Accidents</h4>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <div class="text-end">
                                            <h3 class="fw-semibold">{{$totalNoOfAccident}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Number of Accidents Per Month</h4>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <div class="text-end">
                                            <h3 class="fw-semibold">10</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Number of Users who have AAA</h4>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <div class="text-end">
                                            <h3 class="fw-semibold">4</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div>
                                        <h4 class="header-title">Number of Users who asked for Tow Help</h4>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <div class="text-end">
                                            <h3 class="fw-semibold">4</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->


            </div>
@endsection
@push('script')
   <!-- Apex Chart js -->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <!-- Projects Analytics Dashboard App js -->
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
@endpush
