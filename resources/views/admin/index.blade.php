@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="row grid-margin">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome Aamir</h3>
            <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3
                    unread alerts!</span></h6>
        </div>
        <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white" id="dropdownMenuDate2">
                        <i class="mdi mdi-calendar"></i>
                        <span id="currentDateTime"></span>

                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('img/people.png') }}" alt="people">
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <x-dashboard-card cardClass="card-tale" title="Today’s Students" value="{{ $totalStudents }}"
                    percentage="10.00% (30 days)" />
                <x-dashboard-card cardClass="card-dark-blue" title="Total Material" value="{{ $totalMateri }}"
                    percentage="22.00% (30 days)" />
            </div>
            <div class="row">
                <x-dashboard-card cardClass="card-light-blue" title="Total Users" value="{{ $totalUsers }}"
                    percentage="2.00% (30 days)" />
                <x-dashboard-card cardClass="card-light-danger" title="Total Quiz" value="{{ $totalQuiz }}"
                    percentage="0.22% (30 days)" />
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function updateDateTime() {
            const now = new Date();
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            const date = now.toLocaleDateString('en-GB', options).replace(/ /g, ' ');
            const time = now.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('currentDateTime').textContent = `${date}, ${time}`;
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
@endpush