@extends('layouts.app')

@section('title', 'Company')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="section-body">
                <h2 class="section-title">Attendance</h2>
                <div class="col-12 d-flex justify-content-end">
                    @include('components.alert-success')
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><a href="{{ route('view.create.company') }}" class="btn btn-primary">Create
                                        Attendance</a>
                                </h4>
                                <div class="card-header-form">
                                    <form action="{{ route('view.list.attendance') }}" method="GET">
                                        <div class="input-group">
                                            <input type="text" name="username" class="form-control" placeholder="Search">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"
                                                        style="padding: .4rem;"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->attendances as $attendance)
                                                <tr>
                                                    <td>{{ ($data->attendances->currentPage() - 1) * $data->attendances->perPage() + $loop->iteration }}
                                                    </td>
                                                    <td>{{ $attendance->user->username }}</td>
                                                    <td>{{ $attendance->date }}</td>
                                                    <td>{{ $attendance->time_in }}</td>
                                                    <td>{{ $attendance->time_out }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-success">Detail</a>
                                                        <a href="#" class="btn btn-danger">Delete</a>
                                                        {{-- <a href="{{ route('view.update.company', ['id' => $company->id]) }}"
                                                            class="btn btn-info">Update</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $data->attendances->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
