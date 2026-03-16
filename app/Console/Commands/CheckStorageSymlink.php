<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckStorageSymlink extends Command
{
    protected $signature = 'storage:check';
    protected $description = 'Verifica e crea il symlink dello storage se non esiste';

    public function handle()
    {
        $publicPath = public_path('storage');
        
        if (!file_exists($publicPath)) {
            $this->info('Il symlink dello storage non esiste. Creazione in corso...');
            
            try {
                $this->call('storage:link');
                
                if (file_exists($publicPath)) {
                    $this->info('✅ Symlink dello storage creato con successo!');
                    Log::info('Storage symlink creato tramite comando storage:check');
                } else {
                    $this->error('❌ Impossibile creare il symlink dello storage');
                    Log::error('Impossibile creare il symlink dello storage tramite comando');
                }
            } catch (\Exception $e) {
                $this->error('❌ Errore durante la creazione del symlink: ' . $e->getMessage());
                Log::error('Errore durante la creazione del symlink: ' . $e->getMessage());
            }
        } else {
            $this->info('✅ Il symlink dello storage esiste già');
        }
    }
}
