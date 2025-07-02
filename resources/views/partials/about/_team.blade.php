<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Our Team</span>
            </p>
            <h1 class="mb-4">Meet Our Team</h1>
        </div>
        <div class="row">
            @foreach($team ?? [] as $member)
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
                        <img class="img-fluid w-100" src="{{ asset($member['img']) }}" alt="{{ $member['nama'] }}" />
                    </div>
                    <h4>{{ $member['nama'] }}</h4>
                    <p>{{ $member['nim'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
