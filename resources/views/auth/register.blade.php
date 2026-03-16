<x-layout>
    <div class="registration-container">
        <!-- Video come sfondo -->
        <video autoplay muted loop id="video-background">
            <source src="{{ asset('media/video-green3.mp4') }}" type="video/mp4">
            Il tuo browser non supporta il video.
        </video>

        <!-- Contenuto sovrapposto -->
        <div class="registration-card">
            <h3 class="registration-title">Crea un nuovo account</h3>
            <p class="registration-subtitle">Hai già un account? <a href="{{ route('login') }}"
                    class="registration-link">Accedi!</a></p>

            <form
                action="{{ route('register', ['redir' => request()->query('redir'), 'params' => request()->query('params', [])]) }}"
                method="POST" class="registration-form">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-input" placeholder="Jiara Martins"
                        required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-input"
                        placeholder="hello@reallygreatsite.com" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="*********"
                        required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Conferma Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input"
                        required>
                </div>
                <div class="form-group">
                    <label for="birthdate" class="form-label">Data di Nascita</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-input" required>
                </div>
                <button type="submit" class="btn-submit">Registrati</button>
            </form>
        </div>
    </div>
</x-layout>
