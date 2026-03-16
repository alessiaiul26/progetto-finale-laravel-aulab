<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }
    
    public function show(){
        $user = Auth::user();
        
        // Se l'utente ha appena effettuato il login/registrazione (sessione appena creata)
        if (session()->has('login') || session()->has('register')) {
            $message = session()->has('register') 
            ? 'Benvenuto! La registrazione è avvenuta con successo.' 
            : 'Bentornato! Login effettuato con successo.';
            
            return view('profile.show', compact('user'))->with('success', $message);
        }
        
        return view('profile.show', compact('user')); 
    }
    
    public function update(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'biography' => 'nullable|string|max:1000',
            'date_of_birth' => 'nullable|date',
        ]);
        
        // Aggiorna i dati dell'utente
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->update([
            'biography' => $request->biography,
            'date_of_birth' => $request->date_of_birth,
        ]);
        $user->save();
        
        return redirect()->route('profile.show')->with('success', 'Profilo aggiornato con successo!');
    }
}
