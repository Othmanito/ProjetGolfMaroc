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

class StockController extends Controller
{

	/****************************
	Afficher le fomulaire d'ajout pour le stock
	****************************/
	public function addStock($p_id_magasin)
	{
		$magasin = Magasin::where('id_magasin',$p_id_magasin)->first();		//$articles = Article::all();

		//Procédure stockee dans la db: permet de retourner la liste des articles qui ne figurent pas deja dans le stock de ce magasin
		$articles = collect( DB::select("call getArticlesForStock(".$p_id_magasin."); ") );
		//dump($articles);

		if( $articles == null )
			return redirect()->back()->withInput()->with('alert_warning','La base de données des articles est vide, veuillez ajouter les articles avant de procéder à la création des stocks.');

		if( $magasin == null )
			return redirect()->back()->withInput()->with('alert_warning','Le magasin choisi n\'existe pas .(veuillez choisir un autre magasin.)');

		else
			return view('Espace_Direct.add-stock_Magasin-form')->with(['data' => Stock::all(), 'articles' => $articles,  'magasin' => $magasin ]);
	}



	public function submitAdd($p_table)
	{
	 switch($p_table)
	 {
		 case 'stocks':       return $this->submitAddStock(); break;
		 default: return redirect()->back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> Vous avez pris le mauvais chemin. ==> AddController@submitAdd');      break;
	 }
	}



	//Valider l'ajout de : Stock
	public function submitAddStock()
	{
		$id_article   = request()->get('id_article');
		$quantite     = request()->get('quantite');
		$quantite_min = request()->get('quantite_min');
		$quantite_max = request()->get('quantite_max');

		foreach( $id_article as $item )
		{
			echo "<li>".$item;
		}

		for( $i=1; $i< count($id_article) ; $i++ )
		{
			echo $id_article[$i]." ".$quantite[$i]." ".$quantite_min[$i]." ".$quantite_max[$i]."<br>";
		}

		dump ( 'id_article', request()->get('id_article'));
		dump ( 'quantite', request()->get('quantite') );
		dump ( 'quantite_min', request()->get('quantite_min') );

		dump(request());

		foreach( request()->get('quantite') as $q )
		{
			echo $q."<br>";
		}
		return 'aa';

		if( request()->get('submit') == 'verifier' )
		{
			 return redirect()->back()->withInput()->with('alert_success','Verifier le stock (magasin/article).s');
		}
		else if( request()->get('submit') == 'valider' )
		{
			//if( request()->get('libelle')==null )
			 //return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> veuillez remplir le champ libelle');

			$item = new Stock;
			$item->id_magasin    = request()->get('id_magasin');
			$item->id_article    = request()->get('id_article');
			$item->quantite      = request()->get('quantite');
			$item->quantite_min  = request()->get('quantite_min');
			$item->quantite_max  = request()->get('quantite_max');

			$item->save();
			return redirect()->back()->with('alert_success','Done');
		}
		else
		{
			return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur de Redirection</strong><br> from: DirectController@submitAdd (submitAddStock)');
		}
	}



}
