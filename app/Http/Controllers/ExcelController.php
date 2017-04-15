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
use \Excel;
use Carbon\Carbon;


class ExcelController extends Controller
{

	public function export($p_table)
	{
		switch($p_table)
		{
			case 'users': 				$this->ExportUsers(); 				break;
			case 'fournisseurs': 	$this->ExportFournisseurs(); 	break;
			default: return redirect()->back()->withInput()->with('alert_warning',' Vous avez pris le mauvais chemin. ==> ExcelController@export');      break;
		}
	}


	//fonction pour exporter la liste des utilisateurs
	public function ExportUsers()
	{
		$carbon = new Carbon();
		$date =  $carbon->format('d/m/Y H:m:s');

		Excel::create('Users '.$date, function($excel)
		{
			$excel->sheet('Utilisateurs', function($sheet)
			{
				$data = User::all(); $i=2;
				//$sheet->setOrientation('landscape');
				$sheet->fromArray( array('id_user', 'nom','prenom','ville','telephone','description','email','password','created_at','updated_at') );
				foreach( $data as $item )
				{
					$sheet->row( $i++ , array($item->id_user,
					$item->nom,$item->prenom,
					$item->ville,
					$item->telephone,
					$item->description,
					$item->email,
					$item->password,
					$item->created_at,
					$item->updated_at) );
				}
			});
		})->download('xls');
	}

	//fonction pour exporter la liste des utilisateurs
	public function ExportFournisseurs()
	{
		$carbon = new Carbon();
		$date =  $carbon->format('d/m/Y H:m:s');

		Excel::create('Fournisseurs '.$date, function($excel)
		{
			$excel->sheet('Fournisseurs', function($sheet)
			{
				$data = Fournisseur::all(); $i=2;
				//$sheet->setOrientation('landscape');
				$sheet->fromArray( array('id_fournisseur', 'code','libelle','agent','email','telephone','fax','description','created_at','updated_at') );
				foreach( $data as $item )
				{
					$sheet->row( $i++ , array(
						$item->id_fournisseur,
						$item->code,$item->libelle,
						$item->agent,$item->email,
						$item->telephone,$item->fax,
						$item->description,
						$item->created_at,
						$item->updated_at
					) );
				}
			});
		})->download('xls');
	}

}
