@extends('admin.layouts.master')
@push('title')
    Permission List
@endpush
@section('content')
      <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1">Permission List</h4>
                                <a href="{{route('admin.permissions.create')}}" class="btn btn-sm btn-primary">
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>Add Permission
                                </a>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="table-gridjs"></div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
@endsection
@push('script')
    <script>
        new gridjs.Grid({
            columns: [
                {
                    name: "ID",
                    width: "80px",
                    formatter: function (e) {
                        return gridjs.html(
                            '<span class="fw-semibold">' + e + "</span>"
                        );
                    },
                },
                { name: "Name", width: "150px" },
                {
                    name: "Email",
                    width: "220px",
                    formatter: function (e) {
                        return gridjs.html('<a href="">' + e + "</a>");
                    },
                },
                { name: "Position", width: "250px" },
                { name: "Company", width: "180px" },
                { name: "Country", width: "180px" },
            ],
            pagination: { limit: 10},
            sort: !0,
            search: !0,
            data: [
                ["11", "John", "john@example.com", "Developer", "ABC Corp", "USA"],
                ["12", "Jane", "jane@example.com", "Designer", "XYZ Inc", "Canada"],
                [
                    "13",
                    "Alice",
                    "alice@example.com",
                    "Manager",
                    "123 Company",
                    "Australia",
                ],
                ["14", "Bob", "bob@example.com", "Engineer", "456 Ltd", "UK"],
                [
                    "15",
                    "Eve",
                    "eve@example.com",
                    "Analyst",
                    "789 Enterprises",
                    "France",
                ],
                [
                    "16",
                    "Charlie",
                    "charlie@example.com",
                    "Consultant",
                    "Hello World",
                    "Germany",
                ],
                [
                    "17",
                    "David",
                    "david@example.com",
                    "Architect",
                    "Goodbye World",
                    "Japan",
                ],
                ["18", "Grace", "grace@example.com", "Programmer", "Foo Bar", "China"],
                [
                    "19",
                    "Heather",
                    "heather@example.com",
                    "Supervisor",
                    "Baz Qux",
                    "Brazil",
                ],
                [
                    "20",
                    "Isaac",
                    "isaac@example.com",
                    "Administrator",
                    "Fizz Buzz",
                    "India",
                ],
            ],
        }).render(document.getElementById("table-gridjs"))
    </script>
@endpush