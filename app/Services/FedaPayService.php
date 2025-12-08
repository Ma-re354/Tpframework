<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Article; // Assure-toi que ton modèle Article existe

class FedapayController extends Controller
{
    /**
     * Redirige l'utilisateur vers Fedapay pour le paiement
     */
    public function redirectToPayment($articleId)
    {
        $article = Article::findOrFail($articleId);
        $amount = $article->price * 100; // Fedapay attend des entiers (centimes)

        $response = Http::withBasicAuth(config('fedapay.secret_key'), '')
            ->post('https://api.fedapay.com/v1/transactions', [
                'amount' => $amount,
                'currency' => 'XOF', // Change si nécessaire
                'callback_url' => route('fedapay.callback'),
                'description' => $article->title,
            ]);

        $data = $response->json();

        if (isset($data['transaction_url'])) {
            return redirect($data['transaction_url']);
        }

        return back()->with('error', 'Impossible de créer le paiement.');
    }

    /**
     * Callback après le paiement
     */
    public function callback(Request $request)
    {
        $transactionId = $request->query('transaction_id');

        if (!$transactionId) {
            return redirect('/')->with('error', 'Transaction invalide.');
        }

        // Vérifier le statut du paiement via l'API
        $response = Http::withBasicAuth(config('fedapay.secret_key'), '')
            ->get("https://api.fedapay.com/v1/transactions/{$transactionId}");

        $transaction = $response->json();

        if (isset($transaction['status']) && $transaction['status'] === 'successful') {
            // Ici tu peux marquer ton article comme payé ou donner l'accès
            // Exemple :
            // $article = Article::find($transaction['metadata']['article_id']);
            // $article->is_paid = true;
            // $article->save();

            return redirect('/')->with('success', 'Paiement réussi ! Vous pouvez maintenant lire l’article.');
        }

        return redirect('/')->with('error', 'Paiement échoué ou en attente.');
    }
}
