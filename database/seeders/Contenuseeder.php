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
                'photos' => json_encode([
                    'https://pin.it/37Ykiqfo1'
                ]),
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
                'photos' => json_encode([
                    'https://pin.it/6I5Igwlj9'
                ]),
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
                'photos' => json_encode([
                    'https://pin.it/Rij4HdWVz'
                ]),
                'date_creation' => Carbon::now()->subDays(2),
                'statut' => 'publié',
                'id_region' => $regionAtacora->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
                'titre' => 'Le 10 Janvier à Ouidah',
                'texte' => 'Chaque année, Ouidah célèbre le 10 janvier avec des cérémonies traditionnelles et des défilés colorés pour honorer les ancêtres. A  cette occasion, des milliers de personnes se rassemblent pour commémorer l\'histoire et la culture vaudou du Bénin.Ouidah, ancienne plaque tournante de la traite des esclaves, est aujourd\'hui un centre culturel important où le vaudou est célébré avec fierté.',
                'photos' => json_encode([
                    'https://pin.it/5Cdb5DSFT'
                ]),
                'date_creation' => Carbon::now()->subDays(1),
                'statut' => 'publié',
                'id_region' => $regionAtlantique->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
            'titre' => 'Le Festival de Ganvié',
                'texte' => 'Ganvié, la "Venise de l’Afrique", célèbre son festival annuel avec des cérémonies traditionnelles et des courses de pirogues sur le lac Nokoué. Ce village lacustre unique attire des visiteurs du monde entier pour découvrir sa culture et son mode de vie aquatique.',
                'photos' => json_encode([
                    'https://pin.it/57jZuNbzn'
                ]),
                'date_creation' => Carbon::now(),
                'statut' => 'publié',
                'id_region' => $regionAtlantique->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
                'titre' => 'Sauce Legume Béninoise',
                'texte' => 'La sauce légume est un plat traditionnel béninois préparé avec des légumes frais, des épices locales et souvent accompagné de riz ou de pâte de maïs. C\'est un mets savoureux et nutritif très apprécié au Bénin.',
                'photos' => json_encode([
                    'https://pin.it/51NALxa43'
                ]),
                'date_creation' => Carbon::now()->subHours(12),
                'statut' => 'publié',
                'id_region' => $regionAtacora->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            [
                'titre' => 'L\'Artisanat a Abomey',
                'texte' => 'Abomey est réputée pour son artisanat riche, notamment la fabrication de tissus traditionnels, de sculptures en bois et de poteries, reflétant l\'héritage culturel du Bénin. Les artisans locaux perpétuent des techniques ancestrales, créant des œuvres uniques qui attirent les amateurs d\'art et de culture du monde entier.',
                'photos' => json_encode([
                    'https://pin.it/1qyXwj9xD'
                ]),
                'date_creation' => Carbon::now()->subHours(6),
                'statut' => 'publié',
                'id_region' => $regionAtacora->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
            


        ];

      foreach ($contenus as $contenu) {
            Contenu::updateOrCreate(
                [
                    'titre' => $contenu['titre'],
                    'id_langue' => $langueFr->id_langue,
                    'id_region' => $contenu['id_region'],
                ],
                [
                    'texte' => $contenu['texte'],
                    'photos' => json_encode($contenu['photos']),
                    'date_creation' => $contenu['date_creation'],
                    'statut' => 'publié',
                    'id_type_contenu' => $typePhoto->id_type_contenu,
                    'id_auteur' => $auteur->id_utilisateur,
                    'id_moderateur' => $auteur->id_utilisateur,
                    'parent_id' => 0,
                ]
            );
        }
        echo "Seed des contenus photos terminé.\n";
    }
}