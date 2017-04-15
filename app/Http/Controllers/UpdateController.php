<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Magasin;
use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\Categorie;

class UpdateController extends Controller
{
  /********************************************************
    afficher le formulaire de modification
  *********************************************************/
  public function updateForm($p_table, $p_id)
  {
    $categories   = Categorie::all();
    $fournisseurs = Fournisseur::all();
    $magasins     = Magasin::all();
    $roles        = Role::all();

    switch($p_table)
    {

      case 'users':         return view('Espace_Admin.update-user-form')->with([ 'data' => $data ,'magasins' => $magasins, 'roles' => $roles ]);          break;
      case 'user_password': return view('Espace_Admin.updatePassword-user-form')->with([ 'data' => $data ,'magasins' => $magasins, 'roles' => $roles ]);  break;
      case 'categories':    return view('Espace_Direct.update-categorie-form')->withData(  Categorie::find($p_id) );     break;
      case 'fournisseurs':  return view('Espace_Direct.update-fournisseur-form')->withData( Fournisseur::find($p_id) );  break;
      case 'magasins':      return view('Espace_Direct.update-magasin-form')->withData( Magasin::find($p_id) );          break;
      case 'articles':      return view('Espace_Direct.update-article-form')->with(['data' =>  Article::find($p_id) , 'fournisseurs' => $fournisseurs , 'categories' => $categories] ); break;
      default: return back()->withInput()->with('alert_warning','Erreur de redirection: UpdateController@updateForm($p_table, $p_id).');
    }
  }

  /********************************************************
    Valider La modification
  *********************************************************/
  public function submitUpdate($p_table)
  {
   switch($p_table)
   {
     case 'users':          return $this->submitUpdateUser();         break;
     case 'user_password':  return $this->submitUpdatePasswordUser(); break;
     case 'magasins':       return $this->submitUpdateMagasin();      break;
     case 'marques':        return $this->submitUpdateMarque();       break;
     case 'fournisseurs':   return $this->submitUpdateFournisseur();  break;
     case 'categories':     return $this->submitUpdateCategorie();    break;
     case 'articles':       return $this->submitUpdateArticle();      break;
     default: return back()->withInput()->with('alert_warning','Erreur de redirection: UpdateController@submitUpdate($p_table)');      break;
   }
  }

  //Valider la modification de user password
  public function submitUpdatePasswordUser()
  {
    if( strlen(request()->get('password'))<8 )
      return redirect()->back()->withInput()->with('alert_danger',"Le mot de passe doit contenir, au moins, 7 caractères.");

    $item = User::find(request()->get('id_user'));
    $item->update([
        'password'  => Hash::make(request()->get('passowrd'))
    ]);
    echo "notification !!!!!";
    return redirect()->route('admin.infoUser',['id' => request()->get('id_user') ])->with('alert_success','Modification du mot de passe de l\'utilisateur reussi.');
  }

  //valider la modification d'un utilisateur
  public function submitUpdateUser()
  {
    if( EmailExist_2( request()->get('email') , request()->get('id_user') )  )
      return redirect()->back()->withInput()->with('alert_danger',' <i>'.request()->get('email').'</i> est deja utilisé pour un autre utilisateur.');
    else
      $item = User::find(request()->get('id_user'));
      $item->update([
        'id_role'     => request()->get('id_role'),
        'id_magasin'  => request()->get('id_magasin'),
        'nom'         => request()->get('nom'),
        'prenom'      => request()->get('prenom'),
        'ville'       => request()->get('ville'),
        'telephone'   => request()->get('telephone'),
        'email'       => request()->get('email'),
        'description' => request()->get('description')
      ]);
     return redirect()->route('admin.infoUser',['id' => request()->get('id_user') ])->with('alert_success','Modification de l\'utilisateur reussi.');
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




}
