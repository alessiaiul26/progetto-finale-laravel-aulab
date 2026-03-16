<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class CheckStorageSymlink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $publicPath = public_path('storage');
        
        // Verifica se il symlink esiste
        if (!file_exists($publicPath)) {
            try {
                // Crea il symlink
                Artisan::call('storage:link');
                Log::info('Storage symlink creato automaticamente');
                
                // Verifica se il symlink è stato creato correttamente
                if (!file_exists($publicPath)) {
                    Log::error('Impossibile creare il symlink dello storage');
                    session()->flash('error', 'Errore nella configurazione dello storage. Contatta l\'amministratore.');
                }
            } catch (\Exception $e) {
                Log::error('Errore durante la creazione del symlink: ' . $e->getMessage());
                session()->flash('error', 'Errore nella configurazione dello storage. Contatta l\'amministratore.');
            }
        }

        return $next($request);
    }
}
