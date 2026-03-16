<x-layout>
    <div class="container mt-5">
        <h2 class="mb-4">Richieste Admin in Attesa</h2>

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

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Richieste in Attesa di Approvazione</h5>
            </div>
            <div class="card-body">
                @if(count($pendingRequests) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Data Richiesta</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $request->user->email }}</td>
                                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $request->id }}">
                                                <i class="bi bi-eye"></i> Dettagli
                                            </button>
                                            <div class="btn-group ms-2" role="group">
                                                <form action="{{ route('admin.request.approve', $request) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm me-2">
                                                        <i class="bi bi-check-circle"></i> Approva
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.request.reject', $request) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-x-circle"></i> Rifiuta
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Dettagli -->
                                    <div class="modal fade" id="detailsModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Dettagli Richiesta - {{ $request->user->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <h6 class="fw-bold">Motivazione:</h6>
                                                        <p>{{ $request->message }}</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h6 class="fw-bold">Esperienza Professionale:</h6>
                                                        <p>{{ $request->experience }}</p>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold">Competenze Tecniche:</h6>
                                                        <p>{{ $request->skills }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        Non ci sono richieste admin in attesa.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
