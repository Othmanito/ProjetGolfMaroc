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

class DeleteController extends Controller
{

  /******************************************
  Fonction pour effacer une ligne d'une table
  *******************************************/
  public function delete($p_table,$p_id)
  {
   try
   {
     switch ($p_table)
     {
       case 'categories':   Categorie::find($p_id)->delete();   return back()->withInput()->with('alert_success','La catégorie a été effacée avec succès');   break;
       case 'users':        User::find($p_id)->delete();        return back()->withInput()->with('alert_success','L\'utilisateur a été effacé avec succès');  break;
       case 'fournisseurs': fournisseur::find($p_id)->delete(); return back()->withInput()->with('alert_success','Le fournisseur a été effacé avec succès');  break;
       case 'articles':     Article::find($p_id)->delete();     return back()->withInput()->with('alert_success','L\'article a été effacé avec succès');      break;
       case 'magasins':     Magasin::find($p_id)->delete();     return back()->withInput()->with('alert_success','Le magasin a été effacé avec succès');      break;
       case 'stocks':       Stock::find($p_id)->delete();       return back()->withInput()->with('alert_success','Le stock a été effacé avec succès');        break;
       default:             return back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> probleme dans: DeleteController@delete');             break;
     }
   }
   catch(Exception $ex)
   {
     return back()->with('alert_danger','erreur!! <strong>'.$ex->getMessage().'</strong> ');
   }
  }



}
