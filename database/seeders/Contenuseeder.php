<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;
use App\Models\langue;
use App\Models\TypeContenu;
use Carbon\Carbon;


class Contenuseeder extends Seeder
{
    public function run(): void
    {
        // Récupérer l'auteur
        $auteur = User::where('email', 'maurice.comlan@uac.bj')->first();
        if (!$auteur) {
            echo "Erreur : utilisateur admin non trouvé.\n";
            return;
        }

        // Récupérer les régions
        $regionAtlantique = Region::where('nom_region', 'Atlantique')->first();
        $regionAtacora = Region::where('nom_region', 'Atacora')->first();
        if (!$regionAtlantique || !$regionAtacora) {
            echo "Erreur : une ou plusieurs régions manquantes.\n";
            return;
        }

        // Récupérer la langue
        $langueFr = Langue::where('code_langue', 'fr')->first();
        if (!$langueFr) {
            echo "Erreur : langue française non trouvée.\n";
            return;
        }

        // Récupérer ou créer les types de contenus
        $typePhoto = TypeContenu::firstOrCreate(['nom_contenu' => 'Photo']);

        // Contenus photo
        $contenus = [
            [
                'titre' => 'Le Marché Dantokpa',
                'texte' => 'Le marché Dantokpa à Cotonou est le plus grand marché d’Afrique de l’Ouest, symbole du commerce et de la vie animée béninoise.',
                'photos' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800',
                'date_creation' => Carbon::now()->subDays(5),
                'statut' => 'publié',
                'id_region' => $regionAtlantique->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
                'titre' => 'Les Plages de Grand-Popo',
                'texte' => 'Grand-Popo est célèbre pour ses plages paisibles et ses couchers de soleil spectaculaires le long du littoral béninois.',
                'photos' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'date_creation' => Carbon::now()->subDays(3),
                'statut' => 'publié',
                'id_region' => $regionAtlantique->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
                'titre' => 'La Forêt de Pendjari',
                'texte' => 'Le Parc National de la Pendjari est un sanctuaire naturel, abritant éléphants, lions et buffles dans des paysages majestueux.',
                'photos' => 'https://images.unsplash.com/photo-1562158070-7d234f2e15d6?w=800',
                'date_creation' => Carbon::now()->subDays(2),
                'statut' => 'publié',
                'id_region' => $regionAtacora->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
                'titre' => 'Les Sculptures de Ouidah',
                'texte' => 'Ouidah est célèbre pour ses sculptures et monuments commémoratifs liés à l’histoire et à la culture béninoises.',
                'photos' => 'https://images.unsplash.com/photo-1574169208507-843761648e2b?w=800',
                'date_creation' => Carbon::now()->subDays(1),
                'statut' => 'publié',
                'id_region' => $regionAtlantique->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
        ];

        foreach ($contenus as $contenu) {
            $contenu['parent_id'] = 0;
            Contenu::create($contenu);
        }

        echo "Seed des contenus photos terminé.\n";
    }
}