<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Richiedi Ruolo Admin</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.request.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Perché vuoi diventare amministratore?</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" 
                                          name="message" 
                                          rows="4" 
                                          required>{{ old('message') }}</textarea>
                                <div class="form-text">
                                    Spiega le tue motivazioni per diventare amministratore.
                                    Minimo 50 caratteri, massimo 1000.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="experience" class="form-label">Esperienza Professionale</label>
                                <textarea class="form-control @error('experience') is-invalid @enderror" 
                                          id="experience" 
                                          name="experience" 
                                          rows="6" 
                                          required>{{ old('experience') }}</textarea>
                                <div class="form-text">
                                    Descrivi la tua esperienza professionale, inclusi ruoli precedenti e responsabilità.
                                    Minimo 100 caratteri, massimo 2000.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="skills" class="form-label">Competenze Tecniche</label>
                                <textarea class="form-control @error('skills') is-invalid @enderror" 
                                          id="skills" 
                                          name="skills" 
                                          rows="4" 
                                          required>{{ old('skills') }}</textarea>
                                <div class="form-text">
                                    Elenca le tue competenze tecniche rilevanti per il ruolo di amministratore.
                                    Minimo 50 caratteri, massimo 1000.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark">Invia Richiesta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
