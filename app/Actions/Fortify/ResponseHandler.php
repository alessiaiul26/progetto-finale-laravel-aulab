<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class ResponseHandler implements LoginResponseContract, RegisterResponseContract
{
    public function toResponse($request)
    {

        $redirect = $request->query('redir');
        $redirect = $redirect ? $redirect : 'profile.show';

        $parameters = $request->query('params', []); // called using route()->parameters()

        if ($request->is('register')) {
            
            return redirect()->route($redirect, $parameters)->with([
                'success' => 'Benvenuto! La registrazione è avvenuta con successo.',
                'register' => true
            ]);
        }

        return redirect()->route($redirect, $parameters)->with([
            'success' => 'Bentornato! Login effettuato con successo.',
            'login' => true
        ]);
    }
}
