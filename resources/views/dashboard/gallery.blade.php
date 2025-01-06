@extends('layouts.app')

@section('content')

<!--------Select 2----------->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <!-- Start Content-->
 <div class="">                

<!-- start page title -->
    <!--<div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Gallery</h4>
            </div>
        </div>
    </div>-->
    <form action="{{ route('get-school-gallery') }}" method="GET">  
        <div class="row  gallery-filter-field-wrapper"> 
            <div class="col-4 gallery-filter-field">
                <div class="mb-3">
                    <label for="example-select" class="form-label">District</label>
                    <select class="js-example-basic-single" name="school">
                        <option value="">Select a school</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->s_emis_code }}"
                                {{ $selectedSchool == $school->s_emis_code ? 'selected' : '' }}>
                                {{ $school->s_emis_code }} | {{ $school->school_name }}
                            </option>
                        @endforeach
                    </select>
                </div>                            
            </div>   
            <div class="col-4 gallery-filter-field">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Tehsil</label>
                    <select class="js-example-basic-single" name="school">
                        <option value="">Select a school</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->s_emis_code }}"
                                {{ $selectedSchool == $school->s_emis_code ? 'selected' : '' }}>
                                {{ $school->s_emis_code }} | {{ $school->school_name }}
                            </option>
                        @endforeach
                    </select>
                </div>                            
            </div>   
            <div class="col-4 gallery-filter-field">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Markaz</label>
                    <select class="js-example-basic-single" name="school">
                        <option value="">Select a school</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->s_emis_code }}"
                                {{ $selectedSchool == $school->s_emis_code ? 'selected' : '' }}>
                                {{ $school->s_emis_code }} | {{ $school->school_name }}
                            </option>
                        @endforeach
                    </select>
                </div>                            
            </div>   
            <div class="col-6 gallery-filter-field">
                <div class="mb-3">
                    <label for="example-select" class="form-label">EMIS - School Name</label>
                    <select class="js-example-basic-single" name="school">
                        <option value="">Select a school</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->s_emis_code }}"
                                {{ $selectedSchool == $school->s_emis_code ? 'selected' : '' }}>
                                {{ $school->s_emis_code }} | {{ $school->school_name }}
                            </option>
                        @endforeach
                    </select>
                </div>                            
            </div>                            
            <div class="col-3 gallery-filter-field">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Date</label>
                    <input class="form-control" id="selectDate" name="date" type="date" 
                        value="{{ $selectedDate }}">
                </div>                            
            </div>               
            <div class="col-3 gallery-filter-field">
                <div class="mb-3 mt-3 pt-1">
                    <button type="submit" class="btn btn-success mb-3 w-100">Submit</button>
                </div>                            
            </div>
        </div>                        
    </form>

    <!-- Display selected filters -->
    @if($selectedSchool || $selectedDate)
        <div class="mt-3">
            <h4>Filters Applied:</h4>
            <ul>
                @if($selectedSchool)
                    <li><strong>School:</strong> {{ $schools->firstWhere('s_emis_code', $selectedSchool)->school_name ?? 'Not found' }}</li>
                @endif
                @if($selectedDate)
                    <li><strong>Date:</strong> {{ $selectedDate }}</li>
                @endif
            </ul>
        </div>
    @endif


   
   
    <div class="row gallery">
        @forelse($images as $image)
            <div class="col-md-3">
                <div class="card text-center gallery-item-box">
                    <img class="card-img-top gallery-item" src="{{ asset('storage/' . $image->image_path) }}" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->class }}</h5>
                    </div>
                </div>
            </div><!--Col End-->
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No images found for the selected filters.
                </div>
            </div><!--Col End-->
        @endforelse
    </div>
<!-- end row-->
</div> <!-- container -->
 <!-- Popup for Viewing Larger Images -->
 <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <span id="prev">&#10094;</span>
            <img id="popup-img" class="popup-img" src="" alt="Popup Image">
            <span id="next">&#10095;</span>
        </div>
    </div>

        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            }); 
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const galleryItems = document.querySelectorAll(".gallery-item");
                const thumbnailItems = document.querySelectorAll(".thumbnail-item");
                const popup = document.getElementById("popup");
                const popupImg = document.getElementById("popup-img");
                const close = document.querySelector(".close");
                const prev = document.getElementById("prev");
                const next = document.getElementById("next");
                const featuredImage = document.getElementById("featured");
    
                let currentIndex = 0;
    
                galleryItems.forEach((item, index) => {
                    item.addEventListener("click", function () {
                        currentIndex = index;
                        showPopup();
                    });
                });
    
                thumbnailItems.forEach((item, index) => {
                    item.addEventListener("click", function () {
                        currentIndex = index;
                        featuredImage.src = this.src;
                    });
                });
    
                function showPopup() {
                    popup.style.display = "flex";
                    popupImg.src = galleryItems[currentIndex].src;
                }
    
                close.addEventListener("click", function () {
                    popup.style.display = "none";
                });
    
                popup.addEventListener("click", function (e) {
                    if (e.target !== popupImg && e.target !== prev && e.target !== next) {
                        popup.style.display = "none";
                    }
                });
    
                prev.addEventListener("click", function () {
                    currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
                    showPopup();
                });
    
                next.addEventListener("click", function () {
                    currentIndex = (currentIndex + 1) % galleryItems.length;
                    showPopup();
                });
            });
        </script>
@endsection