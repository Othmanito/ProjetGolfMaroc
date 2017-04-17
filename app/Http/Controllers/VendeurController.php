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
use App\Models\Promotion;
use \Exception;




class VendeurController extends Controller

//Afficher la page d'acceuil de l'Espace Vendeur
{
  public function home()
  {
    return view('Espace_Vendeur.dashboard');
  }

//Lister les ventes,les promotions et le stock du magasin
  public function lister($param,$p_id_user)
  {
    switch($param)
    {
      //lister les transactions du magasin du vendeur
      case 'transact': $data = collect( DB::select("call getTransactionsMagasin(".$p_id_user.");"));return view('Espace_Vendeur.liste-transact')->with('data',$data);break;
      //Lister les ventes du magasin du vendeur
      case 'ventes': $data = collect( DB::select("call getVentesMagasin(".$p_id_user.");"));return view('Espace_Vendeur.liste-ventes')->with('data',$data);break;
      //Lister les promotions du magasin du vendeur
      case 'promotions':$data = collect( DB::select("call getPromotionsForMagasin(".$p_id_user."); "));return view('Espace_Vendeur.liste-promos')->with('data',$data);break;
      //Lister les stocks du magasin du vendeur
      case 'stocks':$data = collect( DB::select("call getStockForMagasin(".$p_id_user."); "));return view('Espace_Vendeur.liste-stocks')->with('data',$data);break;

      default: return back()->withInput()->with('alert_warning','<strong>Erreur !!</strong>');      break;
    }
  }

  //Afficher le detail de la transaction
  public function detailTrans($p_id)
  {
    $data = Trans_Article::where('id_transaction', $p_id)->get();
		if($data->isEmpty())
			return redirect()->back()->withInput()->with('alert_warning','Cette transaction ne contient aucun article.');
		else
			return view('Espace_Vendeur.detail-transact')->with('data',$data);
  }

  //Afficher le formulaire d'Ajout de ventes
  public function addFormVente($p_id_trans)
  {
    $trans = Trans_Article::where('id_trans_Article',$p_id_trans)->first();
    $articles = collect( DB::select("call getArticlesForAjout(".$p_id_trans."); ") );
    $alert1 = "";

    if( $articles == null )
      $alert1 = $alert1."<li>la base de données des articles est vide, veuillez ajouter les articles avant de procéder à la création des stocks.";

    if( $trans == null )
      $alert1 = $alert1."<li> La transaction choisi n\'existe pas .(veuillez choisir une autre transaction).";

    if( $articles ==null || $trans == null)
      return back()->withInput()->with('alert_warning',$alert1);

    else
      return view('Espace_Vendeur.add-Vente_Magasin-form')->with(['data' => Stock::all(), 'articles' => $articles,  'trans' => $trans ]);
  }



// Valider l'ajout des ventes du Magasin
public function submitAddVente()
{
  //id du magasin
  $id_trans_Article = request()->get('id_trans_Article');

  //array des element du formulaire
  $id_article   	= request()->get('id_article');
  $designation_c	= request()->get('designation_c');
  $quantite     	= request()->get('quantite');
  $prix_vente     = request()->get('prix_vente');

  $alert1 = "";
  $alert2 = "";
  $error1 = false;
  $error2 = false;
  $nbre_articles = 0;

  for( $i=1; $i<=count($id_article) ; $i++ )
  {
    if( $quantite[$i] == null ) continue;

    /*if( $quantite_min[$i]>$quantite_max[$i] )
    {
      $alert1 = $alert1."<li><b>".$designation_c[$i]."</b>: Quantite min superieur a la quantité max.";
      $error1 = true;
    }

    if( $quantite[$i] != null && ($quantite_min[$i] == null || $quantite_max[$i] == null) )
    {
      $alert1 = $alert1."<li> ".$i.": <b>".$designation_c[$i]."</b>: vous avez oublier de specifier la quantite min et/ou la quantite max.";
      $error1 = true;
    }*/

    if( $quantite[$i]!=null )
    {
      $item = new Trans_Article;
      $item->id_trans_Article    = $id_trans_Article;
      $item->id_article    = $id_article[$i];
      $item->quantite      = $quantite[$i];

      try
      {
        $item->save();
        $nbre_articles++;
      } catch (Exception $e) { $error2 = true; $alert2 = $alert2."<li>Erreur d'ajout de l'article: <b>".$designation_c[$i]."</b> Message d'erreur: ".$e->getMessage().". ";}
    }
  }

  if($error1)
    back()->withInput()->with('alert_warning',$alert1);
  if($error2)
    back()->withInput()->with('alert_danger',$alert2);

  return redirect()->back()->with('alert_success','L\'ajout de la vente s\'est effectué avec succès. Le nombre d\'articles est : '.$nbre_articles);


}
}
