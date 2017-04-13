<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $table = 'marques';
    protected $primaryKey = 'id_marque';

    protected $fillable = [
        'id_marque','libelle' ,'description',
    ];

}
