@extends('admin.layouts.master')
@push('title')
    Vendor Edit
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Edit Vendor</h4>
                </div>
                <div class="card-body">
                    <form id="userForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ ($vendor->id ?? '') }}">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Name of Business</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name_of_business" id="name_of_business" placeholder="Name of Business" value="{{ $vendor->name_of_business ?? '' }}">
                                </div>
                                <div class="invalid-feedback name_of_business-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Name of Contact</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name_of_contact" id="name_of_contact" placeholder="Enter Name of Contact" value="{{ $vendor->name_of_contact ?? '' }}">
                                </div>
                                <div class="invalid-feedback name_of_contact-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Email</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ $vendor->email ?? '' }}">
                                </div>
                                <div class="invalid-feedback email-error"></div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Phone Number</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ $vendor->phone_number ?? '' }}">
                                </div>
                                <div class="invalid-feedback phone_number-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Address</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="address" id="address" placeholder="Enter Address" value="{{ $vendor->address ?? '' }}">
                                </div>
                                <div class="invalid-feedback address-error"></div>
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
    userForm.onsubmit = async (e)=>{
        e.preventDefault();
        makePostRequest("{{route('admin.vendor.update')}}",userForm,'userForm');
    }
</script>
@endpush
