<nav class="navbar navbar-expand-lg bgNavCustom pt-4">
    {{-- Link START --}}
    <div class="container-fluid ms-5">
        <a class="navbar-brand text-white fw-bolder" href="{{ route('homepage') }}">
            <img src="/media/logo-presto.png" width="80" height="80" alt="">Presto.it</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Link END --}}
        <div class="collapse navbar-collapse justify-content-end ms-auto me-5" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="{{ route('homepage') }}">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-newspaper"></i>
                        Annunci
                    </a>
                    <ul class="dropdown-menu bgNavCustom">
                        <li><a class="dropdown-item textColor" href="{{ route('create.article') }}">Aggiungi
                                Annuncio</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item textColor" href="{{ route('article.index') }}">Tutti gli Annunci</a>
                        </li>
                    </ul>
                </li>

                {{-- ! Aggiunta del menu a discesa delle categorie --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-list"></i>
                        Categorie
                    </a>
                    <ul class="dropdown-menu bgNavCustom">
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item"
                                    href="{{ route('byCategory', ['category' => $category]) }}">{{ $category->name }}</a>
                            </li>
                            @if (!$loop->last)
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('aboutUs') }}">
                        <i class="fa-solid fa-house-laptop"></i>Chi Siamo
                    </a>
                </li>



                {{-- USER Loggato --}}
                @auth
                    {{-- !Condizione in cui lo User loggato è un REVISORE --}}
                    {{-- @if (Auth::user()->is_revisor)
                        <li class="nav-item">
                            <a href="{{ route('revisor.index') }}"
                                class="nav-link btn-btn-outline-success btn-sm position-relative w-sm-25 text-white">Zona revisore
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ \App\Models\Article::toBeRevisedCount() }}</span>
                            </a>

                        </li>
                    @endif --}}
                    {{-- !Condizione in cui lo User non è un revisore ma ha un altro RUOLO, generico PER ORA --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-user"></i>
                            Ciao, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu bgNavCustom">
                            @if (Auth::user()->is_admin)
                                <li>
                                    <a class="dropdown-item p-3 d-flex justify-content-between align-items-center"
                                        href="{{ route('admin.dashboard') }}">
                                        <span>
                                            <i class="bi bi-gear-fill me-2"></i>
                                            Dashboard Admin
                                        </span>
                                        @if (App\Http\Controllers\AdminController::getPendingRequestsCount() > 0)
                                            <span class="badge rounded-pill bg-danger">
                                                {{ App\Http\Controllers\AdminController::getPendingRequestsCount() }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            @if (Auth::user()->is_revisor)
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center"
                                        href="{{ route('revisor.index') }}">
                                        <span>
                                            <i class="bi bi-shield-check me-1"></i>
                                            Dashboard Revisore
                                        </span>
                                        @if (App\Models\Article::toBeRevisionedCount() > 0)
                                            <span class="badge rounded-pill bg-danger">
                                                {{ App\Models\Article::toBeRevisionedCount() }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            <li><a class="dropdown-item textColor" href="{{ route('profile.show') }}">Profilo</a></li>
                            <li><a class="dropdown-item textColor" href="{{ route('profile.edit') }}">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Logout Link -->
                            <li>
                                <a class="dropdown-item textColor" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                        <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    @php
                        $parameters = request()->route()->parameters();
                        $values = [];
                        foreach ($parameters as $key => $param) {
                            $values[$key] = $param->getAttributes()['id'];
                        }

                    @endphp
                    {{-- User da autenticare --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                            Area Utente
                        </a>
                        <ul class="dropdown-menu bgNavCustom">
                            <li><a href="{{ route('login', ['redir' => request()->route()->getName(), 'params' => $values]) }}"
                                    class="dropdown-item">Login</a></li>
                            <hr class="dropdown-divider">
                            <li><a href="{{ route('register', ['redir' => request()->route()->getName(), 'params' => $values]) }}"
                                    class="dropdown-item">Register</a></li>
                        </ul>
                    </li>
                @endauth
                {{-- @dd(request()->route()->parameters()) --}}
                {{-- Sezione Carrello --}}
                {{-- <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="#">
                        <i class="fa-solid fa-shopping-cart me-1"></i>
                        Carrello
                    </a>
                </li> --}}
            </ul>
            {{-- Aggiunta del toggle modalità giorno/notte --}}
            <li class="nav-item my-4 mx-1 list-unstyled">
                <button class="nav-link text-white border-0 bg-transparent" id="themeToggle">
                    <i class="fas fa-sun fs-4" id="lightIcon"></i>
                    <i class="fas fa-moon d-none fs-4" id="darkIcon"></i>
                </button>
            </li>

            {{-- Carrello con Counter --}}
            <li class="nav-item mx-3 list-unstyled">
                <a href="#" class="nav-link text-white position-relative" data-bs-toggle="offcanvas"
                    data-bs-target="#cartModal" aria-controls="cartModal">
                    <i class="bi bi-cart3 fs-4"></i>
                    @if (session('cart'))
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </li>

            {{--  Aggiunta del componente _locale (selezione lingua) --}}
            {{-- Selezione lingua --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-globe fs-4 my-2"></i> {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end bgNavCustom" style="width: 200px;">
                    <li><a class="dropdown-item textColor" href="#"><x-_locale lang="it" /> Italiano</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item textColor" href="#"><x-_locale lang="en" /> English</a>
                    </li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item textColor" href="#"><x-_locale lang="es" /> Spagnolo</a>
                        </li>
                </ul>
            </li>

        </div>
    </div>
</nav>
