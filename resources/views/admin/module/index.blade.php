@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Daftar Module</h4>
                            <p class="card-description">
                                Klik Judul materi untuk melihat materi
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
                                    <th>Order</th>
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
                                        <td>{{ $module->order }}</td>
                                        <td>
                                            <a href="{{ route('admin.module.materi.index', $module) }}"
                                                class="text-decoration-none">
                                                <h4 class="mb-0">{{ $module->name }}</h4>
                                                <p class="text-decoration-none text-muted mb-0 text-subtitle">
                                                    {{ \Illuminate\Support\Str::limit($module->description ?? '', 50, '...') }}
                                                </p>
                                            </a>
                                        </td>
                                        <td>{{ $module->user->name ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ti-book"></i>
                                                <p class="ml-2 mb-0">{{ $module->materis->count() ?? '0' }}</p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="ti-time"></i>
                                                <p class="ml-2 mb-0">
                                                    @estimasi($module->estimated)
                                                </p>
                                            </div>
                                        </td>
                                        <td>{{ $module->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle btn-sm" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Materi</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.module.edit', $module) }}">Update</a>
                                                    <button class="dropdown-item text-danger btn-delete-module" type="button"
                                                        data-toggle="modal" data-target="#deleteModal"
                                                        data-id="{{ $module->slug }}"
                                                        data-name="{{ $module->name }}">Delete</button>
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
                    <!-- Modal Delete Global -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus modul <strong id="deleteModuleName">...</strong>?
                                </div>
                                <div class="modal-footer">
                                    <form id="deleteModuleForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteModal');
            const deleteModuleName = document.getElementById('deleteModuleName');
            const deleteModuleForm = document.getElementById('deleteModuleForm');
            document.querySelectorAll('.btn-delete-module').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    deleteModuleName.textContent = name;
                    deleteModuleForm.action = "{{ url('admin/module') }}/" + id;
                });
            });
        });
    </script>
@endpush
