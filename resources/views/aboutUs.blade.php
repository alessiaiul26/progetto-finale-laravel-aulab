<x-layout>
    <section class="hero-section text-white d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            {{-- PRIMA COLONNA --}}
            <div class="row align-items-center mb-5">
                <!-- Image Section -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('media/image.png') }}" 
                         alt="Persona che pensa" 
                         class="img-fluid rounded-circle fade-in-left"
                         style="width:60%;">
                </div>
                <!-- Text Section -->
                <div class="col-md-6 slide-in-right">
                    <h1 class="display-4 fw-bold feedback-title">Benvenuti su Presto.it!</h1>
                    <div class="mt-3">
                        <a href="#" 
                           class="feedback-title btn btn-light text-success fs-3 fw-bolder px-4 py-2 rounded-pill">
                            Presentazione
                        </a>
                        <p class="lead mt-4">
                            Presto.it è la piattaforma di annunci pensata per connettere le persone in modo semplice, veloce e sicuro.
                            Sia che tu stia cercando di vendere, acquistare o semplicemente esplorare nuove opportunità,
                            siamo qui per aiutarti a raggiungere i tuoi obiettivi.
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- SECONDA COLONNA: Il nostro team --}}
            <div class="row align-items-center text-center my-5 fade-in-up">
                <h2 class="display-5 fw-bold mb-5 feedback-title">Il nostro team</h2>
                <div class="col-md-3">
                    <div class="team-member">
                        <img src="{{ asset('media/stefano-user.png')}}" 
                             alt="Stefano Del Sordo" 
                             class="img-fluid rounded-circle  border-white scale-in"
                             style="width:200px; height:200px;">
                        <h5 class="mt-3 fw-bold">Stefano Del Sordo</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member">
                        <img src="{{ asset('media/arianna-user.jpeg')}}" 
                             alt="Arianna D'Alessandro" 
                             class="img-fluid rounded-circle scale-in"
                             style="width:200px; height:200px;" >
                        <h5 class="mt-3 fw-bold">Arianna D'Alessandro</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member">
                        <img src="{{ asset('media/alessia.jpg')}}" 
                             alt="Alessia Iulianetti" 
                             class="img-fluid rounded-circle scale-in"
                             style="width:200px; height:200px;">
                        <h5 class="mt-3 fw-bold"> Alessia Iulianetti</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member">
                       <img src="{{ asset('media/leonardo-user.jpeg')}}"
                             alt="Leonardo Boraso" 
                             class="img-fluid rounded-circle scale-in"
                             style="width:200px; height:200px;">
                        <h5 class="mt-3 fw-bold">Leonardo Boraso</h5>
                    </div>
                </div>
            </div>

            {{-- TERZA COLONNA: La nostra missione --}}
            <div class="row align-items-center mb-5">
                <div class="col-md-6 fade-in-left">
                    <h2 class="display-5 fw-bold feedback-title">La nostra missione</h2>
                    <div class="feedback-title btn btn-light text-success fs-3 fw-bolder px-4 py-2 rounded-pill">
                        I nostri obiettivi
                    </div>
                    <p class="lead">
                        Rendere la compravendita locale e nazionale più accessibile a tutti. Crediamo nel potere delle connessioni e vogliamo offrirti uno spazio
                        dove trovare soluzioni a portata di mano, con la sicurezza e la semplicità che meriti.
                    </p>
                </div>
                <div class="col-md-6 text-center slide-in-right">
                    <img src="{{ asset('media/mission.jpg')}}" alt="Missione collaborativa" class="img-fluid rounded-circle">
                </div>
            </div>
        </div>
    </section>
</x-layout>