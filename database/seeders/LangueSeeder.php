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
            ['nom_langue' => 'Anglais', 'code_langue' => 'en', 'description' => 'Anglais', 'created_at' => now(), 'updated_at' => now()],
            ['nom_langue' => 'Espagnol', 'code_langue' => 'es', 'description' => 'Espagnol', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('langues')->insertOrIgnore($langues);
    }
}


