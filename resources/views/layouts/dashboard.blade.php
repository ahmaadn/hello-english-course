{{-- Layout utama --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Skydash Admin')</title>
    @include('partials.dashboard._head')
    @stack('styles')
</head>

<body>
    <div class="container-scroller">
        @include('partials.dashboard._navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.dashboard._sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('partials.dashboard._footer')
            </div>
        </div>
    </div>
    @include('partials.dashboard._scripts')
    @stack('scripts')
</body>

</html>
