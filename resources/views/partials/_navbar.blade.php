<div class="container-fluid bg-light position-relative shadow">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-1 py-lg-0 px-0 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand font-weight-bold text-secondary" style="font-size: 40px">
            <i class="flaticon-043-teddy-bear"></i>
            <span class="text-primary">Hello English</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav font-weight-bold  py-0">
                <a href="{{ route('home') }}"
                    class="nav-item nav-link {{ ($currentPage ?? '') == 'home' ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link {{ ($currentPage ?? '') == 'about' ? 'active' : '' }}">About</a>
                <a href="{{ route('modules') }}"
                    class="nav-item nav-link {{ ($currentPage ?? '') == 'genres' ? 'active' : '' }}">Modules</a>
            </div>
            <a href="#" class="btn btn-primary px-4">Quiz Now</a>
        </div>
    </nav>
</div>
