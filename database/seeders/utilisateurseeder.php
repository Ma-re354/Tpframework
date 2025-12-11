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
        User::create([
            'nom' => 'COMLAN',
            'prenom' => 'Maurice',
            'email' => 'maurice.comlan@uacc.bj',
            'mot_de_passe' => bcrypt('Eneam123'),
            'sexe' => 'F',
            'date_inscription' => Carbon::parse('2024-01-15'),
            'date_naissance' => Carbon::parse('1995-06-20'),
            'statut' => 'actif',
            'id_role' => $roleAdmin->id_role, // <---- IMPORTANT
            'id_langue' => 1,
        ]);
    }
}