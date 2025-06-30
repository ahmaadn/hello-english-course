@extends('layouts.dashboard')

@section('title', 'Dashboard | Edit Quiz')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Quiz</h4>
                    <p class="card-description">Update the quiz information below</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.quiz.update', $quiz) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="materi_id">Module</label>
                            <select name="materi_id" id="materi_id" class="form-control" required>
                                <option value="">-- Select Module --</option>
                                @foreach($materis as $materi)
                                    <option value="{{ $materi->id }}" {{ old('materi_id', $quiz->materi_id) == $materi->id ? 'selected' : '' }}>{{ $materi->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipe">Type</label>
                            <select class="form-control" id="tipe" name="tipe" required>
                                <option value="">-- Select Type --</option>
                                <option value="pilihan_ganda" {{ old('tipe', $quiz->tipe) == 'pilihan_ganda' ? 'selected' : '' }}>Pilihan Ganda</option>
                                <option value="essay" {{ old('tipe', $quiz->tipe) == 'essay' ? 'selected' : '' }}>Essay
                                </option>
                                <option value="drop_drag" {{ old('tipe', $quiz->tipe) == 'drop_drag' ? 'selected' : '' }}>Drop
                                    & Drag</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $quiz->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_minimal">Minimal Score</label>
                            <input type="number" class="form-control" id="nilai_minimal" name="nilai_minimal"
                                value="{{ old('nilai_minimal', $quiz->nilai_minimal) }}" required min="0" max="100">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <a href="{{ route('admin.quiz.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
