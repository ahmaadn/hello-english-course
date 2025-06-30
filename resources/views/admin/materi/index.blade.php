@extends('layouts.dashboard')

@section('title', 'Dashboard | Materi')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4 class="card-title">Data Materi untuk Modul : <a class="font-weight-bold"
                                    href="{{ route('admin.module.index') }}">{{ $module->name }}</a></h4>
                        </div>
                        <div class="col-6 d-flex justify-content-end" style="width: fit-content; height: fit-content">
                            <a class="btn btn-success btn-sm d-inline-flex align-items-center justify-content-center"
                                href="{{ route('admin.module.materi.create', $module) }}">
                                <i class="icon-sm ti-plus"></i>
                                <p class="ml-2 mb-0">
                                    Add Materi </p>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-12">
                            <h4 class="font-weight-bold mb-3">Module Detail</h4>
                            <div class="mb-3">
                                <strong>Name:</strong> {{ $module->name }}
                            </div>
                            <div class="mb-3">
                                <strong>Slug:</strong> {{ $module->slug }}
                            </div>
                            <div class="mb-3">
                                <strong>Description:</strong> {{ $module->description }}
                            </div>
                            <div class="mb-3">
                                <strong>Estimated:</strong> @estimasi($module->estimated)
                            </div>
                            <div class="mb-3">
                                <strong>Order:</strong> {{$module->order}}
                            </div>
                            <div class="mb-3">
                                <strong>Create by:</strong> {{ $module->user->name ?? '-' }}
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-12">
                            <div class="mb-3">
                                <strong>Image </strong>
                            </div>
                            @if(Str::startsWith($module->image_url, ['http://', 'https://']))

                                <a class="mb-3 text-muted" href="{{ $module->image_url }}" style="font-size: 14px; ">

                                    Download here
                                </a>
                            @else
                                <a class="mb-3 text-muted" href="{{ asset('storage/' . $module->image_url) }}"
                                    style="font-size: 14px; ">

                                    Download here
                                </a>

                            @endif
                            <div class="mb-3">
                                @if(Str::startsWith($module->image_url, ['http://', 'https://']))
                                    <img src="{{ $module->image_url }}" alt="Current Image"
                                        style="max-width: 100%; max-height: 250px; border-radius: 8px;">
                                @else
                                    <img src="{{ asset('storage/' . $module->image_url) }}" alt="Current Image"
                                        style="max-width: 100%; max-height: 250px; border-radius: 8px;">
                                @endif
                            </div>
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
                                    <th>Genre</th>
                                    <th>Order</th>
                                    <th>Task</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($materis as $item)
                                    <tr>
                                        <td>
                                            <a class="text-decoration-none">
                                                <h4 class="mb-0">{{ $item->title }}</h4>
                                                <p class="text-decoration-none text-muted mb-0 text-subtitle">
                                                    {{ \Illuminate\Support\Str::limit($item->content ?? '', 50, '...') }}
                                                </p>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="badge badge-danger">
                                                {{ $item->genre->name ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ti-stats-up"></i>
                                                <p class="ml-2 mb-0">{{ $item->order ?? '-' }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="d-flex align-items-center" @if($item->quizzes->first())
                                            href="{{ route('admin.quiz.show', $item->quizzes->first()->id) }}" @endif>
                                                <p class="ml-2 mb-0">{{ $item->quizzes->first()->tipe ?? '-' }}</p>
                                            </a>
                                        </td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle btn-sm" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.module.materi.edit', [$module, $item]) }}">Update</a>
                                                    <button class="dropdown-item text-danger btn-delete-module" type="button"
                                                        data-toggle="modal" data-target="#deleteModal"
                                                        data-id="{{ $item->slug }}"
                                                        data-name="{{ $item->title }}">Delete</button>
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
                    deleteModuleForm.action = "{{ url('admin/module', ['module' => $module->slug]) }}/materi/" + id;
                });
            });
        });
    </script>
@endpush
