<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\Unit;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\AlignPosition;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessImage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private $effects;
    private $quality;
    private $useWatermark;

    public function __construct($filePath, array $effects = [], int $quality = 80, bool $useWatermark = false)
    {
        $this->filePath = $filePath;
        $this->effects = $effects;
        $this->quality = $quality;
        $this->useWatermark = $useWatermark;
    }

    public function handle(): void
    {
        try {
            $srcPath = storage_path('app/public/' . $this->filePath);
            
            if (!file_exists($srcPath)) {
                return;
            }
            
            $image = Image::load($srcPath);

            // Applica il crop
            if ($this->effects['brightness'] !== 0) {
                $image->brightness($this->effects['brightness']);
            }

            // Applica il contrasto
            if ($this->effects['contrast'] !== 0) {
                $image->contrast($this->effects['contrast']);
            }

            // Applica il sharpen
            if ($this->effects['sharpen'] !== 0) {
                $image->sharpen($this->effects['sharpen']);
            }
            
            
            // Applica watermark se richiesto
            if ($this->useWatermark) {
                
                $watermarkPath = public_path('media/Watermark.png');
                \Log::info("Applicazione watermark: " . $watermarkPath);

                $image->watermark($watermarkPath,
                    AlignPosition::Top,
                    width:100,widthUnit:Unit::Percent,
                    height:100,heightUnit:Unit::Percent,
                    fit: Fit::Stretch
                );
            }
            
            // Salva l'immagine processata
            $image->save($srcPath);
            
            \Log::info("Immagine processata con successo: " . $srcPath);
        } catch (\Exception $e) {
            \Log::error("Errore durante il processing dell'immagine: " . $e->getMessage());
            throw $e;
        }
    }
}
