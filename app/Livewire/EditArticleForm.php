<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;
use App\Models\Category;

class EditArticleForm extends Component
{
    use WithFileUploads;
    
    // Proprietà per i dati del modulo
    public $articleId;
    public $title;
    public $description;
    public $price;
    public $category;
    public $article;
    public $successMessage;  // Messaggio di successo creazione articolo
    public $temporaryImages = []; // Nuova proprietà per le immagini temporanee
    public $images = []; // Proprietà per le immagini esistenti

    // Regole di validazione articolate
    protected $rules = [
        'title' => 'required|min:5|max:100|regex:/^[a-zA-Z0-9\s]+$/', 
        'description' => 'required|min:10|max:1000', 
        'price' => 'required|numeric|min:0.01|max:9999.99', 
        'category' => 'required|exists:categories,id',
        'temporaryImages.*' => 'image|max:2048',
    ];

    public function mount($articleId)
    {
        $this->articleId = $articleId;
        $article = Article::findOrFail($this->articleId);
        $this->title = $article->title;
        $this->description = $article->description;
        $this->price = $article->price;
        $this->category = $article->category_id;
        $this->categories = Category::all();
        $this->images = $article->images; // Carica le immagini esistenti
    }

    public function edit()
    {
        // Validazione dei dati secondo le regole definite
        $this->validate();

        // Modifica dell'articolo
        $this->article = Article::findOrFail($this->articleId);
        
        // Aggiornamento dei dati dell'articolo
        $this->article->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
        ]);

        // Gestione delle immagini
        if (!empty($this->temporaryImages)) {
            foreach ($this->temporaryImages as $image) {
                $newFileName = "articles/{$this->article->id}";
                $newImage = $image->store($newFileName, 'public');
                $this->article->images()->create(['path' => $newImage]);
            }
        }
        
        // Messaggio di successo
        $this->successMessage = "Articolo modificato con successo! Verifica il DB";
        
        // Reset delle immagini temporanee
        $this->temporaryImages = [];
    }

    public function render()
    {
        return view('livewire.edit-article-form');
    }
}
