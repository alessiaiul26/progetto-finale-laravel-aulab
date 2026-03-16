<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Article;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function homepage(){
        $articles = Article::where('is_accepted', true)->take(6)->orderBy('created_at', 'desc')->get();
        return view('homepage', compact('articles'));
    }
    public function aboutUs(){
        return view('aboutUs');
    }
    public function contacts(){
        return view('contacts');
    }
    public function contactUs(Request $request){
        // dd($request);
        $user = $request->input('user');
        $email = $request->input('email');
        $message = $request->input('message');
        
        $userData = compact('user', 'email', 'message');
        try {
            Mail::to($email)->send(new ContactMail($userData));
            
        } catch (Exception $e) {
            return redirect()->route('contacts')->with('emailError', 'Si è verificato un errore durante l\'invio della email.');
        }
        // dd('Controlla la casella di posta');
        return redirect(route('contacts'))->with('emailSent', 'Hai correttamente inviato una email');
    }

    // funzione per impostare la LINGUA
    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }

    // visualizzazione limitata agli articoli accettati
    public function index(){
        $articles = Article::where('is_accepted', true)->orderBy('created_at,', 'desc')->paginate(10);
        return view('article.index', compact('articles'));
    }

    // public function careers(){
    //     return view('careers');
    // }

    // public function faq(){
    //     return view('faq');
    // }

    // !RICERCA ARTICOLI
    public function searchArticles(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->paginate(9); 

        return view('article.searched', ['articles' => $articles, 'query' => $query]);
    }

    public function joinTeam()
    {
        return view('join-team');
    }
}