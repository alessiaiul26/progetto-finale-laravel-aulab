<div class="col-12 col-md-6 col-lg-4 mb-4 px-5">
    <div class="card h-100 shadow-sm">
        <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl('card') : 'https://via.placeholder.com/300x300' }}" 
            class="card-img-top" alt="copertina di {{$article->title}}">
        <div class="card-body">
            <span class="badge bg-green mb-2">{{ $article->category->name }}</span>
            <h5 class="card-title">{{ $article->title }}</h5>
            <p class="card-text text-green fw-bold">€ {{ number_format($article->price, 2) }}</p>
            @if($article->location)
                <p class="card-text text-muted">
                    <i class="fas fa-map-marker-alt"></i> {{ $article->location }}
                </p>
            @endif
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="far fa-clock"></i> {{ $article->created_at->locale('it')->diffForHumans() }}
                </small>
                <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-green">
                    Dettaglio
                </a>
            </div>
        </div>
    </div>
</div>