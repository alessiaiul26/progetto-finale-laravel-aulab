<x-layout>
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="rounded shadow  mb-4">
                    <h1 class="display-5 text-center pb-2">annunci da Revisionare</h1>
                </div>
            </div>
        </div>

        {{-- Messaggio di sistema --}}
        @if (session()->has('message'))
            <div class="row justify-content-center align-items-center">
                <div class="col-5 alert alert-warning text-center fst-italic shadow rounded fw-bold mt-2 mb-4">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        {{-- Tabella per dispositivi medi e grandi --}}
        <div class="row justify-content-center mb-5">
            <div class="col-12">
                @if ($articles_to_check && count($articles_to_check) > 0)
                    <table class="table table-striped table-hover d-none d-md-table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titolo Annuncio</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Descrizione</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles_to_check as $article)
                                <tr>
                                    <th scope="row">{{ $article->id }}</th>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>{{ Str::limit($article->description, 80) }}</td>
                                    <td>€{{ number_format($article->price, 2) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-green py-2 px-4 fw-bold"
                                            data-bs-toggle="modal" data-bs-target="#articleModal{{ $article->id }}">
                                            Controlla annuncio
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center text-warning">Non ci sono annunci da revisionare.</h3>
                @endif
            </div>
        </div>

        {{-- Versione mobile: Card-table --}}
        <div class="d-md-none mb-5">
            @if ($articles_to_check && count($articles_to_check) > 0)
                @foreach ($articles_to_check as $article)
                    <div class="card-table mb-3 shadow">
                        <div class="card-table-body">
                            <h5 class="card-table-title fw-bold">{{ $article->title }}</h5>
                            <p class="card-table-text"><strong>Categoria:</strong> {{ $article->category->name }}</p>
                            <p class="card-table-text"><strong>Descrizione:</strong>
                                {{ Str::limit($article->description, 80) }}</p>
                            <p class="card-table-text"><strong>Prezzo:</strong>
                                €{{ number_format($article->price, 2) }}</p>
                            <div class="d-flex flex-column">
                                <button type="button" class="btn btn-green py-2 px-4 fw-bold mb-2"
                                    data-bs-toggle="modal" data-bs-target="#articleModal{{ $article->id }}">
                                    Controlla annuncio
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="text-center text-muted">Non ci sono annunci da revisionare.</h3>
            @endif
        </div>

        {{-- Sezione annunci Revisionati --}}
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-4">annunci Revisionati da Me</h2>

                    {{-- Sezione annunci Accettati --}}
                    <div class="mb-5">
                        <h3 class="mb-4">annunci Accettati</h3>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Titolo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Prezzo</th>
                                        <th scope="col">Creato il</th>
                                        <th scope="col">Stato</th>
                                        <th scope="col">Data Approvazione</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accepted_articles as $article)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $article->title }}</td>
                                            <td>{{ $article->category->name }}</td>
                                            <td>€{{ number_format($article->price, 2) }}</td>
                                            <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if ($article->was_rejected)
                                                    <span class="badge bg-info">Riaccettato</span>
                                                @else
                                                    <span class="badge bg-success">Accettato</span>
                                                @endif
                                            </td>
                                            <td>
                                                <x-format-date :date="$article->approved_at" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Sezione annunci Rifiutati --}}
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-danger  fw-bold mb-4 border-bottom pb-2">annunci Rifiutati</h3>
                        </div>
                        <div class="row g-4">
                            @forelse($rejected_articles as $article)
                                <div class="col-12 col-md-8 col-lg-6">
                                    <div class="card-review bgModal BorderModal">
                                        {{-- Componente per le immagini --}}
                                        <x-article-images :article="$article" />

                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h5 class="card-title text-danger mb-0">{{ $article->title }}</h5>
                                            </div>

                                            <p class="card-text">
                                                <small class="text-muted">Categoria:
                                                    {{ $article->category->name }}</small>
                                            </p>
                                            <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                                            <p class="card-text">
                                                <strong>Prezzo:</strong> €{{ number_format($article->price, 2) }}
                                            </p>
                                            <p class="card-text">
                                                <small class="text-muted">Rifiutato il: <x-format-date
                                                        :date="$article->rejected_at" /></small>
                                            </p>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#reapproveModal{{ $article->id }}">
                                                <i class="bi bi-check-circle me-1"></i>Riaccetta
                                            </button>
                                        </div>

                                        <!-- Modal di Conferma -->
                                        <div class="modal fade" id="reapproveModal{{ $article->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark">Conferma Riapprovazione</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Sei sicuro di voler riapprovare l'annuncio
                                                        "{{ $article->title }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bi bi-x-circle me-1"></i>Annulla
                                                        </button>
                                                        <form action="{{ route('accept', ['article' => $article]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="bi bi-check-circle me-1"></i>Conferma
                                                                Riapprovazione
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-light text-center">
                                        <p class="mb-0">Non hai ancora rifiutato nessun annuncio</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Paginazione -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $rejected_articles->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Modali per VALUTAZIONE ogni annuncio --}}
        @foreach ($articles_to_check as $article)
            <div class="modal fade" id="articleModal{{ $article->id }}" tabindex="-1"
                aria-labelledby="articleModalLabel{{ $article->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bgModal">
                        <div class="modal-header">
                            <h5 class="modal-title text-white" id="articleModalLabel{{ $article->id }}">
                                Revisione annuncio: {{ $article->title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center flex-column align-content-center">
                            {{-- Dettagli annuncio --}}
                            <div class="article-details mt-4 text-white text-center">
                                <h6 class="fw-bold">Dettagli annuncio:</h6>
                                <p><strong class="text-white">Categoria:</strong> {{ $article->category->name }}</p>
                                <p><strong class="text-white">Prezzo:</strong>
                                    €{{ number_format($article->price, 2) }}</p>
                                <p><strong class="text-white">Descrizione:</strong> {{ $article->description }}</p>
                            </div>

                            {{-- Immagini dell'annuncio --}}
                            <div class="article-images col-md-12 mb-4 mx-3">
                                <x-article-images :article="$article" />
                                {{-- !inserire QUI ratings, adult, violence, spoof, racy, medical --}}
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <form action="{{ route('reject', ['article' => $article]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Rifiuta</button>
                            </form>
                            <form action="{{ route('accept', ['article' => $article]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Accetta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
