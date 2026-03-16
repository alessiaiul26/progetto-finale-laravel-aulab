<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AdminRequest;
use Illuminate\Http\Request;
use App\Mail\AdminRequestAccepted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminRequestController extends Controller
{
    public function showRequestForm()
    {
        return view('admin.request-form');
    }
    
    public function submitRequest(Request $request)
    {
        // Controllo se l'utente è già admin
        if(Auth::user()->is_admin) {
            return redirect()->back()->with('error', 'Sei già un amministratore!');
        }
        // dd(Auth::user()->adminRequest);
        // Controllo se l'utente ha già fatto una richiesta
        if(Auth::user()->adminRequest) {
            return redirect()->back()->with('error', 'Hai già inviato una richiesta. Attendi la risposta del super admin.');
        }
        
        // Validazione
        $validated = $request->validate([
            'message' => 'required|min:15|max:1000',
            'experience' => 'required|min:30|max:2000',
            'skills' => 'required|min:30|max:1000',
        ]);
        
        // Creo la richiesta
        // Auth::user()->adminRequest()->create($validated);
        AdminRequest::create([
            'message' => $request->message,
            'experience' => $request->experience,
            'skills' => $request->skills,
            'user_id' => Auth::user()->id,
            'approved_by_super_admin' => false,  //! Richiesta non ancora approvata dall'amministratore superadmin
        ]);
        return redirect()->back()->with('success', 'La tua richiesta è stata inviata con successo! Verrai contattato dal super admin.');
    }
    
    public function pendingRequests()
    {
        $pendingRequests = AdminRequest::with('user')
        ->where('approved_by_super_admin', false)
        ->get();
        
        return view('admin.pending-requests', compact('pendingRequests'));
    }
    
    public function approveRequest(AdminRequest $adminRequest)
    {
        // Controllo se l'utente è già admin
        if($adminRequest->user->is_admin) {
            return redirect()->back()->with('error', 'L\'utente è già un amministratore!');
        }
        
        // Aggiorno lo stato dell'utente
        $adminRequest->user->is_admin = true;
        $adminRequest->user->save();
        
        // Aggiorno lo stato della richiesta
        $adminRequest->approved_by_super_admin = true;
        $adminRequest->save();
        
        // Invio email di conferma
        Mail::to($adminRequest->user->email)->send(new AdminRequestAccepted($adminRequest->user));
        
        return redirect()->back()->with('success', 'Richiesta admin approvata con successo!');
    }
    
    public function rejectRequest(AdminRequest $adminRequest)
    {
        $adminRequest->delete();
        return redirect()->back()->with('success', 'Richiesta admin rifiutata.');
    }
}
