<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $table = 'transactions';
  protected $primaryKey = 'id_transaction';

  protected $fillable = ['id_transaction','id_user', 'id_magasin','id_type_Trans','id_paiement','created_at','updated_at'];

  public function user()
   {
       return $this->belongsTo(\App\Models\User::class);
   }
   public function articles()
   {
       return $this->belongsToMany('App\Models\Article');
   }
}
