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

<!-- Related Post -->
<div class="mb-5 mx-n3">
    <h2 class="mb-4 ml-3">Related Post</h2>
    <div class="owl-carousel post-carousel position-relative">
        <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mx-3">
            <img class="img-fluid" src="img/post-1.jpg" style="width: 80px; height: 80px" />
            <div class="pl-3">
                <h5 class="">Diam amet eos at no eos</h5>
                <div class="d-flex">
                    <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                    <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web
                        Design</small>
                    <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mx-3">
            <img class="img-fluid" src="img/post-2.jpg" style="width: 80px; height: 80px" />
            <div class="pl-3">
                <h5 class="">Diam amet eos at no eos</h5>
                <div class="d-flex">
                    <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                    <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web
                        Design</small>
                    <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mx-3">
            <img class="img-fluid" src="img/post-3.jpg" style="width: 80px; height: 80px" />
            <div class="pl-3">
                <h5 class="">Diam amet eos at no eos</h5>
                <div class="d-flex">
                    <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                    <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web
                        Design</small>
                    <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comment List -->
<div class="mb-5">
    <h2 class="mb-4">3 Comments</h2>
    <div class="media mb-4">
        <img src="img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px" />
        <div class="media-body">
            <h6>
                John Doe <small><i>01 Jan 2045 at 12:00pm</i></small>
            </h6>
            <p>
                Diam amet duo labore stet elitr ea clita ipsum, tempor labore
                accusam ipsum et no at. Kasd diam tempor rebum magna dolores
                sed sed eirmod ipsum. Gubergren clita aliquyam consetetur
                sadipscing, at tempor amet ipsum diam tempor consetetur at
                sit.
            </p>
            <button class="btn btn-sm btn-light">Reply</button>
        </div>
    </div>
    <div class="media mb-4">
        <img src="img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px" />
        <div class="media-body">
            <h6>
                John Doe <small><i>01 Jan 2045 at 12:00pm</i></small>
            </h6>
            <p>
                Diam amet duo labore stet elitr ea clita ipsum, tempor labore
                accusam ipsum et no at. Kasd diam tempor rebum magna dolores
                sed sed eirmod ipsum. Gubergren clita aliquyam consetetur
                sadipscing, at tempor amet ipsum diam tempor consetetur at
                sit.
            </p>
            <button class="btn btn-sm btn-light">Reply</button>
            <div class="media mt-4">
                <img src="img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px" />
                <div class="media-body">
                    <h6>
                        John Doe <small><i>01 Jan 2045 at 12:00pm</i></small>
                    </h6>
                    <p>
                        Diam amet duo labore stet elitr ea clita ipsum, tempor
                        labore accusam ipsum et no at. Kasd diam tempor rebum
                        magna dolores sed sed eirmod ipsum. Gubergren clita
                        aliquyam consetetur, at tempor amet ipsum diam tempor at
                        sit.
                    </p>
                    <button class="btn btn-sm btn-light">Reply</button>
                </div>
            </div>
        </div>
    </div>
</div>
