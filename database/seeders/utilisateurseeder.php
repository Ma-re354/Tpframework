<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;

class utilisateurseeder extends Seeder
{
    public function run(): void
    {
        // S’assurer que le rôle Administrateur existe
        $roleAdmin = Role::firstOrCreate(
            ['nom_role' => 'Administrateur']
        );

        // Création utilisateur admin
      User::updateOrCreate(
    ['email' => 'maurice.comlan@uac.bj'], // clé unique
    [
        'nom' => 'COMLAN',
        'prenom' => 'Maurice',
        'mot_de_passe' => bcrypt('Eneam123'),
        'sexe' => 'F',
        'date_inscription' => Carbon::parse('2024-01-15'),
        'date_naissance' => Carbon::parse('1995-06-20'),
        'statut' => 'actif',
        'id_role' => $roleAdmin->id_role,
        'id_langue' => 1,
    ]
);
    }
}