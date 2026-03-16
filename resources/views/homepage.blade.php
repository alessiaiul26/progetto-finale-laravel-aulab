<x-layout>
    {{-- SESSIONE MESSAGGI --}}
    @if (session()->has('errorMessage'))
        <div class="alert alert-danger text-center shadow rounded w-50 fst-italic">
            {{ session('errorMessage') }}
        </div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success text-center shadow rounded w-50 fst-italic">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('successLogin'))
        <div class="alert alert-success text-center shadow rounded w-50 fst-italic">
            {{ session('successLogin') }}
        </div>
    @endif
    @if (session()->has('successRegister'))
        <div class="alert alert-success text-center shadow rounded w-50 fst-italic">
            {{ session('successRegister') }}
        </div>
    @endif

    <!-- Header principale -->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="left-section mx-5 d-flex flex-column align-items-center align-items-md-start mb-4 mb-md-0">
            <div class="logo mx-2">
                <img src="/media/logo2.png" alt="Logo Presto.it" class="logo-image mb-3">
            </div>
        </div>
        <div class="right-section mx-5 mt-5 text-white text-center text-md-start">
            <h1 class="welcome">{{ __('homepage.Benvenuto_su_Presto.it') }}</h1>
            <h2 class="feedback-title text-center">{{ __('homepage.Nostro_sito_di_annunci') }}</h2>
            <p class="subtitle">{{ __('homepage.Trova_cio_che_cerchi_vendi_cio_che_vuoi.') }}</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('article.index') }}" class="btn btn-green p-3">{{ __('homepage.Scopri_di_ più') }}</a>
            </div>
        </div>
    </div>

<!-- Carosello per Desktop (3 card per slide) -->
<div class="container my-5 d-none d-md-block">
    <h1 class="feedback-title text-center mb-4">{{ __('homepage.I_nostri_articoli') }}</h1>
    <div id="articleCarouselDesktop" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            @forelse ($articles->chunk(3) as $index => $chunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach ($chunk as $article)
                            <div class="col-md-4 mb-3 d-flex justify-content-center">
                                <x-welcome-card :article="$article" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="carousel-item active">
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <h3>{{ __('homepage.Nessun_articolo_disponibile') }}</h3>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- Controlli -->
        <button class="carousel-control-prev" type="button" data-bs-target="#articleCarouselDesktop" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('homepage.Precedente') }}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#articleCarouselDesktop" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('homepage.Successivo') }}</span>
        </button>
    </div>
</div>

<!-- Carosello per Mobile (1 card per slide) -->
<div class="container my-5 d-block d-md-none">
    <h1 class="feedback-title text-center mb-4">{{ __('homepage.I_nostri_articoli') }}</h1>
    <div id="articleCarouselMobile" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            @forelse ($articles as $index => $article)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <x-welcome-card :article="$article" />
                    </div>
                </div>
            @empty
                <div class="carousel-item active">
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <h3>{{ __('homepage.Nessun_articolo_disponibile') }}</h3>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- Controlli -->
        <button class="carousel-control-prev" type="button" data-bs-target="#articleCarouselMobile" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('homepage.Precedente') }}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#articleCarouselMobile" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('homepage.Successivo') }}</span>
        </button>
    </div>
</div>



    <!-- Sezione {{ __('homepage.Chi_siamo') }} -->
    <div class="container my-5">
        <h1 class="feedback-title text-center mb-5">{{ __('homepage.Chi_siamo') }}</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <div class="custom-card mb-4">
                    <h5 class="txt-card">{{ __('homepage.Chi_siamo') }}?</h5>
                    <p>{{ __('homepage.Piattaforma_di_annunci_per_facilitare_vendite') }}
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="custom-card mb-4">
                    <h5 class="txt-card">{{ __('homepage.Cosa_facciamo?') }}</h5>
                    <p>{{ __('homepage.Connettiamo_persone_e_venditori.') }} <br>
                    {{ __('homepage.Facilitiamo_la_compravendita') }} <br>
                    {{ __('homepage.Promuoviamo_la_sostenibilità.') }}</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="custom-card">
                    <h5 class="txt-card">{{ __('homepage.Perché_scegliere_Presto.it') }}</h5>
                    <p>{{ __('homepage.Facilità_d’uso_pubblicare_annuncio') }} <br>
                    {{ __('homepage.Garantiamo_un’esperienza_sicura') }} <br>
                    {{ __('homepage.Funzionalità_gratuite_per_tutti.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione {{ __('homepage.Feedback') }} -->
    <div class="container my-5">
        <div class="feedback-container">
            <!-- Stelle sopra il titolo -->
            <div class="star-rating text-center mb-4">
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="far fa-star text-warning"></i>
            </div>
            <div class="feedback-title text-center mb-4">{{ __('homepage.Feedback') }}</div>

            <!-- Testo del feedback -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="feedback-text text-center">
                        {{ __('homepage.Servizio_eccellente_e_facile_da_usare') }}
                        {{ __('homepage.Supporto_clienti_incredibile') }}
                        {{ __('homepage.raccomando_vivamente_questo_sito') }}
                        {{ __('homepage.Servizio_di_assistenza_di_alta_qualità') }}
                    </div>
                </div>
            </div>

            <!-- Linea separatrice -->
            <div class="separator my-2"></div>

            <!-- Foto e nome -->
            <div class="feedback-author text-center">
                <img src="/media/mario-rossi.jpg" alt="Icona Utente" class="rounded-circle">
                <div class="feedback-author-name mt-2">{{ __('homepage.Mario_Rossi') }}</div>
            </div>
        </div>
    </div>
</x-layout>
