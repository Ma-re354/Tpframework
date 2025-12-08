<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Contenu;

class RegionController extends Controller
{
    public function index()
    {
        // Récupérer toutes les régions avec le nombre de contenus
        $regions = Region::all()->map(function ($region) {
            // Compter les contenus publiés pour chaque région
            $region->contenus_count = Contenu::where('id_region', $region->id_region)
                                            ->where('statut', 'publié')
                                            ->count();
            return $region;
        });

        return view('regions', compact('regions'));
    }

    public function show($id)
    {
        // Récupérer la région avec ses contenus publiés
        $region = Region::findOrFail($id);
        
        // Récupérer les contenus publiés de cette région
        $contenus = Contenu::with(['langue', 'auteur'])
                          ->where('id_region', $id)
                          ->where('statut', 'publié')
                          ->orderBy('date_creation', 'desc')
                          ->paginate(12);
        
        // Récupérer les langues parlées dans cette région
        $languesRegion = Contenu::where('id_region', $id)
                               ->where('statut', 'publié')
                               ->with('langue')
                               ->get()
                               ->pluck('langue')
                               ->filter()
                               ->unique('id_langue')
                               ->values();
        
        return view('region-show', compact('region', 'contenus', 'languesRegion'));
    }
}