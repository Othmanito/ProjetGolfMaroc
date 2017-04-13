<?php
/*
Helper pour le adminController
*/



// fonction permet de verifier si une valeur d'un champ exist dans une table
if( !function_exists('Exists') )
{
	function Exists($table, $field, $value)
	{
    $data = DB::table($table)->get()->pluck($field);
    foreach( $data as $item )
    {
      if( $item == $value )
      return true;
    }
    return false;
	}
}

//returns Gender
if( !function_exists('getSexeName') )
{
	function getSexeName($value)
	{
		switch ($value) {
			case 'h': return 'Homme'; break;
			case 'f': return 'Femme'; break;
			default:  return '-'; 		break;
		}
	}
}

//test if is Color
if( !function_exists('isColor') )
{
	function isColor($value)
	{
		return substr($value,0,1) == '#' ? true : false;
	}
}


// fonction permet de retourner un champ d'une table a partir d un id
if( !function_exists('getChamp') )
{
	function getChamp($table, $id_field, $id, $field)
	{
		return DB::table($table)->where($id_field,$id)->pluck($field)->first();
	}
}
