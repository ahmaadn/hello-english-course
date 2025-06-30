@extends('layouts.page', ['currentPage' => 'result'])

@section('content')
    <div class="container py-4">
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title mb-3">Hasil Ujian: {{ $quiz->title ?? '-' }}</h3>
                <p><strong>Materi:</strong> {{ $materi->title ?? '-' }}</p>
                <p><strong>Skor Anda:</strong> <span class="badge bg-primary fs-5 text-white">{{ $skor }}</span></p>
                <p><strong>Nilai Minimal:</strong> {{ $quiz->nilai_minimal }}</p>
                @if($skor >= $quiz->nilai_minimal)
                    <div class="alert alert-success">Selamat! Anda lulus ujian ini.</div>
                @else
                    <div class="alert alert-danger">Skor Anda belum memenuhi nilai minimal. Silakan coba lagi.</div>
                @endif
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
                            <th>Jawaban Anda</th>
                            <th>Jawaban Benar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{!! nl2br(e($item['soal'])) !!}</td>
                                <td>{{ $item['jawaban_user'] }}</td>
                                <td>{{ $item['jawaban_benar'] }}</td>
                                <td>
                                    @if($item['is_true'] === true)
                                        <span class="badge bg-success text-white">Benar</span>
                                    @elseif($item['is_true'] === false)
                                        <span class="badge bg-danger text-white">Salah</span>
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
            <a href="{{ route('materi.next', [$module, $materi]) }}" class="btn btn-outline-primary">Kembali ke Materi</a>
        </div>
    </div>
@endsection
