<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Article $article)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$article->id])) {
            $cart[$article->id]['quantity']++;
        } else {
            $cart[$article->id] = [
                "title" => $article->title,
                "quantity" => 1,
                "price" => $article->price,
                "image" => $article->images->first() ? $article->images->first()->getUrl('thumbnail') : '/img/default.png'
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Articolo aggiunto al carrello!');
    }

    public function showCart()
    {
        return view('cart.show');
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Articolo rimosso dal carrello!');
        }
    }
}
