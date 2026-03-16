<x-layout>
    <div class="container mt-5 join-team-page">
        <h1 class="feedback-title text-center mb-5">Unisciti al nostro Team</h1>

        <!-- Sezione Ruoli -->
        <div class="row mb-5">
            <!-- Writer Card -->
            <div class="col-md-4 mb-4">
                <div class="card-hover h-100 w-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-pencil-square display-4 text-green"></i>
                        </div>
                        <h3 class="card-title mb-3">Writer</h3>
                        <p class="card-text">
                            Come Writer, potrai:
                        </p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check2 text-success me-2"></i>Creare e pubblicare annunci</li>
                            <li><i class="bi bi-check2 text-success me-2"></i>Gestire i tuoi contenuti</li>
                            <li><i class="bi bi-check2 text-success me-2"></i>Interagire con la community</li>
                        </ul>
                        <p class="card-text mt-3">
                            Ideale per chi ama scrivere e condividere contenuti.
                        </p>
                        <button class="btn btn-outline-primary mt-3"
                            onclick="window.location.href='{{ route('register') }}'">
                            Registrati come Writer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Revisor Card -->
            <div class="col-md-4 mb-4">
                <div class="card-hover w-100 h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-shield-check display-4 text-success"></i>
                        </div>
                        <h3 class="card-title mb-3 text-dark">Revisore</h3>
                        <p class="card-text">
                            Come Revisore, potrai:
                        </p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check2 text-success me-2"></i>Revisionare gli annunci</li>
                            <li><i class="bi bi-check2 text-success me-2"></i>Garantire la qualità dei contenuti</li>
                            <li><i class="bi bi-check2 text-success me-2"></i>Collaborare con gli autori</li>
                        </ul>
                        <p class="card-text mt-3">
                            Perfetto per chi ha occhio critico e attenzione ai dettagli.
                        </p>
                        @auth
                            <button class="btn btn-outline-success mt-3" data-bs-toggle="modal"
                                data-bs-target="#revisorModal">
                                Diventa Revisore
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-success mt-3">
                                Accedi per diventare Revisore
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Admin Card -->
            <div class="col-md-4 mb-4">
                <div class="card-hover h-100 w-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-gear display-4 text-dark"></i>
                        </div>
                        <h3 class="card-title mb-3">Amministratore</h3>
                        <p class="card-text">
                            Come Amministratore, potrai:
                        </p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check2 text-success me-2"></i>Gestire l'intero sito</li>
                            <li><i class="bi bi-check2 text-success me-2"></i>Approvare i revisori</li>
                            <li><i class="bi bi-check2 text-success me-2"></i>Supervisionare i contenuti</li>
                        </ul>
                        <p class="card-text mt-3">
                            Per chi ha esperienza e vuole gestire la piattaforma.
                        </p>
                        <button class="btn btn-outline-dark mt-3" data-bs-toggle="modal" data-bs-target="#adminModal">
                            Diventa Amministratore
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Revisore -->
        <div class="modal fade" id="revisorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Richiesta Ruolo Revisore</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('become.revisor', ['user' => Auth::user()]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label text-dark">Perché vuoi diventare
                                    revisore?</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4"
                                    required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    Raccontaci perché vorresti diventare revisore e quali sono le tue competenze.
                                    Minimo 20 caratteri, massimo 500.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-success">Invia Richiesta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Admin -->
        <div class="modal fade" id="adminModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Richiesta Ruolo Amministratore</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.request.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label text-dark">Perché vuoi diventare
                                    amministratore?</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4"
                                    required>{{ old('message') }}</textarea>
                                <div class="form-text">
                                    Spiega le tue motivazioni per diventare amministratore.
                                    Minimo 15 caratteri, massimo 1000.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="experience" class="form-label text-dark">Esperienza Professionale</label>
                                <textarea class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience"
                                    rows="6" required>{{ old('experience') }}</textarea>
                                <div class="form-text">
                                    Descrivi la tua esperienza professionale, inclusi ruoli precedenti e responsabilità.
                                    Minimo 50 caratteri, massimo 2000.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="skills" class="form-label text-dark">Competenze Tecniche</label>
                                <textarea class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills" rows="4"
                                    required>{{ old('skills') }}</textarea>
                                <div class="form-text">
                                    Elenca le tue competenze tecniche rilevanti per il ruolo di amministratore.
                                    Minimo 30 caratteri, massimo 1000.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark">Invia Richiesta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
