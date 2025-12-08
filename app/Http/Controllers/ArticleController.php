<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Méthode pour afficher un article
    public function show(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // Si paiement réussi, mettre 'success' dans la session
        if ($request->has('payment_status') && $request->payment_status == 'success') {
            session()->flash('success', true);
        }

        return view('articles.show', compact('article'));
    }

    // Méthode pour rediriger vers Fedapay
    public function payer($id)
    {
        $article = Article::findOrFail($id);

        $token = env('FEDAPAY_TOKEN'); // Ton token Fedapay
        $amount = $article->prix * 100; // en centimes
        $currency = "XOF";
        $callbackUrl = route('articles.show', $article->id); // Retour après paiement

        $fedapayUrl = "https://www.fedapay.com/checkout/pay?token={$token}&amount={$amount}&currency={$currency}&callback={$callbackUrl}";

        return redirect($fedapayUrl);
    }
}
