<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Magasin;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Article;
use App\Models\Marque;
use App\Models\Stock;
use \Exception;

class DirectController extends Controller
{
  public function home()
  {
    return view('Espace_Direct.dashboard');
  }





  /*****************************************************************************
  Lister Stocks
  *****************************************************************************/
  public function listerStocks($p_id_magasin)
  {
    $data = Stock::where('id_magasin', $p_id_magasin)->get();
    if($data->isEmpty())
      return redirect()->back()->withInput()->with('alert_warning','No stock in that Shop.');

    else
      return view('Espace_Direct.liste-stocks')->with('data',$data);
  }


}
