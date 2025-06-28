@extends('layouts.dashboard')

@section('title', 'Module Detail')

@section('content')
    <h4>Module Detail</h4>
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
        <strong>Image URL:</strong> {{ $module->image_url }}
    </div>
    <div class="mb-3">
        <strong>Estimated:</strong> {{ $module->estimated }}
    </div>
    <div class="mb-3">
        <strong>Genre:</strong> {{ $module->genre->name ?? '-' }}
    </div>
    <div class="mb-3">
        <strong>User:</strong> {{ $module->user->name ?? '-' }}
    </div>
    <a href="{{ route('admin.module.index') }}" class="btn btn-secondary">Back</a>
@endsection
