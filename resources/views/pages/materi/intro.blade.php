@extends('layouts.page', ['currentPage' => '1'])

@section('title')
    Chapter 1
@endsection


@section('content')
    @include('partials._banner_heading', ['titleBanner' => $module->name])
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-3">
                    <p class="section-title pr-5">
                        <span class="pr-2">Module Detail</span>
                    </p>
                    <h1 class="mb-3">{{ $module->name }}</h1>
                    <div class="d-flex">
                        <p class="mr-3"><i class="fa fa-user text-primary"></i> {{ $module->user->name }}</p>
                        <p class="mr-3">
                            <i class="fa fa-book text-primary"></i> {{ $module->materis->count() }}
                        </p>
                        <p class="mr-3"><i class="fa fa-clock text-primary"></i>@estimasi($module->estimated)</p>
                    </div>
                </div>
                <div class="mb-5">
                    <img class="img-fluid rounded w-100 mb-4" src="{{ asset('storage/' . $module->image_url) }}"
                        alt="Image" />
                    <p>
                        {{ $module->description }}
                    </p>
                    <h3 class="mb-4">Material for this Module</h3>
                    <ul class="list-group mb-4">
                        @foreach($module->materis as $material)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a @if(!$material->is_accessible) class="text-muted disabled" tabindex="-1" aria-disabled="true"
                                @endif>
                                    {{ $material->title }}
                                    @if(!$material->is_accessible)
                                        <i class="fa fa-lock ml-2" title="Locked"></i>
                                    @endif
                                </a>
                                <span class="badge badge-primary badge-pill">
                                    {{ $material->genre->name }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 mt-5 mt-lg-0">
                @include('partials.chapter._sidebar')
            </div>
        </div>
    </div>
@endsection
