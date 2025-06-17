@extends('admin.layouts.master')
@push('title')
    Accident List
@endpush
@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Accident List</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        {{-- <h4 class="header-title">Accident List</h4> --}}
                        <table id="accidentList" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>User Name</th>
                                    <th>User Type</th>
                                    <th>Accident Date</th>
                                    <th>Accident Time</th>
                                    <th>Who was With You</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div><!-- end row-->
    </div> <!-- container -->
@endsection
@push('script')
    <script>
        var table;
        $(function() {
            table =$("#accidentList").DataTable({
                processing: true,
                scrollY: true,
                scrollX: true,
                serverSide: true,
                autoWidth: false,
                scrollCollapse: true,
                bSearchable: true,
                ajax: "{{ route('admin.accident.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'users.name',
                        name: 'users.name',
                    },
                    {
                        data: 'user_type',
                        name: 'user_type',
                    },
                    {
                        data: 'accident_date',
                        name: 'accident_date',
                    },
                    {
                        data: 'accident_time',
                        name: 'accident_time',
                    },
                    {
                        data: 'who_was_with_you',
                        name: 'who_was_with_you',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        })
    </script>
@endpush
