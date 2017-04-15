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

class ShowController extends Controller
{

  /****************************************
  retourner la vue pour afficher les details
  *****************************************/
  public function info($p_table,$p_id)
  {
    switch($p_table)
    {
      case 'users':         $item = User::find($p_id);        return ( $item != null ? view('Espace_Admin.info-user')->with('data',$item)         : back()->withInput()->with('alert_warning','L\'utilisateur choisi n\'existe pas.') );    break;
      case 'categories':    $item = Categorie::find($p_id);   return ( $item != null ? view('Espace_Direct.info-categorie')->with('data',$item)   : back()->withInput()->with('alert_warning','La catégorie choisie n\'existe pas.') );     break;
      case 'fournisseurs':  $item = fournisseur::find($p_id); return ( $item != null ? view('Espace_Direct.info-fournisseur')->with('data',$item) : back()->withInput()->with('alert_warning','Le fournisseur choisi n\'existe pas.') );    break;
      case 'articles':      $item = Article::find($p_id);     return ( $item != null ? view('Espace_Direct.info-article')->with('data',$item)     : back()->withInput()->with('alert_warning','L\'article choisi n\'existe pas.') );        break;
      case 'magasins':      $item = Magasin::find($p_id);     return ( $item != null ? view('Espace_Direct.info-magasin')->with(['data'=>$item, 'stocks'=> Stock::where('id_magasin',$p_id)->get() ]) :     back()->withInput()->with('alert_warning','Le magasin choisi n\'existe pas') );   break;
      default: return back()->withInput()->with('alert_warning','Vous avez pris le mauvais chemin. ==> ShowController@info');      break;
    }
  }


  /****************************************
  retourner la vue pour afficher les tables
  *****************************************/
  public function lister($p_table)
  {
    switch($p_table)
    {
      case 'users':         $data = User::all();        return view('Espace_Admin.liste-users')->with('data',$data);          break;
      case 'categories':    $data = Categorie::all();   return view('Espace_Direct.liste-categories')->with('data',$data);    break;
      case 'fournisseurs':  $data = Fournisseur::all(); return view('Espace_Direct.liste-fournisseurs')->with('data',$data);  break;
      case 'articles':      $data = Article::all();     return view('Espace_Direct.liste-articles')->with('data',$data);      break;
      case 'magasins':      $data = Magasin::all();     return view('Espace_Direct.liste-magasins')->with('data',$data);      break;
      default: return back()->withInput()->with('alert_warning','Vous avez pris le mauvais chemin. ==> ShowController@lister');  
    }
  }


}
