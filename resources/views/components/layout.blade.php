<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CODERS_NINJA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <x-navbar/>
    
    <div class="min-vh-100">
        <x-alert-success />
        <x-alert-error />
        <x-alert-danger />
        {{$slot}}
    </div>
    <!-- Modale laterale del carrello -->
<div class="offcanvas offcanvas-end p-5" tabindex="-1" id="cartModal" aria-labelledby="cartModalLabel">
    <div class="offcanvas-header">
        <h5 id="cartModalLabel" class="offcanvas-title">Il tuo carrello</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body custom-offcanvas-body">
        @if(session('cart'))
            <div class="row">
                @php $total = 0 @endphp
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <div class="col-12 mb-3">
                        <div class="d-flex align-items-center">
                            <!-- Immagine prodotto -->
                            <div class="me-3">
                                <img src="{{ $details['image'] }}" alt="{{ $details['title'] }}" style="width: 80px;">
                            </div>
                            <!-- Dettagli del prodotto -->
                            <div class="flex-grow-1">
                                <h5>{{ $details['title'] }}</h5>
                                <p class="mb-0">€{{ number_format($details['price'], 2) }} x {{ $details['quantity'] }}</p>
                                <p class="mb-0 fw-bold">Subtotale: €{{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                            </div>
                            <!-- Rimuovi prodotto -->
                            <div>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Totale del carrello -->
            <div class="d-flex justify-content-between mt-4">
                <h4 class="fw-bold">Totale:</h4>
                <h4 class="fw-bold">€{{ number_format($total, 2) }}</h4>
            </div>
            <button type="submit" class="add-btn btn btn-green w-100 mt-4">
                <i class="fas fa-shopping-cart me-2"></i>Conferma Ordine
            </button>
        @else
            <div class="alert alert-info">
                Il tuo carrello è vuoto
            </div>
        @endif
    </div>
</div>

    <x-footer/>
    <x-footer-modals/>
</body>
</html>