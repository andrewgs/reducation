<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function number_document($number){
		
		$current_year = date("y");
		if($current_year > 12):
			return $number.'/'.$current_year;
		else:
			return $number;
		endif;
	}
?>