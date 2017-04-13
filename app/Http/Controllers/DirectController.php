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

  /****************************************
  retourner la vue pour afficher les tables
  *****************************************/
  public function lister($param)
  {
    switch($param)
    {
      case 'categories':   $data = DB::table('categories')->get();   return view('Espace_Direct.liste-categories')->with('data',$data);    break;
      case 'fournisseurs': $data = DB::table('fournisseurs')->get(); return view('Espace_Direct.liste-fournisseurs')->with('data',$data);  break;
      case 'articles':     $data = DB::table('articles')->get();     return view('Espace_Direct.liste-articles')->with('data',$data);      break;
      case 'magasins':     $data = DB::table('magasins')->get();     return view('Espace_Direct.liste-magasins')->with('data',$data);      break;
      default: return back()->withInput()->with('alert_warning','<strong>Erreur !!</strong>');      break;
    }
  }




  /****************************************
  retourner la vue pour afficher les details
  *****************************************/
  public function info($p_table,$p_id)
  {
    switch($p_table)
    {
      case 'categories':    $item = Categorie::find($p_id);   return ( $item != null ? view('Espace_Direct.info-categorie')->with('data',$item) :   back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> la catégorie choisie n\'existe pas') );   break;
      case 'fournisseurs':  $item = fournisseur::find($p_id); return ( $item != null ? view('Espace_Direct.info-fournisseur')->with('data',$item) : back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> le fournisseur choisi n\'existe pas') );   break;
      case 'articles':      $item = Article::find($p_id);     return ( $item != null ? view('Espace_Direct.info-article')->with('data',$item) :     back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> l\'article choisi n\'existe pas') );   break;
      case 'magasins':      $item = Magasin::find($p_id);     return ( $item != null ? view('Espace_Direct.info-magasin')->with(['data'=>$item, 'stocks'=> Stock::where('id_magasin',$p_id)->get() ]) :     back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> le magasin choisi n\'existe pas') );   break;
      default: return back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> Vous avez pris le mauvais chemin. ==> DirectController@info');      break;
    }
  }


  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

  /****************************
  Afficher le fomulaire d'ajout pour le stock
  ****************************/
  public function addFormStock($p_id_magasin)
  {
    $magasin = Magasin::where('id_magasin',$p_id_magasin)->first();
    $articles = Article::all();

    if( $articles == null )
      return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> la base de données des articles est vide, veuillez ajouter les articles avant de procéder à la création des stocks.');

    if( $magasin == null )
      return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> Le magasin choisi n\'existe pas .(veuillez choisir un autre magasin.)');

    else
      return view('Espace_Direct.add-stock_Magasin-form')->with(['data' => Stock::all(), 'articles' => $articles,  'magasin' => $magasin ]);
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

  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

  /********************************************************
    afficher le formulaire de modification
  *********************************************************/
  public function updateForm($p_table, $p_id)
  {
    $categories   = DB::table('categories')->get();
    $fournisseurs = DB::table('fournisseurs')->get();

    switch($p_table)
    {
      case 'categories':   return view('Espace_Direct.update-categorie-form')->withData(  Categorie::find($p_id) );     break;
      case 'fournisseurs': return view('Espace_Direct.update-fournisseur-form')->withData( Fournisseur::find($p_id) );  break;
      case 'magasins':     return view('Espace_Direct.update-magasin-form')->withData( Magasin::find($p_id) );          break;
      case 'articles':     return view('Espace_Direct.update-article-form')->with(['data' =>  Article::find($p_id) , 'fournisseurs' => $fournisseurs , 'categories' => $categories] ); break;
      default: return 'DirectController@updateForm($param)';
    }
  }

  /********************************************************
    Valider La modification
  *********************************************************/
  public function submitUpdate($param)
  {
   switch($param)
   {
     case 'magasin':        return $this->submitUpdateMagasin(); break;
     case 'marque':         return $this->submitUpdateMarque(); break;
     case 'fournisseur':    return $this->submitUpdateFournisseur(); break;
     case 'categorie':      return $this->submitUpdateCategorie(); break;
     case 'article':        return $this->submitUpdateArticle(); break;
     default: return back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> Vous avez pris le mauvais chemin.');      break;
   }
  }

  //Valider la modification d un article
  public function submitUpdateArticle()
  {
      $item = Article::find( request()->get('id_article') );
      $item->update([
        'id_categorie'    => request()->get('id_categorie'),
        'id_fournisseur'  => request()->get('id_fournisseur'),
        'num_article'     => request()->get('num_article'),
        'code_barre'      => request()->get('code_barre'),
        'designation_c'   => request()->get('designation_c'),
        'designation_l'   => request()->get('designation_l'),
        'taille'          => request()->get('taille'),
        'couleur'         => request()->get('couleur'),
        'sexe'            => request()->get('sexe'),
        'prix'            => request()->get('prix')
      ]);
     return redirect()->route('direct.info',['p_table' => 'articles', 'id' => request()->get('id_article') ])->with('alert_success','Modification de l\'article reussi.');
  }

  //Valider la modification d un Categorie
  public function submitUpdateCategorie()
  {
      $item = Categorie::find( request()->get('id_categorie') );
      $item->update([
        'libelle'     => request()->get('libelle'),
        'description' => request()->get('description')
      ]);
     return redirect()->route('direct.info',['p_table' => 'categories', 'id' => request()->get('id_categorie') ])->with('alert_success','Modification du fournisseur reussi.');
  }

  //Valider la modification d un fournisseur
  public function submitUpdateFournisseur()
  {
      $item = Fournisseur::find( request()->get('id_fournisseur') );
      $item->update([
        'code'        => request()->get('code'),
        'libelle'     => request()->get('libelle'),
        'agent'       => request()->get('agent'),
        'email'       => request()->get('email'),
        'telephone'   => request()->get('telephone'),
        'fax'         => request()->get('fax'),
        'description' => request()->get('description')
      ]);
     return redirect()->route('direct.info',['p_table' => 'fournisseurs', 'id' => request()->get('id_fournisseur') ])->with('alert_success','Modification du fournisseur reussi.');
  }

  //Valider la modification d un Magasin
  public function submitUpdateMagasin()
  {
      $item = Magasin::find( request()->get('id_magasin') );
      $item->update([
        'libelle'     => request()->get('libelle'),
        'ville'       => request()->get('ville'),
        'agent'       => request()->get('agent'),
        'email'       => request()->get('email'),
        'telephone'   => request()->get('telephone'),
        'adresse'     => request()->get('adresse'),
        'description' => request()->get('description')
      ]);
     return redirect()->route('direct.info',['p_tables' => 'magasins', 'id' => request()->get('id_magasin') ])->with('alert_success','Modification du magasin reussi.');
  }


  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

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
