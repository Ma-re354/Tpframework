<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class utilisateurseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles and langues exist (seeders should have run but just in case)
        $roleAdmin = DB::table('roles')->where('nom_role', 'Administrateur')->first();
        $langFr = DB::table('langues')->where('code_langue', 'fr')->first();

        $now = now();

        $users = [
            [
                'nom' => 'COMLAN',
                'prenom' => 'Maurice',
                'email' => 'mauricecomlan@uac.bj',
                'mot_de_passe' => Hash::make('eneam123'),
                'sexe' => 'M',
                'date_inscription' => $now->toDateString(),
                'date_naissance' => '1990-01-01',
                'statut' => 'actif',
                'photo' => null,
                'id_role' => $roleAdmin->id_role ?? 1,
                'id_langue' => $langFr->id_langue ?? 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nom' => 'Jean',
                'prenom' => 'Dupont',
                'email' => 'jean.dupont@example.com',
                'mot_de_passe' => Hash::make('password'),
                'sexe' => 'M',
                'date_inscription' => $now->toDateString(),
                'date_naissance' => '1985-07-15',
                'statut' => 'actif',
                'photo' => null,
                'id_role' => 4,
                'id_langue' => $langFr->id_langue ?? 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('utilisateurs')->insertOrIgnore($users);
    }
}