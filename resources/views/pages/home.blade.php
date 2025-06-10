<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')
</head>

<body>
    <!-- Navbar Start -->
    @include('partials._navbar', ['currentPage' => 'home'])
    <!-- Navbar End -->

    <!-- Header Start -->
    @include('partials.home._header')
    <!-- Header End -->

    <!-- Facilities Start -->
    @include('partials.home._facilities')
    <!-- Facilities End -->

    <!-- About Start -->
    @include('partials.home._about')
    <!-- About End -->

    <!-- Class Start -->
    <!-- @include('partials.home._classes_preview') -->
    <!-- Class End -->

    <!-- Registration Start -->
    <!-- @include('partials.home._registration_cta') -->
    <!-- Registration End -->

    <!-- Team Start -->
    <!-- @include('partials.home._team_preview') -->
    <!-- Team End -->

    <!-- Testimonial Start -->
    <!-- @include('partials.home._testimonial') -->
    <!-- Testimonial End -->

    <!-- Blog Start -->
    @include('partials.home._blog_latest')
    <!-- Blog End -->

    <!-- Footer Start -->
    @include('partials._footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    @include('partials._back_to_top')

    <!-- JavaScript Libraries -->
    @include('partials._scripts')
</body>

</html>
