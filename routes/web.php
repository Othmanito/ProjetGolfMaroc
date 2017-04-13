<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\User;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Role;
use App\Models\Magasin;
use App\Models\Stock;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/c','ChartsController@index');  //afficher les chart


Route::get('/form', function () {
    return view('form')->with('articles', Article::all() );
});

Route::get('/t', function () {

  $v = Input::get("aa");
  dump($v);
  $data = DB::select( DB::raw("SELECT * FROM stocks s join articles a on s.id_article=a.id_article ") );
  dump($data);

  $data = DB::statement('select * from users where id_role=:id', array('id' => 1) );
  dump($data);



  return "a";

  $stocks = Stock::where('id_magasin',1)->get();
  dump($stocks->first()->quantite);

});


//Route pour generer des PDF
Route::get('print/{param}','PDFController@imprimer')->name('print');









/**************************************
Routes AddForm et SubmitAdd
***************************************/
Route::get('/admin/add/{p_table}','AddController@addForm')->name('admin.add');
Route::post('/admin/submitAdd/{p_table}','AddController@submitAdd')->name('admin.submitAdd');

Route::get('/direct/add/{p_table}','AddController@addForm')->name('direct.add');
Route::post('/direct/submitAdd/{p_table}','AddController@submitAdd')->name('direct.submitAdd');
/***************************************
***************************************/

/**************************************
Routes Delete
***************************************/
Route::get('/admin/delete/{p_table}/{p_id}','DeleteController@delete')->name('admin.delete');
Route::get('/direct/delete/{p_table}/{p_id}','DeleteController@delete')->name('direct.delete');
/***************************************
***************************************/



/**************************
Routes pour l espace Admin
***************************/

Route::prefix('/admin')->group( function()
{
  //home --> Dashboard
  Route::get('','AdminController@home')->name('admin.home');


  //update user
  Route::get('/updateUser/{id}','AdminController@updateFormUser')->name('admin.updateUser');
  Route::post('/submitUpdateUser','AdminController@submitUpdateUser')->name('admin.submitUpdateUser');

  //update password
  Route::get('/updatePasswordUser/{id}','AdminController@updatePasswordFormUser')->name('admin.updatePasswordUser');
  Route::post('/submitUpdatePasswordUser','AdminController@submitUpdatePasswordUser')->name('admin.submitUpdatePasswordUser');

  //delete User
  Route::get('/deleteUser/{id}','AdminController@deleteUser')->name('admin.deleteUser');

  //lister les utlisateurs & trier les users
  Route::get('/lister','AdminController@listerUsers')->name('admin.lister');
  Route::get('/lister/{orderby}','AdminController@listerUsersOrder')->name('admin.listerOrder');

  //afficher le profile d un user:
  Route::get('/infoUser/{id}','AdminController@infoUser')->name('admin.infoUser');
});




/***************************
Routes pour l espace Direct
***************************/

Route::prefix('/direct')->group( function()
{
  //home --> Dashboard
  Route::get('/','DirectController@home')->name('direct.home');


  Route::get('/addStock/{p_id_magasin}','DirectController@addFormStock')->name('direct.addFormStock');  //formulaire d'ajout au stock

  //lister
  Route::get('/lister/{param}','DirectController@lister')->name('direct.lister');

  //delete data
  Route::get('/delete/{p_table}/{p_id}','DirectController@delete')->name('direct.delete');

  //afficher le profile
  Route::get('/info/{p_table}/{p_id}','DirectController@info')->name('direct.info');

  //afficher
  Route::get('/update/{p_table}/{p_id}','DirectController@updateForm')->name('direct.updateForm');
  Route::post('/submitUpdate/{param}','DirectController@submitUpdate')->name('direct.submitUpdate');

  //lister stocks
  Route::get('/stocks/{p_id_magasin}','DirectController@listerStocks')->name('direct.stocks');

  Route::get('/update/{value}/{aa}','DirectController@routeError');
  Route::get('/update','DirectController@routeError');

});


//Route::get('/{param}',function(){
//  return view('welcome');
//});





/***************************
Routes pour l espace Vendeur
***************************/

Route::prefix('/vendeur')->group( function()
{
  //home --> Dashboard
  Route::get('/','VendeurController@home')->name('vendeur.home');


  Route::get('/addVente/{p_id_user}','VendeurController@addFormVente')->name('vendeur.addFormVente');  //formulaire d'ajout des ventes

  //lister
  Route::get('/lister/{param}','VendeurController@lister')->name('vendeur.lister');

  //delete data
  Route::get('/delete/{p_table}/{p_id}','DirectController@delete')->name('direct.delete');

  //afficher le profile
  Route::get('/info/{p_table}/{p_id}','DirectController@info')->name('direct.info');

  //afficher
  Route::get('/update/{p_table}/{p_id}','DirectController@updateForm')->name('direct.updateForm');
  Route::post('/submitUpdate/{param}','DirectController@submitUpdate')->name('direct.submitUpdate');

  //lister stocks
  Route::get('/stocks/{p_id_magasin}','DirectController@listerStocks')->name('direct.stocks');

  Route::get('/update/{value}/{aa}','DirectController@routeError');
  Route::get('/update','DirectController@routeError');

});
