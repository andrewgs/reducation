<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audiencemodel extends CI_Model{

    var $id   			= 0;
    var $login 			= '';
    var $password    	= '';
    var $lastname   	= '';
    var $name    		= '';
    var $middlename   	= '';
    var $address    	= '';
    var $graduated    	= '';
    var $year    		= '';
    var $documentnumber	= '';
    var $specialty    	= '';
    var $signupdate    	= '';
    var $customer    	= '';
    var $online    		= 0;
	var $access			= 0;
	var $cryptpassword	= '';
	var $personaemail	= '';
	var $personaphone	= '';
	var $qualification	= '';
	var $typedocument	= 1;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($customer,$data){
			
		$this->login 			= '';
		$this->password			= '';
		$this->lastname 		= $data['lastname'];
		$this->name 			= $data['name'];
		$this->middlename		= $data['middlename'];
		$this->address 			= $data['address'];
		$this->personaemail		= $data['personaemail'];
		$this->personaphone		= $data['personaphone'];
		$this->graduated		= $data['graduated'];
		$this->year 			= $data['year'];
		$this->documentnumber 	= $data['documentnumber'];
		$this->specialty 		= $data['specialty'];
		$this->qualification 	= $data['qualification'];
		$this->signupdate 		= date("Y-m-d");
		$this->customer 		= $customer;
		$this->online 			= 0;
		$this->access 			= 1;
		$this->cryptpassword	= '';
		$this->typedocument		= $data['typedocument'];
		
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
	
	function read_view_record($customer){
		
		$this->db->where('access',1);
		$this->db->where('customer',$customer);
		$this->db->order_by('lastname');
		$this->db->order_by('id');
		$query = $this->db->get('audience');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_customer_record($customer){
		
		$this->db->where('customer',$customer);
		$this->db->order_by('lastname');
		$this->db->order_by('id');
		$query = $this->db->get('audience');
		$data = $query->result_array();
		if(count($data)>0) return $data;
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
		$this->db->where('password',md5($password));
		$this->db->where('access',1);
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
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('audience');
		return $this->db->affected_rows();
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
	
	function delete_records($customer){
	
		$this->db->where('customer',$customer);
		$this->db->delete('audience');
		return $this->db->affected_rows();
	}
	
	function set_access($customer,$access){
		
		$this->db->set('access',$access);
		$this->db->where('id',$customer);
		
		$this->db->update('audience');
		return $this->db->affected_rows();
	}
	
}