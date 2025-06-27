<!DOCTYPE html>
<html lang="en">

<head>
    @stack('prepend-styles')
    @include('partials._head')
    @stack('styles')
</head>

<body>
    <!-- Navbar Start -->
    @include('partials._navbar', ['currentPage' => $currentPage])
    <!-- Navbar End -->

    <!-- Content -->
    @yield('content')
    <!-- Content End -->

    <!-- Footer Start -->
    @include('partials._footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    @include('partials._back_to_top')

    <!-- JavaScript Libraries -->
    @stack('prepend-scripts')
    @include('partials._scripts')
    @stack('scripts')

    @include('partials._toastr')
</body>

</html>
