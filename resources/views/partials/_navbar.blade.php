<div class="container-fluid bg-light position-relative shadow">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-1 py-lg-0 px-0 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand font-weight-bold text-secondary" style="font-size: 40px">
            <img src="{{ asset('img/logo.png') }}" width="180" alt="logo" />
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
            <div>

            @auth
                @roles(['admin'])
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary px-4 mr-2">Dashboard</a>
                @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-primary px-4 mr-2">Dashboard</a>
                @endroles
                <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary px-4">Logout</button>
                </form>
            @else
                <a href="{{ route('auth.login') }}" class="btn btn-primary px-4 mr-2">Login</a>
                <a href="{{ route('auth.register') }}" class="btn btn-outline-secondary px-4">register</a>
            @endauth
            </div>
        </div>
    </nav>
</div>
