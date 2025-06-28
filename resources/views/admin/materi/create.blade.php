@extends('layouts.dashboard')

@section('title', 'Tambah Modul')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create material for module <span
                            class="font-weight-bold">{{ $module->name }}</span></h4>
                    <p class="card-description">Enter the material information belows</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.module.materi.store', $module) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="content" class="form-control autoresizing" rows="15"
                                required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control"
                                value="{{ old('urutan', $module->materis->count() + 1) }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Genre</label>
                            <select name="genre_id" class="form-control" required>
                                <option value="">-- Pilih Genre --</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Ilustrasi</label>
                            <input type="file" name="illustrations" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.module.materi.index', $module) }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">
        $('.autoresizing').on('input', function () {
            this.style.height = 'auto';

            this.style.height =
                (this.scrollHeight) + 'px';
        });
    </script>
@endpush
