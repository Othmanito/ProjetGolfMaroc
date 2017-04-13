<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id_article';

    protected $fillable = [
      'id_article', 'id_fournisseur','id_categorie' ,
      'designation_c', 'designation_l',
      'code_barre','num_article' ,
      'couleur','taille', 'sexe','prix_achat','prix_vente',
    ];
}
