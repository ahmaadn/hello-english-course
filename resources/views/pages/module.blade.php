@extends('layouts.page', ['currentPage' => 'genres'])


@section('title')
    Module
@endsection

@section('content')
    @include('partials._banner_heading', ['titleBanner' => 'Module'])
    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                {{--
                <p class="section-title px-5">
                    <span class="px-2">Genre Material</span>
                </p>
                --}}
                <h1 class="mb-4">Module Learning</h1>
            </div>
            <div class="row pb-3">
                @foreach ($modules as $module)
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm mb-2">
                            <img class="card-img-top mb-2" src="{{ asset('storage/' . $module->image_url) }}" alt="" />
                            <div class="card-body bg-light text-center p-4">
                                <h4 class="">{{ $module->name }}</h4>
                                <div class="d-flex justify-content-center mb-3">
                                    <small class="mr-3">
                                        <i class="fa fa-user text-primary"></i>
                                        {{ $module->user->name }}
                                    </small>
                                    <small class="mr-3">
                                        <i class="fa fa-book text-primary"></i>
                                        {{ $module->materis->count() }}
                                    </small>
                                    <small class="mr-3">
                                        <i class="fa fa-clock text-primary"></i>
                                        @estimasi($module->estimated)
                                    </small>
                                </div>
                                <p>
                                    {{ \Illuminate\Support\Str::limit($module->description, 100) }}
                                </p>
                                <a href="" class="btn btn-primary px-4 mx-auto my-2">Enroll Module</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
