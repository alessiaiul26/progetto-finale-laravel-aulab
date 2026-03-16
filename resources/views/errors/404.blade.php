<x-layout>
    <div class="position-relative vh-100 overflow-hidden">
        <!-- Video Background -->
        <video class="position-absolute w-100 h-100 object-fit-cover" autoplay muted loop>
            <source src="/video/video-profile.mp4" type="video/mp4">
        </video>
        
        <!-- Overlay scuro -->
        <div class="position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.6)"></div>
        
        <!-- Contenuto centrale -->
        <div class="position-relative h-100 d-flex flex-column justify-content-center align-items-center text-white">
            <!-- Logo Brain -->
            <img src="/img/brain.png" alt="Brain Logo" class="mb-4" style="width: 150px; height: auto;">
            
            <!-- Testo Error -->
            <h1 class="display-1 fw-bold mb-3" style="font-family: 'Montserrat', sans-serif;">ERROR 404</h1>
            <h2 class="h1 mb-4" style="font-family: 'Montserrat', sans-serif;">PAGE NOT FOUND</h2>
            
            <!-- Pulsante Home -->
            <a href="{{ route('homepage') }}" class="btn btn-green btn-lg mt-3">
                Torna alla Home
            </a>
        </div>
    </div>
</x-layout>
