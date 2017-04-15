<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    protected $table = 'magasins';
    protected $primaryKey = 'id_magasin';

    protected $fillable = [
        'id_magasin','libelle' ,'description',
        'ville','agent' ,'telephone',
        'email','adresse'
    ];
}
