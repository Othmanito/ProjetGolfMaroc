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
                  case 'promotions':$data = collect( DB::select("call getPromotionsForMagasin(".$p_id_user."); "));


                  return view('Espace_Vendeur.liste-promos')->with('data',$data);break;
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




public function getMagasin($p_id_mag){

                        $data = collect( DB::select("call getArticlesForAjout(".$p_id_mag."); ") );
                          return view('Espace_Vendeur._nav_menu_2')->with(['data' => $data]);
                        }

}
