@extends('admin.layouts.master')
@push('title')
    Gift Card List
@endpush
@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1"> Gift Card List</h4>
                        <a href="{{route('admin.gift.card.create')}}" class="btn btn-sm btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>Add Gift Card </a>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <table id="accountDeletionRequestList" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Expire At</th>
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
            table =$("#accountDeletionRequestList").DataTable({
                processing: true,
                scrollY: true,
                scrollX: true,
                serverSide: true,
                autoWidth: false,
                scrollCollapse: true,
                bSearchable: true,
                ajax: "{{ route('admin.gift.card.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'gift-card',
                        name: 'gift-card',
                    },
                    {
                        data: 'gift-card-image',
                        name: 'gift-card-image',
                    },
                    {
                        data: 'gift-card-expire_at',
                        name: 'gift-card-expire_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        })
    </script>
@endpush
