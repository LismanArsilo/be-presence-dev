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
                <h2 class="section-title">Permission</h2>
                <div class="col-12 d-flex justify-content-end">
                    @include('components.alert-success')
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><a href="{{ route('view.create.company') }}" class="btn btn-primary">Create
                                        Permission</a>
                                </h4>
                                <div class="card-header-form">
                                    <form action="{{ route('view.list.permission') }}" method="GET">
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
                                                <th>Username</th>
                                                <th>Date</th>
                                                <th>Approved Lead</th>
                                                <th>Approved Managment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->permissions as $permission)
                                                <tr>
                                                    <td>{{ ($data->permissions->currentPage() - 1) * $data->permissions->perPage() + $loop->iteration }}
                                                    </td>
                                                    <td>{{ $permission->user->username }}</td>
                                                    <td>{{ $permission->date }}</td>
                                                    <td
                                                        class="{{ $permission->is_approved_lead ? 'text-primary' : 'text-danger' }}">
                                                        {{ $permission->is_approved_lead ? 'Approved' : 'Not Approved' }}
                                                    </td>
                                                    <td
                                                        class="{{ $permission->is_approved_manag ? 'text-primary' : 'text-danger' }}">
                                                        {{ $permission->is_approved_manag ? 'Approved' : 'Not Approved' }}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success btnDetail">Detail</button>
                                                        <button class="btn btn-danger btnDelete">Delete</button>
                                                        {{-- <a href="{{ route('view.update.company', ['id' => $company->id]) }}"
                                                            class="btn btn-info">Update</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $data->permissions->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('pages.dashboard.permission.modal-detail-permission')
    @include('pages.dashboard.permission.modal-delete-permission')
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>

    {{-- Custom JS --}}
    <script type="text/javascript" src="{{ asset('js/page-custom/permission.js') }}"></script>
@endpush
