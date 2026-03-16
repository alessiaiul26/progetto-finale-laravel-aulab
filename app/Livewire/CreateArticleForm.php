<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\ResizeImage;
use App\Jobs\ProcessImage;
use App\Jobs\RemoveFaces;
use App\Jobs\GoogleVisionSafeSearch;

use App\Models\Image;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateArticleForm extends Component
{
    // Proprietà per i dati del modulo
    public $title;
    public $description;
    public $price;
    public $category;
    public $location;
    public $article;
    public $successMessage;  // Messaggio di successo creazione articolo
    public $images = [];
    public $temporaryImages = [];
    public $maxImages = 6; // Numero massimo di immagini consentite
    public $imageEffects = [];
    public $imageQuality = 80;
    public $useWatermark = true;

    // Regole di validazione articolate
    protected $rules = [
        'title' => 'required|min:5|max:100|regex:/^[a-zA-Z0-9\s]+$/',
        'description' => 'required|min:10|max:1000',
        'price' => 'required|numeric|min:0.01|max:9999.99',
        'category' => 'required|exists:categories,id',
        'location' => 'nullable|string|max:100',
        'temporaryImages.*' => 'image|max:2048', // 2MB Max
        'temporaryImages' => 'max:6', // Max 6 files
        'imageQuality' => 'integer|min:1|max:100',
    ];

    protected $messages = [
        'temporaryImages.max' => 'Puoi caricare al massimo 6 immagini',
        'temporaryImages.*.image' => 'I file devono essere immagini',
        'temporaryImages.*.max' => 'Le immagini devono essere massimo di 2MB',
    ];

    public function mount()
    {
        // Verifica il symlink dello storage
        if (!file_exists(public_path('storage'))) {
            Log::warning('Storage symlink non trovato. Esegui php artisan storage:check');
            session()->flash('warning', 'Configurazione storage incompleta. Alcune funzionalità potrebbero non funzionare correttamente.');
        }

        // Imposta gli effetti predefiniti
        $this->imageEffects = [
            'brightness' => 0,
            'contrast' => 0,
            'sharpen' => 0,
        ];
    }

    public function updateImageEffect($effect, $value)
    {
        $this->imageEffects[$effect] = $value;
    }

    public function toggleWatermark()
    {
        $this->useWatermark = !$this->useWatermark;
    }

    // La funzione save (che potrebbe essere chiamata store)
    public function save()
    {
        // Verifica il symlink prima del salvataggio
        if (!file_exists(public_path('storage'))) {
            session()->flash('error', 'Impossibile caricare immagini. Contatta l\'amministratore.');
            return;
        }

        // Validazione dei dati secondo le regole definite
        $this->validate();

        try {
            $this->article = Article::create([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category,
                'location' => $this->location,
                'user_id' => Auth::id()
            ]);

            if (count($this->images) > 0) {
                foreach ($this->images as $image) {
                    $path = $image->store('images', 'public');
                    $imageModel = $this->article->images()->create(['path' => $path]);

                    \Log::info('Immagine salvata: ' . $path);

                    // Genera tutte le versioni necessarie
                    $allJobs = [
                        new ProcessImage($path, $this->imageEffects, $this->imageQuality, $this->useWatermark),
                    ];

                    $formats = ['thumbnail', 'card', 'preview', 'full'];
                    foreach ($formats as $format) {
                        array_push($allJobs, new ResizeImage($path, $format));
                    }

                    array_push($allJobs, new GoogleVisionSafeSearch($imageModel->id));
                    array_push($allJobs, new GoogleVisionLabelImage($imageModel->id));

                    RemoveFaces::withChain($allJobs)->dispatch($imageModel->id);
                }

                $this->successMessage = "Articolo creato con successo! Le immagini verranno elaborate a breve.";
            } else {
                $this->successMessage = "Articolo creato con successo!";
            }

            $this->cleanForm();

        } catch (\Exception $e) {
            Log::error('Errore durante il salvataggio nella creazione del articolo: ' . $e->getMessage());
            session()->flash('error', 'Si è verificato un errore durante il salvataggio. Riprova più tardi.');
            if (isset($this->article)) {
                $this->article->delete();
            }
            throw $e;
            return;
        }
    }

    public function render()
    {
        return view('livewire.create-article-form');
    }

    use WithFileUploads;

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporaryImages.*' => 'image|max:2048',
            'temporaryImages' => 'max:' . ($this->maxImages - count($this->images)),
        ])) {
            foreach ($this->temporaryImages as $image) {
                $this->images[] = $image;
            }
        }
        $this->temporaryImages = []; // Reset dopo il caricamento
    }

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            // Se l'immagine è già stata salvata nel database, eliminala
            if (is_string($this->images[$key])) {
                Storage::disk('public')->delete($this->images[$key]);
                if ($this->article) {
                    $this->article->images()->where('path', $this->images[$key])->delete();
                }
            }
            unset($this->images[$key]);
            $this->images = array_values($this->images); // Reindex array
        }
    }

    protected function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->location = '';
        $this->images = [];
        $this->temporaryImages = [];
    }
}
