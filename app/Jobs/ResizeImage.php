<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use App\Jobs\ResizeImage;
use Intervention\Image\ImageManager;
use Spatie\Image\Enums\CropPosition;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResizeImage implements ShouldQueue
{
    use Queueable;
    
    private $w, $h, $filename, $path;
    private $mode;
    private $format;
    private $quality;

    // Formati predefiniti per diversi contesti
    const FORMATS = [
        // !usare solo 300x300
        'thumbnail' => [
            'width' => 300,
            'height' => 300,
            'mode' => 'cover',
            'quality' => 80
        ],
        'card' => [
            'width' => 400,
            'height' => 300,
            'mode' => 'cover',
            'quality' => 85
        ],
        'preview' => [
            'width' => 600,
            'height' => 400,
            'mode' => 'contain',
            'quality' => 85
        ],
        'full' => [
            'width' => 1200,
            'height' => 800,
            'mode' => 'contain',
            'quality' => 90
        ],
        'banner' => [
            'width' => 1920,
            'height' => 600,
            'mode' => 'cover',
            'quality' => 90
        ]
    ];
    
    public function __construct($filePath, $format = 'preview')
    {
        $this->path = dirname($filePath);
        $this->filename = basename($filePath);
        
        // !quando un'img viene caricata, il job 'ResizeImage' deve essere dispatchato con il formato 'thumbnail'
        // !Da applicare il controller o nel caricamento dei file.
        // $path = $uploadedImage->store('images');
        // ResizeImage::dispatch($path, 'thumbnail' );
        // Usa il formato predefinito o fallback su preview
        $config = self::FORMATS[$format] ?? self::FORMATS['preview'];
        
        $this->w = $config['width'];
        $this->h = $config['height'];
        $this->mode = $config['mode'];
        $this->quality = $config['quality'];
        $this->format = $format;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $w = $this->w;
            $h = $this->h;
            $srcPath = storage_path('app/public/' . $this->path . '/' . $this->filename);
            $destPath = storage_path('app/public/' . $this->path . "/{$this->format}_{$w}x{$h}_" . $this->filename);
    
            if (!file_exists($srcPath)) {
                \Log::error("File sorgente non trovato: {$srcPath}");
                return;
            }
    
            $directory = dirname($destPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            Image::load($srcPath)
                ->fit(fit: Fit::Crop, desiredWidth: $w, desiredHeight: $h)
                ->save($destPath);

        } catch (\Exception $e) {
            \Log::error("Errore durante il ridimensionamento dell'immagine: " . $e->getMessage());
            return;
        }
    }
}
