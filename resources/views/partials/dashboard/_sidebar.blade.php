<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- DASHBOARD --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- Module --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.module.index') }}">
                <i class="ti-bookmark-alt menu-icon"></i>
                <span class="menu-title">Module</span>
            </a>
        </li>
        {{-- Materi
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.module.index') }}">
                <i class="ti-book menu-icon"></i>
                <span class="menu-title">Taks</span>
            </a>
        </li> --}}
        {{-- Quiz --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.quiz.index') }}">
                <i class="ti-book menu-icon"></i>
                <span class="menu-title">Quiz</span>
            </a>
        </li>
        {{-- Progress Kuis --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.history-quiz.index') }}">
                <i class="ti-harddrives menu-icon"></i>
                <span class="menu-title">Quiz Results History</span>
            </a>
        </li>
    </ul>
</nav>