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



  //permet de retourner la vue qui contient le formulaire de modification du mot de passe
  /*public function updatePasswordFormUser($id)
  {
    $magasins = DB::table('magasins')->get();      $roles = DB::table('roles')->get();
    $data = DB::table('users')->where('id_user',$id)->first();

    //si l'utilisateur n'existe pas, redirect vers la page precedente avec un message d'erreur
    if($data==null)
     return redirect()->back()->with('alert_danger','<strong>Erreur !!</strong> l\'utilisateur que vous avez choisi n\'existe pas, veuillez actualiser la page.');

    return view('Espace_Admin.updatePassword-user-form')->with([ 'data' => $data ,'magasins' => $magasins, 'roles' => $roles ]);
  }*/





  //supprimer utilisateur
  public function deleteUser($id)
  {
   $user = User::find($id);
   $user->delete();
   return redirect()->route('admin.lister')->with('alert_success','l\'Utilisateur a bien été effacé.');
  }




}
