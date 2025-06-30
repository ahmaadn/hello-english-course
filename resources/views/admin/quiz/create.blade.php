@extends('layouts.dashboard')

@section('title', 'Dashboard | Add Quiz')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Quiz</h4>
                    <p class="card-description">Enter the quiz information below</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.quiz.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="materi_id">Module</label>
                            <p>Masukkan nama judul untuk menambahkan quiz</p>
                            <select name="materi_id" id="materi_id" class="form-control" required>
                                <option value="">-- Select Materi --</option>
                                @foreach($materis as $materi)
                                    <option value="{{ $materi->id }}" {{ old('materi_id') == $materi->id ? 'selected' : '' }}>
                                        {{ $materi->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipe">Type</label>
                            <select class="form-control" id="tipe" name="tipe" required>
                                <option value="">-- Select Type --</option>
                                <option value="pilihan_ganda" {{ old('tipe') == 'pilihan_ganda' ? 'selected' : '' }}>Pilihan
                                    Ganda</option>
                                <option value="essay" {{ old('tipe') == 'essay' ? 'selected' : '' }}>Essay</option>
                                <option value="drop_drag" {{ old('tipe') == 'drop_drag' ? 'selected' : '' }}>Drop & Drag
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_minimal">Minimal Score</label>
                            <input type="number" class="form-control" id="nilai_minimal" name="nilai_minimal"
                                value="{{ old('nilai_minimal') }}" required min="0" max="100">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('admin.quiz.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
