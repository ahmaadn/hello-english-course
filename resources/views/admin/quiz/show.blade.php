@extends('layouts.dashboard')

@section('title', 'Dashboard | Quiz Detail')

@section('content')
    <h4>Quiz: {{ $quiz->title }}</h4>
    <div class="mb-4">
        <strong>Materi.:</strong> {{ $quiz->materi->title ?? '-' }}<br>
        <strong>Type:</strong> {{ $quiz->tipe }}<br>
        <strong>Minimal Score:</strong> {{ $quiz->nilai_minimal }}
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tambah Soal</h5>
            <form action="{{ route('admin.pertanyaan.store', $quiz->id) }}" method="POST" id="formTambahSoal">
                @csrf
                <input type="hidden" name="tipe" value="{{ $quiz->tipe }}">
                <div class="mb-3">
                    <label for="teks">Teks Soal</label>
                    <textarea class="form-control" id="teks" name="teks" rows="3" required></textarea>
                    @if($quiz->tipe === 'drop_drag')
                        <small class="form-text text-muted">Untuk tipe Drop & Drag, disarankan menambah <FIELD> pada bagian yang
                                ingin diisi siswa, contoh: "I have a <FIELD> in my bag."</small>
                    @endif
                </div>
                @if($quiz->tipe === 'pilihan_ganda')
                    <div>
                        <label>Pilihan Jawaban</label>
                        <div id="pilihanContainer">
                            <div class="input-group mb-2">
                                <input type="text" name="options[]" class="form-control" placeholder="Pilihan 1" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger btn-remove-option" type="button">Hapus</button>
                                </div>
                            </div>
                            <div class="input-group mb-2">
                                <input type="text" name="options[]" class="form-control" placeholder="Pilihan 2" required>
                                <div class="input-group-append">
                                    <button class="btn btn-danger btn-remove-option" type="button">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mb-2" id="btnTambahPilihan">Tambah
                            Pilihan</button>
                        <div class="mb-3">
                            <label for="jawaban_benar">Jawaban Benar</label>
                            <select name="jawaban_benar" id="jawaban_benar" class="form-control" required></select>
                        </div>
                    </div>
                @elseif($quiz->tipe === 'drop_drag')
                    <div class="mb-3">
                        <label for="jawaban_benar_dd">Jawaban Benar</label>
                        <input type="text" name="jawaban_benar_dd" class="form-control" placeholder="Jawaban benar"
                            id="jawaban_benar_dd">
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Tambah Soal</button>
            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Daftar Soal</h5>
            @if($quiz->pertanyaans->count())
                <ul class="list-group">
                    @foreach($quiz->pertanyaans as $pertanyaan)
                        <li class="list-group-item mb-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>Soal:</strong> {{ $pertanyaan->teks }}<br>
                                    @if($quiz->tipe === 'pilihan_ganda')
                                        <div class="mt-2">
                                            <strong>Pilihan:</strong>
                                            <ul>
                                                @foreach(json_decode($pertanyaan->options, true) ?? [] as $opt)
                                                    <li>{{ $opt }}</li>
                                                @endforeach
                                            </ul>
                                            <strong>Jawaban Benar:</strong> {{ $pertanyaan->jawaban_benar }}
                                        </div>
                                    @elseif($quiz->tipe === 'drop_drag')
                                        <div class="mt-2">
                                            <strong>Jawaban Benar:</strong> {{ $pertanyaan->jawaban_benar }}<br>
                                            <small class="text-muted">Pastikan soal mengandung <FIELD> untuk drop & drag.</small>
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('admin.pertanyaan.destroy', $pertanyaan) }}" method="POST"
                                    onsubmit="return confirm('Hapus soal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-muted">Belum ada soal untuk quiz ini.</div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    @if($quiz->tipe === 'pilihan_ganda')
        <script>
            function updateJawabanBenarOptions() {
                const container = document.getElementById('pilihanContainer');
                const select = document.getElementById('jawaban_benar');
                select.innerHTML = '';
                Array.from(container.querySelectorAll('input[name="options[]"]')).forEach(function (input, idx) {
                    const val = input.value || `Pilihan ${idx + 1}`;
                    const option = document.createElement('option');
                    option.value = val;
                    option.textContent = val;
                    select.appendChild(option);
                });
            }
            document.getElementById('btnTambahPilihan').addEventListener('click', function () {
                const container = document.getElementById('pilihanContainer');
                const idx = container.children.length + 1;
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `<input type="text" name="options[]" class="form-control" placeholder="Pilihan ${idx}" required><div class="input-group-append"><button class="btn btn-danger btn-remove-option" type="button">Hapus</button></div>`;
                container.appendChild(div);
                updateJawabanBenarOptions();
            });
            document.getElementById('pilihanContainer').addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-remove-option')) {
                    e.target.closest('.input-group').remove();
                    updateJawabanBenarOptions();
                }
            });
            document.getElementById('pilihanContainer').addEventListener('input', function (e) {
                if (e.target.name === 'options[]') {
                    updateJawabanBenarOptions();
                }
            });
            // Inisialisasi awal
            updateJawabanBenarOptions();
        </script>
    @endif
@endpush
