@extends('layouts.app')

@section('content')
<div class="container-fluid">

                        <!-- start page title -->
                       
                        <!-- end page title -->       
                                             
                        <form id="filterForm" method="POST" action="{{ route('dashboard') }}">  
                            @csrf
                            <div class="row">                              
                                <div class="col-3 filter-box-col">
                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Districts</label>
                                        <select id="districtSelect" class="form-select" name="districtid">
                                            <option value="0">Select District</option>
                                            @if ($districts->isNotEmpty())
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->d_id }}" {{ $district_id == $district->d_id ? 'selected' : '' }}>
                                                {{ $district->d_name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>                            
                                </div>  
                                <div class="col-3 filter-box-col">
                                    <div class="mb-3">
                                        <label for="tehsilSelect" class="form-label">Tehsils</label>
                                        <select id="tehsilSelect" class="form-select" name="tehsilid">
                                            <option value="">Select Tehsil</option>
                                            @forelse ($tehsils as $tehsil)
                                                <option value="{{ $tehsil->t_id }}" {{ $tehsil_id == $tehsil->t_id ? 'selected' : '' }}>
                                                    {{ $tehsil->t_name }}
                                                </option>
                                            @empty
                                                <option value="">No Tehsils Available</option>
                                            @endforelse
                                        </select>
                                    </div>                            
                                </div>

                                <div class="col-3 filter-box-col">
                                    <div class="mb-3">
                                        <label for="markazSelect" class="form-label">Markaz</label>
                                        <select class="form-select" id="markazSelect" name="markazid">
                                            <option value="">Select Markaz</option>
                                            @forelse ($markazes as $markaz)
                                                <option value="{{ $markaz->m_id }}" {{ $markaz_id == $markaz->m_id ? 'selected' : '' }}>
                                                    {{ $markaz->m_name }}
                                                </option>
                                            @empty
                                                <option value="">No Markaz Available</option>
                                            @endforelse
                                        </select>
                                    </div>                            
                                </div>

                                <div class="col-3 filter-box-col">
                                    <div class="mb-3">
                                        <label for="markazSelect" class="form-label">School</label>
                                        <select class="form-select" id="schoolNameSelect" name="schoolemis">
                                            <option value="">Select School</option>
                                           
                                        </select>
                                    </div>                            
                                </div>

                                <div class="col-3 filter-box-col">
                                    <div class="mb-3">
                                    <label for="example-select" class="form-label"></label>
                                        <button class="btn btn-primary mb-2 w-100" type="submit" style="background: #28416f;border: 0px;margin-top: 30px;float:right;">Submit</button> 
                                    </div>                            
                                </div>
                               
                                
                            </div>                        
                        </form>
                        <!-- end Filter -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title stat-boxes-heading">Overall Stats</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/school.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Customers">Total Schools</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_schools[0]->total_schools == '' ? '0': $total_schools[0]->total_schools)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-3">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/enroll.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Total Enrollments</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_enrollments[0]->total_enrollment == '' ? '0': $total_enrollments[0]->total_enrollment)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/school.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Customers">No Consumption Schools</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($no_consumption_schools[0]->no_consumption_schools == '' ? '0': $no_consumption_schools[0]->no_consumption_schools)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/school.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Customers">No Inventory Recieved Schools</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($metro_pending_delivery_schools[0]->metro_pending_delivery_schools == '' ? '0': $metro_pending_delivery_schools[0]->metro_pending_delivery_schools)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/boxes.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Delivered by Metro</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($metro_delivered_inventory[0]->metro_delivered_inventory == '' ? '0': $metro_delivered_inventory[0]->metro_delivered_inventory)}}</h3>
                                            </div> 
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/boxes.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Received by Schools</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_inventory_received[0]->total_quantity_received == '' ? '0': $total_inventory_received[0]->total_quantity_received)}}</h3>
                                            </div> 
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->  
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/consumption.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Total Consumption</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_consumed[0]->total_consumed == '' ? '0': $total_consumed[0]->total_consumed)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->                             
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/remaining.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Remaining Balance</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_inventory_received[0]->total_quantity_received - $total_consumed[0]->total_consumed) }}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col--> 
                                </div> <!-- end row -->
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title stat-boxes-heading">Daily Stats</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/school.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Customers">Packs Dispatched By Metro</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($metro_dispatch_today[0]->metro_dispatch_today == '' ? '0': $metro_dispatch_today[0]->metro_dispatch_today)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-3">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/enroll.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Packs Received By Schools</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_quantity_received_today[0]->total_quantity_received_today == '' ? '0': $total_quantity_received_today[0]->total_quantity_received_today)}}</h3>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/boxes.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Packs Consumed by Schools</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($total_consumed_today[0]->total_consumed_today == '' ? '0': $total_consumed_today[0]->total_consumed_today)}}</h3>
                                            </div> 
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    <div class="col-lg-3 ">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <span class="widget-icon">
                                                        <img src="assets/images/boxes.png" alt="" height="32">
                                                    </span>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0 dashboard-card-heading" title="Number of Orders">Schools with No Consumption</h5>
                                                <h3 class="mt-3 mb-3">{{number_format($no_consumption_schools_today[0]->no_consumption_schools_today == '' ? '0': $no_consumption_schools_today[0]->no_consumption_schools_today)}}</h3>
                                            </div> 
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                    
                                                                
                                    <!-- end col--> 
                                </div> <!-- end row -->
                            </div> <!-- end col -->
                        </div>
                        <!---------Inventory Start---------->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">                                     
                                        <h4 class="header-title mb-3">Inventory Utilization</h4>        
                                        <div id="inventoryUtilization1"></div>
                                            
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!---------Inventory End---------->
                         <!---------Inventory Start---------->
                         <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">                                     
                                        <!-- <h4 class="header-title mb-3">School Mapped</h4>  
                                       
                                        <div class="col-md-12 mb-3">
                                            <div id="map1"></div>
                                        </div> -->
                                            
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!---------Inventory End---------->
                        <!-- end row -->
                    </div>

    
   
<script>
// Apply Select2 to your select element
//   $(document).ready(function() {
//     $('#district').select2();
// 	$('#tehsil').select2();
// 	$('#markez').select2();
// 	$('#s_type').select2();
// 	$('#s_level').select2();
//   });
$(document).ready(function() {
    $('#school').select2();


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
                            .school_name, school.id));
                    });

                    // Show schools select
                    $schoolsSelect.show();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching schools:', error);
                }
            });
        }



        $('#tehsilSelect').on('change', function() {
            var tehsilId = $(this).val();
            fetchMarkezAndUpdateDropdown(tehsilId);
        });

        $('#markazSelect').on('change', function() {
            var markezId = $(this).val();
            fetchSchoolsAndUpdateDropdown(markezId);
        });

});
function showTooltip() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.style.visibility = "visible";
    tooltip.style.opacity = "1";
    // You can perform any other actions here when the tooltip is clicked
}
</script>
<script type="text/javascript">
        // Get the data from the Blade view
        var districtGraphData = @json($district_graph);

        // Prepare arrays to hold chart data
        var categories = [];
        var inventoryData = [];
        var utilizationData = [];
        var balanceData = [];

        // Process data to extract chart values
        districtGraphData.forEach(function(item) {
            categories.push(item.d_name); // District names for x-axis
            inventoryData.push(parseFloat(item.total_quantity_received)); // Inventory data
            utilizationData.push(parseFloat(item.total_consumed)); // Utilization data
            balanceData.push(parseFloat(item.total_quantity_received) - parseFloat(item.total_consumed)); // Balance
        });

        // Create the Highcharts chart
        Highcharts.chart('inventoryUtilization1', {
            chart: {
                type: 'column'
            },
            colors: ['#07215C ', '#fd9639', '#C0C0C0'],
            title: {
                text: 'Districts Wise Inventory Vs Utilization',
                align: 'left',
                style: {
                    display: 'none'
                }
            },
            xAxis: {
                categories: categories,
                crosshair: true,
                accessibility: {
                    description: 'Districts'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Units'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'Inventory',
                    data: inventoryData
                },
                {
                    name: 'Utilization',
                    data: utilizationData
                },
                {
                    name: 'Remaining Balance',
                    data: balanceData
                }
            ]
        });
    </script> 
   


@endsection
