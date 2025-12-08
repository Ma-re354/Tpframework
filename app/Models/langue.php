<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    protected $table = 'langues';
    protected $primaryKey = 'id_langue';

    protected $fillable = [
        'nom_langue',
        'code_langue',
        'description',
    ];
     public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_langue', 'id_langue');
    }
}
