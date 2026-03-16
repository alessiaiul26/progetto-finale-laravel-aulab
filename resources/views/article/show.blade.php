<x-layout>
    <!-- Titolo Pagina -->
    <div class="container py-4">
        <h1 class="feedback-title text-center">
            Dettaglio annuncio
        </h1>
    </div>

    <div class="container py-5">
        <!-- Sezione Prodotto -->
        <div class="row g-5">
            <!-- Immagine Prodotto -->
            <div class="col-12 col-md-6">
                <!-- Swiper -->
                <div class="swiper mySwiper1">
                    <div class="swiper-wrapper">
                        @if($article->images->isNotEmpty())
                            @foreach($article->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->getUrl('') }}" class="img-fluid" alt="Immagine {{ $loop->iteration }} di {{ $article->title }}"/>
                                </div>
                            @endforeach
                        @else
                            @for($i = 0; $i < 3; $i++)
                                <div class="swiper-slide">
                                    <img src="https://picsum.photos/800/600?random={{ $i }}" class="img-fluid" alt="Immagine placeholder"/>
                                </div>
                            @endfor
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <!-- Dettagli Prodotto -->
            <div class="col-12 col-md-6">
                <div class="product-details">
                    <!-- Titolo Prodotto -->
                    <h1 class="fw-bold text-dark">{{ $article->title }}</h1>

                    <!-- Categoria -->
                    <p class="mt-2">
                        <a href="{{ route('byCategory', ['category' => $article->category]) }}"
                            class="text-decoration-none text-success fw-bold">
                            <i class="fa-brands fa-shopify"></i> {{ $article->category->name }}
                        </a>
                    </p>

                    <!-- Descrizione -->
                    <p class="mt-4 fs-5 text-dark">
                        {{ $article->description }}
                    </p>
                    <!-- Prezzo -->
                    <p class="card-text">€{{ number_format($article->price, 2) }}</p>
                    <form action="{{ route('cart.add', $article) }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-green">
                            <i class="bi bi-cart-plus"></i> Aggiungi al carrello
                        </button>
                    </form>
                    <!-- Pulsanti -->
                    <div class="mt-5 d-flex align-items-center">
                        <!-- Pulsante Torna Indietro -->
                        <a href="{{ route('article.index') }}" class="btn btn-outline-dark btn-lg fst-italic">
                            Torna Indietro

                        </a>
                    </div>
                </div>
            </div>
            <div class="container mt-5 mb-5">
                <h1 class="feedback-title text-white text-center mb-5">annunci Correlati</h1>
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach($relatedArticles as $relatedArticle)
                            <div class="swiper-slide">
                                <x-searched_article_card :article="$relatedArticle" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
