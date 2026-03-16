<x-layout>
    <div class="container mt-5">
        <h2 class="feedback-title mb-4 text-center">Modifica il tuo profilo</h2>

        <div class="row">
            <!-- Colonna Sinistra più espansiva -->
            <div class="col-12 col-lg-8 mb-4">
                <form action="{{ route('profile.update') }}" method="POST" class="card-setting shadow-sm">
                    @csrf
                    <div class="card-setting-body">
                        <!-- Campi attualmente funzionanti -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-dark">Nome</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-dark">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <!-- Campi non ancora disponibili -->
                        <div class="coming-soon-fields">
                            <div class="position-relative">
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-secondary">Presto disponibile</span>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Immagine Profilo</label>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/100" alt="Profile"
                                            class="rounded-circle me-3" style="width: 100px; height: 100px;">
                                        <div class="flex-grow-1">
                                            <input type="file" class="form-control" name="profile_image">
                                            <small class="text-muted">Dimensione massima: 2MB. Formati supportati: JPG,
                                                PNG</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Data di Nascita</label>
                                    <input type="date" class="form-control" name="date_of_birth">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Località</label>
                                    <input type="text" class="form-control" name="local"
                                        placeholder="Es: Milano, IT">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Hobby e Interessi</label>
                                    <select class="form-select" name="category" multiple>
                                        <option>Sport</option>
                                        <option>Musica</option>
                                        <option>Arte</option>
                                        <option>Tecnologia</option>
                                        <option>Viaggi</option>
                                    </select>
                                    <small class="text-muted">Seleziona uno o più interessi</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark">Biografia</label>
                                    <textarea class="form-control" name="biography" rows="4" placeholder="Raccontaci qualcosa di te..."></textarea>
                                    <small class="text-muted">Massimo 500 caratteri</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-green">Aggiorna Profilo</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary ms-2">Annulla</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Colonna Destra più piccola -->
            <div class="col-12 col-lg-4">
                <div class="card-setting shadow-sm">
                    <div class="card-setting-body">
                        <h5 class="card-title-setting text-dark">
                            <i class="fas fa-info-circle me-2"></i>Informazioni
                        </h5>
                        <p class="card-text-setting">
                            Stiamo lavorando per rendere disponibili nuove funzionalità per il tuo profilo.
                            Presto potrai personalizzare ulteriormente il tuo account con foto, interessi e molto altro!
                        </p>
                        <hr>
                        <small class="text-muted">
                            <i class="fas fa-lock me-1"></i>
                            I tuoi dati sono al sicuro con noi. Non condivideremo mai le tue informazioni personali con
                            terze parti.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
