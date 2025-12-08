<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ContenuController extends Controller
{
    public function index($type = null)
    {
        Log::info('ContenuController index appelé', ['type' => $type]);
        
        try {
            // Base query - sans vérifier le slug
            $query = Contenu::with(['region', 'langue', 'auteur'])
                            ->where('statut', 'publié')
                            ->orderBy('date_creation', 'desc');

            if ($type) {
                switch ($type) {
                    case 'recettes':
                        $query->where('id_type_contenu', 1);
                        $pageTitle = 'Recettes Traditionnelles';
                        break;

                    case 'histoires':
                        $query->where('id_type_contenu', 2);
                        $pageTitle = 'Histoires & Contes';
                        break;

                    case 'articles':
                        $query->where('id_type_contenu', 3);
                        $pageTitle = 'Articles Culturels';
                        break;

                    default:
                        $pageTitle = 'Tous les Contenus Culturels';
                }
            } else {
                $pageTitle = 'Tous les Contenus Culturels';
            }

            $contenus = $query->paginate(12);
            
            Log::info('Contenus récupérés', ['count' => $contenus->count(), 'total' => $contenus->total()]);

            return view('contenus', [
                'contenus' => $contenus,
                'pageTitle' => $pageTitle,
                'type' => $type
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur dans ContenuController@index: ' . $e->getMessage());
            
            return view('contenus', [
                'contenus' => collect(),
                'pageTitle' => 'Erreur',
                'type' => $type
            ]);
        }
    }

    public function show($id)
    {
        try {
            Log::info('ContenuController show appelé', ['id' => $id]);
            
            // Utiliser l'ID directement au lieu du slug
            $contenu = Contenu::with(['region', 'langue', 'auteur', 'typeContenu'])
                              ->where('statut', 'publié')
                              ->where('id_contenu', $id)
                              ->firstOrFail();

            // Récupérer la région associée
            $region = $contenu->region;
            
            // Si le contenu n'a pas de région, on crée un objet région vide
            if (!$region) {
                $region = new Region();
                $region->nom_region = 'Sans région';
                $region->id_region = null;
            }

            // Vérifier si l'utilisateur a payé pour ce contenu
            $hasPaid = false;
            if (auth()->check()) {
                $hasPaid = DB::table('content_payments')
                    ->where('user_id', auth()->id())
                    ->where('contenu_id', $id)
                    ->where('status', 'completed')
                    ->exists();
            }

            // Incrémenter les vues si le champ existe
            if (isset($contenu->vues)) {
                $contenu->increment('vues');
            }

            // Contenus similaires
            $contenusSimilaires = Contenu::with(['region', 'langue'])
                                        ->where('statut', 'publié')
                                        ->where('id_region', $contenu->id_region)
                                        ->where('id_contenu', '!=', $contenu->id_contenu)
                                        ->limit(3)
                                        ->get();

            return view('contenus_show', compact('contenu', 'region', 'hasPaid', 'contenusSimilaires'));

        } catch (\Exception $e) {
            Log::error('Erreur dans ContenuController@show: ' . $e->getMessage());
            abort(404);
        }
    }
}