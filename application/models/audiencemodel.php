<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audiencemodel extends CI_Model {

    var $id   			= 0;
    var $login 			= '';
    var $password    	= '';
    var $lastname   	= '';
    var $name    		= '';
    var $middlename   	= '';
    var $country    	= '';
    var $area    		= '';
    var $city    		= '';
    var $graduated    	= '';
    var $year    		= '';
    var $diplom    		= '';
    var $specialty    	= '';
    var $signupdate    	= '';
    var $company    	= '';
    var $online    		= 0;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->login 			= $data['login'];
		$this->password			= $this->encrypt->encode($insertdata['password']);
		$this->lastname 		= $data['lastname'];
		$this->name 			= $data['name'];
		$this->middlename		= $data['middlename'];
		$this->country 			= $data['country'];
		$this->area 			= $data['area'];
		$this->city 			= $data['city'];
		$this->graduated		= $data['graduated'];
		$this->year 			= $data['year'];
		$this->diplom 			= $data['diplom'];
		$this->specialty 		= $data['specialty'];
		$this->uconfirmation	= $data['confirm'];
		$this->signupdate 		= date("Y-m-d");
		$this->customer 		= $data['customer'];
		$this->online 			= 0;
		
		$this->db->insert('audience',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('audience',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function active_user($id){
		
		$this->db->set('online',1);
		$this->db->where('id',$id);
		$this->db->update('audience');
	}
	
	function deactive_user($id){
		
		$this->db->set('online',0);
		$this->db->where('id',$id);
		$this->db->update('audience');
	}
	
	function auth_user($login,$password){
		
		$this->db->where('login',$login);
		$this->db->where('password',$this->encrypt->encode($insertdata['password']););
		$query = $this->db->get('audience',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('audience',1);
		$data = $query->result_array();
		if(count($data) > 0) return $data[0]['id'];
		return FALSE;
	}
	
	function user_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('audience',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['id'];
		return FALSE;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('audience',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('audience');
		return $this->db->affected_rows();
	}	
}