<!-- Footer -->
<footer class="text-center text-white mt-5" style="background-color: transparent;">
    <!-- Grid container -->
    <div class="container p-4">

        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Social Icons -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998;" href="#!" role="button"><i
                    class="fab fa-facebook-f"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac;" href="#!"
                role="button"><i class="fab fa-instagram"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="#!"
                role="button"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="#!"
                role="button"><i class="fab fa-github"></i></a>
        </section>

        <!-- Grid row -->
        <div class="row text-center">

            <!-- Contatti -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4 fw-bolder">Contatti</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <i class="fas fa-phone-alt fa-lg"></i>
                        <p class="mt-2">+39 123 456 7890</p>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope fa-lg"></i>
                        <p class="mt-2">info@presto.it</p>
                    </li>
                </ul>
            </div>

            <!-- FAQ -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4 fw-bolder">FAQ</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <i class="fas fa-info-circle fa-lg me-2"></i>
                        <p class="class mt-2"><a href="#" class="text-white" data-bs-toggle="modal"
                                data-bs-target="#howItWorksModal">Come funziona Presto?</a></p>
                    </li>
                    <li>
                        <i class="fas fa-question-circle fa-lg me-2"></i>
                        <p class="class mt-2"><a href="#" class="text-white" data-bs-toggle="modal"
                                data-bs-target="#faqModal">Domande
                                frequenti</a></p>
                    </li>
                </ul>
            </div>

            <!-- Lavora con Noi -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4 fw-bolder">Lavora con Noi</h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fa-solid fa-headphones"></i>
                        <p class="mt-2"><a href="{{ route('contacts') }}" class="text-white">Contatti</a></p>
                    </li>
                    <li class="mb-3">
                        <i class="fa-solid fa-suitcase"></i>
                        <p class="mt-2"><a href="{{ route('join.team') }}" class="text-white">Unisciti al Team</a></p>
                    </li>
                </ul>
            </div>

            <!-- Sicurezza e Privacy -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4 fw-bolder">Sicurezza e Privacy</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <i class="fas fa-shield-alt fa-lg"></i>
                        <p class="mt-2"><a href="#privacy" class="text-white" data-bs-toggle="modal"
                                data-bs-target="#privacyModal">Politica sulla privacy</a></p>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-shield-alt fa-lg"></i>
                        <p class="mt-2"><a href="#terms" class="text-white" data-bs-toggle="modal"
                                data-bs-target="#termsModal">Termini e condizioni</a></p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            <a class="text-body text-white" href="https://mdbootstrap.com/">www.presto.it</a> &copy; 2024
            Copyright: <a class="text-body text-white" href="https://www.coders-ninja.it/">Coders Ninja</a>
        </div>
    </div>
</footer>

<!-- Modal: Come funziona Presto -->
<div class="modal fade" id="howItWorksModal" tabindex="-1" aria-labelledby="howItWorksModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="howItWorksModalLabel">Come funziona Presto?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="howItWorksAccordion">
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header" id="howItWorksHeader">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseHowItWorks" aria-expanded="true"
                                aria-controls="collapseHowItWorks">
                                <i class="fas fa-info-circle me-2"></i>Come funziona Presto?
                            </button>
                        </h2>
                        <div id="collapseHowItWorks" class="accordion-collapse collapse show"
                            aria-labelledby="howItWorksHeader" data-bs-parent="#howItWorksAccordion">
                            <div class="accordion-body">
                                <p class="mb-3">Presto è una piattaforma di annunci che ti permette di comprare e
                                    vendere oggetti in modo semplice e sicuro.</p>
                                <h5 class="mb-2">Ecco come funziona:</h5>
                                <ol class="list-group list-group-numbered mb-3">
                                    <li class="list-group-item">Registrati gratuitamente sul sito</li>
                                    <li class="list-group-item">Sfoglia gli annunci o pubblica i tuoi</li>
                                    <li class="list-group-item">Contatta venditori o acquirenti interessati</li>
                                    <li class="list-group-item">Concludi l'affare in sicurezza</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-green" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Domande frequenti -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="faqModalLabel">Domande frequenti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item mb-3 border rounded">
                        <h2 class="accordion-header" id="howToPostHeader">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseHowToPost" aria-expanded="true"
                                aria-controls="collapseHowToPost">
                                <i class="fas fa-edit me-2"></i>Come inserire un annuncio
                            </button>
                        </h2>
                        <div id="collapseHowToPost" class="accordion-collapse collapse show"
                            aria-labelledby="howToPostHeader" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <h5 class="mb-3">Segui questi semplici passi:</h5>
                                <div class="steps-guide">
                                    <div class="step mb-4">
                                        <h6 class="fw-bold"><i class="fas fa-sign-in-alt me-2"></i>1. Accedi al tuo
                                            account</h6>
                                        <p class="ms-4">Se non sei registrato, crea un account gratuito</p>
                                    </div>
                                    <div class="step mb-4">
                                        <h6 class="fw-bold"><i class="fas fa-plus-circle me-2"></i>2. Clicca su
                                            "Inserisci Annuncio"</h6>
                                        <p class="ms-4">Trovi il pulsante nella barra di navigazione</p>
                                    </div>
                                    <div class="step mb-4">
                                        <h6 class="fw-bold"><i class="fas fa-camera me-2"></i>3. Prepara il contenuto
                                        </h6>
                                        <ul class="list-unstyled ms-4">
                                            <li>• Scatta foto chiare dell'oggetto</li>
                                            <li>• Scrivi un titolo accattivante</li>
                                            <li>• Inserisci una descrizione dettagliata</li>
                                            <li>• Indica il prezzo</li>
                                        </ul>
                                    </div>
                                    <div class="step mb-4">
                                        <h6 class="fw-bold"><i class="fas fa-check-circle me-2"></i>4. Pubblica</h6>
                                        <p class="ms-4">Rivedi le informazioni e pubblica l'annuncio</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-green" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

