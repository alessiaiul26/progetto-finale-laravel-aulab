<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleController extends Controller
{

    public function create()
    {
        return view('article.create');
    }

    public function edit($id)
    {
        return view('article.edit', ['articleId' => $id]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with('danger', 'Annuncio cancellato correttamente');
    }

    //  Tutti gli articoli-annunci
    public function index(Category $category)
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(6);
        return view('article.index', compact('articles', 'category'));
    }

    //  Dettaglio articoli-annunci
    public function show(Article $article)
    {
        $relatedArticles = $article->relatedArticles()->get();
        return view('article.show', compact('article', 'relatedArticles'));
    }

    //! limito la vista agli articoli creati
    public function byCategory(Category $category, Request $request)
    {
        $query = Article::where('category_id', $category->id)
                       ->where('is_accepted', true);

        // Applica i filtri
        switch($request->filter) {
            case 'new':
                $query->orderBy('created_at', 'desc');
                break;
            case 'old':
                $query->orderBy('created_at', 'asc');
                break;
            case 'location':
                // Assumendo che ci sia una colonna 'location' nel modello Article
                $query->orderBy('location', 'asc');
                break;
            case 'other':
                // Puoi personalizzare questo filtro come preferisci
                $query->inRandomOrder();
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $articles = $query->get();
        
        return view('article.byCategory', compact('articles', 'category'));
    }
}
