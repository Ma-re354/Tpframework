<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'langues' => [
                'Fon', 'Yoruba', 'Dendi', 'Goun', 'Bariba', 
                'Adja', 'Ditammari', 'Yom', 'Mina', 'Foodo'
            ],
            'regions' => [
                ['name' => 'Atacora', 'description' => 'Tata Somba, tissage, danses traditionnelles'],
                ['name' => 'Zou', 'description' => 'Histoire royale, artisanat, cérémonies vodoun'],
                ['name' => 'Mono', 'description' => 'Pêche traditionnelle, tissage de paniers'],
                ['name' => 'Collines', 'description' => 'Agriculture, musique, traditions orales'],
                ['name' => 'Atlantique', 'description' => 'Culture côtière, pêche, danses Guèlèdè'],
                ['name' => 'Borgou', 'description' => 'Élevage, fêtes traditionnelles, artisanat'],
            ]
        ];

        return view('home', $data);
    }
}