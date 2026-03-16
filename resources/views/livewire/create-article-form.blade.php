<div class="announcement-container">
    <form class="announcement-form p-4 shadow rounded bg-white" wire:submit.prevent="save">

        <!-- Messaggio di successo -->
        @if ($successMessage)
            <div class="alert alert-success text-center mb-4">
                {{ $successMessage }}
            </div>
        @endif

        <!-- Titolo -->
        <div class="form-group mb-3">
            <label for="title" class="form-label fw-bold text-dark">Titolo:</label>
            <input type="text" class="form-control" id="title" wire:model.live="title" placeholder="Inserisci il titolo">
            @error('title')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Inserimento immagini -->
        <div class="form-group mb-3">
            <label for="temporaryImages" class="form-label fw-bold text-dark">Immagini (max 6):</label>
            <input type="file" class="form-control" id="temporaryImages" wire:model="temporaryImages" multiple accept="image/*">
            @error('temporaryImages.*')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
            @error('temporaryImages')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Anteprima immagini -->
        @if (count($images) > 0)
            <div class="mb-4">
                <p class="fw-bold mb-3 text-dark">Immagini caricate ({{ count($images) }}/6):</p>
                <div class="row g-3 justify-content-center">
                    @foreach ($images as $key => $image)
                        <div class="col-6 col-sm-4">
                            <div class="position-relative">
                                <img src="{{ $image->temporaryUrl() }}" alt="Anteprima" class="img-thumbnail rounded">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    wire:click="removeImage({{ $key }})">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Effetti immagine -->
            <div class="card-size mt-4">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold text-dark">Effetti Immagine</h5>
                </div>
                <div class="card-filter ">
                    <div class="row g-3">
                        <!-- Luminosità -->
                        <div class="col-md-4">
                            <label class="form-label d-flex justify-content-between">
                                <span class="text-dark">Luminosità</span>
                                <span class="text-muted">{{ $imageEffects['brightness'] }}%</span>
                            </label>
                            <input type="range" class="form-range" min="-100" max="100"
                                wire:model.live="imageEffects.brightness"
                                wire:change="updateImageEffect('brightness', $event.target.value)">
                        </div>

                        <!-- Contrasto -->
                        <div class="col-md-4">
                            <label class="form-label d-flex justify-content-between">
                                <span class="text-dark">Contrasto</span>
                                <span class="text-muted">{{ $imageEffects['contrast'] }}%</span>
                            </label>
                            <input type="range" class="form-range" min="-100" max="100"
                                wire:model.live="imageEffects.contrast"
                                wire:change="updateImageEffect('contrast', $event.target.value)">
                        </div>

                        <!-- Nitidezza -->
                        <div class="col-md-4">
                            <label class="form-label d-flex justify-content-between">
                                <span class="text-dark">Nitidezza</span>
                                <span class="text-muted">{{ $imageEffects['sharpen'] }}%</span>
                            </label>
                            <input type="range" class="form-range" min="0" max="100"
                                wire:model.live="imageEffects.sharpen"
                                wire:change="updateImageEffect('sharpen', $event.target.value)">
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <!-- Qualità -->
                        <div class="col-md-6">
                            <label class="form-label d-flex justify-content-between">
                                <span class="text-dark">Qualità Compressione</span>
                                <span class="text-muted">{{ $imageQuality }}%</span>
                            </label>
                            <input type="range" class="form-range" min="1" max="100" wire:model.live="imageQuality">
                        </div>

                        <!-- Watermark -->
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model.live="useWatermark">
                                <label class="form-check-label">Aggiungi Watermark</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Descrizione -->
        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold text-dark">Descrizione:</label>
            <textarea id="description" cols="30" rows="5" class="form-control" wire:model.blur="description" placeholder="Descrivi l'annuncio"></textarea>
            @error('description')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Prezzo -->
        <div class="form-group mb-3">
            <label for="price" class="form-label fw-bold text-dark">Prezzo:</label>
            <input type="text" class="form-control" id="price" wire:model.blur="price" placeholder="Inserisci il prezzo">
            @error('price')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Località -->
        <div class="form-group mb-3">
            <label for="location" class="form-label fw-bold text-dark">Località:</label>
            <input type="text" class="form-control" id="location" wire:model.blur="location" placeholder="Es: Milano, Roma, etc.">
            @error('location')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Categoria -->
        <div class="form-group mb-4">
            <label for="category" class="form-label fw-bold text-dark">Categoria:</label>
            <select id="category" wire:model.blur="category" class="form-select">
                <option value="" selected>Seleziona una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Pulsante Crea -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg">Crea</button>
        </div>

    </form>
</div>