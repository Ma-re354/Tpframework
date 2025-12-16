<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\langue;



class LangueSeeder extends Seeder
{
    public function run(): void
    {
        $langues = [
            ['nom_langue' => 'Français', 'code_langue' => 'fr', 'description' => 'Français'],
            ['nom_langue' => 'Fon', 'code_langue' => 'Fn', 'description' => 'Fon'],
            ['nom_langue' => 'Bariba', 'code_langue' => 'Br', 'description' => 'Bariba'],
            ['nom_langue' => 'Goun', 'code_langue' => 'Gn', 'description' => 'Goun'],
            ['nom_langue' => 'Tori', 'code_langue' => 'Tr', 'description' => 'Tori'],
            ['nom_langue' => 'Minan', 'code_langue' => 'Mn', 'description' => 'Minan'],
            ['nom_langue' => 'Yoruba', 'code_langue' => 'Yr', 'description' => 'Yoruba'],
        ];

        foreach ($langues as $langue) {
            Langue::updateOrCreate(
                ['code_langue' => $langue['code_langue']], // clé unique
                $langue
            );
        }
    }
}


