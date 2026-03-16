<div class="product-container">
    <div class="product-card mt-5">
        <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl('card') : 'https://via.placeholder.com/300x300' }}" alt="img {{ $article->title }}" >
        <h5 class="fst-italic">{{ $article->title }} </h5>
        <span><strong>{{ $article->description }}</strong></span>

        <div class="d-flex mx-4 justify-content-center mt-3 text-center">
            <p class="price">€ {{ number_format($article->price, 2) }}</p>
        </div>

        <div class="d-flex justify-content-evenly align-items-center mt-4">
            <a href="{{ route('article.show', compact('article')) }}" class="btn btn-green">Dettaglio</a>
            <a href="{{ route('byCategory', ['category' => $article->category]) }}" class="btn btn-green mx-2">
                {{ $article->category->name }}
            </a>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-3">
            <form action="{{ route('cart.add', ['article' => $article]) }}" method="POST">
                @csrf
                <button type="submit" class="add-btn">
                    <i class="fas fa-shopping-cart me-2"></i>Aggiungi al carrello
                </button>
            </form>
        </div>

        <div class="card-footer bg-light text-muted mt-3 p-2 text-center">
            <small>
                <i class="far fa-clock me-1"></i>
                Pubblicato {{ $article->created_at->locale('it')->diffForHumans() }}
                @if($article->location)
                    <br>
                    <i class="fas fa-map-marker-alt me-1 mt-1"></i>{{ $article->location }}
                @endif
            </small>
        </div>
    </div>
</div>
