<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Curriculums extends MY_Model{

	protected $table = "curriculums";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		parent::__construct();
	}
}