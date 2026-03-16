<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImmagineService
{
    const DIMENSIONE_THUMBNAIL = 300;
    
    public function processaImmagine($immagine, $percorso = 'public/images')
    {
        // Genera nome file univoco
        $nomeFile = Str::uuid() . '.' . $immagine->getClientOriginalExtension();
        
        // Salva immagine originale
        $percorsoOriginale = $immagine->storeAs($percorso . '/originali', $nomeFile);
        
        // Processa thumbnail in modo asincrono
        dispatch(function () use ($immagine, $percorso, $nomeFile) {
            $this->creaThumbnail($immagine, $percorso, $nomeFile);
        })->afterResponse();
        
        return $nomeFile;
    }
    
    protected function creaThumbnail($immagine, $percorso, $nomeFile)
    {
        // Crea thumbnail
        $thumbnail = Image::make($immagine)
            ->fit(self::DIMENSIONE_THUMBNAIL, self::DIMENSIONE_THUMBNAIL, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
        // Salva thumbnail
        Storage::put(
            $percorso . '/thumbnails/' . $nomeFile,
            (string) $thumbnail->encode()
        );
    }
    
    public function getUrlImmagine($nomeFile, $dimensione = 'originali')
    {
        return Storage::url("images/{$dimensione}/{$nomeFile}");
    }
}
