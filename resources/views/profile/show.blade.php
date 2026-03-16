<x-layout>
    <div class="container mt-5">
        <!-- Video come sfondo -->
        <video autoplay muted loop id="video-background">
            <source src="{{ asset('media/video-profile.mp4') }}" type="video/mp4">
            Il tuo browser non supporta il video.
        </video>
        <div class="row justify-content-center">
            <div class=" col-12 col-md-6">

                <!-- Titolo principale -->
                <h1 class="text-center display-4 mb-5 fw-bold feedback-title">Il mio profilo</h1>

                <!-- Card profilo migliorata -->
                <div class="card-profile shadow-lg border-0 rounded-4 mx-auto"
                    style="max-width: 600px; overflow: hidden;">
                    <!-- Sezione immagine profilo -->
                    <div class="bg-green position-relative" style="height: 180px;">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            @if ($user->profile_image)
                                <img src="{{ Storage::url($user->profile_image) }}"
                                    class="rounded-circle border border-4 border-white shadow" alt="Profile Image"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light border border-4 border-white d-flex align-items-center justify-content-center shadow"
                                    style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x text-green"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Corpo della card -->
                    <div class="card-body text-center pt-5">
                        <h3 class="card-title text-white fw-bold mb-3">Ciao, {{ $user->name }} 👋</h3>
                        <p class="card-text text-white">
                            <i class="fas fa-envelope me-2 text-green"></i><strong>Email:</strong> {{ $user->email }}
                        </p>
                        <p class="card-text text-white">
                            <i class="fas fa-birthday-cake me-2 text-green"></i><strong>Data di nascita:</strong>
                            {{ $user->date_of_birth ? $user->date_of_birth : 'Non disponibile' }}
                        </p>
                        <div class="card-text text-white">
                            <i class="fas fa-user-edit me-2 text-green"></i><strong>Biografia:</strong>
                            <p class="mt-2 fst-italic {{ $user->biography ? '' : 'text-white' }}">
                                {{ $user->biography ?? 'Nessuna biografia disponibile' }}
                            </p>
                        </div>
                        <p class="card-text text-white">
                            <i class="fas fa-calendar-alt me-2 text-green"></i><strong>Account creato il:</strong>
                            {{ $user->created_at->format('d/m/Y') }}
                        </p>
                        <p class="card-text text-white">
                            <strong>Ruolo Utente:</strong>
                        </p>
                        <div class="d-flex align-items-center">
                            @if (auth()->user()->is_admin)
                                <i class="bi bi-gear-fill text-dark me-2 fs-4"></i>
                                <h4 class="mb-0">{{ auth()->user()->role }}</h4>
                            @elseif(auth()->user()->is_revisor)
                                <i class="bi bi-shield-check text-success me-2 fs-4"></i>
                                <h4 class="mb-0">{{ auth()->user()->role }}</h4>
                            @else
                                <i class="bi bi-pencil-square text-primary me-2 fs-4"></i>
                                <h4 class="mb-0">Writer: {{ auth()->user()->name }}</h4>
                            @endif
                        </div>
                        <p class="text-white mt-2 mb-0">
                            @if (Auth::user()->is_admin)
                                Come amministratore, puoi gestire l'intero sito e approvare le richieste dei
                                revisori.
                            @elseif(Auth::user()->is_revisor)
                                Come revisore, puoi revisionare gli annunci prima della pubblicazione.
                            @else
                                Come writer, puoi creare e pubblicare i tuoi annunci nella nostra piattaforma.
                            @endif
                        </p>


                        <!-- Pulsante modifica -->
                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-green rounded-pill px-4 py-2 mt-3 shadow-sm">
                            <i class="fas fa-user-edit me-2"></i>Modifica Profilo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
