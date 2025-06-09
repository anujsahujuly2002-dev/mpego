@extends('admin.layouts.master')
@push('title')
    User Details
@endpush
@section('content')
 <div class="page-container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bordered mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#car-details-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">
                                    <span class="d-none d-md-inline-block">Car Details</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#car-insurance-info-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                    <span class="d-none d-md-inline-block">Car Insurance Info</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#healthInsurence-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                    <span class="d-none d-md-inline-block">Health Insurance</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#twoService-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                    <span class="d-none d-md-inline-block">Two Service</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#emergencyContact-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                    <span class="d-none d-md-inline-block">Emergency Contact</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="car-details-b1" role="tabpanel">
                               <table id="carDetailList" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Vehicle Make</th>
                                            <th>Model</th>
                                            <th>Color</th>
                                            <th>Vin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="car-insurance-info-b1" role="tabpanel">
                                <table id="carInsurenceInfoList" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Carrier</th>
                                            <th>Policy Number</th>
                                            <th>Agent Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="healthInsurence-b1" role="tabpanel">
                                <table id="healthInsurenceList" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Medi Care</th>
                                            <th>Policy Number</th>
                                            <th>Insurer Name</th>
                                            <th>Insurance Carrier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="twoService-b1" role="tabpanel">
                                <table id="twoServiceList" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Membership Number</th>
                                            <th>Two Contact Info</th>
                                            <th>Emergency Contact First</th>
                                            <th>Emergency Contact Second</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="emergencyContact-b1" role="tabpanel">
                                <table id="emergencyContactList" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Contact Name</th>
                                            <th>Contact Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row-->
    </div> <!-- container -->
@endsection
@push('script')
    <script>
        var carDetailListTable,carInsurenceInfoListTable,healthInsurenceListTable,twoServiceListTable,emergencyContactListTable;
        $(function() {
            carDetailListTable = $("#carDetailList").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.car.details',request()->id) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'make', name: 'make' },
                    { data: 'model', name: 'model' },
                    { data: 'color', name: 'color' },
                    { data: 'vin', name: 'vin' }
                ]
            });

            carInsurenceInfoListTable = $("#carInsurenceInfoList").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.car.insurance.info',request()->id) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'carrier', name: 'carrier' },
                    { data: 'policy_number', name: 'policy_number' },
                    { data: 'agent_name', name: 'agent_name' },
                ]
            });

            healthInsurenceListTable = $("#healthInsurenceList").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.health.insurance.info',request()->id) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'medi_care', name: 'medi_care' },
                    { data: 'policy_number', name: 'policy_number' },
                    { data: 'insurer_name', name: 'insurer_name' },
                    { data: 'insurance_carrier', name: 'insurance_carrier' }
                ]
            });

            twoServiceListTable = $("#twoServiceList").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.two.service.info',request()->id) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'membership_number', name: 'membership_number' },
                    { data: 'tow_contact_info', name: 'tow_contact_info' },
                    { data: 'emergency_contact_1', name: 'emergency_contact_1' },
                    { data: 'emergency_contact_2', name: 'emergency_contact_2' }
                ]
            });

            emergencyContactListTable = $("#emergencyContactList").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.emergency.contact.info',request()->id) }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'emergency_contact_name', name: 'emergency_contact_name' },
                    { data: 'emergency_contact_phone', name: 'emergency_contact_phone' }
                ]
            });
        });
    </script>
@endpush
