<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Magasin;

class AdminController extends Controller
{
  //afficher la page d'accueil
  public function home()
  {
    return view('Espace_Admin.dashboard');
  }

  //permet de retourner la vue qui contient le formulaire d'ajout
  public function addFormUser()
  {
    $magasins = DB::table('magasins')->get();      $roles = DB::table('roles')->get();
    return view('Espace_Admin.add-user-form')->with([ 'magasins' => $magasins, 'roles' => $roles ]);
  }

  //permet de retourner la vue qui contient le formulaire de modification
  public function updateFormUser($id)
  {
    $magasins = DB::table('magasins')->get();      $roles = DB::table('roles')->get();
    $data = DB::table('users')->where('id_user',$id)->first();

    //si l'utilisateur n'existe pas, redirect vers la page precedente avec un message d'erreur
    if($data==null)
     return redirect()->back()->with('alert_danger','<strong>Erreur !!</strong> l\'utilisateur que vous avez choisi n\'existe pas, veuillez actualiser la page.');

    return view('Espace_Admin.update-user-form')->with([ 'data' => $data ,'magasins' => $magasins, 'roles' => $roles ]);
  }

  //permet de retourner la vue qui contient le formulaire de modification du mot de passe
  public function updatePasswordFormUser($id)
  {
    $magasins = DB::table('magasins')->get();      $roles = DB::table('roles')->get();
    $data = DB::table('users')->where('id_user',$id)->first();

    //si l'utilisateur n'existe pas, redirect vers la page precedente avec un message d'erreur
    if($data==null)
     return redirect()->back()->with('alert_danger','<strong>Erreur !!</strong> l\'utilisateur que vous avez choisi n\'existe pas, veuillez actualiser la page.');

    return view('Espace_Admin.updatePassword-user-form')->with([ 'data' => $data ,'magasins' => $magasins, 'roles' => $roles ]);
  }

  //permet d'afficher la liste des utilisateur avec order By
  public function listerUsersOrder($orderby)
  {
   $data = DB::table('users')->orderBy($orderby)->get();
   return view('Espace_Admin.liste-users')->with('data',$data);
  }

  //permet d'afficher la liste des utilisateurs
  public function listerUsers()
  {
    $data = DB::table('users')->get();
    return view('Espace_Admin.liste-users')->with('data',$data);
  }

  //permet d'afficher le profil d'un utilisateur
  public function infoUser($id)
  {
   $data = DB::table('users')->where('id_user',$id)->first();

   //si l'utilisateur n'existe pas, redirect vers la page precedente avec un message d'erreur
   if($data==null)
    return redirect()->back()->with('alert_danger','<strong>Erreur !!</strong> l\'utilisateur que vous avez choisi n\'existe pas, veuillez actualiser la page.');

   return view('Espace_Admin.info-users')->with('data',$data);
  }

  //supprimer utilisateur
  public function deleteUser($id)
  {
   $user = User::find($id);
   $user->delete();
   return redirect()->route('admin.lister')->with('alert_success','l\'Utilisateur a bien été effacé.');
  }


  /*********************
  Valider L'ajout des Users
  ***********************/
  public function submitAddUser(Request $request)
  {
    //creation d'un Directeur a partir des donnees du formulaire:
    $user = new User();
    $user->id_role     = $request->id_role;
    $user->id_magasin  = $request->id_magasin;
    $user->nom         = $request->nom;
    $user->prenom      = $request->prenom;
    $user->ville       = $request->ville;
    $user->telephone   = $request->telephone;
    $user->email       = $request->email;
    $user->password    = Hash::make( $request->password );
    $user->description = $request->description;

    //si l'email exist deja alors revenir au formulaire avec les donnees du formulaire et un message d'erreur
    if( EmailExist( $request->email , 'users' )  )
      return redirect()->route('admin.addUser')->withInput()->with('alert_danger','<strong>Erreur: </strong>  "'.$request->email.'" est deja utilisé');

    //si le mot de passe et trop court:
    if( strlen($request->password)<7 )
      return redirect()->route('admin.addUser')->withInput($request->only('nom','prenom','ville','email','description') )->with('alert_danger','<strong>Erreur: </strong> Mot de Passe trop court.');

      $user->save();
    //dump( $user );
    return redirect()->route('admin.addUser')->with('alert_success','ajout de  "<strong>'.$request->email.'</strong>"  Reussi');
  }

    /*********************
    Valider La modification des Users
    ***********************/
    public function submitUpdateUser(Request $request)
    {
      if( EmailExist_2( $request->email , $request->id_user )  )
        return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur: </strong>  "'.$request->email.'" est deja utilisé pour un autre utilisateur.');
      else
        $user = User::find($request->id_user);
        $user->update([
          'id_role'     => $request->id_role,
          'id_magasin'  => $request->id_magasin,
          'nom'         => $request->nom,
          'prenom'      => $request->prenom,
          'ville'       => $request->ville,
          'telephone'   => $request->telephone,
          'email'       => $request->email,
          'description' => $request->description
        ]);
       echo "notification !!!!!";
       return redirect()->route('admin.infoUser',['id' => $request->id_user ])->with('alert_success','Modification de l\'utilisateur reussi.');
    }

    /*********************
    Valider La modification du mot de passe
    ***********************/
    public function submitUpdatePasswordUser(Request $request)
    {

      if( strlen($request->password)<8 )
        return redirect()->back()->withInput()->with('alert_danger','<strong>Erreur: </strong> le mot de passe doit contenir, au moins, 7 caractères.');

      $user = User::find($request->id_user);
      $user->update([
          'password'     => Hash::make($request->password)
      ]);
      echo "notification !!!!!";
      return redirect()->route('admin.infoUser',['id' => $request->id_user ])->with('alert_success','Modification du mot de passe de l\'utilisateur reussi.');
    }




}
