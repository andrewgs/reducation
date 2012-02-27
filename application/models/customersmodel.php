<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Customersmodel extends CI_Model {

	var $id				= 0;
	var $login			= '';
	var $password		= '';
	var $organization	= '';
	var $inn			= '';
	var $kpp			= '';
	var $uraddress		= '';
	var $postaddress	= '';
	var $bik			= '';
	var $bank			= '';
	var $person			= '';
	var $personemail	= '';
	var $accounttype	= '';
	var $signupdate		= '';
	var $online			= 0;
	var $accountnumber	= 0;
	var $accountkornumber= 0;

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->login 			= '';
		$this->password			= '';
		$this->organization 	= $data['organization'];
		$this->inn 				= $data['inn'];
		$this->kpp				= $data['kpp'];
		$this->uraddress		= $data['uraddress'];
		$this->postaddress		= $data['postaddress'];
		$this->bik				= $data['bik'];
		$this->bank				= $data['bank'];
		$this->person			= $data['person'];
		$this->personemail		= $data['personemail'];
		$this->accounttype		= $data['accounttype'];
		$this->signupdate 		= date("Y-m-d");
		$this->online 			= 0;
		$this->accountnumber	= $data['accountnumber'];
		$this->accountkornumber	= $data['accountkornumber'];
		
		$this->db->insert('customers',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('customers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function active_user($id){
		
		$this->db->set('online',1);
		$this->db->where('id',$id);
		$this->db->update('customers');
	}
	
	function deactive_user($id){
		
		$this->db->set('online',0);
		$this->db->where('id',$id);
		$this->db->update('customers');
	}
	
	function auth_user($login,$password){
		
		$this->db->where('login',$login);
		$this->db->where('password',$this->encrypt->encode($insertdata['password']));
		$query = $this->db->get('customers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('customers',1);
		$data = $query->result_array();
		if(count($data) > 0) return $data[0]['id'];
		return FALSE;
	}
	
	function user_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('customers',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['id'];
		return FALSE;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('customers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('customers');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('customers');
		return $this->db->affected_rows();
	}	
}