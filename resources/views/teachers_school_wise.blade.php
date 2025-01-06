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
		<section class="position-relative overflow-hidden text-center bg-light hero-area">
		<div class="row">
			<div class="col-md-12 p-lg-12 mx-auto">
				<h1 class="indicator-heading">Teacher Wise Schools</h1>
			</div>	
		</div>
    </section>	
	<section class="filter-wrapper">
		<div class="container">
		
		<!--<div class="row">
			<div class="col-md-12">
				<h1 class="app-name-title">Punjab Schools : Teachers &amp; Facilities</h1>
			</div>
	   </div>-->
	   
	   	<div class="teacher-filter-wrapper" id="">
		   <form class="teacher-filter-inner-form" id="filterForm" method="GET" action="{{ url('/teachers-school-wise/' . ($district_id ?? '') . '/' . ($teacher_count ?? '')) }}">

				<div class="row">
					<div class="form-group col-lg-5 col-md-6 mb-2">
						<label for="District" class="form-label">District</label>
						<select class="form-select" id="district" name="district_id">
							<option value="all">All Punjab</option>
							<!-- Populate options dynamically from database -->
							@foreach($districts as $district)
								<option value="{{ $district->s_district_idFk }}" @if($district_id == $district->s_district_idFk) selected @endif >{{ $district->d_name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-lg-5 col-md-6 mb-2">
						<label for="Gender" class="form-label">No. Of Teachers</label>
						<select class="form-select" id="teachers" name="teacher_count">
							<option value="">Select Teachers</option>
							<option value="zero" @if($teacher_count == "zero") selected @endif>Zero Teacher</option>
							<option value="one" @if($teacher_count == "one") selected @endif>Single Teacher</option>
							<option value="two" @if($teacher_count == "two") selected @endif>Two Teachers</option>
							<option value="more" @if($teacher_count == "more") selected @endif>More Than Two Teachers</option>
						</select>
					</div>
					<div class="form-group col-xl-2 col-lg-3 col-md-6  mb-2 align-self-center">
						<button id="submitBtn" class="btn btn-primary mb-2" type="submit" style="background: #28416f;border: 0px;margin-top: 34px;float:right;width: 100%;">Submit</button>
					</div>



				</div>
			</form>
		</div>

	   
	  
		
	</section>

	<section class="demographic-wrapper">
    <div class="container">
        <!-- Pagination Links -->
       
        <!-- Table -->
        <div class="row mt-4 mb-4">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">District</th>
                                <th scope="col">Markaz</th>
                                <th scope="col">Tehsil</th>
                                <th scope="col">School Name</th>
                                <th scope="col">Level</th>
                                <th scope="col">EMIS Code</th>
                                <th scope="col">No. of Students</th>
                                <th scope="col">No. of Teachers</th>
                                <th scope="col">Student to Teacher Ratio (40:1)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schoolsTeacherWise as $school)
                            <tr>
                                <td>{{ $school->d_name }}</td>
                                <td>{{ $school->t_name }}</td>
                                <td>{{ $school->m_name }}</td>
                                <td>{{ $school->s_name }}</td>
                                <td>{{ $school->s_level }}</td>
                                <td>{{ $school->s_emis_code }}</td>
                                <td>{{ $school->total_students }}</td>
                                <td>{{ $school->no_of_teachers }}</td>
                                <td>{{ $school->no_of_teachers != 0 ? round($school->total_students / $school->no_of_teachers) . ':1' : $school->total_students . ':0' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pagination Links -->
        <div class="row justify-content-center">
            <div class="col-md-12 table-pagenation pb-5">
                {{ $schoolsTeacherWise->links() }}
            </div>
        </div>
    </div>
</section>




  </main>
  <footer class="pt-2 text-center" style="color: #ffffff !important;background: #04578F;line-height: 2;">
    Copyright © Designed & Developed by PMIU Data Center 2024
  </footer>
<!--</div>-->

<script>
    $(document).ready(function() {
        $("#submitBtn").click(function(e) {
            e.preventDefault(); // Prevent default form submission behavior

            // Get the selected district ID
            var districtId = $("#district").val();

            // Get the selected number of teachers
            var teacherCount = $("#teachers").val();

            // Construct the URL
            var url = "{{ url('/teachers-school-wise') }}/" + districtId + "/" + teacherCount;

            // Redirect to the generated URL
            window.location.href = url;
        });
    });
</script>

</body>
</html>
