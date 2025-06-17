@extends('admin.layouts.master')
@push('title')
    Account Deletion Request List
@endpush
@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1"> Account Deletion Request List</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        {{-- <h4 class="header-title"> Account Deletion Request List</h4> --}}
                        <table id="accountDeletionRequestList" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>User Name</th>
                                    <th>Account Delete Reason</th>
                                    <th>Account Delete Request Date</th>
                                   
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
            table =$("#accountDeletionRequestList").DataTable({
                processing: true,
                scrollY: true,
                scrollX: true,
                serverSide: true,
                autoWidth: false,
                scrollCollapse: true,
                bSearchable: true,
                ajax: "{{ route('admin.account.delete.request') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'account_delete_reason.reason',
                        name: 'account_delete_reason.reason',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    }
                ]
            });
        })
    </script>
@endpush
