<div class="card mb-4 shadow-sm">
    <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl('thumbnail') : 'https://via.placeholder.com/300x300' }}"
        class="card-img-top" alt="img di {{ $article->title }}">
    <div class="card-body d-flex flex-column">
        <!-- Categoria -->
        <h6 class="card-subtitle mb-2 text-muted">{{ $article->category->name }}</h6>

        <!-- Titolo -->
        <h5 class="card-title">{{ $article->title }}</h5>

        <!-- Prezzo -->
        <p class="card-text flex-grow-1">€ {{ number_format($article->price, 2) }}</p>

        <!-- Pulsante Dettagli -->
        <a href="{{ route('article.show', $article->id) }}" class="btn btn-green">Dettaglio</a>
    </div>
</div>
