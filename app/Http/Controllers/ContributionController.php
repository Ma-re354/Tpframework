<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Langue;
use App\Models\Region;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function showForm()
    {
        // Récupérer les données nécessaires pour les select
        $langues = Langue::orderBy('nom_langue', 'asc')->get();
        $regions = Region::orderBy('nom_region', 'asc')->get();
        $typesContenu = TypeContenu::all();
        
        return view('auth-form', compact('langues', 'regions', 'typesContenu'));
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->mot_de_passe)) {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
        
        if ($user->statut !== 'actif') {
            return response()->json(['message' => 'Votre compte n\'est pas actif'], 403);
        }
        
        // Connexion manuelle si vous n'utilisez pas Laravel Auth
        // Auth::login($user);
        
        return response()->json([
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->id_utilisateur,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email
            ]
        ]);
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:6',
            'sexe' => 'nullable|in:M,F',
            'date_naissance' => 'nullable|date',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'photo' => 'nullable|image|max:2048',
            'terms' => 'required|accepted'
        ]);
        
        // Création de l'utilisateur
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->mot_de_passe = Hash::make($request->password);
        $user->sexe = $request->sexe;
        $user->date_naissance = $request->date_naissance;
        $user->id_langue = $request->id_langue;
        $user->statut = 'actif';
        $user->date_inscription = now();
        $user->id_role = 5; // Rôle contributeur par défaut
        
        // Gérer l'upload de la photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profiles', 'public');
            $user->photo = $photoPath;
        }
        
        $user->save();
        
        // Connexion automatique après inscription
        // Auth::login($user);
        
        return response()->json([
            'message' => 'Inscription réussie',
            'user' => [
                'id' => $user->id_utilisateur,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email
            ]
        ]);
    }
    
    public function storeContribution(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_type_contenu' => 'required|exists:typecontenus,id_type_contenu',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_auteur' => 'required|exists:utilisateurs,id_utilisateur',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:5120',
            'videos' => 'nullable|array',
            'videos.*' => 'mimes:mp4,avi,mov,wmv|max:51200'
        ]);
        
        // Création du contenu
        $contenu = new \App\Models\Contenu();
        $contenu->titre = $request->titre;
        $contenu->texte = $request->texte;
        $contenu->date_creation = now();
        $contenu->statut = 'en attente';
        $contenu->id_type_contenu = $request->id_type_contenu;
        $contenu->id_region = $request->id_region;
        $contenu->id_langue = $request->id_langue;
        $contenu->id_auteur = $request->id_auteur;
        
        // Gérer les photos
        if ($request->hasFile('photos')) {
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('contenus/photos', 'public');
                $photoPaths[] = $path;
            }
            $contenu->photos = json_encode($photoPaths);
        }
        
        // Gérer les vidéos
        if ($request->hasFile('videos')) {
            $videoPaths = [];
            foreach ($request->file('videos') as $video) {
                $path = $video->store('contenus/videos', 'public');
                $videoPaths[] = $path;
            }
            $contenu->videos = json_encode($videoPaths);
        }
        
        $contenu->save();
        
        return response()->json([
            'message' => 'Contribution enregistrée avec succès',
            'contenu_id' => $contenu->id_contenu
        ]);
    }
}