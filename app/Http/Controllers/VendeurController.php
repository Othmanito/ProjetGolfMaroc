<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Magasin;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Article;
use App\Models\Marque;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\Trans_Article;
use App\Models\Type_transaction;
use \Exception;




class VendeurController extends Controller

//Afficher la page d'acceuil de l'Espace Vendeur
{
  public function home()
  {
    return view('Espace_Vendeur.dashboard');
  }

//Lister les ventes du magasin
  public function lister($param)
  {
    switch($param)
    {
      case 'ventes': $data = DB::table('trans_article')->join('transactions','trans_article.id_transaction','=','transactions.id_transaction')
    ->where('transactions.id_typeTrans',3)
    ->get();



      return view('Espace_Vendeur.liste-ventes')->with('data',$data);      break;
      default: return back()->withInput()->with('alert_warning','<strong>Erreur !!</strong>');      break;
    }
  }

  //Afficher le formulaire d'Ajout de ventes

  public function addFormVente($p_id_user)
  {
    $magasin = Magasin::where('id_user',$p_id_user)->first();
    $articles = Article::all();


    if( $articles == null )
      return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> la base de données des articles est vide, veuillez ajouter les articles avant de procéder à la création des stocks.');

    if( $magasin == null )
      return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> Le magasin choisi n\'existe pas .(veuillez choisir un autre magasin.)');

    else
      return view('Espace_Direct.add-Vente_Magasin-form')->with(['data' => Trans_Article::all, 'articles' => $articles,  'magasin' => $magasin ]);
  }



}
