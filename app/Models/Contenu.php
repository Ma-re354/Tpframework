<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\langue;
use App\Models\User;
use App\Models\Region;
use App\Models\TypeContenu;

class Contenu extends Model
{
    protected $table = 'contenues';
    protected $primaryKey = 'id_contenu';
    public $timestamps = false;

    protected $fillable = [
        'titre',
        'texte',
        'slug',
        'photos',
        'videos',
        'id_region',
        'id_langue',
        'id_auteur',
        'id_moderateur',
        'id_type_contenu',
        'statut',
        'vues',
        'likes',
        'parent_id',
        'date_creation',
        'date_validation'
    ];

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'id_auteur', 'id_utilisateur');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }

    public function moderateur()
    {
        return $this->belongsTo(User::class, 'id_moderateur', 'id_utilisateur');
    }

    public function typeContenu()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu', 'id_type_contenu');
    }

    // Mutator sécurisé pour les photos
    public function getPhotosAttribute($value)
    {
        $photos = json_decode($value, true);

        // Si json_decode échoue ou renvoie null, on vérifie si $value contient une seule URL
        if (!is_array($photos)) {
            $photos = $value ? [$value] : [];
        }

        return array_map(fn($photo) => asset($photo), $photos);
    }

    // Mutator sécurisé pour les vidéos
    public function getVideosAttribute($value)
    {
        $videos = json_decode($value, true);

        if (!is_array($videos)) {
            $videos = $value ? [$value] : [];
        }

        return array_map(fn($video) => asset($video), $videos);
    }

    // Récupère la première photo ou une image par défaut
    public function getFirstPhotoAttribute()
    {
        $photos = $this->photos;
        return $photos[0] ?? asset('css/default-image.jpg');
    }
}