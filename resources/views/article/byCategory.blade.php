<x-layout>
    <!-- Sezione con immagine di sfondo -->
    <div class="container-fluid py-5" 
         style="background-image: url('{{ asset('media/gradient.jpg') }}'); 
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-6 text-center text-white">
                    <h1 class="display-4 fw-bold feedback-title text-uppercase">
                        <i class="fa-brands fa-shopify mx-3"></i>{{ $category->name }}
                    </h1>
                    <p class="lead text-green">Esplora tutti gli annunci in questa categoria</p>
                    
                    <!-- Barra di Ricerca -->
                    <form action="{{route('article.search')}}" method="GET" class="d-flex justify-content-center mt-4 flex-column flex-md-row">
                        <input type="text" name="query" class="form-control mb-2 mb-md-0 me-md-2 rounded-pill w-100 w-md-50" 
                               placeholder="Cerca annunci..." 
                               aria-label="Cerca annunci">
                        <button type="submit" class="btn btn-green text-green rounded-pill px-4">
                            Cerca
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Bottoni e annunci -->
    <div class="container-fluid">
        <div class="row">
            <!-- Elenco annunci -->
            <div class="col-12 col-md-12">
                <div class="row justify-content-center">
                    @forelse ($articles as $article)
                        <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex">
                            <x-card :article="$article" class="w-100" />
                        </div>
                    @empty
                        <div class="col-12 col-md-6 text-center py-5">
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
            </div>
        </div>
    </div>
</x-layout>