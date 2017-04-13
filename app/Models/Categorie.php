<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_categorie';

    protected $fillable = ['libelle','description'];

    private $id_categorie;
    private $libelle;
    private $description;
    private $created_at;
    private $updated_at;



}
