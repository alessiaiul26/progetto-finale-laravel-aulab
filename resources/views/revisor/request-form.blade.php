<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Diventa Revisore</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('become.revisor', ['user' => Auth::user()]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Perché vuoi diventare revisore?</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"
                                    required>{{ old('message') }}</textarea>
                                <div class="form-text">
                                    Raccontaci perché vorresti diventare revisore e quali sono le tue competenze.
                                    Minimo 20 caratteri, massimo 500.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-green">Invia Richiesta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
