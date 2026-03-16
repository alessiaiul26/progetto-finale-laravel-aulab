<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RevisorAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingRevisors = User::whereHas('revisorRequest', function ($query) {
            $query->whereNull('accepted_at');
        })->get() ?? collect();

        $acceptedRevisors = User::where('is_revisor', true)->get();

        $rejectedRevisors = User::whereHas('revisorRequest', function ($query) {
            $query->whereNotNull('rejected_at');
        })->get() ?? collect();

        // Recupera i revisori che hai approvato come admin (is_revisor = true)
        $myApprovedRevisors = User::where('is_revisor', true)
            ->whereHas('revisorRequest', function ($query) {
                $query->where('accepted_by', auth()->id());
            })
            ->with('revisorRequest.acceptedBy')
            ->get() ?? collect();

        return view('admin.dashboard', compact('pendingRevisors', 'acceptedRevisors', 'rejectedRevisors', 'myApprovedRevisors'));
    }

    public function acceptRevisor(User $user)
    {
        // Controllo se l'utente è già revisore
        if($user->is_revisor) {
            return redirect()->back()->with('error', 'L\'utente è già un revisore!');
        }

        try {
            // Aggiorno lo stato dell'utente
            $user->is_revisor = true;
            $user->save();

            // get the revisor request object and update the accepted_by field
            $revisorRequest = $user->revisorRequest;
            \Log::info('Request user id: ' . $revisorRequest->user_id);
            if ($revisorRequest) {
                $revisorRequest->is_approved = true;
                $revisorRequest->accepted_by = auth()->id();
                $revisorRequest->accepted_at = now();
                $revisorRequest->save();
            }

            // Invio email di conferma
            Mail::to($user->email)->send(new RevisorAccepted($user));

            return redirect()->back()->with('success', "Revisore accettato con successo! Ora l'utente {$user->name} è un revisor");
        } catch (\Exception $e) {
            \Log::error('Errore durante l\'accettazione del revisore: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'accettazione del revisore. Riprova più tardi.');
        }
    }

    public function rejectRevisor(User $user)
    {
        try {
            // get the revisor request object and update the rejected_at field
            $revisorRequest = $user->revisorRequest;
            if ($revisorRequest) {
                $revisorRequest->rejected_at = now();
                $revisorRequest->save();
            }

            return redirect()->back()->with('reject', "La richiesta di {$user->name} è stata rifiutata.");
        } catch (\Exception $e) {
            \Log::error('Errore durante il rifiuto della richiesta revisore: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante il rifiuto della richiesta. Riprova più tardi.');
        }
    }

    public function removeRevisor(User $user)
    {
        try {
            // Rimuovo il ruolo di revisore
            $user->is_revisor = false;
            $user->save();

            return redirect()->back()->with('success', "Il revisore {$user->name} è stato rimosso con successo.");
        } catch (\Exception $e) {
            \Log::error('Errore durante la rimozione del revisore: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante la rimozione del revisore. Riprova più tardi.');
        }
    }

    public static function getPendingRequestsCount()
    {
        return \App\Models\RevisorRequest::where('is_approved', false)->count();
    }
}
