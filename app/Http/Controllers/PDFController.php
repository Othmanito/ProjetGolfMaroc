<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;
use DB;
use Carbon\Carbon;

class PDFController extends Controller
{

    public function imprimer($param)
    {
      switch($param)
      {
        case 'users':         return $this->printUsers();         break;
        case 'categories':    return $this->printCategories();    break;
        case 'fournisseurs':  return $this->printFournisseurs();  break;
        case 'articles':      return $this->printArticles();      break;
        default: return 'erreur PDFController-> imprimer';
      }
    }

    private function printUsers()
    {
      $date = Carbon::now()->format('j/m/Y');
      //echo $date;
      //return true;
      $pdf = PDF::loadView('pdf-users',['data' => DB::table('users')->get() ,'magasins' => DB::table('magasins')->get(), 'roles' =>  DB::table('roles')->get() ] );
      return $pdf->stream("Utilisateurs $date .pdf");
    }

    public function printArticles()
    {
      $pdf = PDF::loadView('pdf-articles',['data' => DB::table('articles')->get(), 'fournisseurs' => DB::table('fournisseurs')->get(), 'categories' => DB::table('categories')->get() ] );
      return $pdf->stream('Articles '.date('d-M-Y').'.pdf');
    }

    public function printCategories()
    {
      $pdf = PDF::loadView('pdf-categories',['data' => DB::table('categories')->get() ] );
      return $pdf->stream('Categories.pdf');
    }

    public function printFournisseurs()
    {
      $pdf = PDF::loadView('pdf-fournisseurs',['data' => DB::table('fournisseurs')->get() ] );
      return $pdf->stream('Fournisseurs '.date('d-M-Y').'.pdf');
    }

    public function pdf1()
    {
      //$users = User::all();
      $page = "
      <h1>Title 1</h1>
      <h2>Title 2</h2>
      <h3>Title 3</h3>\"aaa\"
      <h4>Title 4</h4>
      <h5>Title 5</h5>
      <h6>Title 6</h6>";

      $pdf = PDF::loadHTML($page);

      dump($pdf);
      return $pdf->stream('users.pdf');
      //return $pdf->download('test.pdf');
    }
}
