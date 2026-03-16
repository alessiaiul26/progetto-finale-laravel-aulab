<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    protected $signature = 'app:make-user-admin {email}';
    protected $description = 'Rende un utente amministratore';

    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        
        if (!$user) {
            $this->error('Utente non trovato');
            return;
        }

        $user->is_admin = true;
        $user->save();
        
        $this->info("L'utente {$user->name} è ora amministratore");
    }
}
