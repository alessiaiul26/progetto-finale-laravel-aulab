<x-layout>
    {{-- @dd($articles) --}}
    <div class="container-fluid text-center">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-12">
                <div class="row">
                    {{-- ! inserisco il componente di LIVEWIRE per la RICERCA --}}
                    @livewire('search-article-index')

                    
                    {{-- ?cicli di card FE --}}
                    {{-- @forelse ($articles as $article)
                        <div class="col-12 col-md-4 py-3 mb-3">
                            <x-article-card :article="$article" />

                        </div>
                    @empty
                        <div class="col-12">
                            <h3 class="text-center">
                                Nessun annuncio creato.
                            </h3>
                        </div>
                    @endforelse --}}
                </div>
            </div>

        </div>
    </div>

</x-layout>
