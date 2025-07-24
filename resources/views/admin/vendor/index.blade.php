@extends('admin.layouts.master')
@push('title')
    Vendor List
@endpush

@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1">Vendor List</h4>
                        @can('vendor-create')
                            <a href="{{route('admin.vendor.create')}}" class="btn btn-sm btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>Add Vendor
                            </a>
                        @endcan
                    </div><!-- end card header -->
                    <div class="card-body">
                        <table id="clientList" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name of Business</th>
                                    <th>Name of Contact</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
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
        $(document).ready(function() {
            table=$('#clientList').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.vendor.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name_of_business', name: 'name_of_business'},
                    {data: 'name_of_contact', name: 'name_of_contact'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush
