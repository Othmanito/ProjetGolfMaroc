<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
  protected $table = 'paiements';
  protected $primaryKey = 'id_paiement';
  protected $fillable = ['id_paiement', 'id_mode','created_at','updated_at'];

}
