<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<link rel="icon" type="image/png" sizes="16x16" href="https://www.pesrp.edu.pk/wp-content/uploads/2023/11/pin.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&display=swap" rel="stylesheet">
    
    <title>Visual Information System - Punjab</title>

    <!-- Bootstrap core CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" />
	<!-- Include jQuery -->
	<script src="{{ asset('/js/jquery.min.js') }}"></script>
	<!-- Include Select2 JavaScript -->
	<script src="{{ asset('/js/select2.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>
    
<!--<div class="col-lg-10 mx-auto app-main-wrapper">-->
<!----------------------->
<div class="container p-0">
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
        <a href="{{ url('logout') }}" type="button" class="btn btn-outline-primary"  >Logout</a>
      </div>
    </header>
  </div>
  <!--------------------->

  <main>
		<section class="position-relative overflow-hidden text-center bg-light hero-area-map">
		<div class="row">
			<div class="col-md-12 p-lg-12 mx-auto">
				<h1 class="indicator-heading">Punjab Schools : Teachers & Facilities</h1>
			</div>	
		</div>
    </section>	
	<section class="filter-wrapper">
		<div class="container">
		<div class="row align-items-center justify-content-between pt-3 pb-3">
			
			<div class="col-md-12 mobile-btn-location">
				<button class="btn btn-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="background: #28416f;border: 0px;margin-top: 10px;float:right;">
					<i class="fa fa-filter" aria-hidden="true"></i> Filters
				</button>
			</div>
	   </div>
		<!--<div class="row">
			<div class="col-md-12">
				<h1 class="app-name-title">Punjab Schools : Teachers &amp; Facilities</h1>
			</div>
	   </div>-->
	   
	<div class="collapse" id="collapseExample">
	   <form id="filterForm" method="POST" action="{{ route('get-schools') }}">
            @csrf
			<div class="row">
					<div class="col-md-3 mb-2">
					<label for="District" class="form-label">District</label>
					<select class="form-select" id="district" name="district" >
						<option value="">All Punjab</option>
						<!-- Populate options dynamically from database -->
						@foreach($districts as $district)
						
							<option value="{{ $district->s_district_idFk }}" <?php if($districtId == $district->s_district_idFk) { echo "selected"; } ?>>{{ $district->d_name }}</option>
						@endforeach
					</select>
					</div>
					<div class="col-md-3 mb-2 ">
					<label for="Tehsils" class="form-label">Tehsil</label>
					<select class="form-select" id="tehsil" name="tehsil" >
							<option value="">Select Tehsil</option>
							@if($tehsils)
                                @foreach($tehsils as $tehsil)                          
                                    <option value="{{ $tehsil->s_tehsil_idFk }}" <?php if($tehsilId == $tehsil->s_tehsil_idFk) { echo "selected"; } ?>>{{ $tehsil->t_name }}</option>
                                @endforeach
                            @endif
					</select>
					</div>
					<div class="col-md-3 mb-2">
					<label for="Marakez" class="form-label">Markaz</label>
					<select class="form-select" id="markaz" name="markaz">
						<option value="">Select Markaz</option>
                        @if($markazes)
                            @foreach($markazes as $markaz)                          
                                <option value="{{ $markaz->s_markaz_idFk }}" <?php if($markazId == $markaz->s_markaz_idFk) { echo "selected"; } ?>>{{ $markaz->m_name }}</option>
                            @endforeach
                        @endif
					</select>
					</div>			
					<div class="col-md-3 mb-2">
					<label for="School_level" class="form-label">School Type</label>
					<select class="form-select" id="s_type" name="s_type" >
						<option value="">Select Gender</option>
						<option value="Male"<?php if($s_type =="Male") { echo "selected"; } ?>>Male</option>
						<option value="Female" <?php if($s_type =="Female") { echo "selected"; } ?>>Female</option>
					</select>
					</div>
					<div class="col-md-3 mb-2">
					<label for="Gender" class="form-label">School Level</label>
					<select class="form-select"  id="s_level" name="s_level" >
							<option value="">Select Level</option>
							<option value="Primary" <?php if($s_level =="Primary") { echo "selected"; } ?>>Primary</option>
							<!-- <option value="sMosque">sMosque</option> -->
							<option value="Middle" <?php if($s_level =="Middle") { echo "selected"; } ?>>Middle</option>
							<option value="High" <?php if($s_level == "High") { echo "selected"; } ?>>High</option>
                            <option value="H.Sec." <?php if($s_level =="H.Sec.") { echo "selected"; } ?>>Higher Secondary</option>
					</select>
					</div>
					<div class="col-md-3 mb-2">
					<label for="Gender" class="form-label">No. Of Teachers</label>
					<select class="form-select"  id="teachers" name="teachers" >
							<option value="">Select Teachers</option>
							<option value="0"  <?php if($teachers == "0") { echo "selected"; } ?>>Zero Teacher</option>
							<option value="1" <?php if($teachers =="1") { echo "selected"; } ?>>Single Teacher</option>
							<option value="2" <?php if($teachers =="2") { echo "selected"; } ?>>Two Teachers</option>
							
					</select>
					</div>
                    <div class="col-md-6 mb-2">
					<label for="Gender" class="form-label">School</label><br>
					<select class="form-select select2-w-100"  id="school" name="school" style="width: 100%;">
                        <option value="">Select School</option>
                        @if($schools)
                            @foreach($schools as $school)                          
                                <option value="{{ $school->id }}" <?php if($schoolId == $school->id) { echo "selected"; } ?>>{{ $school->s_emis_code }} || {{ $school->s_name }}  </option>
                            @endforeach
                        @endif
							
					</select>
					</div>
					<div class="col-md-12 text-right">
                   
					 <button class="btn btn-primary mb-2" type="submit" style="background: #28416f;border: 0px;margin-top: 10px;float:right;">Submit</button> 
                    <a href="{{ url('show-map') }}" class="btn btn-danger mb-2 mr-3" style="border: 0px;margin-top: 10px;float:right;margin-right: 10px;">Reset </a>
					</div>
					
			</div>
		</form>
	</div>
	   <div class="row">
			
			<div class="col-md-12 mb-2">
				<h4 class="school-count">No. Of Schools: <span class="school-count-value">{{count($schools)}}</span></h4>								
			</div>
			<div class="col-md-12 mb-3">
				<div id="map"></div>
			</div>
	   </div>
	  
		</div>
		</section>


  </main>
  <footer class="pt-2 text-center" style="color: #ffffff !important;background: #04578F;line-height: 2;">
    Copyright © Designed & Developed by PMIU Data Center 2024
  </footer>
<!--</div>-->
<script type="text/javascript">
    function initMap() {
        const districts = {!! json_encode($districts) !!};
        console.log( districts); 
        const districtId = parseInt(document.getElementById('district').value, 10);
       
        const selectedDistrict = districts.find(district => district.s_district_idFk === districtId);

        let center, zoom;

        // Set center and zoom level based on selected district or default values
        if (selectedDistrict) {
            const latitude = parseFloat(selectedDistrict.lat);
            const longitude = parseFloat(selectedDistrict.long);

            if (!isNaN(latitude) && !isNaN(longitude)) {
                center = { lat: latitude, lng: longitude };
                zoom = 10;
            } else {
                // Handle case where latitude or longitude is not a number
                // Set default center and zoom
                center = { lat: 31.1704, lng: 72.7097 };
                zoom = 7;
            }
        } else {
            // Handle case where selected district is not found
            // Set default center and zoom
            center = { lat: 31.1704, lng: 72.7097 };
            zoom = 7;
        }

        // Initialize map with dynamic center and zoom
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: zoom,
            center: center,
        });
        console.log('Type of districtId:', typeof districtId);
console.log('Type of s_district_idFk:', typeof districts[0].s_district_idFk);
        console.log('Selected District:', selectedDistrict);
        console.log('District ID:', districtId);
        console.log('Center:', center);
        console.log('Zoom:', zoom);

        const markerIcons = {
        'Male Primary': '/img/pins/male-p.png',
        'Male sMosque': '/img/pins/male-p.png',
        'Female Primary': '/img/pins/female-p.png',
        'Male Middle': '/img/pins/male-md.png',
        'Female Middle': '/img/pins/female-md.png',
        'Male High': '/img/pins/male-h.png',
        'Female High': '/img/pins/female-h.png',
        'Male H.Sec.': '/img/pins/male-hs.png',
        'Female H.Sec.': '/img/pins/female-hs.png',
        };

        // Create legends panel
        const legendsPanel = document.createElement('div');
        legendsPanel.classList.add('legends-panel');
        legendsPanel.innerHTML = `
            <div><img src="/img/pins/male-p.png"> Boys Primary</div>
            <div><img src="/img/pins/female-p.png"> Girls Primary</div>
            <div><img src="/img/pins/male-md.png"> Boys Middle</div>
            <div><img src="/img/pins/female-md.png"> Girls Middle</div>
            <div><img src="/img/pins/male-h.png"> Boys High</div>
            <div><img src="/img/pins/female-h.png"> Girls High</div>
            <div><img src="/img/pins/male-hs.png"> Boys H.Sec.</div>
            <div><img src="/img/pins/female-hs.png"> Girls H.Sec.</div>
        `;

        // Append toggle button and legends panel to map
        //map.controls[google.maps.ControlPosition.RIGHT_TOP].push(toggleButton);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legendsPanel);
        
        





        // Get schools data passed from the controller
        const schools = {!! json_encode($schools) !!};
        let openInfoWindow = null;
        // Loop through schools data and add markers to the map
        schools.forEach(function(school) {
            const markerIcon = markerIcons[`${school.s_type} ${school.s_level}`];

            const marker = new google.maps.Marker({
                position: { lat: parseFloat(school.s_lat), lng: parseFloat(school.s_lng) },
                map: map,
                title: school.s_name,
                icon: markerIcon
            });

            // Add info window to the marker
            const infoWindow = new google.maps.InfoWindow({
                content: createInfoWindowContent(school)
            });

            // Show info window when marker is clicked
            marker.addListener('click', function() {
                if (openInfoWindow !== null) {
                    openInfoWindow.close();
                }
                infoWindow.open(map, marker);
                openInfoWindow = infoWindow;
            });
        });

        // Attach event listeners outside the loop
        attachEventListeners();
            
    }

    function createInfoWindowContent(school) {
       return '<div class="school-info-map-wrapper"><table class="table table-bordered table-striped ">' +
                            '<tr style="background: #04578f !important;color: #ffffff !important;"><td colspan="4"><h4 class="school-name-heading">'+ school.s_emis_code + ' - ' +  school.s_name + '</h4></td></tr>' +
                            '<tr><td class="school-info-title">District</td><td class="school-info-vaule">' + school.d_name + '</td>' +
                            '<td class="school-info-title">Tehsil</td><td class="school-info-vaule">' + school.t_name + '</td></tr>' +
                            '<tr><td class="school-info-title">Markaz</td><td class="school-info-vaule">' + school.m_name + '</td>' +
                            '<td class="school-info-title">Gender</td><td class="school-info-vaule">' + school.s_type + '</td></tr>' +
                            '<tr><td class="school-info-title">Level</td><td class="school-info-vaule">' + school.s_level + '</td>' +
                            '<td class="school-info-title">No. of Teachers</td><td class="school-info-vaule">' + school.no_of_teachers + '</td></tr>' +
                            '<tr><td class="school-info-title">No. of Students</td><td class="school-info-vaule">' + school.total_students + '</td>' +
                            '<td class="school-info-title">Student to Teacher Ratio (40:1 recommended)</td><td class="school-info-vaule">'  + (Math.round(school.total_students / school.no_of_teachers) > 40 ? '<span style="color:red;">' + Math.round(school.total_students / school.no_of_teachers) + ':1</span>' : Math.round(school.total_students / school.no_of_teachers) + ':1') +  '</td></tr>' +
                            '<tr style="background: #04578f !important;color: #ffffff !important;"><td colspan="4"><h4 class="school-facility-heading"> Available Facilities </h4></td></tr>' +
                            '<tr><td class="school-info-title">Electricity</td><td class="school-info-vaule">' + (school.electricity == 1 ? 'Yes' : '<span style="color:red;">No</span>') + '</td>' +
                            '<td class="school-info-title">Drinking Water</td><td class="school-info-vaule">' + (school.dw == 1 ? 'Yes' : '<span style="color:red;">No</span>') + '</td></tr>' +
                            '<tr><td class="school-info-title">Toilets</td><td class="school-info-vaule">' + (school.toilet_facility == 1 ? 'Yes (Total: '+ school.total_toilets +', Usable: '+ school.usable_toilets +')' : '<span style="color:red;">No</span>') + '</td>' +
                            '<td class="school-info-title">Boundary Wall</td><td class="school-info-vaule">' + (school.bw == 1 ? 'Yes' : '<span style="color:red;">No</span>') + '</td></tr>' +
                            '<tr><td class="school-info-title">Functional Classrooms</td><td class="school-info-vaule">' + school.functional_classrooms + '</td>' +
                            '<td class="school-info-title">Science Lab</td><td class="school-info-vaule">' + (school.science_lab == 1 ? 'Yes' : '<span style="color:red;">No</span>') + '</td></tr>' +
                            '<tr><td class="school-info-title">Library</td><td class="school-info-vaule">' + (school.library == 1 ? 'Yes' : '<span style="color:red;">No</span>') + '</td>' +
                            '<td class="school-info-title">Computer Lab</td><td class="school-info-vaule">' + (school.computer_lab == 1 ? 'Yes (Functional Computers: '+ school.functional_computers +')' : '<span style="color:red;">No</span>') + '</td></tr>' +
                            '<tr><td class="school-info-title">Play Ground</td><td class="school-info-vaule">' + (school.play_ground == 1 ? 'Yes' : '<span style="color:red;">No</span>') + '</td>' +
                            '<td class="school-info-title">Total Area</td><td class="school-info-vaule">' + school.area  + '</td></tr>' +
                        '</table></div>';
    }

    function attachEventListeners() {
    // Toggle button
       

        // Legends panel
        const legendsPanel = document.createElement('div');
        legendsPanel.classList.add('legends-panel');
        legendsPanel.innerHTML = `
            <div><img src="/img/pins/male-p.png"> Boys Primary</div>
            <div><img src="/img/pins/female-p.png"> Girls Primary</div>
            <div><img src="/img/pins/male-md.png"> Boys Middle</div>
            <div><img src="/img/pins/female-md.png"> Girls Middle</div>
            <div><img src="/img/pins/male-h.png"> Boys High</div>
            <div><img src="/img/pins/female-h.png"> Girls High</div>
            <div><img src="/img/pins/male-hs.png"> Boys H.Sec.</div>
            <div><img src="/img/pins/female-hs.png"> Girls H.Sec.</div>
        `;

        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legendsPanel);
 
    }


    window.initMap = initMap;

    // Event listener for district change
    document.getElementById("district").addEventListener("change", function() {
           
        const districtId = this.value;
           $.ajax({
               url: "/get-tehsils",
               type: "POST",
               data: { district_id: districtId, _token: '{{ csrf_token() }}' },
               success: function(data) {
                   // Populate tehsil dropdown with fetched tehsils
                   
                   $("#tehsil").html('<option value="">Select Tehsil</option>');
                   $.each(data, function(key, value) {
                       console.log(value);
                       $("#tehsil").append('<option value="' + value.s_tehsil_idFk + '"  <?php if($tehsilId == "' + value.s_tehsil_idFk + '") { echo "selected"; } ?>>' + value.t_name + '</option>');

                   });
               }
           });
       });

        // Event listener for tehsil change
        document.getElementById("tehsil").addEventListener("change", function() {
            const tehsilId = this.value;
            // Enable markaz dropdown
            

            // Fetch markazes based on selected tehsil using AJAX
            $.ajax({
                url: "/get-markazes",
                type: "POST",
                data: { tehsil_id: tehsilId, _token: '{{ csrf_token() }}' },
                success: function(data) {
                    // Populate markaz dropdown with fetched markazes
                    $("#markaz").html('<option value="">Select Markaz</option>');
                    $.each(data, function(key, value) {
                        $("#markaz").append('<option value="' + value.s_markaz_idFk + '"  <?php if($markazId == "' + value.s_markaz_idFk + '") { echo "selected"; } ?>>' + value.m_name + '</option>');
                    });
                }
            });
        });

        document.getElementById("markaz").addEventListener("change", function() {
            const markazId = this.value;
            // Enable markaz dropdown
            

            // Fetch markazes based on selected tehsil using AJAX
            $.ajax({
                url: "/get-schools-ajax",
                type: "POST",
                data: { markaz_id: markazId, _token: '{{ csrf_token() }}' },
                success: function(data) {
                    // Populate markaz dropdown with fetched markazes
                    $("#school").html('<option value="">Select School</option>');
                    $.each(data, function(key, value) {
                        $("#school").append('<option value="' + value.id + '"  <?php if($schoolId == "' + value.id + '") { echo "selected"; } ?>>' + value.s_emis_code + ' || ' + value.s_name +'</option>');
                    });
                }
            });
        });
</script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>

<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
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
});
function showTooltip() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.style.visibility = "visible";
    tooltip.style.opacity = "1";
    // You can perform any other actions here when the tooltip is clicked
}
</script>
      
</body>
</html>
