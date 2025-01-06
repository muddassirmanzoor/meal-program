@extends('layouts.app')
@section('content')
<!-- Datatables css -->
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">FMTS</a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Files Listing</li>

                            </ol>
                        </div>
                        <h4 class="page-title">Files Listing</h4>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row justify-content-end ">
                                <div class="col-3">
                                    <div class="mb-3">
                                    <select name="wing_id" class="form-control select2 wingwise" data-toggle="select2">
                                        <option value="0">All Wings</option>
                                        @foreach(generateDropdown('wings', 'wing_name', ['wing_status'=>1]) as $id=>$wing)
                                            @if(Auth::id()==17 || Auth::id()==18)
                                            <option value="{{ $id }}" {{ $wing_id == $id ? 'selected' : '' }}>
                                                {{ $wing }}
                                            </option>
                                            @else
                                                    @if(Auth::user()->wing_id == $id)
                                                        <option value="{{ $id }}" {{ $wing_id == $id ? 'selected' : '' }}>
                                                            {{ $wing }}
                                                        </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a href="#all" data-bs-toggle="tab" aria-expanded="true" class="nav-link {{$type=='all'? 'active': ''}}">
                                        <i class="mdi mdi-Assigned-variant d-md-none d-block"></i>
                                        <span class="d-none d-md-block">All Files</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#opened" data-bs-toggle="tab" aria-expanded="false" class="nav-link  {{$type=='opened' ? 'active': ''}}">
                                        <i class="mdi mdi-Accepted-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Opened Files</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#archived" data-bs-toggle="tab" aria-expanded="false" class="nav-link {{$type=='archived' ? 'active': ''}}">
                                        <i class="mdi mdi-Accepted-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Archived Files</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#requested" data-bs-toggle="tab" aria-expanded="false" class="nav-link {{$type=='requested' ? 'active': ''}}">
                                        <i class="mdi mdi-Accepted-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Requested Files</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#accepted" data-bs-toggle="tab" aria-expanded="false" class="nav-link {{$type=='accepted' ? 'active': ''}}">
                                        <i class="mdi mdi-Accepted-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Accepted Files</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#assigned" data-bs-toggle="tab" aria-expanded="false" class="nav-link {{$type=='assigned' ? 'active': ''}}">
                                        <i class="mdi mdi-Accepted-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Assigned Files</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#delayed" data-bs-toggle="tab" aria-expanded="false" class="nav-link {{$type=='delayed' ? 'active': ''}}">
                                        <i class="mdi mdi-Accepted-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Deyaled Files</span>
                                    </a>
                                </li>
                                
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane  show active" id="all">
                                    <!---Table---->
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                            <th>Sr#</th>
                                                <th>File No.</th>
                                                <th>Name/Subject</th>
                                                <th>Initiated by</th>
                                                <th>Current Location</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($files as $file)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $file->file_no }}</td>
                                                    <td>{{ $file->subject }}</td>
                                                    <td>{{ $file->file_initiated_by }}</td>
                                                    <td>
                                                        @if($file->file_status=='0')
                                                            CRR
                                                        @else
                                                           
                                                                {{ $file->current_location }}
                                                          
                                                        @endif

                                                    </td>
                                                    <td>@if($file->file_status=='1')
                                                        <span class="badge bg-success">Open</span>
                                                        @elseif($file->file_status>='2')
                                                        <span class="badge bg-warning">Requested</span>

                                                        @else
                                                        <span class="badge bg-danger">Closed</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    <p class="muted mb-0" id="tooltip-container">

                                                        <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                        
                                                    </p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!---Table--->
                                </div>
                                <div class="tab-pane" id="opened">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th>Sr#</th>
                                                    <th>File No.</th>
                                                    <th>Name/Subject</th>
                                                    <th>Initiated by</th>
                                                    <th>Current Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($files as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $file->file_no }}</td>
                                                        <td>{{ $file->subject }}</td>
                                                        <td>{{ $file->file_initiated_by }}</td>
                                                        <td>
                                                            @if($file->file_status=='0')
                                                                CRR
                                                            @else
                                                            
                                                                    {{ $file->current_location }}
                                                            
                                                            @endif

                                                        </td>
                                                        <td>@if($file->file_status=='1')
                                                            <span class="badge bg-success">Open</span>
                                                            @elseif($file->file_status>='2')
                                                            <span class="badge bg-warning">Requested</span>

                                                            @else
                                                            <span class="badge bg-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <p class="muted mb-0" id="tooltip-container">

                                                            <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                            
                                                        </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane" id="archived">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th>Sr#</th>
                                                    <th>File No.</th>
                                                    <th>Name/Subject</th>
                                                    <th>Initiated by</th>
                                                    <th>Current Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($files as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $file->file_no }}</td>
                                                        <td>{{ $file->subject }}</td>
                                                        <td>{{ $file->file_initiated_by }}</td>
                                                        <td>
                                                            @if($file->file_status=='0')
                                                                CRR
                                                            @else
                                                            
                                                                    {{ $file->current_location }}
                                                            
                                                            @endif

                                                        </td>
                                                        <td>@if($file->file_status=='1')
                                                            <span class="badge bg-success">Open</span>
                                                            @elseif($file->file_status>='2')
                                                            <span class="badge bg-warning">Requested</span>

                                                            @else
                                                            <span class="badge bg-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <p class="muted mb-0" id="tooltip-container">

                                                            <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                            
                                                        </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane" id="requested">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th>Sr#</th>
                                                    <th>File No.</th>
                                                    <th>Name/Subject</th>
                                                    <th>Initiated by</th>
                                                    <th>Current Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($files as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $file->file_no }}</td>
                                                        <td>{{ $file->subject }}</td>
                                                        <td>{{ $file->file_initiated_by }}</td>
                                                        <td>
                                                            @if($file->file_status=='0')
                                                                CRR
                                                            @else
                                                            
                                                                    {{ $file->current_location }}
                                                            
                                                            @endif

                                                        </td>
                                                        <td>@if($file->file_status=='1')
                                                            <span class="badge bg-success">Open</span>
                                                            @elseif($file->file_status>='2')
                                                            <span class="badge bg-warning">Requested</span>

                                                            @else
                                                            <span class="badge bg-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <p class="muted mb-0" id="tooltip-container">

                                                            <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                            
                                                        </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane" id="accepted">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th>Sr#</th>
                                                    <th>File No.</th>
                                                    <th>Name/Subject</th>
                                                    <th>Initiated by</th>
                                                    <th>Current Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($files as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $file->file_no }}</td>
                                                        <td>{{ $file->subject }}</td>
                                                        <td>{{ $file->file_initiated_by }}</td>
                                                        <td>
                                                            @if($file->file_status=='0')
                                                                CRR
                                                            @else
                                                            
                                                                    {{ $file->current_location }}
                                                            
                                                            @endif

                                                        </td>
                                                        <td>@if($file->file_status=='1')
                                                            <span class="badge bg-success">Open</span>
                                                            @elseif($file->file_status>='2')
                                                            <span class="badge bg-warning">Requested</span>

                                                            @else
                                                            <span class="badge bg-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <p class="muted mb-0" id="tooltip-container">

                                                            <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                            
                                                        </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane" id="assigned">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th>Sr#</th>
                                                    <th>File No.</th>
                                                    <th>Name/Subject</th>
                                                    <th>Initiated by</th>
                                                    <th>Current Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($files as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $file->file_no }}</td>
                                                        <td>{{ $file->subject }}</td>
                                                        <td>{{ $file->file_initiated_by }}</td>
                                                        <td>
                                                            @if($file->file_status=='0')
                                                                CRR
                                                            @else
                                                            
                                                                    {{ $file->current_location }}
                                                            
                                                            @endif

                                                        </td>
                                                        <td>@if($file->file_status=='1')
                                                            <span class="badge bg-success">Open</span>
                                                            @elseif($file->file_status>='2')
                                                            <span class="badge bg-warning">Requested</span>

                                                            @else
                                                            <span class="badge bg-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <p class="muted mb-0" id="tooltip-container">

                                                            <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                            
                                                        </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <div class="tab-pane" id="delayed">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                <th>Sr#</th>
                                                    <th>File No.</th>
                                                    <th>Name/Subject</th>
                                                    <th>Initiated by</th>
                                                    <th>Current Location</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($files as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $file->file_no }}</td>
                                                        <td>{{ $file->subject }}</td>
                                                        <td>{{ $file->file_initiated_by }}</td>
                                                        <td>
                                                            @if($file->file_status=='0')
                                                                CRR
                                                            @else
                                                            
                                                                    {{ $file->current_location }}
                                                            
                                                            @endif

                                                        </td>
                                                        <td>@if($file->file_status=='1')
                                                            <span class="badge bg-success">Open</span>
                                                            @elseif($file->file_status>='2')
                                                            <span class="badge bg-warning">Requested</span>

                                                            @else
                                                            <span class="badge bg-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        <p class="muted mb-0" id="tooltip-container">

                                                            <a href="{{ route('file-details', ['id' => $file->id]) }}"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>
                                                            
                                                        </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                
                            </div>                                
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            
            



        </div> <!-- container -->

    </div> <!-- content -->



    <!-- Mark File modal -->




<!-- Modal for Success -->

<!-- Datatable Init js -->

<!-- Your existing HTML code -->

<script>
    $(document).ready(function() {
        // Function to load table data via AJAX
        function loadTableData(tab, wing_id = 0) {
        
            $.ajax({
                type: 'GET',
                url: '/get-file-list/' + tab + '/' + wing_id,
                success: function(response) {
                    // Update the table body with the fetched data
                    $('#basic-datatable tbody').html('');
                    $.each(response.data, function(index, file) {
                        $('#basic-datatable tbody').append('<tr>\
                            <td>' + (index + 1) + '</td>\
                            <td>' + file.file_no + '</td>\
                            <td>' + file.subject + '</td>\
                            <td>' + file.file_initiated_by + '</td>\
                            <td>' + (file.file_status == '0' ? 'CRR' : file.current_location) + '</td>\
                            <td>' + getStatusBadge(file.file_status) + '</td>\
                            <td>\
                                <p class="muted mb-0" id="tooltip-container">\
                                    <a href="/file-details/' + file.id + '"><i class="mdi mdi-eye" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" title="File Detail"></i></a>\
                                </p>\
                            </td>\
                        </tr>');
                    });
                },
                error: function(error) {
                    console.error('Error fetching table data:', error);
                }
            });
        }

        // Function to get status badge based on file status
        function getStatusBadge(status) {
            if (status == '1') {
                return '<span class="badge bg-success">Open</span>';
            } else if (status >= '2') {
                return '<span class="badge bg-warning">Requested</span>';
            } else {
                return '<span class="badge bg-danger">Closed</span>';
            }
        }

        // Event handler for tab clicks
        $('ul.nav-tabs li.nav-item a').on('click', function() {
            var tabId = $(this).attr('href').substring(1); // Extract tab ID from href
            var selectedWingId = $('.wingwise').val();
            loadTableData(tabId,selectedWingId);
        });
        $('.wingwise').on('change', function () {
            // Get the active tab
            var activeTab = $('ul.nav-tabs li.nav-item a.active').attr('href').substring(1);
            var selectedWingId = $(this).val();
            // Call the loadTableData function with the active tab as an argument
            loadTableData(activeTab, selectedWingId );
        });

        // Load initial data for the active tab
        //var activeTab = $('ul.nav-tabs li.nav-item a.active').attr('href').substring(1);
        //loadTableData(activeTab);
    });
</script>


@endsection
