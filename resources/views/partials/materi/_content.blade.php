<div class="d-flex flex-column text-left mb-3">
    <p class="section-title pr-5">
        <span class="pr-2">{{ $module->name }} | {{ $materi->title }}</span>
    </p>
    <h1 class="mb-3">{{ $materi->title }}</h1>
    <div class="d-flex">
        <p class="mr-3"><i class="fa fa-user text-primary"></i> {{ $module->user->name }}</p>
        <p class="mr-3">
            <i class="fa fa-folder text-primary"></i> {{ $materi->genre->name }}
        </p>
    </div>
</div>
<div class="mb-5">
    @if(Str::startsWith($module->image_url, ['http://', 'https://']))
        <img class="img-fluid rounded w-100 mb-4" src="{{  $module->image_url }}" alt="Image" />
    @else
        <img class="img-fluid rounded w-100 mb-4" src="{{  asset('storage/' . $materi->image_url) }}" alt="Image" />
    @endif

    <p>
        {{ $materi->content }}
    </p>
</div>
@if(isset($quiz) && $quiz->pertanyaans->count())
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Quiz: {{ $quiz->title }}</h5>
            <form action="{{ route('materi.quiz.submit', [$module->slug, $materi->slug, $quiz->id]) }}"  method="POST" id="formQuizMateri">
                @csrf
                @if($quiz->tipe === 'essay')
                    <div class="alert alert-info">Answer the following questions with short answers.</div>
                @elseif($quiz->tipe === 'pilihan_ganda')
                    <div class="alert alert-info">Choose the most correct answer.</div>
                @elseif($quiz->tipe === 'drop_drag')
                    <div class="alert alert-info">Drag the answer to the appropriate box on the question.</div>
                @endif
                @foreach($quiz->pertanyaans as $idx => $soal)
                    <div class="mb-4">
                        <strong>Soal {{ $idx + 1 }}:</strong>
                        <div class="mt-2">
                            @if($quiz->tipe === 'essay')
                                <div>{{ $soal->teks }}</div>
                                <textarea name="jawaban[{{ $soal->id }}]" class="form-control mt-2" rows="2"
                                    placeholder="Jawaban Anda..."></textarea>
                            @elseif($quiz->tipe === 'pilihan_ganda')
                                <div>{{ $soal->teks }}</div>
                                @foreach(json_decode($soal->options, true) ?? [] as $opt)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opt }}"
                                            id="soal_{{ $soal->id }}_{{ $loop->index }}">
                                        <label class="form-check-label" for="soal_{{ $soal->id }}_{{ $loop->index }}">{{ $opt }}</label>
                                    </div>
                                @endforeach
                            @elseif($quiz->tipe === 'drop_drag')
                                @php
                                    $jawabanList = [];
                                    foreach ($quiz->pertanyaans as $q) {
                                        if ($q->jawaban_benar)
                                            $jawabanList[] = $q->jawaban_benar;
                                    }
                                    $jawabanList = array_unique($jawabanList);

                                    $teks = e($soal->teks);
                                    if (strpos($teks, 'FIELD') !== false) {
                                        $output = preg_replace('[FIELD]', '<span class="drop-field" data-id="' . $soal->id . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>', $teks, 1);
                                    } else {
                                        $output = $teks . ' <span class="drop-field" data-id="' . $soal->id . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                                    }
                                @endphp
                                <div>{!! $output !!}</div>
                            @endif
                        </div>
                    </div>
                @endforeach
                @if($quiz->tipe === 'drop_drag')
                    <div class="mb-3">
                        <strong>Jawaban:</strong>
                        <div id="drag-answers" class="d-flex flex-wrap">
                            @foreach($jawabanList as $ans)
                                <div style="border-radius: 6px;" class="draggable-answer btn btn-primary btn- m-2" draggable="true">
                                    {{ $ans }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <button type="submit" class="btn btn-success">Kirim Jawaban</button>
            </form>
        </div>
    </div>
@endif
@push('scripts')
    @if(isset($quiz) && $quiz->tipe === 'drop_drag')
        <style>
            .drop-field {
                display: inline-block;
                min-width: 80px;
                min-height: 32px;
                border: 2px dashed #007bff;
                border-radius: 6px;
                background: #f8f9fa;
                padding: 4px 10px;
                margin: 0 4px;
                text-align: center;
                vertical-align: middle;
                cursor: pointer;
                transition: background 0.2s, border-color 0.2s;
            }

            .drop-field.bg-light {
                background: #e3f0ff !important;
                border-color: #0056b3 !important;
            }
        </style>
        <script>
            document.querySelectorAll('.draggable-answer').forEach(function (el) {
                el.addEventListener('dragstart', function (e) {
                    e.dataTransfer.setData('text/plain', this.textContent);
                });
            });
            document.querySelectorAll('.drop-field').forEach(function (field) {
                field.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    this.classList.add('bg-light');
                });
                field.addEventListener('dragleave', function (e) {
                    this.classList.remove('bg-light');
                });
                field.addEventListener('drop', function (e) {
                    e.preventDefault();
                    this.textContent = e.dataTransfer.getData('text/plain');
                    this.classList.remove('bg-light');
                });
            });
            document.getElementById('formQuizMateri').addEventListener('submit', function (e) {
                document.querySelectorAll('.drop-field').forEach(function (field) {
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'jawaban[' + field.dataset.id + ']';
                    input.value = field.textContent.trim();
                    e.target.appendChild(input);
                });
            });
        </script>
    @endif
@endpush
