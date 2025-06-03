@extends('admin.layouts.master')
@push('title')
    Role Edit
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Edit Role</h4>
                </div>
                <div class="card-body">
                    <form id="roleForm">
                        @csrf
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="group" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="group" placeholder="Enter Role name" name="name" value="{{  ucwords(str_replace('-',' ',$role->name)) }}">
                                <div class="invalid-feedback name-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($permissions as $key => $permission)
                                <div class="col-md-3">
                                    <h5 class="font-size-14 mb-3 card-title">
                                        <i class="mdi mdi-arrow-right-bold text-primary me-1"></i> {{ucwords($key)}}
                                    </h5>
                                    <div class="vstack gap-2">
                                        @foreach ($permission as $key =>$per)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="permission_{{$per->id}}" name="permissions[]" value="{{$per->id}}" @checked(in_array($per->id, $role->permissions->pluck('id')->toArray()))>    
                                                <label for="permission_{{$per->id}}" class="fw-bold lh-base form-check-label">{{ucwords(str_replace('-',' ',$per->name))}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="invalid-feedback permissions-error"></div>
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
    roleForm.onsubmit = async (e)=>{
        e.preventDefault();
        makePostRequest("{{route('admin.roles.update')}}",roleForm,'roleForm');
    }
</script>
@endpush
