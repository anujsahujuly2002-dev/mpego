@extends('admin.layouts.master')
@push('title')
    Account Delete Reason Create
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Create  Account Delete Reason</h4>
                </div>
                <div class="card-body">
                    <form id="accountDeleteReasonForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="group" class="form-label">Account Delete Reason Name</label>
                                <input type="text" class="form-control" id="group" placeholder="Enter Account Delete Reason" name="reason">
                                <div class="invalid-feedback reason-error"></div>
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
    accountDeleteReasonForm.onsubmit = async (e)=>{
        e.preventDefault();
        makePostRequest("{{route('admin.account.deletion.store')}}",accountDeleteReasonForm,'accountDeleteReasonForm');
    }
</script>
@endpush
