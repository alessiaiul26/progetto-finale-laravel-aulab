<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class SearchArticleIndex extends Component
{
    
    public $search = '';
    public $priceMin = '';
    public $priceMax = '';
    public $selectedCategories = [];
    public $sortBy = '';
    public $location = '';

    protected $rules = [
        'search' => 'nullable|string|max:255',
        'priceMin' => 'nullable|numeric|min:0',
        'priceMax' => 'nullable|numeric|min:0',
        'selectedCategories' => 'array',
        'sortBy' => 'nullable|string|in:price_asc,price_desc,date_asc,date_desc',
        'location' => 'nullable|string|max:100',
    ];

    public function mount()
    {
        $this->selectedCategories = [];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->validate();

        $query = Article::where('is_accepted', true);

        // Filtro per ricerca testuale
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filtro per prezzo
        if ($this->priceMin) {
            $query->where('price', '>=', $this->priceMin);
        }
        if ($this->priceMax) {
            $query->where('price', '<=', $this->priceMax);
        }

        // Filtro per categorie
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Filtro per località
        if ($this->location) {
            $query->where('location', 'like', '%' . $this->location . '%');
        }

        // Ordinamento
        switch ($this->sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $articles = $query->paginate(6);
        $categories = \App\Models\Category::all();

        return view('livewire.search-article-index', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
