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
                    'https://www.bing.com/images/search?view=detailV2&ccid=hRhlCCnd&id=B2CC0C9A6AA923A49CF94384C35FA9E57242D255&thid=OIP.hRhlCCndlA8GT7F-CKEgWAHaEK&mediaurl=https%3a%2f%2flp-cms-production.imgix.net%2f2019-06%2f170480848_master.jpg%3fauto%3dformat%26q%3d40%26ar%3d16%3a9%26fit%3dcrop%26crop%3dcenter%26fm%3dauto%26w%3d7401&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.8518650829dd940f064fb17e08a12058%3frik%3dVdJCcuWpX8OEQw%26pid%3dImgRaw%26r%3d0&exph=3087&expw=5489&q=marcher+de+dantopka&FORM=IRPRST&ck=AB50CA221BE458CF196301230AE4B8F7&selectedIndex=0&itb=0'
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
                    'https://www.bing.com/images/search?view=detailV2&ccid=1WsjnnIq&id=468122C24CB965ECD2107294E53621A27D66815B&thid=OIP.1WsjnnIqFSSf89nSs0OE7QHaE8&mediaurl=https%3a%2f%2fwww.les-covoyageurs.com%2fressources%2fimages-lieux%2fphoto-lieu-446-1.jpg&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.d56b239e722a15249ff3d9d2b34384ed%3frik%3dW4FmfaIhNuWUcg%26pid%3dImgRaw%26r%3d0&exph=3456&expw=5184&q=plage+de+grand+popo&FORM=IRPRST&ck=A8BE1115D71ECB2017A9E21F2ED4281D&selectedIndex=8&itb=0'
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
                    'https://www.bing.com/images/search?view=detailV2&ccid=HtBQEK3z&id=745FE4F41DA683BFC425F3529D9D745DEDE69E1B&thid=OIP.HtBQEK3zy3ZBW9KP7zKjFgHaE7&mediaurl=https%3a%2f%2fwww.routedestata.bj%2fwp-content%2fuploads%2f2020%2f11%2fexplorer_parc-national-de-la-pendjari-cc%40daniel-nelson.jpg&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.1ed05010adf3cb76415bd28fef32a316%3frik%3dG57m7V10nZ1S8w%26pid%3dImgRaw%26r%3d0&exph=853&expw=1280&q=parc+de+pendjari&FORM=IRPRST&ck=74E57F9D476B12F5E872B71A5E332236&selectedIndex=8&itb=0'
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
                    'https://www.bing.com/images/search?view=detailV2&ccid=5Zib7sMx&id=8B47B3C33240FD39E069D29284BACB22351C7467&thid=OIP.5Zib7sMxAkQ9l_vfhcT5yAHaE8&mediaurl=https%3a%2f%2fsparticulture.com%2fwp-content%2fuploads%2f2024%2f01%2fIMG-20240110-WA0008.jpg&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.e5989beec33102443d97fbdf85c4f9c8%3frik%3dZ3QcNSLLuoSS0g%26pid%3dImgRaw%26r%3d0&exph=667&expw=1000&q=10+janvier+au+b%c3%a9nin&FORM=IRPRST&ck=73FF53D179B0E1E6A5A004FAD615E1D7&selectedIndex=2&itb=0'
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
                    'https://www.bing.com/images/search?view=detailV2&ccid=407hBkJy&id=253A0BC10CEB89544AFC68265BCB13F34225538B&thid=OIP.407hBkJybeQdzFw4WHEbcgHaEK&mediaurl=https%3a%2f%2fwww.ruvival.de%2fwp-content%2fuploads%2f2019%2f08%2fGWD_BENIN_JUIN2019_3.png&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.e34ee10642726de41dcc5c3858711b72%3frik%3di1MlQvMTy1smaA%26pid%3dImgRaw%26r%3d0&exph=1080&expw=1920&q=Festival+de+Ganvie&FORM=IRPRST&ck=D5DF77BE56FEBD6E97C32D24801B36D8&selectedIndex=0&itb=0'
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
                    'https://www.bing.com/images/search?view=detailV2&ccid=qUSXEMDE&id=A79215CAFC1CF22019B49DDCC60BEE871CB76971&thid=OIP.qUSXEMDEvp_4Rz-hFDfI7wHaE8&mediaurl=https%3a%2f%2fwww.cuisinedecheznous.net%2fwp-content%2fuploads%2f2021%2f12%2fb487980aaaf5872a391a71c6f15a9656.jpg&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.a9449710c0c4be9ff8473fa11437c8ef%3frik%3dcWm3HIfuC8bcnQ%26pid%3dImgRaw%26r%3d0&exph=683&expw=1024&q=sauce+legumes&FORM=IRPRST&ck=1A9419D8A80F89338A9A2A7D9E1CDC68&selectedIndex=8&itb=0'
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
                    'https://www.bing.com/images/search?view=detailV2&ccid=jdbkXXn1&id=ACC3E97973DCF54EDCDCAF72B82A17A429DD2B64&thid=OIP.jdbkXXn1dnf7zuq-5EimvgHaCa&mediaurl=https%3a%2f%2fplantourisme.com%2fwp-content%2fuploads%2f2023%2f06%2fFabrication-artisanale-de-Pagne-tisse-Abomey-1.png&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.8dd6e45d79f57677fbceeabee448a6be%3frik%3dZCvdKaQXKrhyrw%26pid%3dImgRaw%26r%3d0&exph=348&expw=1071&q=Artisan+B%c3%a9nin&FORM=IRPRST&ck=C92DD3019FDCF2B8E7E582772228819E&selectedIndex=4&itb=0'
                ]),
                'date_creation' => Carbon::now()->subHours(6),
                'statut' => 'publié',
                'id_region' => $regionAtacora->id_region,
                'id_langue' => $langueFr->id_langue,
                'id_type_contenu' => $typePhoto->id_type_contenu,
                'id_auteur' => $auteur->id_utilisateur,
                'id_moderateur' => $auteur->id_utilisateur,
            ],
             [
                'titre' => 'La Fête des Masques à Dassa-Zoumé',
                'texte' => 'Dassa-Zoumé célèbre la Fête des Masques avec des danses traditionnelles, des rituels et des cérémonies qui honorent les esprits ancestraux et renforcent les liens communautaires.',
                'photos' => json_encode([
                    'https://www.bing.com/images/search?view=detailV2&ccid=xMe8jQQo&id=9BBCB33DC8956BFCCF651A4EED24773D95DD4CD6&thid=OIP.xMe8jQQo9HoCpalts5AqowHaEK&mediaurl=https%3a%2f%2fcdn.thecollector.com%2fwp-content%2fuploads%2f2024%2f11%2fphoto-of-zangbeto-dancing.jpg&cdnurl=https%3a%2f%2fth.bing.com%2fth%2fid%2fR.c4c7bc8d0428f47a02a5a96db3902aa3%3frik%3d1kzdlT13JO1OGg%26pid%3dImgRaw%26r%3d0&exph=675&expw=1200&q=DANSE+ZANGBETO&FORM=IRPRST&ck=9C9A1B4059E99A2796163F19354933C0&selectedIndex=2&itb=0'
                ]),
                'date_creation' => Carbon::now()->subHours(3),
                'statut' => 'publié',
                'id_region' => $regionAtacora->id_region,
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