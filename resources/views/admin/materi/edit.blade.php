@extends('layouts.dashboard')

@section('title', 'Edit Module')

@section('content')
    <h4>Edit Module</h4>
    <div class="row">

        <div class="col-md-8">
            <form action="{{ route('admin.module.materi.update', [$module, $materi]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $materi->title) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control autoresizing" rows="15" required>{{ old('content', $materi->content) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $materi->order) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label>Genre</label>
                    <select name="genre_id" class="form-control" required>
                        <option value="">-- Pilih Genre --</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id', $materi->genre_id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Illustration (optional)</label>
                    <input type="file" name="illustrations" class="form-control">
                    <small class="text-muted">Leave blank if you don't want to change the illustration..</small>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.module.materi.index', $module) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <strong>Thumbnail Image </strong>
            </div>
            @if($module->image_url)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $module->image_url) }}" alt="Current Image"
                        style="max-width: 100%; max-height: 250px; border-radius: 8px;">
                </div>
            @else
                <div class="mb-3 text-muted">No image available</div>
            @endif
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
