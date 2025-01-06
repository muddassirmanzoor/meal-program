<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">	
	<link rel="icon" type="image/png" sizes="16x16" href="https://www.pesrp.edu.pk/wp-content/uploads/2023/11/pin.png">
    <meta name="generator" content="Hugo 0.88.1">
	<title>Schools Teachers & Facilities - Punjab</title>
    <!-- Bootstrap core CSS -->
<link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
   
	<link href="{{ asset('/assets/dist/css/select2.min.css')}}" rel="stylesheet" />

	
	<!-- Include jQuery -->
	<script src="{{ asset('/assets/dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/highcharts-3d.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/cylinder.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/funnel3d.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/exporting.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/export-data.js') }}"></script>
<script src="{{ asset('/assets/dist/js/highcharts/accessibility.js') }}"></script>
	<script>
   jQuery(function ($) {
        $('#library').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: 'No of library',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'No. of Libraries'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'No. of Libraries: <b>{point.y:.1f} %</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->library_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->library_1_percentage }}],
				//	['District1', 37.33],
				//	['District2', 31.18],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#computerLab').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'No. of Computer Labs',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'No. of Computer Labs'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'No. of Computer Labs: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->computer_lab_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->computer_lab_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#scienceLab').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'No. of Science Labs',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'No. of Science Labs'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'No. of Science Labs: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->science_lab_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->science_lab_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#toilet').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'No of Toilet',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'No. of Toilets'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'No. of Toilets: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->toilet_facility_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->toilet_facility_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#electricity').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'Electricity',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Electricity'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Electricity: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->electricity_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->electricity_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#boundaryWall').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'Boundary Walls',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Boundary Walls'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Boundary Walls: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->bw_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->bw_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#drinkingWater').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'Drinking Water',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Drinking Water'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Drinking Water: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->dw_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->dw_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#str').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'Student Teacher Ratio',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Student Teacher Ratio'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Student Teacher Ratio: <b>{point.y:.0f}:1</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ round($stat_district_1[0]->s_t_r) }}],
					['{{ $stat_district_2[0]->district_name}}', {{  round($stat_district_2[0]->s_t_r) }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					format: '{point.y:.0f}:1', // one decimal
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#csr').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'Class Student Ratio',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Class Student Ratio'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Class Student Ratio: <b>{point.y:.0f}:1</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ round($stat_district_1[0]->s_c_r) }}],
					['{{ $stat_district_2[0]->district_name}}', {{ round($stat_district_2[0]->s_c_r) }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					format: '{point.y:.0f}:1', // one decimal
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
		$('#playGround').highcharts({
            chart: {
				type: 'column'
			},
			title: {
				text: 'Play Grounds',
				style: {
					display: 'none'
				}
			},
			xAxis: {
				type: 'category',
				labels: {
					autoRotation: [-45, -90],
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Play Grounds'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Play Grounds: <b>{point.y:.1f}%</b>'
			},
			series: [{
				name: 'District',
				colors: ['#c39f3b', '#d3d3d3'],
				colorByPoint: true,
				groupPadding: 0,
				data: [
					['{{ $stat_district_1[0]->district_name}}', {{ $stat_district_1[0]->play_ground_1_percentage }}],
					['{{ $stat_district_2[0]->district_name}}', {{ $stat_district_2[0]->play_ground_1_percentage }}],
				],
				dataLabels: {
					enabled: true,
					color: '#000000',
					inside: true,
					verticalAlign: 'top',
					formatter: function() {
						return this.y.toFixed(1) + '%'; // Round to one decimal point
					},
					y: -20, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textOutline: false
					}
				}
			}]
		});
	});
</script>
  </head>
  <body>
  <!----------------------->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
      <a href="#" title="PESRP PMIU" rel="home" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="/img/Pesrp_pmiu_logo.png" alt="PESRP PMIU" style="width: 100px;">
      </a>
		
      <!--<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
      </ul>-->
		<h2 class="heading-1 col-12 col-md-auto mb-2 justify-content-center mb-md-0">Visual Information System</h2>
      <div class="col-md-3 text-end">
        <button type="button" class="btn btn-outline-primary me-2">Logout</button>
      </div>
    </header>
  </div>
  <!---------main content area start------------>
  <main>
	<section class="position-relative overflow-hidden text-center bg-light hero-area">
		<div class="row">
			<div class="col-md-12 p-lg-12 mx-auto">
				<h1 class="indicator-heading">Punjab Districts Comparison</h1>
				<p class="indicator-sub-heading">POPULAR INDICATORS</p>
				<ul class="list-inline">
					<li class="list-inline-item indicator-box"><a href="#drinkingWater">Drinking Water</a></li>
					<li class="list-inline-item indicator-box"><a href="#electricity">Electricity</a></li>
					<li class="list-inline-item indicator-box"><a href="#toilet">Toilet</a></li>
					<li class="list-inline-item indicator-box"><a href="#boundaryWall">Boundary Walls</a></li>					
					<li class="list-inline-item indicator-box"><a href="#playGround">Play Grounds</a></li>
					<li class="list-inline-item indicator-box"><a href="#str">STR</a></li>
					<li class="list-inline-item indicator-box"><a href="#indicator-label">CSR</a></li>
				</ul>
			</div>	
		</div>
    </section>
	<section class="filter-wrapper">
		<div class="container">
		<form class="filter-action border-radius-xl" action="{{ route('district-comparison') }}" method="POST">
			@csrf
			<div class="row">
			<div class="form-group col-lg-5 col-md-6  mb-2">
					<select name="district1" class="w-100 form-control mt-lg-1 mt-md-2 form-select" required>
					<option value="">Select First District</option>
						<!-- Populate options dynamically from database -->
						@foreach($districts as $district)
						
							<option value="{{ $district->s_district_idFk }}" <?php if($district1 == $district->s_district_idFk) { echo "selected"; } ?>>{{ $district->d_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-lg-5 col-md-6  mb-2">
					<select name="district2" class="w-100 form-control mt-lg-1 mt-md-2 form-select" required>
					<option value="">Select Second District</option>
						<!-- Populate options dynamically from database -->
						@foreach($districts as $district)
						
							<option value="{{ $district->s_district_idFk }}" <?php if($district2 == $district->s_district_idFk) { echo "selected"; } ?>>{{ $district->d_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-xl-2 col-lg-3 col-md-6  mb-2 align-self-center">
					<button type="submit" class="btn btn-primary active w-100" style="background: #28416f;border: 0px;margin-top: 10px;float:right;">Comparison</button>
				</div>
			</div><!---Row End----->
		</form>
		</section>
		<section class="demographic-wrapper">
		<div class="container">	
			<div class="row mt-4 mb-4 after-hero-box-row"> <!----Row Start----->
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-header p-3 pt-2">
							<div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10"><img class="demographic-icon" src="./assets/images/school.png" alt="Generic placeholder image" width="60" height="auto"></i>
							</div>
							<div class="text-end pt-1">
								<p class="text-sm mb-0 text-capitalize">Total Schools</p>
								<h4 class="mb-0 district-label-name">{{  ucwords(strtolower($stat_district_1[0]->district_name)) }}: {{ $stat_district_1[0]->total_schools }}</h4>
								<h4 class="mb-0 district-label-name">{{  ucwords(strtolower($stat_district_2[0]->district_name)) }}: {{ $stat_district_2[0]->total_schools }}</h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-header p-3 pt-2">
							<div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10"><img class="demographic-icon" src="./assets/images/enrollment.png" alt="Generic placeholder image" width="60" height="auto"></i>
							</div>
							<div class="text-end pt-1">
								<p class="text-sm mb-0 text-capitalize">Total Enrollment</p>
								<h4 class="mb-0 district-label-name">{{  ucwords(strtolower($stat_district_1[0]->district_name)) }}: {{ $stat_district_1[0]->t_students }}</h4>
								<h4 class="mb-0 district-label-name">{{  ucwords(strtolower($stat_district_2[0]->district_name)) }}: {{ $stat_district_2[0]->t_students }}</h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-header p-3 pt-2">
							<div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10"><img class="demographic-icon" src="./assets/images/teacher.png" alt="Generic placeholder image" width="60" height="auto"></i>
							</div>
							<div class="text-end pt-1">
								<p class="text-sm mb-0 text-capitalize">Total Teachers</p>
								<h4 class="mb-0 district-label-name">{{  ucwords(strtolower($stat_district_1[0]->district_name)) }}: {{ $stat_district_1[0]->total_teachers }}</h4>
								<h4 class="mb-0 district-label-name">{{  ucwords(strtolower($stat_district_2[0]->district_name)) }}: {{ $stat_district_2[0]->total_teachers }}</h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<div class="card-header p-3 pt-2">
							<div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10"><img class="demographic-icon" src="./assets/images/classroom.png" alt="Generic placeholder image" width="60" height="auto"></i>
							</div>
							<div class="text-end pt-1">
								<p class="text-sm mb-0 text-capitalize">Total Class Rooms</p>
								<h4 class="mb-0 district-label-name">{{ ucwords(strtolower($stat_district_1[0]->district_name)) }}: {{ $stat_district_1[0]->total_classrooms }}</h4>
								<h4 class="mb-0 district-label-name">{{ ucwords(strtolower($stat_district_2[0]->district_name)) }}: {{ $stat_district_2[0]->total_classrooms }}</h4>
							</div>
						</div>
					</div>
				</div>
			</div><!----Row End----->			
			<div class="row mt-4 mb-4"><!----Row Star----->				
				<div class="col-xl-6 col-lg-6 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/count-teacher-icon.png" class="card-img-top card-image" alt="..."></span><span class="indicator-label">   School Count Teachers wise in {{ ucwords(strtolower($stat_district_1[0]->district_name)) }}</span></h5>
						</div>
						<div class="card-body">
							<div class="row"><!----Row Star----->				
								<!-- <div class="col-md-12"><div class="count-teacter-wrapper"><div class="batch-icon-label">> 3 Teachers</div><div class="batch-icon-bg">800</div><div class="teacher-image"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"></div></div></div> -->
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district1 . '/more') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">More than two Teachers</div>
										<div class="batch-icon-bg">{{ $stat_district_1[0]->more_than_two_teachers }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg">
											<span>{{ $stat_district_1[0]->more_than_two_teachers_enrollments }}</span>
										</div>
										<div class=""></div>
									</a>
								</div>
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district1 . '/two') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">Two Teachers</div>
										<div class="batch-icon-bg">{{ $stat_district_1[0]->two_teachers }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg">
											<span>{{ $stat_district_1[0]->two_teachers_enrollments }}</span>
										</div>
										
									</a>
								</div>
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district1 . '/one') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">One Teacher</div>
										<div class="batch-icon-bg">{{ $stat_district_1[0]->one_teacher }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg">
											<span>{{ $stat_district_1[0]->one_teacher_enrollments }}</span>
										</div>
										
									</a>
								</div>
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district1 . '/zero') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">Zero Teacher</div>
										<div class="batch-icon-bg">{{ $stat_district_1[0]->zero_teacher }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg">
											<span>{{ $stat_district_1[0]->zero_teacher_enrollments }}</span>
										</div>
										
									</a>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/count-teacher-icon.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label">  School Count Teachers wise in {{ ucwords(strtolower($stat_district_2[0]->district_name)) }}</span></h5>
						</div>
						<div class="card-body">
							<div class="row"><!----Row Star----->				
							<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district2 . '/more') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">More than two Teachers</div>
										<div class="batch-icon-bg">{{ $stat_district_2[0]->more_than_two_teachers }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg">
											<span >{{ $stat_district_2[0]->more_than_two_teachers_enrollments }}</span >
										</div>
										
									</a>
								</div>
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district2 . '/two') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">Two Teachers</div>
										<div class="batch-icon-bg">{{ $stat_district_2[0]->two_teachers }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg">
											<span >{{ $stat_district_2[0]->two_teachers_enrollments }}</span>
										</div>
										
									</a>
								</div>
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district2 . '/one') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">One Teacher</div>
										<div class="batch-icon-bg">{{ $stat_district_2[0]->one_teacher }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/yes-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg">
											<span>{{ $stat_district_2[0]->one_teacher_enrollments }}</span>
										</div>
										
									</a>
								</div>
								<div class="col-md-12">
									<a href="{{ url('/teachers-school-wise/' . $district2 . '/zero') }}" class="count-teacter-wrapper">
										<div class="batch-icon-label">Zero Teacher</div>
										<div class="batch-icon-bg">{{ $stat_district_2[0]->zero_teacher }}</div>
										<div class="teacher-image">
											<img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg"><img class="teacher-image-placeholder" src="./assets/images/no-teacher-icon.svg">
											<span >{{ $stat_district_2[0]->zero_teacher_enrollments }}</span>
										</div>
										
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/glass-of-water.png" class="card-img-top card-image" alt="..."></span><span class="indicator-label">  Drinking Water</span></h5>
						</div>
						<div class="card-body">
							<div id="drinkingWater" style="height:300px"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/bulb.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Electricity</span></h5>
						</div>
						<div class="card-body">
							<div id="electricity" style="height:300px"></div>
						</div>
					</div>
				</div>				
				<div class="col-xl-3 col-lg-3 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/toilet.png" class="card-img-top card-image" alt="..."></span><span class="indicator-label">  Toilet</span></h5>
						</div>
						<div class="card-body">
							<div id="toilet" style="height:300px"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/boundary-wall.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Boundary Wall</span></h5>
						</div>
						<div class="card-body">
							<div id="boundaryWall" style="height:300px"></div>
						</div>
					</div>
				</div>				
				<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/science-lab.png" class="card-img-top card-image" alt="..."></span><span class="indicator-label">  Science Lab</span></h5>
						</div>
						<div class="card-body">
							<div id="scienceLab" style="height:300px"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/computer-lab.jpg" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Computer Lab</span></h5>
						</div>
						<div class="card-body">
							<div id="computerLab" style="height:300px"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/library.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Library</span></h5>
						</div>
						<div class="card-body">
							<div id="library" style="height:300px"></div>
						</div>
					</div>
				</div>
				<!--------Ratio Graph Start---------->
				<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/playground.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Play Ground</span></h5>
						</div>
						<div class="card-body">
							<div id="playGround" style="height:300px"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/str.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Student Teacher Ratio</span></h5>
						</div>
						<div class="card-body">
							<div id="str" style="height:300px"></div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
					<div class="card">				 
						<div class="card-header">					
							<h5 class="card-title"><span class="ml-1"><img src="./assets/images/csr.png" class="card-img-top card-image" alt="..."></span> <span class="indicator-label"> Class Student Ratio</span></h5>
						</div>
						<div class="card-body">
							<div id="csr" style="height:300px"></div>
						</div>
					</div>
				</div>
				<!--------Ratio Graph END---------->					
			</div><!----Row End----->
		</div>
	</section>
  </main>
  <footer class="pt-2 text-center" style="color: #ffffff !important;background: #04578F;line-height: 2;">
    Copyright © Designed & Developed by PMIU Data Center 2024
  </footer>


  <script src="{{ asset('/assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script>
 
</script>
      
  </body>
</html>
