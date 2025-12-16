<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langues = [
            ['nom_langue' => 'Français', 'code_langue' => 'fr', 'description' => 'Français', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Fon', 'code_langue' => 'Fn', 'description' => 'Fon', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Bariba', 'code_langue' => 'Br', 'description' => 'Bariba', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Goun', 'code_langue' => 'Gn', 'description' => 'Goun', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Tori', 'code_langue' => 'Tr', 'description' => 'Tori', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Minan', 'code_langue' => 'Mn', 'description' => 'Minan', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Yoruba', 'code_langue' => 'Yr', 'description' => 'Yoruba', 'created_at' => now(), 'updated_at' => now()],
          
            
        ];

        DB::table('langues')->insertOrIgnore($langues);
    }
}


