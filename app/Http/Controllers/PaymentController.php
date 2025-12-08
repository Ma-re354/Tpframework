<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FedaPayService;
use App\Models\Contenu;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $fedaPayService;

    public function __construct(FedaPayService $fedaPayService)
    {
        $this->fedaPayService = $fedaPayService;
    }

    public function payForContent($contenuId)
    {
        $contenu = Contenu::findOrFail($contenuId);
        
        // Vérifier si l'utilisateur a déjà payé pour ce contenu
        if ($this->hasUserPaidForContent($contenuId)) {
            return redirect()->route('contenus.show', $contenuId);
        }

        $transaction = $this->fedaPayService->createPayment(
            500, // 500 XOF (~0.75€) - ajustez le prix selon vos besoins
            Auth::user()->email ?? 'client@example.com',
            route('fedapay.content.callback', ['contenuId' => $contenuId]),
            [
                'contenu_id' => $contenuId,
                'user_id' => Auth::id(),
                'description' => 'Accès complet au contenu: ' . $contenu->titre
            ]
        );

        // Stocker temporairement l'ID de transaction en session
        session(['payment_transaction_id' => $transaction->id]);
        session(['payment_contenu_id' => $contenuId]);

        return redirect($transaction->generateUrl());
    }

    public function callback(Request $request, $contenuId)
    {
        try {
            $transaction = \FedaPay\Transaction::retrieve($request->id);
            
            if ($transaction->status == 'approved') {
                // Enregistrer le paiement en base de données
                $this->recordPaymentSuccess(
                    Auth::id(),
                    $contenuId,
                    $transaction->id,
                    $transaction->amount,
                    $transaction->currency['code'] ?? 'XOF'
                );

                // Rediriger vers la page du contenu avec accès complet
                return redirect()->route('contenus.show', $contenuId)
                    ->with('success', 'Paiement réussi ! Vous pouvez maintenant accéder au contenu complet.');
            }

            return redirect()->route('contenus.show', $contenuId)
                ->with('error', 'Paiement échoué ou annulé.');

        } catch (\Exception $e) {
            return redirect()->route('contenus.show', $contenuId)
                ->with('error', 'Erreur lors du traitement du paiement.');
        }
    }

    private function hasUserPaidForContent($contenuId)
    {
        if (!Auth::check()) {
            return false;
        }

        // Vérifier dans la base de données si l'utilisateur a déjà payé
        // Vous devrez créer une table `content_payments` pour stocker ça
        return \DB::table('content_payments')
            ->where('user_id', Auth::id())
            ->where('contenu_id', $contenuId)
            ->where('status', 'completed')
            ->exists();
    }

    private function recordPaymentSuccess($userId, $contenuId, $transactionId, $amount, $currency)
    {
        // Enregistrer le paiement en base de données
        \DB::table('content_payments')->insert([
            'user_id' => $userId,
            'contenu_id' => $contenuId,
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'currency' => $currency,
            'status' => 'completed',
            'paid_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}