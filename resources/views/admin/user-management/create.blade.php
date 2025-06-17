@extends('admin.layouts.master')
@push('title')
    User Create
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Create User</h4>
                </div>
                <div class="card-body">
                    <form id="userForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Role</label>
                                <div class="mb-3">
                                    <select class="form-control" data-choices name="role"  id="choices-single-default">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}">{{ucwords(str_replace('-',' ',$role->name))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Email</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email" id="name" placeholder="Enter Email">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                             <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Phone</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Date Of Birth</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y"  placeholder="Enter Date Of Birth" name="date_of_birth" id="date_of_birth">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Address</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="address" id="address" placeholder="Enter Address">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Street Address</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="street_address" id="street_address" placeholder="Enter Street Address">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Apt Suite</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="apt_suite" id="apt_suite" placeholder="Enter Apt Suite">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">City</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="city" id="city" placeholder="Enter City">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">State</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="state" id="state" placeholder="Enter State">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Country</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="country" id="country" placeholder="Enter country">
                                </div>
                                <div class="invalid-feedback name-error"></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="group" class="form-label">Zip Code</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control"  name="zip_code" id="zip_code" placeholder="Enter Zip Code">
                                </div>
                                <div class="invalid-feedback name-error"></div>
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
        makePostRequest("{{route('admin.users.store')}}",userForm,'userForm');
    }
</script>
@endpush
