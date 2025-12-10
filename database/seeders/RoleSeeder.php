<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nom_role' => 'Administrateur', 'created_at' => now(), 'updated_at' => now()],
            ['nom_role' => 'Superviseur', 'created_at' => now(), 'updated_at' => now()],
            ['nom_role' => 'Contrôleur', 'created_at' => now(), 'updated_at' => now()],
            ['nom_role' => 'Utilisateur', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('roles')->insertOrIgnore($roles);
    }
}
