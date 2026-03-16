<x-layout>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-light fw-bold mb-4 display-4 text-center">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                </h2>
            </div>
        </div>
        
        {{-- Cards riassuntive --}}
        <div class="row mb-4">
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Richieste in Attesa</h6>
                                <h3 class="mb-0">{{ $pendingRevisors->count() }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-hourglass-split text-primary fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Revisori Attivi</h6>
                                <h3 class="mb-0">{{ $acceptedRevisors->count() }}</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-person-check text-success fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Totale Revisori</h6>
                                <h3 class="mb-0">{{ $pendingRevisors->count() + $acceptedRevisors->count() }}</h3>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people text-info fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            {{-- Richieste in attesa --}}
            <div class="col-12 mb-1 me-3">
                <div class="border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-primary">
                                <i class="bi bi-hourglass-split me-2"></i>Richieste in Attesa
                            </h5>
                            <span class="badge bg-primary rounded-pill">{{ $pendingRevisors->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="card-body p-0" style="height: 400px; overflow-y: auto;">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col" class="ps-4">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Creato il</th>
                                        <th scope="col">Stato</th>
                                        <th scope="col" class="text-end pe-4">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pendingRevisors->count() > 0)
                                        @foreach ($pendingRevisors as $index => $user)
                                            <tr>
                                                <td class="ps-4">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-light rounded-circle p-2 me-2">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    {{ $user->revisorRequest->created_at->format('d/m/Y H:i') }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">In Attesa</span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="btn-group" role="group">
                                                        <form action="{{ route('admin.revisor.accept', $user) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm me-2">
                                                            <i class="bi bi-check-lg"></i> Accetta
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.revisor.reject', $user) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-x-lg"></i> Rifiuta
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <img src="/media/empty-state.svg" alt="No data" class="mb-3" style="width: 200px;">
                                        <h5 class="text-muted mb-0">Non ci sono richieste in attesa di approvazione</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        {{-- Revisori Attivi Tabella --}}
        <div class="col-12 mb-4">
            <div class="border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-success">
                            <i class="bi bi-person-check me-2"></i>Revisori Attivi
                        </h5>
                        <span class="badge bg-success rounded-pill">{{ $acceptedRevisors->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body p-0" style="height: 400px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Stato</th>
                                    <th scope="col" class="text-end pe-4">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($acceptedRevisors->count() > 0)
                                    @foreach ($acceptedRevisors as $index => $user)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                                        <i class="bi bi-person text-success"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge bg-success">Attivo</span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <form action="{{ route('admin.revisor.remove', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-person-x"></i> Rimuovi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="/media/empty-state.svg" alt="No data" class="mb-3" style="width: 200px;">
                                            <h5 class="text-muted mb-0">Non ci sono ancora revisori attivi</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Revisori Rifiutati Tabella --}}
        <div class="col-12 mb-4">
            <div class="border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-danger">
                            <i class="bi bi-person-x me-2"></i>Revisori Rifiutati
                        </h5>
                        <span class="badge bg-danger rounded-pill">{{ $rejectedRevisors->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body p-0" style="height: 400px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rifiutato il</th>
                                    <th scope="col">Stato</th>
                                    <th scope="col" class="text-end pe-4">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($rejectedRevisors->count() > 0)
                                    @foreach ($rejectedRevisors as $index => $user)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-2">
                                                        <i class="bi bi-person text-danger"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <i class="bi bi-calendar-x text-danger me-1"></i>
                                                @if($user->revisorRequest && $user->revisorRequest->rejected_at)
                                                    {{ $user->revisorRequest->rejected_at->format('d/m/Y H:i') }}
                                                @else
                                                    Data non disponibile
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">Rifiutato</span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#reconsiderModal{{ $user->id }}">
                                                    <i class="bi bi-person-check"></i> Riconsiderare
                                                </button>

                                                <!-- Modale di Conferma Riconsiderazione -->
                                                <div class="modal fade" id="reconsiderModal{{ $user->id }}" tabindex="-1" aria-labelledby="reconsiderModalLabel{{ $user->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-start" id="reconsiderModalLabel{{ $user->id }}">Conferma Riconsiderazione</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-start">
                                                                <div class="mb-3">
                                                                    <h6>Stai per riconsiderare la richiesta di:</h6>
                                                                    <div class="d-flex align-items-center mt-2">
                                                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                                                            <i class="bi bi-person text-success"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                                                            <small class="text-muted">{{ $user->email }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="alert alert-warning">
                                                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                                                    Questa azione rimuoverà il rifiuto precedente e approverà l'utente come revisore.
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                                <form action="{{ route('admin.revisor.accept', $user) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">
                                                                        <i class="bi bi-check-lg me-1"></i>Conferma Riconsiderazione
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="/media/empty-state.svg" alt="No data" class="mb-3" style="width: 200px;">
                                            <h5 class="text-muted mb-0">Non ci sono revisori rifiutati</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- I Miei Revisori Approvati --}}
        <div class="col-12 mb-4">
            <div class="border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-success">
                            <i class="bi bi-shield-check me-2"></i>Revisori da Me Approvati
                        </h5>
                        <span class="badge bg-success rounded-pill">{{ $myApprovedRevisors->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body p-0" style="height: 400px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Approvato il</th>
                                    <th scope="col">Stato Attuale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($myApprovedRevisors->count() > 0)
                                    @foreach ($myApprovedRevisors as $index => $user)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                                        <i class="bi bi-person-badge text-success"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <i class="bi bi-calendar-check text-success me-1"></i>
                                                {{ $user->revisorRequest->accepted_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td>
                                                @if($user->is_revisor)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Revisore Attivo
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="bi bi-x-circle me-1"></i>
                                                        Non più Revisore
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <img src="/media/empty-state.svg" alt="No data" class="mb-3" style="width: 200px;">
                                            <h5 class="text-muted mb-0">Non hai ancora approvato nessun revisore</h5>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 mb-4">
            {{-- Statistiche Revisori --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-success">
                        <i class="bi bi-graph-up me-2"></i>Statistiche Revisori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Totale Revisori</span>
                        <span class="badge bg-success rounded-pill">{{ $acceptedRevisors->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Richieste Pendenti</span>
                        <span class="badge bg-warning rounded-pill">{{ $pendingRevisors->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Tasso Accettazione</span>
                        @php
                        $total = $acceptedRevisors->count() + $pendingRevisors->count();
                        $rate = $total > 0 ? round(($acceptedRevisors->count() / $total) * 100) : 0;
                        @endphp
                        <span class="badge bg-info rounded-pill">{{ $rate }}%</span>
                    </div>
                </div>
            </div>
            
            {{-- Lista Revisori Attivi --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-success">
                            <i class="bi bi-person-check me-2"></i>Revisori Attivi
                        </h5>
                        <span class="badge bg-success rounded-pill">{{ $acceptedRevisors->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if ($acceptedRevisors->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach ($acceptedRevisors as $user)
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-person text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <div>
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-circle-fill me-1 small"></i>Attivo
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 ps-5">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-check me-1"></i>
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <img src="/media/empty-state.svg" alt="No data" class="mb-3"
                        style="width: 150px;">
                        <p class="text-muted mb-0">Non ci sono ancora revisori attivi</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Inizializza i tooltip di Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
</x-layout>
