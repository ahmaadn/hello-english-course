<div class="mb-5">
    <h3 class="mb-4">Material for this Module</h3>
    <ul class="list-group mb-4">
        @foreach($module->materis as $material)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a @if($material->progress) href="{{ route('materi.show', [$module, $material]) }}" @else
                class="text-muted disabled" tabindex="-1" aria-disabled="true" @endif>
                    {{ $material->title }}
                    @if($material->progress)
                        @if ($material->id == $materi->id)
                            <span class="badge badge-success badge-pill">
                                current
                            </span>
                        @elseif($material->progress->status == 'finish')
                            <span class="badge badge-success badge-pill">
                                {{ $material->progress->status }}
                            </span>
                        @else
                            <span class="badge badge-warning badge-pill">
                                {{ $material->progress->status }}
                            </span>
                        @endif
                    @else
                        <i class="fa fa-lock ml-2" title="Locked"></i>
                    @endif
                </a>
                <span class="badge badge-primary badge-pill">
                    {{ $materi->genre->name }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
