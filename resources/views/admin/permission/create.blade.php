@extends('admin.layouts.master')
@push('title')
    Permission Create
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Create Permission</h4>
                </div>
                <div class="card-body">
                    <form id="permissionForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="group" class="form-label">Permission Group</label>
                                <input type="text" class="form-control" id="group" placeholder="Permission Group" name="group">
                                <div class="invalid-feedback group-error"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Permission name" name="name">
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
    permissionForm.onsubmit = async (e)=>{
        e.preventDefault();
        makePostRequest("{{route('admin.permissions.store')}}",permissionForm,'permissionForm');
    }
</script>
@endpush
