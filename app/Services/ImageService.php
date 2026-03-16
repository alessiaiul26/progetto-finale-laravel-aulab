<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageService
{
    const THUMBNAIL_SIZE = 300;
    
    public function processImage($image, $path = 'public/images')
    {
        // Generate unique filename
        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
        
        // Store original image
        $originalPath = $image->storeAs($path . '/original', $filename);
        
        // Process thumbnail asynchronously
        dispatch(function () use ($image, $path, $filename) {
            $this->createThumbnail($image, $path, $filename);
        })->afterResponse();
        
        return $filename;
    }
    
    protected function createThumbnail($image, $path, $filename)
    {
        // Create thumbnail
        $thumbnail = Image::make($image)
            ->fit(self::THUMBNAIL_SIZE, self::THUMBNAIL_SIZE, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
        // Store thumbnail
        Storage::put(
            $path . '/thumbnails/' . $filename,
            (string) $thumbnail->encode()
        );
    }
    
    public function getImageUrl($filename, $size = 'original')
    {
        return Storage::url("images/{$size}/{$filename}");
    }
}
