@extends('layouts.app')

@section('title', 'Company')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Company</h4>
                        </div>
                        <form action="{{ route('api.update.company', ['id' => $data->company->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Name" value="{{ old('name', $data->company->name) }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email" value="{{ old('email', $data->company->email) }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="latitude">Latitude</label>
                                        <input type="latitude" name="latitude" class="form-control" id="latitude"
                                            placeholder="Latitude" value="{{ old('latitude', $data->company->latitude) }}"
                                            required>
                                        @error('latitude')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="longitude">Longitude</label>
                                        <input type="longitude" name="longitude" class="form-control" id="longitude"
                                            placeholder="Longitude"
                                            value="{{ old('longitude', $data->company->longitude) }}" required>
                                        @error('longitude')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control" id="phone_number"
                                            placeholder="Phone Number"
                                            value="{{ old('phone_number', $data->company->phone_number) }}" required>
                                        @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" class="form-control" id="website"
                                            placeholder="Website" value="{{ old('website', $data->company->website) }}"
                                            required>
                                        @error('website')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="time_in">Time In</label>
                                        <input type="text" name="time_in" class="form-control" id="time_in"
                                            placeholder="Time In" value="{{ old('time_in', $data->company->time_in) }}"
                                            required>
                                        @error('time_in')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="time_out">Time Out</label>
                                        <input type="text" name="time_out" class="form-control" id="time_out"
                                            placeholder="Time Out" value="{{ old('time_in', $data->company->time_out) }}"
                                            required>
                                        @error('time_out')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="radius">Radius</label>
                                        <input type="number" name="radius" class="form-control" id="radius"
                                            placeholder="Radius ( KM )"
                                            value="{{ old('radius_km', $data->company->radius_km) }}" required>
                                        @error('radius')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address" placeholder="Address" rows="40" cols="20"
                                            required>{{ $data->company->address }}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end" style="gap: .5rem">
                                <a href="{{ route('view.list.company') }}" class="btn btn-danger">Cancel</a>
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- Page Specific JS File -->
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
