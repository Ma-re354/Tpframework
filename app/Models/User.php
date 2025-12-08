<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'sexe',
        'date_inscription',
        'date_naissance',
        'statut',
        'photo',
        'id_role',
        'id_langue',
    ];

    /**
     * Hide sensitive attributes for arrays.
     */
    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    public $timestamps = true;

    /**
     * Override the password field used by Laravel authentication.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
