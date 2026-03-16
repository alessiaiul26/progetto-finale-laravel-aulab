<x-layout>
    <div class="container my-5">
        <h1 class="text-center display-4 mb-5 feedback-title">Posizioni Aperte</h1>
        
        <div class="row justify-content-center g-4">
            <!-- Revisore -->
            <div class="col-12 col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Revisore</h3>
                        <p class="card-text">Come revisore, sarai responsabile di:</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Revisione contenuti degli annunci</li>
                            <li><i class="fas fa-check text-success me-2"></i> Verifica conformità alle linee guida</li>
                            <li><i class="fas fa-check text-success me-2"></i> Moderazione commenti</li>
                            <li><i class="fas fa-check text-success me-2"></i> Supporto alla community</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Amministratore -->
            <div class="col-12 col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Amministratore</h3>
                        <p class="card-text">Come amministratore, ti occuperai di:</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Gestione utenti e permessi</li>
                            <li><i class="fas fa-check text-success me-2"></i> Supervisione piattaforma</li>
                            <li><i class="fas fa-check text-success me-2"></i> Analisi performance</li>
                            <li><i class="fas fa-check text-success me-2"></i> Sviluppo strategico</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Redattore -->
            <div class="col-12 col-md-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Redattore</h3>
                        <p class="card-text">Come redattore, sarai incaricato di:</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> Creazione contenuti</li>
                            <li><i class="fas fa-check text-success me-2"></i> Ottimizzazione SEO</li>
                            <li><i class="fas fa-check text-success me-2"></i> Gestione blog</li>
                            <li><i class="fas fa-check text-success me-2"></i> Comunicazione social</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <h4 class="mb-4">Interessato a far parte del nostro team?</h4>
            <a href="{{ route('contacts') }}" class="btn btn-dark">Invia il tuo CV</a>
        </div>
    </div>
</x-layout>
