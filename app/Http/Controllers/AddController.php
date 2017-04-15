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

class AddController extends Controller
{

	/********************************************************
	Afficher le formulaire d'ajout pour tt les tables
	*********************************************************/
	public function addForm($p_table)
	{
		switch($p_table)
		{
			case 'users':					return view('Espace_Admin.add-user-form')->with([ 'data' => User::all(), 'magasins' => Magasin::all(), 'roles' => Role::all() ]); break;
			case 'categories':    return view('Espace_Direct.add-categorie-form')->withData( Categorie::all() );      break;
			case 'fournisseurs':  return view('Espace_Direct.add-fournisseur-form')->withData( Fournisseur::all() );  break;
			case 'magasins':      return view('Espace_Direct.add-magasin-form')->withData( Magasin::all() );          break;
			case 'articles':      return view('Espace_Direct.add-article-form')->with(['data' => Article::all() , 'fournisseurs' => Fournisseur::all() , 'categories' => Categorie::all() ]); break;
			default: return 'AddController@addForm($p_table)';
		}
	}

	/********************************************************
	Valider L'ajout: Fonction de principale
	*********************************************************/
	public function submitAdd($p_table)
	{
	 switch($p_table)
	 {
		 case 'magasins':     return $this->submitAddMagasin(); break;
		 case 'fournisseurs': return $this->submitAddFournisseur(); break;
		 case 'categories':   return $this->submitAddCategorie(); break;
		 case 'articles':     return $this->submitAddArticle(); break;
		// case 'stocks':       return $this->submitAddStock(); break;
		 case 'users':				return $this->submitAddUser(); break;
		 default: return redirect()->back()->withInput()->with('alert_warning','<strong>Erreur !!</strong> Vous avez pris le mauvais chemin. ==> AddController@submitAdd');      break;
	 }
	}

	//Valider l'ajout d un utilisateur
	public function submitAddUser()
	{
		//creation d'un Directeur a partir des donnees du formulaire:
		$item = new User();
		$item->id_role     = request()->get('id_role');
		$item->id_magasin  = request()->get('id_magasin');
		$item->nom         = request()->get('nom');
		$item->prenom      = request()->get('prenom');
		$item->ville       = request()->get('ville');
		$item->telephone   = request()->get('telephone');
		$item->email       = request()->get('email');
		$item->password    = Hash::make( request()->get('password') );
		$item->description = request()->get('description');

		//si l'email exist deja alors revenir au formulaire avec les donnees du formulaire et un message d'erreur
		if( EmailExist( request()->get('email') , 'users' )  )
			return redirect()->back()->withInput()->with('alert_danger',"<li><i>".request()->get('email')."</i> est deja utilisé.");

		//si le mot de passe et trop court:
		if( strlen(request()->get('password'))<7 )
			return back()->withInput()->with('alert_danger',"<li>Mot de Passe trop court.");

			try
			{
				$item->save();
			}catch(Exception $ex)
			{
				return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> l\'out de '.request()->get('email').' a echoue. <br> message d\'erreur: '.$ex->getMessage().'');
			}

		return redirect()->back()->with('alert_success','ajout de  "<strong>'.request()->get('email').'</strong>"  Reussi');
	}

	//Valider l'ajout de : Magasin
	public function submitAddMagasin()
	{
		//if( Exists('magasins', 'libelle', request()->get('libelle') )  )			return redirect()->back()->withInput()->with('alert_warning','<strong>Alert !!</strong> Le magasin <i>'.request()->get('libelle').'</i> existe déjà');
		//if( request()->get('email')==null || request()->get('agent')==null || request()->get('ville')==null || request()->get('telephone')==null || request()->get('adresse')==null  )			return redirect()->back()->withInput()->with('alert_info','il est préférable de remplir tous les champs.');
		//if( Exists('magasins', 'libelle', request()->get('libelle')) )			return redirect()->back()->withInput()->with('alert_warning','Le magasin <strong>'.request()->get('libelle').'</strong> exist deja.');

		$item = new Magasin;
		$item->libelle      = request()->get('libelle');
		$item->email        = request()->get('email');
		$item->agent        = request()->get('agent');
		$item->ville        = request()->get('ville');
		$item->telephone    = request()->get('telephone');
		$item->adresse      = request()->get('adresse');
		$item->description  = request()->get('description');
		try
		{
			$item->save();
		}catch(Exception $e)
		{
			return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> l\'out du magasin: '.request()->get('libelle').' a echoue. <br> message d\'erreur: '.$ex->getMessage().'');
		}
		return redirect()->back()->with('alert_success','Le Magasin <strong>'.request()->get('libelle').'</strong> a bien été ajouté.');

	}

	//Valider l'ajout de : Categorie
	public function submitAddCategorie()
	{
		if( request()->get('libelle')==null )
			 return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> veuillez remplir le champ libelle');
		if( Exists('categories', 'libelle', request()->get('libelle') )  )
			 return redirect()->back()->withInput()->with('alert_warning','<strong>Alert !!</strong> La catégorie <i>'.request()->get('libelle').'</i> existe déjà');
		if( request()->get('libelle')==null )
			 return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> veuillez remplir le champ libelle');

		$item = new Categorie;
		$item->libelle      = request()->get('libelle');
		$item->description  = request()->get('description');
		try
		{
			$item->save();
		}catch(Exception $ex)
		{
			return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> l\'out de '.request()->get('libelle').' a echoue. <br> message d\'erreur: '.$ex->getMessage().'');
		}
		return redirect()->back()->with('alert_success','La Categorie <strong>'.request()->get('libelle').'</strong> a bien été ajouté.');
	}

	//Valider l'ajout de Fournisseur
	public function submitAddFournisseur()
	{
		if( request()->get('libelle')==null )
			return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> veuillez remplir le champ libelle');

		$item = new Fournisseur;
		$item->code         = request()->get('code');
		$item->libelle      = request()->get('libelle');
		$item->agent        = request()->get('agent');
		$item->email        = request()->get('email');
		$item->telephone    = request()->get('telephone');
		$item->fax          = request()->get('fax');
		$item->description  = request()->get('description');
		try
		{
			$item->save();
		}catch(Exception $ex)
		{
			return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur !!</strong> l\'out du fournisseur: '.request()->get('libelle').' a echoue. <br> message d\'erreur: '.$ex->getMessage().'');
		}
		return redirect()->back()->with('alert_success','Le Fournisseur <strong>'.request()->get('code').': '.request()->get('libelle').'</strong> a bien été ajouté.');

	}

	//Valider l'ajout de : Magasin
	public function submitAddArticle()
	{
		$alerts = "";		$alerts2 = "";
		$item = new Article;
		$item->id_categorie   = request()->get('id_categorie');
		$item->id_fournisseur = request()->get('id_fournisseur');
		$item->num_article    = request()->get('num_article');
		$item->code_barre     = request()->get('code_barre');
		$item->designation_c  = request()->get('designation_c');
		$item->designation_l  = request()->get('designation_l');
		$item->taille         = request()->get('taille');
		$item->sexe           = request()->get('sexe');
		$item->couleur        = request()->get('couleur');
		$item->prix_achat     = request()->get('prix_achat');
		$item->prix_vente     = request()->get('prix_vente');

		if( request()->has('force') && request()->get('force')=="true" )
		{
			if( Exists('articles', 'designation_c', request()->get('designation_c') )  )
				$alerts = $alerts."<li>L\'article <i>".request()->get('designation_c')."</i> existe déjà.";
			if( Exists('articles', 'num_article', request()->get('num_article') )  )
				$alerts = $alerts."<li>Le numero: <i>".request()->get('num_article')."</i> est deja utilise pour un autre article.";

			try
			{
				$item->save();
			}
			catch(Exception $ex){ return redirect()->back()->withInput()->with('alert_danger','<li>Une erreur s\'est produite lors de l\'ajout de l\'article.<br>Message d\'erreur: '.$ex->getMessage() ); }

			return redirect()->back()->with('alert_success','L\'article <strong>'.request()->get('designation_c').'</strong> a bien été ajouté.');
		}
		else
		{
			if( Exists('articles', 'designation_c', request()->get('designation_c') )  )
				$alerts = $alerts."<li>L\'article <i>".request()->get('designation_c')."</i> existe déjà.";

			if( Exists('articles', 'num_article', request()->get('num_article') )  )
				$alerts = $alerts."<li>Le numero: <i>".request()->get('num_article')."</i> est deja utilise pour un autre article.";

			if( Exists('articles', 'code_barre', request()->get('code_barre') )  )
				$alerts = $alerts."<li>Le code: <i>".request()->get('code')."</i> est deja utilise pour un autre article.";

			if( request()->get('prix_vente')==null )
				$alerts2 = $alerts2."<li>Veuillez remplir le champ: <i>Prix de vente</i>";
			if( request()->get('prix_achat')==null )
				$alerts2 = $alerts2."<li>Veuillez remplir le champ: <i>Prix d'achat</i>";

			if( request()->get('taille')==null )
				$alerts2 = $alerts2."<li>Veuillez remplir le champ: <i>Taille</i>";
			if( request()->get('couleur')==null )
				$alerts2 = $alerts2."<li>Veuillez remplir le champ: <i>Couleur</i>";

			redirect()->back()->withInput()->with('alert_info',$alerts2);
			redirect()->back()->withInput()->with('alert_warning',$alerts);

			try
			{
				$item->save();
			}
			catch(Exception $ex){ return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur! </strong> une erreur s\'est produite lors de l\'ajout de l\'article.<br>Message d\'erreur: '.$ex->getMessage() ); }

			return redirect()->back()->with('alert_success','L\'article <strong>'.request()->get('designation_c').'</strong> a bien été ajouté.');


		}



	}













  //permet de retourner la vue qui contient le formulaire de modification du mot de passe
  public function updatePasswordFormUser($id)
  {
		$magasins = DB::table('magasins')->get();
		$roles = DB::table('roles')->get();
		$data = DB::table('users')->where('id_user',$id)->first();

		//si l'utilisateur n'existe pas, redirect vers la page precedente avec un message d'erreur
		if($data==null)
	 		return redirect()->back()->with('alert_danger','<strong>Erreur !!</strong> l\'utilisateur que vous avez choisi n\'existe pas, veuillez actualiser la page.');
		else
			return view('Espace_Admin.updatePassword-user-form')->with([ 'data' => $data ,'magasins' => $magasins, 'roles' => $roles ]);
  }





	/*********************
	Valider La modification des Users
	***********************/
	public function submitUpdateUser()
	{
	  if( EmailExist_2( request()->get('email') , request()->get('id_user') )  )
		return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur: </strong>  "'.request()->get('email').'" est deja utilisé pour un autre utilisateur.');
	  else
		$user = User::find(request()->get('id_user'));
		$user->update([
		  'id_role'     => request()->get('id_role'),
		  'id_magasin'  => request()->get('id_magasin'),
		  'nom'         => request()->get('nom'),
		  'prenom'      => request()->get('prenom'),
		  'ville'       => request()->get('ville'),
		  'telephone'   => request()->get('telephone'),
		  'email'       => request()->get('email'),
		  'description' => request()->get('description'),
		]);

	   return redirect()->route('admin.infoUser',['id' => request()->get('id_user') ])->with('alert_success','Modification de l\'utilisateur reussi.');
	}

	/*********************
	Valider La modification du mot de passe
	***********************/
	public function submitUpdatePasswordUser()
	{

	  if( strlen(request()->get('password'))<8 )
		return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur: </strong> le mot de passe doit contenir, au moins, 7 caractères.');

	  $user = User::find(request()->get('id_user'));
	  $user->update([
		  'password'     => Hash::make( request()->get('password')  )
	  ]);

	  return redirect()->route('admin.infoUser',['id' => request()->get('id_user') ])->with('alert_success','Modification du mot de passe de l\'utilisateur reussi.');
	}




}
