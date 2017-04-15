<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'id_stock';

    protected $fillable = [
      'id_stock', 'id_article','id_magasin' ,
      'quantite', 'quantite_min','quantite_max',
    ];
}
