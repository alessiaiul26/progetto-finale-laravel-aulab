<x-layout>
    <div class="registration-container">
        <!-- Video come sfondo -->
        <video autoplay muted loop id="video-background">
            <source src="{{ asset('media/video-green3.mp4') }}" type="video/mp4">
            Il tuo browser non supporta il video.
        </video>

        <!-- Contenuto sovrapposto -->
        <div class="registration-card">
            <h3 class="registration-title">Accedi</h3>
            <p class="registration-subtitle">Accedi per continuare</p>

            <form
                action="{{ route('login', ['redir' => request()->query('redir'), 'params' => request()->query('params', [])]) }}"
                method="POST" class="registration-form">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-input"
                        placeholder="example@mail.com" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="*********"
                        required>
                </div>
                <button type="submit" class="btn-submit">Accedi</button>
            </form>

            <p class="registration-subtitle mt-3">Non sei ancora registrato? <a href="{{ route('register') }}"
                    class="registration-link">Registrati!</a></p>
        </div>
    </div>
</x-layout>
