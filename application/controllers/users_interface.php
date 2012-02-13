<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends CI_Controller{
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function index(){

		$this->load->view("users_interface/index");
	}

	public function admin_login(){
		
		$this->load->view("users_interface/admin-login");
	}
}