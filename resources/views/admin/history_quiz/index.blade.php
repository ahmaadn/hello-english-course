@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Quiz Results History</h2>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Quiz</th>
                            <th>Materi</th>
                            <th>Module</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $i => $history)
                            <tr>
                                <td>{{ $histories->firstItem() + $i }}</td>
                                <td>{{ $history->user->name ?? '-' }}</td>
                                <td>{{ $history->quiz->title ?? '-' }}</td>
                                <td>{{ $history->quiz->materi->title ?? '-' }}</td>
                                <td>{{ $history->quiz->materi->module->name ?? '-' }}</td>
                                @php
                                    $badgeClass = $history->nilai < $history->quiz->nilai_minimal ? 'bg-danger' : 'bg-success';
                                @endphp
                                <td><span class="badge {{ $badgeClass }}">{{ $history->nilai }}</span></td>
                                <td>{{ $history->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.history-quiz.show', $history) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection