<form class="bg-body-tertiary shadow rounded p-5 my-5" wire:submit.prevent="edit">

    {{-- Messaggio di successo per modifica ANNUNCIO --}}
    @if ($successMessage)
        <div class="alert alert-success text-center">
            {{ $successMessage }}
        </div>
    @endif

    <div class="mb-3">
        <label for="title" class="form-label text-dark fw-bold">Titolo:</label>
        <input type="text" class="form-control" id="title" wire:model.blur="title" aria-label="Titolo">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label  text-dark fw-bold">Descrizione:</label>
        <textarea id="description" cols="30" rows="10" class="form-control" wire:model.blur="description"
            aria-label="Descrizione"></textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label  text-dark fw-bold">Prezzo:</label>
        <input type="text" class="form-control" id="price" wire:model.blur="price" aria-label="Prezzo">
        @error('price')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    {{-- categoria --}}
    <div class="mb-3">
        <select id="category" wire:model.blur="category" class="form-control  text-dark fw-bold" aria-label="Categoria">
            <option value="" disabled selected>Seleziona una categoria</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Immagini esistenti --}}
    @if($images->isNotEmpty())
    <div class="mb-3">
        <p class="text-dark fw-bold">Immagini attuali:</p>
        <div class="row">
            @foreach($images as $image)
                <div class="col-12 col-md-4 mb-3">
                    <img src="{{ Storage::url($image->path) }}" alt="Immagine annuncio" class="img-fluid rounded">
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Upload nuove immagini --}}
    <div class="mb-3">
        <label for="temporaryImages" class="form-label text-dark fw-bold">Aggiungi nuove immagini:</label>
        <input type="file" class="form-control" id="temporaryImages" wire:model="temporaryImages" multiple accept="image/*">
        @error('temporaryImages.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    {{-- Anteprima nuove immagini --}}
    @if(!empty($temporaryImages))
        <div class="mb-3">
            <p class="text-dark fw-bold">Anteprima nuove immagini:</p>
            <div class="row">
                @foreach($temporaryImages as $image)
                    <div class="col-12 col-md-4 mb-3">
                        <img src="{{ $image->temporaryUrl() }}" alt="Anteprima immagine" class="img-fluid rounded">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-green me-4">Modifica</button>
        <a href="{{ route('article.index') }}" class="btn btn-dark">Torna indietro</a>
    </div>
</form>
