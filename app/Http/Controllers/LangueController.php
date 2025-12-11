<?php

namespace App\Http\Controllers;

use App\Models\langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function index()
    {
             // Charger les langues avec leurs contenus (sans tri par date)
        $langues = Langue::with(['contenus' => function($query) {
            $query->with('region')->take(3);
        }])->orderBy('nom_langue', 'asc')->get();
        
        return view('langues', compact('langues'));
    }
}