<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Mail\BecomeRevisor;
use App\Mail\RevisorAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class RevisorController extends Controller
{
    public function index(){
        $articles_to_check = Article::where('is_accepted', null)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        // Articoli accettati, inclusi quelli riaccettati dopo il rifiuto
        $accepted_articles = Article::where('revisor_id', auth()->id())
                                  ->where(function($query) {
                                      $query->where('is_accepted', true)
                                            ->orWhere(function($q) {
                                                $q->where('is_accepted', true)
                                                  ->whereColumn('updated_at', '>', 'created_at');
                                            });
                                  })
                                  ->orderBy('updated_at', 'desc')
                                  ->get();

        $rejected_articles = Article::where('is_accepted', false)
                                  ->where('revisor_id', auth()->id())
                                  ->orderBy('updated_at', 'desc')
                                  ->paginate(6);
        
        return view('revisor.index', compact('articles_to_check', 'accepted_articles', 'rejected_articles'));
    }
    
    // Funzione per ACCETTARE articolo
    public function accept(Article $article){
        // Se l'articolo era stato precedentemente rifiutato, impostiamo was_rejected a true
        if ($article->is_accepted === false) {
            $article->was_rejected = true;
        }
        $article->approved_at = now();
        $article->setAccepted(true);
        return redirect()->back()->with('message', "Complimenti, hai accettato l'articolo: $article->title");
    }

    // Funzione per RIFIUTARE articolo
    public function reject(Article $article){
        $article->rejected_at = now();
        $article->setAccepted(false);
        return redirect()->back()->with('message', "Hai rifiutato l'articolo: $article->title");
    }

    // Funzione per annullare l'ultima revisione
    public function undo(){
        $article = Article::where('is_accepted', '!=', null)
                         ->orderBy('updated_at', 'desc')
                         ->first();
        
        if(!$article) {
            return redirect()->back()->with('error', 'Nessun articolo da ripristinare');
        }

        $article->is_accepted = null;
        $article->save();

        return redirect()->back()->with('message', "L'ultima revisione è stata annullata");
    }

    // Richiesta di diventare revisor
    public function becomeRevisor(Request $request)
    {
        $user = Auth::user();
        // Controllo se l'utente è già revisore
        if($user->is_revisor) {
            return redirect()->back()->with('error', 'Sei già un revisore!');
        }

        // Controllo se l'utente ha già fatto una richiesta
        if($user->revisorRequest) {
            return redirect()->back()->with('error', 'Hai già inviato una richiesta. Attendi la risposta dell\'amministratore.');
        }

        // Validazione
        $validated = $request->validate([
            'message' => 'required|min:20|max:500',
        ]);

        try {
            // Creo la richiesta

            $user->revisorRequest()->create([
                'message' => $validated['message']
            ]);

            // Invio email all'amministratore
            $admin = User::where('is_admin', true)->first();
            
            if (!$admin) {
                \Log::error('Nessun amministratore trovato nel sistema');
                return redirect()->back()
                    ->with('error', 'Si è verificato un errore durante l\'invio della richiesta. Nessun amministratore trovato.')
                    ->withInput();
            }

            \Log::info('Invio email di richiesta revisore', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'admin_email' => $admin->email
            ]);

            Mail::to($admin->email)->send(new BecomeRevisor($user));

            return redirect()->back()->with('success', 'La tua richiesta è stata inviata con successo! Verrai contattato presto.');
        } catch (\Exception $e) {
            \Log::error('Errore durante l\'invio della richiesta revisore: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id()
            ]);
            return redirect()->back()
                ->with('error', 'Si è verificato un errore durante l\'invio della richiesta. Riprova più tardi.')
                ->withInput();
        }
    }   

    // Rendi utente revisore
    public function makeRevisor(Request $request){
        if(!$request->email) {
            return redirect()->back()->with('error', 'Email non specificata');
        }

        try {
            Artisan::call('app:make-user-revisor', ['email' => $request->email]);
            
            // Invio email di conferma
            $user = User::where('email', $request->email)->first();
            if($user) {
                Mail::to($user->email)->send(new RevisorAccepted($user));
                return redirect()->back()->with('success', 'Utente promosso a revisore con successo e email di conferma inviata');
            }

            return redirect()->back()->with('success', 'Utente promosso a revisore con successo');
        } catch(\Exception $e) {
            \Log::error('Errore durante la promozione a revisore: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante la promozione a revisore: ' . $e->getMessage());
        }
    }

    // Mostra il form per la richiesta di diventare revisore
    public function showRequestForm()
    {
        return view('join-team');
    }

    // Dashboard del revisore
    public function dashboard(){
        $pending_articles = Article::where('is_accepted', null)
                                 ->orderBy('created_at', 'asc')
                                 ->get();
        $accepted_articles = Article::where('is_accepted', true)
                                  ->orderBy('updated_at', 'desc')
                                  ->take(5)
                                  ->get();
        $rejected_articles = Article::where('is_accepted', false)
                                  ->orderBy('updated_at', 'desc')
                                  ->take(5)
                                  ->get();

        return view('revisor.dashboard', compact('pending_articles', 'accepted_articles', 'rejected_articles'));
    }
}
