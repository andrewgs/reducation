<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audience_interface extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function index(){

		$this->load->view("audience_interface/index");
	}
}