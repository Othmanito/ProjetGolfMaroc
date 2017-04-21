<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_Article extends Model
{
  protected $table = 'trans_article';
  protected $primaryKey = 'id_trans_Article';
  protected $fillable = ['id_trans_Article', 'id_transaction','id_article','quantite','created_at','updated_at'];

}
