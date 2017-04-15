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
    ->select('transactions.*','trans_article.*')
    ->where('transactions.id_typeTrans',3)
    ->where('transactions.id_user',3)
    ->get();

      return view('Espace_Vendeur.liste-ventes')->with('data',$data);      break;
      default: return back()->withInput()->with('alert_warning','<strong>Erreur !!</strong>');      break;
    }
  }



  //Afficher le formulaire d'Ajout de ventes

  public function addFormVente($p_id_trans_art)
  {
    $trans = Trans_Article::where('id_trans_Article',$p_id_trans_art)->first();
    $articles = collect( DB::select("call getArticlesForVentes(".$p_id_trans_art."); ") );
    $alert1 = "";

    if( $articles == null )
      $alert1 = $alert1."<li>la base de données des articles est vide, veuillez ajouter les articles avant de procéder à la création des stocks.";

    if( $trans == null )
      $alert1 = $alert1."<li> Le magasin choisi n\'existe pas .(veuillez choisir un autre magasin).";

    if( $articles ==null || $trans == null)
      return back()->withInput()->with('alert_warning',$alert1);

    else
      return view('Espace_Vendeur.add-Vente_Magasin-form')->with(['data' => Trans_Article::all(), 'articles' => $articles,  'trans' => $trans ]);
  }





}
