<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Categorie;
use App\Models\User;
use App\Models\Role;

use Charts;
use Khill\Lavacharts\Lavacharts;

class ChartsController extends Controller
{
  public function index()
      {
        /*  $chart = Charts::multi('bar', 'material')
              // Setup the chart settings
              ->title("My Cool Chart")
              // A dimension of 0 means it will take 100% of the space
              ->dimensions(0, 400) // Width x Height
              // This defines a preset of colors already done:)
              ->template("material")
              // You could always set them manually
              // ->colors(['#2196F3', '#F44336', '#FFC107'])
              // Setup the diferent datasets (this is a multi chart)
              ->dataset('Element 1', [5,20,100])
              ->dataset('Element 2', [15,30,80])
              ->dataset('Element 3', [25,10,40])
              // Setup what the values mean
              ->labels(['One', 'Two', 'Three']);

          return view('dashboard', ['chart' => $chart]);*/

//---------------------------------------Line Chart ------------------------------------------
     $chart = Charts::database(User::all(), 'line', 'highcharts')
     ->title("Nombre d'utilisateurs par role ")
     ->elementLabel("Total")
     ->dimensions(600, 500)
     ->responsive(true)
     ->groupBy('id_role')
     ->labels(['Administrateur','Direction','Magasinier','Vendeur']);

     //---------------------------------------Bar Chart ------------------------------------------

     $chart2 = Charts::database(User::all(), 'bar', 'highcharts')
     ->title("Nombre d'utilisateurs par role ")
     ->elementLabel("Total")
     ->dimensions(600, 500)
     ->responsive(true)
     ->groupBy('id_role')
     ->labels(['Administrateur','Direction','Magasinier','Vendeur']);
     //---------------------------------------Pie Chart ------------------------------------------

     $chart3 = Charts::database(User::all(), 'pie', 'highcharts')
     ->title("Nombre d'utilisateurs par role ")

     ->elementLabel("Total")
     ->dimensions(700, 500)
     ->responsive(true)
     ->groupBy('id_role')
     ->labels(['Administrateur','Direction','Magasinier','Vendeur']);

     //---------------------------------------area Chart ------------------------------------------

     $chart4 = Charts::database(User::all(), 'area', 'highcharts')
     ->title("Nombre d'utilisateurs par role ")

     ->elementLabel("Total")
     ->dimensions(600, 500)
     ->responsive(true)
     ->groupBy('id_role')
     ->labels(['Administrateur','Direction','Magasinier','Vendeur']);

     return view('Espace_Admin.charts', ['chart' => $chart,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);


      }

}
