<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{

    use HasFactory;

    protected $fillable = ['path', 'processed_path'];

    private $verifiedImageTypes = [];

    protected static function boot()
    {
        parent::boot();

        // Elimina i file quando viene eliminato il modello
        static::deleting(function ($image) {
            if ($image->path) {
                Storage::disk('public')->delete($image->path);
            }
            if ($image->processed_path) {
                Storage::disk('public')->delete($image->processed_path);
            }
        });
    }

    public function isTypeProcessed(string $type): bool
    {
        if (array_key_exists($type, $this->verifiedImageTypes)) {
            return true;
        }

        $fileName = pathinfo($this->path, PATHINFO_FILENAME);

        // get a list of all files in the storage/images folder
        $files = Storage::disk('public')->files('images');

        $images = array_filter($files, function ($file) use ($fileName) {
            return strpos($file, $fileName) !== false;
        });
        
        foreach ($images as $image) {
            if (strpos($image, $type) !== false) {
                $this->verifiedImageTypes[$type] = [ 'path' => $image, 'type' => $type ];
                return true;
            }
        }
        
        return false;
    }

    // Ottieni l'URL dell'immagine processata o originale
    public function getUrl($imageType): string
    {

        $path = $this->isTypeProcessed($imageType) ? $this->verifiedImageTypes[$imageType]['path'] : $this->path;
        return Storage::url($path);
    }

    // Relazione con l'articolo
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    protected function casts():array{
        return [
            'labels' => 'array',
        ];
    }
}
