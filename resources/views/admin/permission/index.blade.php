@extends('admin.layouts.master')
@push('title')
    Permission List
@endpush
@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Permission List</h4>
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>Add Permission
                        </a>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <h4 class="header-title">Permission List</h4>
                        <table id="permissionList" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Permission Group</th>
                                    <th>Permission Name</th>
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
        $(function() {
            $("#permissionList").DataTable({
                processing: true,
                scrollY: true,
                scrollX: true,
                serverSide: true,
                autoWidth: false,
                scrollCollapse: true,
                bSearchable: true,
                ajax: "{{ route('admin.permissions.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'group',
                        name: 'group'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
