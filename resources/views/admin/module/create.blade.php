@extends('layouts.dashboard')

@section('title', 'Tambah Modul')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Material to add</h4>
                    <p class="card-description">Enter the module information below</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{ route('admin.module.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control"
                                value="{{ old('urutan', $moduleCount + 1) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="estimated">Estimated Study (Minutes)</label>
                            <input type="number" class="form-control" id="estimated" name="estimated"
                                value="{{ old('estimated') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control autoresizing" id="description" name="description" rows="15"
                                required>{{ old('description') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('admin.module.index') }}" class="btn btn-light">Cancel</a>
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
