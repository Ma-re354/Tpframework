<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Langue;
use App\Models\Region;
use App\Models\Contenu;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class DashboardController extends Controller
{
    // Supprimer ou commenter cette ligne pour enlever l'authentification
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $data = [
            'usersCount' => 1254,
            'moderatorsCount' => 24,
            'contentsCount' => 568,
            'languagesCount' => 5,
            'viewsCount' => 12458,
            'recentActivities' => [
                [
                    'icon' => 'fa-user-plus',
                    'description' => 'Nouvel utilisateur inscrit',
                    'time' => 'Il y a 2 heures'
                ],
                [
                    'icon' => 'fa-user-shield',
                    'description' => 'Nouveau modérateur ajouté',
                    'time' => 'Il y a 4 heures'
                ],
                [
                    'icon' => 'fa-file-upload',
                    'description' => 'Nouvelle recette ajoutée',
                    'time' => 'Il y a 5 heures'
                ],
                [
                    'icon' => 'fa-edit',
                    'description' => 'Contenu modifié',
                    'time' => 'Il y a 1 jour'
                ]
            ]
        ];

        return view('dashboard.accueil', $data);
    }

    public function utilisateurs()
    {
        $users = \App\Models\User::all();
        return view('dashboard.utilisateurs', compact('users'));
    }
     public function edit()
    {
        $users = \App\Models\User::find($id);
        $roles = \App\Models\Role::all();
        $langues = \App\Models\Langue::all();
        return view('dashboard.utilisateurs', compact('users','roles','langues'));
    }

    /**
     * Create / Store / Destroy utilisateur
     */
    public function createUtilisateur()
    {
        $langues = Langue::all();
        $roles = [1 => 'Administrateur', 2 => 'Superviseur', 3 => 'Contrôleur', 4 => 'Utilisateur'];
        return view('dashboard.create_utilisateur', compact('langues','roles'));
    }

    public function storeUtilisateur(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs,email',
            'mot_de_passe' => 'required|string|min:6',
            'sexe' => 'nullable|string|max:10',
            'date_inscription' => 'nullable|date',
            'date_naissance' => 'nullable|date',
            'statut' => 'nullable|string|max:50',
            'photo' => 'nullable|file|image|max:2048',
            'id_role' => 'nullable|integer',
            'id_langue' => 'nullable|integer'
        ]);

        // Hash password
        $data['mot_de_passe'] = Hash::make($data['mot_de_passe']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('utilisateurs', 'public');
            $data['photo'] = $path;
        }

        // Default date_inscription
        if (empty($data['date_inscription'])) {
            $data['date_inscription'] = now();
        }

        User::create($data);
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur créé');
    }

    public function destroyUtilisateur($id)
    {
        $user = User::where('id_utilisateur', $id)->firstOrFail();
        $user->delete();
        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur supprimé');
    }

    public function moderateurs()
    {
        // Données fictives pour les modérateurs
        $moderators = [
            (object)[
                'id' => 1,
                'name' => 'Sophie Bernard',
                'email' => 'sophie.bernard@example.com',
                'role' => 'moderator',
                'created_at' => now()->subDays(90),
                'permissions' => 'Contenus, Commentaires'
            ],
            (object)[
                'id' => 2,
                'name' => 'Thomas Moreau',
                'email' => 'thomas.moreau@example.com',
                'role' => 'moderator',
                'created_at' => now()->subDays(75),
                'permissions' => 'Utilisateurs, Signalements'
            ],
            (object)[
                'id' => 3,
                'name' => 'Laura Petit',
                'email' => 'laura.petit@example.com',
                'role' => 'moderator',
                'created_at' => now()->subDays(45),
                'permissions' => 'Contenus, Modération'
            ]
        ];

        return view('dashboard.moderateurs', compact('moderators'));
    }

    public function langues()
    {
      $langues = Langue::all();
    return view('dashboard.langues', compact('langues'));
        
        
    }

    /** Create / Store / Destroy langues */
    public function createLangue()
    {
        return view('dashboard.create_langue');
    }

    public function storeLangue(Request $request)
    {
        $data = $request->validate([
            'nom_langue' => 'required|string|max:255',
            'code_langue' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);
        Langue::create($data);
        return redirect()->route('admin.langues.index')->with('success', 'Langue créée');
    }

    public function destroyLangue($id)
    {
        $langue = Langue::where('id_langue', $id)->firstOrFail();
        $langue->delete();
        return redirect()->route('admin.langues.index')->with('success', 'Langue supprimée');
    }

    public function recettes()
    {
        // Récupère tous les contenus (ou filtrez par type si besoin)
        $contenues = Contenu::with(['langue', 'auteur'])->get();

        return view('dashboard.recettes', compact('contenues'));
    }

    /** Create / Store / Destroy contenu */
    public function createContenu()
    {
        $langues = Langue::all();
        $users = User::all();
        $regions = Region::all();
        $moderateurs = User::where('id_role', 3)->get();

        return view('dashboard.create_contenu', compact('langues','users','regions','moderateurs' ));
    }

  


public function storeContenu(Request $request)
{
    $data = $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'id_region' => 'required|integer',
        'id_langue' => 'required|integer',
        'id_moderateur' => 'nullable|integer',
        'id_auteur' => 'required|integer',
        'id_type_contenu' => 'nullable|integer', // Ajoutez si vous voulez le contrôler
        'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120', // Multiple images
        'videos.*' => 'nullable|mimetypes:video/mp4,video/avi,video/mov,video/wmv|max:20480' // Multiple videos
    ]);

    try {
        // Définition automatique des champs imposés
        $data['statut'] = 'publié';
        $data['parent_id'] = 0;
        $data['date_creation'] = now();
        $data['date_modification'] = now();
        
        // Assurez-vous que id_type_contenu a une valeur
        $data['id_type_contenu'] = $data['id_type_contenu'] ?? 1; // 1 = recette par défaut

        // Stockage des photos multiples
        $photoUrls = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('contenus/photos', 'public');
                $photoUrls[] = 'storage/' . $path; // Format: storage/contenus/photos/filename.jpg
            }
            $data['photos'] = !empty($photoUrls) ? json_encode($photoUrls) : null;
        }

        // Stockage des vidéos multiples
        $videoUrls = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('contenus/videos', 'public');
                $videoUrls[] = 'storage/' . $path; // Format: storage/contenus/videos/filename.mp4
            }
            $data['videos'] = !empty($videoUrls) ? json_encode($videoUrls) : null;
        }

        Contenu::create($data);

        return redirect()->route('admin.contenu.index')->with('success', 'Contenu créé avec succès!');
    } catch (\Exception $e) {
        // Log l'erreur pour débogage
        \Log::error('Erreur création contenu: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => 'Impossible d\'ajouter le contenu. Erreur: ' . $e->getMessage()]);
    }
}


    public function destroyContenu($id)
    {
        $contenu = Contenu::where('id_contenu', $id)->firstOrFail();
        $contenu->delete();
        return redirect()->route('admin.contenu.index')->with('success', 'Contenu supprimé');
    }

    /**
     * Affiche les détails d'un utilisateur
     */
    public function showUtilisateur($id)
    {
        $user = User::where('id_utilisateur', $id)->firstOrFail();
        return view('dashboard.show_utilisateur', compact('user'));
    }

    public function editUtilisateur($id)
    {
        $user = User::where('id_utilisateur', $id)->firstOrFail();
        $langues = Langue::all();
        $roles = [1 => 'Administrateur', 2 => 'Superviseur', 3 => 'Contrôleur', 4 => 'Utilisateur'];
        return view('dashboard.edit_utilisateur', compact('user','langues','roles'));
    }

    public function updateUtilisateur(Request $request, $id)
    {
        $user = User::where('id_utilisateur', $id)->firstOrFail();
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateurs,email,' . $id . ',id_utilisateur',
            'mot_de_passe' => 'nullable|string|min:6',
            'sexe' => 'nullable|string|max:10',
            'date_inscription' => 'nullable|date',
            'date_naissance' => 'nullable|date',
            'statut' => 'nullable|string|max:50',
            'photo' => 'nullable|file|image|max:2048',
            'id_role' => 'nullable|integer',
            'id_langue' => 'nullable|integer'
        ]);

        // If password provided, hash it
        if (!empty($data['mot_de_passe'])) {
            $data['mot_de_passe'] = Hash::make($data['mot_de_passe']);
        } else {
            unset($data['mot_de_passe']);
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('utilisateurs', 'public');
            $data['photo'] = $path;
        }

        $user->update($data);
        return redirect()->route('utilisateurs')->with('success','Utilisateur mis à jour');
    }

    /**
     * Langue show/edit/update
     */
    public function showLangue($id)
    {
        $langue = Langue::where('id_langue', $id)->firstOrFail();
        return view('dashboard.show_langue', compact('langue'));
    }

    public function editLangue($id)
    {
        $langue = Langue::where('id_langue', $id)->firstOrFail();
        return view('dashboard.edit_langue', compact('langue'));
    }

    public function updateLangue(Request $request, $id)
    {
        $langue = Langue::where('id_langue', $id)->firstOrFail();
        $langue->update($request->only(['nom_langue','code_langue','description']));
        return redirect()->route('admin.langues.index')->with('success','Langue mise à jour');
    }

    /**
     * Region show/edit/update
     */
    public function showRegion($id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        return view('dashboard.show_region', compact('region'));
    }

    public function editRegion($id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        return view('dashboard.edit_region', compact('region'));
    }

    public function updateRegion(Request $request, $id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        $region->update($request->only(['nom_region','description','population','superficie','localisation']));
        return redirect()->route('admin.regions.index')->with('success','Région mise à jour');
    }

    /**
     * Contenu (recette) show/edit/update
     */
    public function showContenu($id)
    {
        $contenu = Contenu::with(['langue','auteur'])->where('id_contenu', $id)->firstOrFail();
        return view('dashboard.show_contenu', compact('contenu'));
    }

    public function editContenu($id)
    {
        $contenu = Contenu::with(['langue','auteur'])->where('id_contenu', $id)->firstOrFail();
        return view('dashboard.edit_contenu', compact('contenu'));
    }

    public function updateContenu(Request $request, $id)
{
    $contenu = Contenu::where('id_contenu', $id)->firstOrFail();
    
    $data = $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'id_langue' => 'nullable|integer',
        'id_auteur' => 'nullable|integer',
        'photos.*' => 'nullable|file|image|mimes:jpg,jpeg,png,gif|max:5120',
        'videos.*' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:20480',
        'remove_photos' => 'nullable|array', // Pour supprimer des photos existantes
        'remove_videos' => 'nullable|array', // Pour supprimer des vidéos existantes
    ]);

    // Gestion des photos existantes
    $currentPhotos = json_decode($contenu->photos ?? '[]', true);
    
    // Supprimer les photos sélectionnées
    if ($request->has('remove_photos')) {
        foreach ($request->remove_photos as $photoPath) {
            $relativePath = str_replace('/storage/', '', $photoPath);
            Storage::disk('public')->delete($relativePath);
            
            // Retirer de la liste
            $currentPhotos = array_diff($currentPhotos, [$photoPath]);
        }
    }

    // Ajouter nouvelles photos
    $newPhotoUrls = [];
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('contenus/photos', 'public');
            $newPhotoUrls[] = Storage::url($path);
        }
    }

    // Fusionner les anciennes et nouvelles photos
    $allPhotos = array_merge($currentPhotos, $newPhotoUrls);

    // Même logique pour les vidéos
    $currentVideos = json_decode($contenu->videos ?? '[]', true);
    
    if ($request->has('remove_videos')) {
        foreach ($request->remove_videos as $videoPath) {
            $relativePath = str_replace('/storage/', '', $videoPath);
            Storage::disk('public')->delete($relativePath);
            $currentVideos = array_diff($currentVideos, [$videoPath]);
        }
    }

    $newVideoUrls = [];
    if ($request->hasFile('videos')) {
        foreach ($request->file('videos') as $video) {
            $path = $video->store('contenus/videos', 'public');
            $newVideoUrls[] = Storage::url($path);
        }
    }

    $allVideos = array_merge($currentVideos, $newVideoUrls);

    // Mise à jour du contenu
    $contenu->update([
        'titre' => $data['titre'],
        'texte' => $data['texte'],
        'id_langue' => $data['id_langue'],
        'id_auteur' => $data['id_auteur'],
        'photos' => !empty($allPhotos) ? json_encode($allPhotos) : null,
        'videos' => !empty($allVideos) ? json_encode($allVideos) : null,
    ]);

    return redirect()->route('recettes')->with('success', 'Contenu mis à jour!');
}

    public function histoires()
    {
        return view('dashboard.histoires');
    }

    public function regions()
    {
        // Récupère toutes les régions depuis la table `region`
        try {
            $regions = Region::all();
        } catch (\Exception $e) {
            // En cas d'erreur de connexion / table manquante, on passe un tableau vide
            $regions = [];
        }

        return view('dashboard.regions', compact('regions'));
    }

    /** Create / Store / Destroy regions */
    public function createRegion()
    {
        return view('dashboard.create_region');
    }

    public function storeRegion(Request $request)
    {
        $data = $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|numeric',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string'
        ]);
        Region::create($data);
        return redirect()->route('admin.regions.index')->with('success', 'Région créée');
    }

    public function destroyRegion($id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        $region->delete();
        return redirect()->route('admin.regions.index')->with('success', 'Région supprimée');
    }

    public function motDePasse()
    {
        return view('dashboard.mot-de-passe');
    }

    public function deconnexion()
    {
        return view('dashboard.deconnexion');
    }


    
}