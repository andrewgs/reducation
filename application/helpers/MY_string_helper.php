<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function number_order($number,$current_year){
		
		if($current_year > 12):
			return $number.'/'.$current_year;
		else:
			return $number;
		endif;
	}
?>