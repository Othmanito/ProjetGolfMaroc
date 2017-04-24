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
use App\Models\ModePaiement;
use App\Models\Paiement;
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
    //  case 'transact2': $data = collect( DB::select("call getTransactionsMagasin(".$p_id_user.");"));return view('Espace_Vendeur._nav_menu_2')->with('data',$data);break;

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
  public function addFormVente($p_id_mag)
  {
  //  $trans = Trans_Article::where('id_trans_Article',$p_id_mag)->first();
    $articles = collect( DB::select("call getArticlesForAjout(".$p_id_mag."); ") );
    $mode=collect( DB::select("call getMode(); ") );

    $alert1 = "";

    if( $articles == null )
      $alert1 = $alert1."<li>la base de données des articles est vide, veuillez ajouter les articles avant de procéder à la création des stocks.";

  //  if( $trans == null )
    //  $alert1 = $alert1."<li> La transaction choisi n\'existe pas .(veuillez choisir une autre transaction).";

    if( $articles ==null)
      return back()->withInput()->with('alert_warning',$alert1);

    else
      return view('Espace_Vendeur.add-Vente_Magasin-form')->with(['data' => Stock::all(), 'articles' => $articles,'mode'=>$mode]);
  }



// Valider l'ajout des ventes du Magasin
public function submitAddVente()
{

//Alertes et messages d'erreur
  $alert1 = "";
  $alert2 = "";
  $error1 = false;
  $error2 = false;
  $nbre_articles = 0;

  //array des element du formulaire
  $id_article   	= request()->get('id_article');
  $designation_c	= request()->get('designation_c');
  $quantiteV     	= request()->get('quantiteV');
  $prix_vente     = request()->get('prix_vente');
  $quantite       = request()->get('quantite');

  $id_magasin     = request()->get('id_magasin');
  $id_user   	    = request()->get('id_user');
  $id_typeTrans   = request()->get('id_typeTrans');
  //$id_paiement    =  collect(DB::select("call getPaiementID(); "));
  $id_mode        = request()->get('mode');


  //test pour recuperer la derniere ligne de transaction et lui ajouter 1 si elle n'était pas nulle
  $last_transaction = Transaction::all()->last();
  if($last_transaction->id_transaction==null)
  $id=1;
  else {
    $id=$last_transaction->id_transaction+1;
  }
//test pour recuperer la derniere ligne de l'id paiement et lui ajouter 1 si elle n'était pas nulle
$id_paiement = Paiement::all()->last();
if($id_paiement->id_paiement==null)
$id_p=1;
else {
  $id_p=$id_paiement->id_paiement+1;
}

//Insertion d'une transaction et d'un paiement
$item2=new Transaction;
$item3=new Paiement;

$item3->id_paiement=$id_p;
$item3->id_mode=$id_mode;

$item2->id_transaction=$id;
$item2->id_magasin=$id_magasin;
$item2->id_user=$id_user;
$item2->id_typeTrans=$id_typeTrans;
$item2->id_paiement=$id_p;

try{
$item3->save();
$item2->save();
} catch (Exception $e) { $error2 = true; $alert2 = $alert2."<li>Erreur d'ajout de la vente ayant l'id : <b>".$id."</b> Message d'erreur: ".$e->getMessage().". ";}



//Boucle d'ajout des articles dans trans_article
  for( $i=1; $i<=count($id_article) ; $i++ )
  {

    if( $quantite[$i] == null )
    {
      $alert1 = $alert1."<li> ".$i.": <b></b>: vous avez oublier de specifier la quantite vendue de l'article :".$designation_c[$i];
      $error1 = true;
    }

    if( $quantite[$i]!=null )
    {
      $item = new Trans_Article;
      $item->id_article    = $id_article[$i];
      $item->id_transaction= $id;
      $item->quantite      = $quantite[$i];

      try
      {

        $item->save();
        $nbre_articles++;
      } catch (Exception $e) { $error2 = true; $alert2 = $alert2."<li>Erreur d'ajout de la vente d'article: <b>".$designation_c[$i]."</b> Message d'erreur: ".$e->getMessage().". ";}
    }
  }

  if($error1)
    back()->withInput()->with('alert_warning',$alert1);
  if($error2)
    back()->withInput()->with('alert_danger',$alert2);

  return redirect()->back()->with('alert_success','L\'ajout de la vente s\'est effectué avec succès. Le nombre d\'articles est : '.$nbre_articles);
}


public function getMagasin($p_id_mag){
$data = collect( DB::select("call getArticlesForAjout(".$p_id_mag."); ") );
  return view('Espace_Vendeur._nav_menu_2')->with(['data' => $data]);
}

}
