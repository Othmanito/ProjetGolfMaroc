<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseurs';
    protected $primaryKey = 'id_fournisseur';

    protected $fillable = [
        'id_fournisseur','libelle' ,'description',
        'code','agent' ,'email',
        'telephone','fax',
    ];
}
