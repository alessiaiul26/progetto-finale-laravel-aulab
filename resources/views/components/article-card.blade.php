<div class="card mb-4 shadow-sm">
    <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl('card') : 'https://via.placeholder.com/300x300' }}" class="card-img-top" alt="img di {{ $article->title }}">
    <div class="card-body">
        <!-- Categoria -->
        <a href="#"
            class="card-subtitle mb-2 text-muted">{{ $article->category->name }}</a>

        <!-- Titolo -->
        <h5 class="card-title">{{ $article->title }}</h5>

        <!-- Prezzo -->
        <p class="card-text">€ {{ number_format($article->price, 2) }}</p>

        <!-- Pulsante Dettaglio -->
        <a href="{{ route('article.show', $article->id) }}" class="btn btn-green m-2">Dettaglio</a>

        {{-- TODO: Fare in modo che solo l'utente padre possa visualizzare il bottone modifica --}}
        <!-- Pulsante Modifica -->
        @if (Auth::user()->isParent($article->id))
            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-green m-2">Modifica</a>
            {{-- <a href="{{ route('article.delete', $article->id) }}" class="btn btn-danger m-2">Elimina annuncio</a> --}}
            {{-- modal for article delete --}}

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $article->id }}">
                Elimina annuncio
            </button>

            <div class="modal" id="deleteModal{{ $article->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cancella</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler cancellare questo annuncio?L'operazione è irreversibile.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <a href="{{ route('article.delete', $article->id) }}" class="btn btn-danger m-2">Elimina annuncio</a>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
