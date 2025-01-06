@extends('layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Listing Data</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form>
        <div class="row">
            <div class="col-2">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Districts</label>
                    <select id="districtSelect" class="form-select" name="districtid">
                        <option value="0">Select District</option>
                        @if ($districts->isNotEmpty())
                        @foreach ($districts as $district)
                        <option value="{{ $district->d_id }}">
                            {{ $district->d_name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Tehsils</label>
                    <select id="tehsilSelect" class="form-select">
                        <option value="0">Select Tehsil</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Markaz</label>
                    <select class="form-select" id="markazSelect">
                        <option value="0">Markaz</option>
                    </select>
                </div>
            </div>
            <div class="col-3 d-none">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="example-select" class="form-label">Date</label>
                        <input class="form-control form-date" type="text" id="daterange" name="daterange"
                            value="01/01/2024 - 12/31/2024" />
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="example-select" class="form-label">EMIS - School Name</label>
                    <select id="schoolNameSelect" class="form-select">
                        <option value="0">Select School</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="mb-3">
                    <button class="btn btn-primary mb-2" type="submit"
                        style="background: #07215C;border: 0px;margin-top: 28px;" id="filter_apply">Filter</button>
                </div>
            </div>
        </div>
    </form>
    <!-- end Filter -->
    <!--------- Utilization End---------->
    <!-- end row -->
    <div class="row">
        <div id="data_total">
            @include('report.district_report')
        </div> <!-- end col-->
    </div> <!-- end col-->
    <div class="col-lg-12" id="school_detail">
    </div>
    <!-- end col-->
</div>
<!-- end row -->
</div>
<!-- end demo js-->
<script>
    $(document).ready(function() {
        $('#districtSelect').on('change', function() {
            var districtId = $(this).val();
            fetchTehsilsAndUpdateDropdown(districtId);
        });
        // Function to fetch Tehsils and update dropdown
        function fetchTehsilsAndUpdateDropdown(districtId) {
            console.log(districtId, 'districtId');
            $.ajax({
                url: '/get-tehsils/' + districtId,
                method: 'GET',
                cache: false,
                success: function(data) {
                    var $tehsilSelect = $('#tehsilSelect');

                    // Clear existing options
                    $tehsilSelect.empty().append('<option value="">Select Tehsil</option>');

                    // Populate tehsil select with fetched tehsils
                    $.each(data, function(index, tehsil) {
                        $tehsilSelect.append(new Option(tehsil.t_name, tehsil.t_id));
                    });

                    // Show tehsil select
                    $tehsilSelect.show();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        }
        // Function to fetch Markez and update dropdown
        function fetchMarkezAndUpdateDropdown(tehsilId) {
            $.ajax({
                url: '/get-markaz/' + tehsilId,
                method: 'GET',
                cache: false,
                success: function(data) {
                    var $markezSelect = $('#markazSelect');

                    // Clear existing options
                    $markezSelect.empty().append('<option value="">Select Markaz</option>');

                    // Populate markez select with fetched markez
                    $.each(data, function(index, markez) {
                        $markezSelect.append(new Option(markez.m_name, markez.m_id));
                    });

                    // Show markez select
                    $markezSelect.show();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching markez:', error);
                }
            });
        }

        // Function to fetch Schools and update dropdown
        function fetchSchoolsAndUpdateDropdown(markezId) {
            $.ajax({
                url: '/get-schools/' + markezId,
                method: 'GET',
                cache: false,
                success: function(data) {
                    var $schoolsSelect = $('#schoolNameSelect');

                    // Clear existing options
                    $schoolsSelect.empty().append('<option value="">Select School</option>');

                    // Populate schools select with fetched schools
                    $.each(data, function(index, school) {
                        $schoolsSelect.append(new Option(school.s_emis_code + ' - ' + school
                            .s_name, school.id));
                    });

                    // Show schools select
                    $schoolsSelect.show();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching schools:', error);
                }
            });
        }

        // Handle Tehsil select change
        $('#tehsilSelect').on('change', function() {
            var tehsilId = $(this).val();
            fetchMarkezAndUpdateDropdown(tehsilId);
        });

        $('#markazSelect').on('change', function() {
            var markezId = $(this).val();
            fetchSchoolsAndUpdateDropdown(markezId);
        });

        function fetchData(page) {
            var url = '/detail-report';
            var method = 'POST';

            var districtId = $('#districtSelect').val() || 0; // Default to 0 if not set
            var tehsilId = $('#tehsilSelect').val() || 0; // Default to 0 if not set
            var markazId = $('#markazSelect').val() || 0; // Default to 0 if not set
            var schoolNameId = $('#schoolNameSelect').val() || 0; // Default to 0 if not set
            var daterange = $('#daterange').val() || ''; // Default to empty string if not set

            // Show loader
            $('#blur-background').show();
            $('#loader').show();

            $.ajax({
                url: url,
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: JSON.stringify({
                    districtId: districtId,
                    tehsilId: tehsilId,
                    markazId: markazId,
                    schoolNameId: schoolNameId,
                    daterange: daterange,
                }),
                cache: false,
                success: function(response) {
                    // Hide loader
                    $('#loader').hide();
                    $('#blur-background').hide();
                    // Update district table
                    $('#data_total').html(response);
                },
                error: function(xhr, status, error) {
                    // Hide loader
                    $('#loader').hide();
                    $('#blur-background').hide();

                    // Display error message
                    alert('Error: ' + error);
                }
            });
        }

        $('#filter_apply').on('click', function(e) {
            e.preventDefault();
            fetchData(1);
        });

        // Initialize Select2 and Date Range Picker
        $('.js-example-basic-single').select2();

        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });

        $('.js-example-basic-single').select2();
    });
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });
</script>
@endsection