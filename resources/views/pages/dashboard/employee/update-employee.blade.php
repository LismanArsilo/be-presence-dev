@extends('layouts.app')

@section('title', 'Employee')

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
                            <h4>Update Employee</h4>
                        </div>
                        <form action="{{ route('api.update.employee', ['id' => $data->employee->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            placeholder="Username" value="{{ old('username', $data->employee->username) }}"
                                            required>
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="username">Fullname</label>
                                        <input type="text" name="fullname" class="form-control" id="fullname"
                                            placeholder="Username" value="{{ old('fullname', $data->employee->fullname) }}"
                                            required>
                                        @error('fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email" value="{{ old('email', $data->employee->email) }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password">
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Role</label>
                                        <select class="form-control selectric" name="role">
                                            <option value="">Select Your Role</option>
                                            @foreach ($data->roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $role->id == old('role', $data->employee->role_id) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Join Date</label>
                                        <input type="text" class="form-control datepicker" name="join_date"
                                            value="{{ old('join_date', $data->employee->join_date) }}">
                                        @error('join_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="position">Position</label>
                                        <select class="form-control selectric" name="position" id="position">
                                            <option value="">Select Your Position</option>
                                            @foreach ($data->positions as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ $position->id == old('position', $data->employee->position_id) ? 'selected' : '' }}>
                                                    {{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('position')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="unit">Service Unit</label>
                                        <select class="form-control selectric" name="unit" id="unit">
                                            <option value="">Select Your Service Unit</option>
                                            @foreach ($data->units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ $unit->id == old('unit', $data->employee->unit_id) ? 'selected' : '' }}>
                                                    {{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end" style="gap: .5rem">
                                <a href="{{ route('view.list.employee') }}" class="btn btn-danger">Cancel</a>
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
