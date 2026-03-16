<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Queueable;
    private $article_image_id;
    /**
     * Create a new job instance.
     */
    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try {
            // !etichetta l'immagine identificando oggetti e scende al suo interno
            $i = Image::find($this->article_image_id);
            if (!$i){
                return;
            }
    
            $image = file_get_contents(storage_path('app/public/' . $i->path));
            putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));
    
            $imageAnnotator = new ImageAnnotatorClient();
            $response = $imageAnnotator->labelDetection($image);
            // recupero l'array di etichette
            $labels = $response->getLabelAnnotations();
    
            if ($labels){
                $result = [];
                foreach ($labels as $label) {
                    $result[] = $label->getDescription();
                }
    
                $i->labels = $result;
                $i->save();
            }
    
            // salvataggio img aggiornata nel DB
            $imageAnnotator->close();
        }
        catch (\Exception $e) {
            throw new \Exception("Errore durante il labeling dell'immagine: " . $e->getMessage());
        }
    }
}
