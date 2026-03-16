<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Filtri a sinistra -->
        <div class="col-12 col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Filtri di Ricerca</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-dark fw-bold">Cerca</label>
                        <input type="text" class="form-control" wire:model.live="search" placeholder="Cerca annunci...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label  text-dark fw-bold">Prezzo</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control" wire:model.live="priceMin" placeholder="Min €">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" wire:model.live="priceMax" placeholder="Max €">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label  text-dark fw-bold">Località</label>
                        <input type="text" class="form-control" wire:model.live="location" placeholder="Cerca per località">
                    </div>

                    <div class="mb-3">
                        <label class="form-label  text-dark fw-bold">Categorie</label>
                        <div class="overflow-auto" style="max-height: 200px;">
                            @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       wire:model.live="selectedCategories" 
                                       value="{{ $category->id }}" 
                                       id="category{{ $category->id }}">
                                <label class="form-check-label" for="category{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ordina per</label>
                        <select class="form-select" wire:model.live="sortBy">
                            <option value="">Più recenti</option>
                            <option value="date_asc">Meno recenti</option>
                            <option value="price_asc">Prezzo crescente</option>
                            <option value="price_desc">Prezzo decrescente</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista annunci a destra -->
        <div class="col-12 col-md-9">
            <div class="row">
                @forelse ($articles as $article)
                    <x-searched_article_card :article="$article" />
                @empty
                    <div class="col-12 m-auto col-md-6 text-center py-5">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body mt-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <h3 class="card-title">Nessun annuncio trovato</h3>
                                <p class="card-text text-muted">Non sono presenti annunci in questa categoria</p>
                                @auth
                                    <a href="{{ route('create.article') }}" class="btn btn-green mt-3">
                                        <i class="fas fa-plus me-2"></i>Pubblica un annuncio
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        
            {{-- link che gli user possono cliccare per sfogliare le pagine fornite dal set di dati presi dal DB --}}
            @if (!$articles->isEmpty())
                <div class="d-flex align-items-center justify-content-evenly">
                    {{ $articles->links() }}
                </div>
            @endif

            {{-- <div class="d-flex justify-content-center mt-4">
                {{ $articles->links() }}
            </div> --}}
        </div>
    </div>
</div>