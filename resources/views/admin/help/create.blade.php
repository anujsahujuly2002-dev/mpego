@extends('admin.layouts.master')
@push('title')
   Manage Setting 
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Manage Setting</h4>
                </div>
                <div class="card-body">
                    <form id="settingForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">Call</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="call" id="call" placeholder="Enter Call Number" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('call')}}">
                                </div>
                                <div class="invalid-feedback call-error"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">Call My Attorney</label>
                                <div class="mb-3">
                                <input type="text" class="form-control" name="call_me_attorney" id="call_me_attorney" placeholder="Enter Call My Attorney" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('call_me_attorney')}}">
                                </div>
                                <div class="invalid-feedback call_me_attorney-error"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">Text My Attorney Number</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="text_my_attorney" id="name" placeholder="Enter Text My Attorney" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('text_my_attorney')}}">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">Text My Attorney (Pre Filled Message)</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="text_my_attorney_pre_filled_message" id="text_my_attorney_pre_filled_message" placeholder="Enter Text My Attorney text my attorney pre filled message" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('text_my_attorney_pre_filled_message')}}">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                             <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">Contact AAA</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="contact_aaa" id="contact_aaa" placeholder="Enter Contact AAA" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('contact_aaa')}}">
                                </div>
                                <div class="invalid-feedback contact_aaa-error"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">No AAA ? Request Two Truck Message No</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  placeholder="No AAA ? Request Two Truck" name="no_aaa_request_two_truck_number" id="no_aaa_request_two_truck" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('no_aaa_request_two_truck_number')}}">
                                </div>
                                <div class="invalid-feedback no_aaa_request_two_truck-error"></div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="group" class="form-label">No AAA ? Request Two Truck (Pre Filled Message)</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  placeholder="No AAA ? Request Two Truck" name="no_aaa_request_two_truck_message" id="no_aaa_request_two_truck_message" value="{{ App\Http\Helper\GeneralHelper::getSettingValue('no_aaa_request_two_truck_message')}}">
                                </div>
                                <div class="invalid-feedback no_aaa_request_two_truck_message-error"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form> 
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    <!-- end col -->
    </div>
</div>
@endsection
@push('script')
<script>
    settingForm.onsubmit = async (e)=>{
        e.preventDefault();
        makePostRequest("{{route('admin.help.store')}}",settingForm,'settingForm');
    }
</script>
@endpush
