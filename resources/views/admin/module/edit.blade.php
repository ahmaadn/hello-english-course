@extends('layouts.dashboard')

@section('title', 'Edit Module')

@section('content')
    <h4>Edit Module</h4>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('admin.module.update', $module) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $module->name) }}" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" id="autoresizing" rows="15"
                        required>{{ old('description', $module->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Leave it blank if you don't want to change the image..</small>
                </div>
                <div class="mb-3">
                    <label>Estimated Study (Minutes)</label>
                    <input type="number" name="estimated" class="form-control"
                        value="{{ old('estimated', $module->estimated) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.module.index') }}" class="btn btn-secondary">Cancel</a>
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
        $('#autoresizing').on('input', function () {
            this.style.height = 'auto';

            this.style.height =
                (this.scrollHeight) + 'px';
        });
    </script>
@endpush
