<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function index(){

		$this->load->view("admin_interface/index");
	}
}