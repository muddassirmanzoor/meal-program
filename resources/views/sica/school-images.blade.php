@extends('layouts.sica.main')
@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">School Name /</span> EMIS {{$emis_code}}</h4>
        <form action="{{url('sica/add-remarks')}}" method="POST">
            @csrf
            <input type="hidden" name="emis_code" value="{{$emis_code}}">
            <!-- Form START -->
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-1">
                    <div class="form-check">
                        <input class="form-check-input " type="checkbox" id="select-all"/>
                        <label class="form-check-label" for="defaultCheck1"> Select All </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="gate_picture" id="defaultCheck2"/>
                        <label class="form-check-label" for="defaultCheck2"> School Gate </label>
                    </div>
                </div>
                @foreach($organized_data['gate_picture']['images'] as $image)

                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="School Gate"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="academic_block" id="defaultCheck3"/>
                        <label class="form-check-label" for="defaultCheck3">Academic Block</label>
                    </div>
                </div>
                @foreach($organized_data['academic_block']['images'] as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}"
                                 alt="Academic Block"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="drinking_water" id="defaultCheck4"/>
                        <label class="form-check-label" for="defaultCheck4">Drinking Water</label>
                    </div>
                </div>
                @foreach($organized_data['drinking_water']['images'] as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}"
                                 alt="Drinking Water"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="toilet_block" id="defaultCheck5"/>
                        <label class="form-check-label" for="defaultCheck5">Toilet Block</label>
                    </div>
                </div>
                @forelse($organized_data['toilet_block']['images'] ?? [] as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Toilet Block"/>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('sica/assets/img/no-image.jpg')}}" alt="Computer Lab"/>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="play_ground" id="defaultCheck6"/>
                        <label class="form-check-label" for="defaultCheck6">Play Ground</label>
                    </div>
                </div>
                @forelse($organized_data['play_ground']['images'] ?? [] as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Play Ground"/>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('sica/assets/img/no-image.jpg')}}" alt="Play Ground"/>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="library" id="defaultCheck7"/>
                        <label class="form-check-label" for="defaultCheck7">Library</label>
                    </div>
                </div>
                @forelse($organized_data['library']['images'] ?? [] as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Library"/>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('sica/assets/img/no-image.jpg')}}" alt="Computer Lab"/>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input checkbox-group" type="checkbox" value="computer_lab" id="defaultCheck8"/>
                        <label class="form-check-label" for="defaultCheck8">Computer Lab</label>
                    </div>
                </div>
                @forelse($organized_data['computer_lab']['images'] ?? []  as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Computer Lab"/>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('sica/assets/img/no-image.jpg')}}" alt="Computer Lab"/>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="row mb-3">
                @forelse($organized_data['science_lab/physics']['images'] ?? []  as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input checkbox-group" type="checkbox" value="science_lab/physics" id="defaultCheck9"/>
                            <label class="form-check-label" for="defaultCheck9">Science Lab/Physics</label>
                        </div>
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Physics"/>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input checkbox-group" type="checkbox" value="science_lab/physics" id="defaultCheck9"/>
                            <label class="form-check-label" for="defaultCheck9">Science Lab/Physics</label>
                        </div>
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('sica/assets/img/no-image.jpg')}}" alt="Physics"/>
                        </div>
                    </div>
                @endforelse
                @foreach($organized_data['science_lab/chemistry']['images'] ?? []  as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input checkbox-group" type="checkbox" value="science_lab/chemistry" id="defaultCheck9"/>
                            <label class="form-check-label" for="defaultCheck9">Science Lab/Chemistry</label>
                        </div>
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Chemistry"/>
                        </div>
                    </div>
                @endforeach
                @foreach($organized_data['science_lab/biology']['images'] ?? []  as $image)
                    <div class="col-md-4 col-lg-4 mb-3">
                        <div class="form-check mb-3">
                            <input class="form-check-input checkbox-group" type="checkbox" value="science_lab/biology" id="defaultCheck9"/>
                            <label class="form-check-label" for="defaultCheck9">Science Lab/Biology</label>
                        </div>
                        <div class="card">
                            <img class="img-fluid" src="{{ asset('storage/'.$image['file_path'])}}" alt="Biology"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 mb-1">
                    <label class="form-label" for="basic-default-message">Remarks</label>
                    <textarea id="basic-default-message" name="remarks" class="form-control" placeholder="Put Remarks Here"></textarea>
                </div>
                <div class="col-md-12 col-lg-12 mb-1">
                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Action</label>
                        <select id="defaultSelect" name="status" class="form-select">
                            <option>Default select</option>
                            <option value="1">Verified</option>
                            <option value="2">Send Back To School</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 mb-1">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Form END -->
    </div>
    <!-- / Content -->
@endsection



