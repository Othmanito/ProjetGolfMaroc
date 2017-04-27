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

/***************************************
Routes Excel:
****************************************/
Route::get('/export/{p_table}','ExcelController@export')->name('export');
Route::get('/export/{p_table}','ExcelController@export')->name('export');


/**************************************
Routes AddForm et SubmitAdd
***************************************/
Route::get('/admin/add/{p_table}','AddController@addForm')->name('admin.add');
Route::post('/admin/submitAdd/{p_table}','AddController@submitAdd')->name('admin.submitAdd');

Route::get('/direct/add/{p_table}','AddController@addForm')->name('direct.add');
Route::post('/direct/submitAdd/{p_table}','AddController@submitAdd')->name('direct.submitAdd');
/******************************************************************************/

/**************************************
Routes Update
***************************************/
Route::get('/admin/update/{p_table}/{p_id}','UpdateController@updateForm')->name('admin.update');
Route::post('/admin/submitUpdate/{p_table}','UpdateController@submitUpdate')->name('admin.submitUpdate');

Route::get('/direct/update/{p_table}/{p_id}','UpdateController@updateForm')->name('direct.update');
Route::post('/direct/submitUpdate/{p_table}','UpdateController@submitUpdate')->name('direct.submitUpdate');

/******************************************************************************/

/**************************************
Routes Delete
***************************************/
Route::get('/admin/delete/{p_table}/{p_id}','DeleteController@delete')->name('admin.delete');
Route::get('/direct/delete/{p_table}/{p_id}','DeleteController@delete')->name('direct.delete');
/******************************************************************************/

/*****************************************
Routes Lister et infos
*****************************************/
Route::get('/direct/info/{p_table}/{p_id}','ShowController@info')->name('direct.info');
Route::get('/admin/info/{p_table}/{p_id}','ShowController@info')->name('admin.info');

Route::get('/admin/lister/{p_table}','ShowController@lister')->name('admin.lister');
Route::get('/direct/lister/{p_table}','ShowController@lister')->name('direct.lister');
/*******************************************************************************/

/****************************************
Routes gestion des Stocks
*****************************************/
Route::get('/direct/addStock/{p_id_magasin}','StockController@addStock')->name('direct.addStock');
Route::post('/direct/submitAddStock','StockController@submitAddStock')->name('direct.submitAddStock');
/*******************************************************************************/



Route::prefix('/admin')->group( function()
{
  //home --> Dashboard
  Route::get('','AdminController@home')->name('admin.home');
});



Route::prefix('/direct')->group( function()
{
  //home --> Dashboard
  Route::get('/','DirectController@home')->name('direct.home');



  //lister stocks
  Route::get('/stocks/{p_id_magasin}','StockController@listerStocks')->name('direct.stocks');

  Route::get('/update/{value}/{aa}','DirectController@routeError');
  Route::get('/update','DirectController@routeError');
});


/*********************************************************************************************
                            Routes de l'espace Vendeur
**********************************************************************************************/

Route::prefix('/vendeur')->group( function()
{
  //home --> Dashboard
  Route::get('/','VendeurController@home')->name('vendeur.home');
  //Lister les ventes,les promotions et le stock d'un magasin
  Route::get('/Lister/{p_table}/{p_id_user}','VendeurController@lister')->name('vendeur.lister');

//Visualiser les details de la transaction
  Route::get('/details/{p_id}','VendeurController@detailTrans')->name('vendeur.details');


  //Route::get('/lister/{p_table}','VendeurController@lister')->name('vendeur.lister');
  //Afficher le formulaire d'Ajout de vente
  Route::get('/addFormVente/{p_id_mag}','AddController@addFormVente')->name('vendeur.addVente');
  //Valider l'ajout de la vente
  Route::post('/submitAddVente','AddController@submitAddVente')->name('vendeur.submitAddVente');
  Route::get('/menu/{p_id_mag}','VendeurController@getMagasin')->name('vendeur.menu');








});
