<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $primaryKey = 'id_region';
    public $timestamps = false;
    protected $fillable = [
        'nom_region',
        'description',
        'population',
        'superficie',
        'localisation',
    ];
}
