@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Basic Table</h4>
                            <p class="card-description">
                                Add class <code>.table</code>
                            </p>
                        </div>
                        <div class="col-6 d-flex justify-content-end" style="width: fit-content; height: fit-content">
                            <a class="btn btn-success btn-sm d-inline-flex align-items-center justify-content-center"
                                href="{{ route('admin.module.create') }}">
                                <i class="icon-sm ti-plus"></i>
                                <p class="ml-2 mb-0">
                                    Add Modul </p>
                            </a>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Create By</th>
                                    <th>Material</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($modules as $module)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.module.show', $module->id) }}"
                                                class="text-decoration-none">
                                                <h4 class="mb-0">{{ $module->name }}</h4>
                                                <p class="text-decoration-none text-muted mb-0 text-subtitle">
                                                    {{ \Illuminate\Support\Str::words($module->description ?? '', 30, '...') }}
                                                </p>
                                            </a>
                                        </td>
                                        <td>{{ $module->user->name ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ti-stats-up"></i>
                                                <p class="ml-2 mb-0">0</p>
                                            </div>
                                        </td>
                                        <td>{{ $module->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle btn-sm" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item">Materi</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.module.edit', $module->id) }}">Update</a>
                                                    <form action="{{ route('admin.module.destroy', $module->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Data module belum ada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
