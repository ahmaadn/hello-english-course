@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Detail Hasil Quiz</h2>
        <div class="card mb-4">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">User</dt>
                    <dd class="col-sm-9">{{ $historyQuiz->user->name ?? '-' }}</dd>
                    <dt class="col-sm-3">Quiz</dt>
                    <dd class="col-sm-9">{{ $historyQuiz->quiz->judul ?? '-' }}</dd>
                    <dt class="col-sm-3">Materi</dt>
                    <dd class="col-sm-9">{{ $historyQuiz->quiz->materi->judul ?? '-' }}</dd>
                    <dt class="col-sm-3">Module</dt>
                    <dd class="col-sm-9">{{ $historyQuiz->quiz->materi->module->judul ?? '-' }}</dd>
                    <dt class="col-sm-3">Nilai</dt>
                    <dd class="col-sm-9">
                        @php
                            $badgeClass = $historyQuiz->nilai < $historyQuiz->quiz->nilai_minimal ? 'bg-danger' : 'bg-success';
                        @endphp
                        <span class="badge {{ $badgeClass }} fs-5">{{ $historyQuiz->nilai }}</span>
                    </dd>
                    <dt class="col-sm-3">Tanggal</dt>
                    <dd class="col-sm-9">{{ $historyQuiz->created_at->format('d-m-Y H:i') }}</dd>
                </dl>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Detail Jawaban</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban User</th>
                            <th>Jawaban Benar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historyQuiz->quiz->pertanyaans as $i => $soal)
                            @php
                                $jawaban = $jawabanUsers->where('pertanyaan_id', $soal->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{!! nl2br(e($soal->teks)) !!}</td>
                                <td>{{ $jawaban->jawaban ?? '-' }}</td>
                                <td>{{ $soal->jawaban_benar }}</td>
                                <td>
                                    @if(isset($jawaban) && $jawaban->is_true)
                                        <span class="badge bg-success">Benar</span>
                                    @elseif(isset($jawaban) && !$jawaban->is_true)
                                        <span class="badge bg-danger">Salah</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.history-quiz.index') }}" class="btn btn-outline-primary">Kembali ke Riwayat</a>
        </div>
    </div>
@endsection