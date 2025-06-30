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
                        @foreach($module->materis as $materi)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a @if($materi->progress) href="{{ route('materi.show', [$module, $materi]) }}" @else
                                class="text-muted disabled" tabindex="-1" aria-disabled="true" @endif>
                                    {{ $materi->title }}
                                    @if($materi->progress)
                                        @if ($materi->progress->status == 'finish')
                                            <span class="badge badge-success badge-pill">
                                                {{ $materi->progress->status }}
                                            </span>
                                        @else
                                            <span class="badge badge-warning badge-pill">
                                                {{ $materi->progress->status }}
                                            </span>
                                        @endif
                                    @else
                                        <i class="fa fa-lock ml-2" title="Locked"></i>
                                    @endif
                                </a>
                                <span class="badge badge-primary badge-pill">
                                    {{ $materi->genre->name }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Module Information -->
                <div class="mb-5">
                    <h2 class="mb-4">Module Information</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>Author</span>
                            <span class="badge badge-primary badge-pill">{{ $module->user->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>Total Materials</span>
                            <span class="badge badge-primary badge-pill">{{ $module->materis->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>Estimated Time</span>
                            <span class="badge badge-primary badge-pill">@estimasi($module->estimated)</span>
                        </li>
                    </ul>
                    <a href="{{ route('materi.start', [$module]) }}" class="btn btn-success btn-block mt-4">
                        Start Study
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
