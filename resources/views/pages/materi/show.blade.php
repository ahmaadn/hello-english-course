@extends('layouts.page', ['currentPage' => '1'])

@section('title')
    Chapter 1
@endsection


@section('content')
    @include('partials._banner_heading', ['titleBanner' => 'JUDUL MATERI'])
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                @include('partials.materi._content')
            </div>
            <div class="col-lg-4 mt-5 mt-lg-0">
                @include('partials.materi._sidebar')
            </div>
        </div>
    </div>
@endsection
