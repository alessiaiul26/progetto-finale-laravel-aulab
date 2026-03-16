<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\ImageService;

class ProcessImageThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;
    protected $filename;

    public function __construct($imagePath, $filename)
    {
        $this->imagePath = $imagePath;
        $this->filename = $filename;
    }

    public function handle(ImageService $imageService)
    {
        $imageService->createThumbnail($this->imagePath, 'public/images', $this->filename);
    }
}
