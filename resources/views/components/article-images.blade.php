@props(['article'])

<div class="article-images mb-3">
    @if ($article->images && count($article->images) > 0)
        <div id="carousel-{{ $article->id }}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($article->images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="container">
                            <div class="row flex column justify-content-evenly">
                                {{-- ! Img --}}
                                <div class="col-12 col-md-4 col-lg-4">
                                    <img src="{{ $image->getUrl('thumbnail') }}" class="d-block"
                                        alt="Immagine {{ $loop->iteration }}" style="object-fit: cover; height: 200px;">
                                </div>
                                {{-- !Labels --}}
                                <div class="col-md-4 col-lg-4 ps-3 col-12">
                                    <div class="card-body">
                                        <h5 class="fw-bold">Labels</h5>
                                        @if ($image->labels)
                                            @foreach ($image->labels as $label)
                                                #{{ $label }},
                                            @endforeach
                                        @else
                                            <p class="fst-italic">No labels</p>
                                        @endif
                                    </div>
                                </div>
                                {{-- ! Ratings --}}
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="card-body">
                                        <h5 class="fw-bold">Ratings</h5>

                                        {{-- rating 1 --}}
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <div class="text-center mx-auto {{ $image->adult }}">
                                                </div>
                                            </div>
                                            <div class="col-8">adult</div>
                                        </div>

                                        {{-- rating 2 --}}
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <div class="text-center mx-auto {{ $image->violence }}">
                                                </div>
                                            </div>
                                            <div class="col-8">violence</div>
                                        </div>

                                        {{-- rating 3 --}}
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <div class="text-center mx-auto {{ $image->spoof }}">
                                                </div>
                                            </div>
                                            <div class="col-8">spoof</div>
                                        </div>

                                        {{-- rating 4 --}}
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <div class="text-center mx-auto {{ $image->medical }}">
                                                </div>
                                            </div>
                                            <div class="col-8">medical</div>
                                        </div>

                                        {{-- rating 5 --}}
                                        <div class="row justify-content-center">
                                            <div class="col-2">
                                                <div class="text-center mx-auto {{ $image->racy }}">
                                                </div>
                                            </div>
                                            <div class="col-8">racy</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- Chiusura row --}}
                        </div>


                    </div>
                @endforeach
            </div>
            @if (count($article->images) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $article->id }}"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $article->id }}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    @else
        <div class="text-muted text-center py-3 bg-light rounded">
            <i class="bi bi-image"></i>
            <p class="mb-0">Nessuna foto per questo annuncio</p>
        </div>
    @endif
</div>
