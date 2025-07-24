@extends('admin.layouts.master')
@push('title')
    Notification Create
@endpush
@push('css')
    <link href="{{asset('assets/vendor/quill/quill.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Create Notification</h4>
                </div>
                <div class="card-body">
                    <form id="notificationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="group" class="form-label">Notification Template</label>
                                                    <div id="snow-editor" style="height: 300px;"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="group" class="form-label">Notification Type</label>
                                                    <select class="form-control" data-choices name="notification_type"  id="choices-single-default">
                                                        <option value="">Select Notification Type</option>
                                                        <option value="immediate">{{ucwords(str_replace('-',' ','Immediate'))}}</option>
                                                        <option value="schedule">{{ucwords(str_replace('-',' ','Schedule'))}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-none schedule_time">
                                                <div class="mb-3">
                                                    <label for="group" class="form-label">Schedule Time</label>
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="M,d,Y" data-enable-time  placeholder="Enter Of Schedule Time" name="schedule_time" id="schedule_time">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input" id="select_all_user">
                                        <label class="form-check-label" for="select_all_user">Select All</label>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($users as $key =>$user)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="customCheckcolor{{$key+1}}" name="users[]" value="{{$user->id}}">
                                                <label class="form-check-label" for="customCheckcolor{{$key+1}}">{{$user->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
<!-- Quill Editor js -->
<script src="{{asset('assets/vendor/quill/quill.js')}}"></script>
 <!-- Quill Demo js -->
<script src="{{asset('assets/js/components/form-quilljs.js')}}"></script>
<script>
    $("select[name=notification_type]").on("change",function() {
        if($(this).val()=='schedule'){
            $(".schedule_time").removeClass("d-none");
        }else{
            $(".schedule_time").addClass("d-none");
        }
    });

    $("#select_all_user").on('click',function() {
        let checked = $(this).is(":checked");
        if(checked){
           $("input[name='users[]']").prop('checked', checked);
        }else {
            $("input[name='users[]']").prop('checked', checked);
        }
    })

    znotificationForm.onsubmit = async(e)=>{
        try{
            showloader();
            e.preventDefault();
            let formData = new FormData(notificationForm);
            let notificationMessage = quill.root.innerHTML;
            formData.append("notification_message",notificationMessage);
            const response  = await fetch("{{route('admin.notification.store')}}",{
                method:"POST",
                body:formData
            })
            const results = await response.json();
            hideLoader();
            console.log(results);
            if(response.status==422){
                hideLoader();
                toastr.error(results.error)
            }

            if(response.status ==200){
                toastr.success(results.message)
                setTimeout(() => {
                    window.location.href = results.url;
                    hideLoader();
                }, 2000);
            }
        }catch(error) {
            hideLoader();
            toastr.error(error.message);
        }

    }

</script>
@endpush
