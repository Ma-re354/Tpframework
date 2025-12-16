<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Langue;
use App\Models\User;
use App\Models\Region;
use App\Models\TypeContenu;


class Contenu extends Model
{
    protected $table = 'contenues';
    protected $primaryKey = 'id_contenu';
    public $timestamps = false; // la migration ne créé pas timestamps

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

    // Relation avec le type de contenu (si vous avez une table)
    public function typeContenu()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu', 'id_type_contenu');
    }


    // Accessor pour les photos
    public function getPhotosAttribute($value)
    {
        if ($value) {
            $photos = json_decode($value, true);
            return array_map(function ($photo) {
                return asset($photo);
            }, $photos);
        }
        return [];
    }

    // Accessor pour les vidéos
    public function getVideosAttribute($value)
    {
        if ($value) {
            $videos = json_decode($value, true);
            return array_map(function ($video) {
                return asset($video);
            }, $videos);
        }
        return [];
    }

    // Méthode pour obtenir la première photo
    public function getFirstPhotoAttribute()
    {
        $photos = $this->photos;
        return $photos[0] ?? asset('css/default-image.jpg');
    }
    
}
