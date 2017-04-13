<?php
/*
Helper pour le gerer les dates
*/


use Carbon\Carbon;

// permet de donner une date a partir d un timestamps from db
if( !function_exists('getDateHelper') )
{
	function getDateHelper($value)
	{
		$date = Carbon::createFromFormat('d-m-Y', date('d-m-Y', strtotime($value)));

		switch($date->dayOfWeek)
		{
		 case '1': $J = 'Lundi';		break;
		 case '2': $J = 'Mardi';		break;
		 case '3': $J = 'Mercredi';	break;
		 case '4': $J = 'Jeudi';		break;
		 case '5': $J = 'Vendredi';	break;
		 case '6': $J = 'Samedi';		break;
		 case '0': $J = 'Dimanche';	break;
		 default:	 $J = 'Le';
		}

		switch($date->month)
		{
		 case '01': $M = 'Janvier';		break;
		 case '02': $M = 'Février';		break;
		 case '03': $M = 'Mars';			break;
		 case '04': $M = 'Avril';			break;
		 case '05': $M = 'Mai';				break;
		 case '06': $M = 'Juin';			break;
		 case '07': $M = 'Juillet';		break;
		 case '08': $M = 'Août';			break;
		 case '09': $M = 'Septembre';	break;
		 case '10': $M = 'Octobre';		break;
		 case '11': $M = 'Novembre';	break;
		 case '12': $M = 'Décembre';	break;
		 default:	 	$M = '/ '.$date->month.' /';
		}
		return $J." ".$date->day." ".$M." ".$date->year;
	}
}

// permet de donner une l'heur a partir d un timestamps from db
if( !function_exists('getTimeHelper') )
{
	function getTimeHelper($value)
	{
		$date = Carbon::createFromFormat('H:m:s /i', date('H:m:s /i', strtotime($value)));
		//$date = Carbon::now();
		//dump($date);
		return $date->hour.":".$date->minute;//.":".$date->second;
	}
}
