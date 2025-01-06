@extends('layouts.sica.main')
@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detailed </span> Data</h4>

        <!-----------FILTER START------------->
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">District</label>
                    <select id="defaultSelect" class="form-select">
                        <option>Default select</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">Tehsils</label>
                    <select id="defaultSelect" class="form-select">
                        <option>Default select</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">Markaz</label>
                    <select id="defaultSelect" class="form-select">
                        <option>Default select</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="defaultSelect" class="form-label">School Name</label>
                    <select id="defaultSelect" class="form-select">
                        <option>Default select</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>
        <!-----------FILTER END------------->
        <!-- Bordered Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>District</th>
                            <th>Tehsil</th>
                            <th>EMIS<br>Code</th>
                            <th>Name</th>
                            <th>School<br>Gate</th>
                            <th>Academic<br>Block</th>
                            <th>Drinking<br>Water</th>
                            <th>Toilet<br>Block</th>
                            <th>Play<br>Ground</th>
                            <th>Libraray</th>
                            <th>Computer<br>Lab</th>
                            <th>Science<br>Lab</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>01</td>
                            <td>Attock</td>
                            <td>Attock</td>
                            <td><a href="{{url('sica/school-images/'.encrypt(34520173 ))}}"> 37110003</a></td>
                            <td>Attock</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>31.51222</td>
                            <td>74.30192</td>
                            <td><span class="badge bg-label-success me-1">Verified</span></td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Attock</td>
                            <td>Attock</td>
                            <td><a href="school-images.html">1234567</a></td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>31.51222</td>
                            <td>74.30192</td>
                            <td><span class="badge bg-label-success me-1">Verified</span></td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>Attock</td>
                            <td>Attock</td>
                            <td><a href="school-images.html">1234567</a></td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>31.51222</td>
                            <td>74.30192</td>
                            <td><span class="badge bg-label-warning me-1">Pending</span></td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>Attock</td>
                            <td>Attock</td>
                            <td><a href="school-images.html">1234567</a></td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>NaN</td>
                            <td>31.51222</td>
                            <td>74.30192</td>
                            <td><span class="badge bg-label-warning me-1">Pending</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Bordered Table -->
    </div>
    <!-- / Content -->
@endsection



