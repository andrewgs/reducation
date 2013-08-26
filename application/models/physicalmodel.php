<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Physicalmodel extends CI_Model{

	var $id				= 0;
	var $login			= '';
	var $password		= '';
	var $cryptpassword	= '';
	var $fio			= '';
	var $fiodat			= '';
	var $inn			= '';
	var $phones			= '';
	var $postaddress	= '';
	var $email			= '';
	var $signupdate		= '';
	var $online			= '';
	var $access			= 1;

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->login 			= $data['login'];
		$this->password 		= $data['password'];
		$this->cryptpassword 	= $data['cryptpassword'];
		$this->fio 				= $data['fio'];
		$this->fiodat 			= $data['fiodat'];
		$this->phones 			= $data['phones'];
		$this->inn 				= $data['inn'];
		$this->postaddress		= $data['postaddress'];
		$this->email			= $data['email'];
		$this->signupdate		= date("Y-m-d");
		
		$this->db->insert('physical',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->select("physical.*,fio AS fullname",FALSE);
		$this->db->where('id',$id);
		$query = $this->db->get('physical',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
		
		$this->db->order_by('access','DESC');
		$this->db->order_by('signupdate','DESC');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('physical');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_records_pages($count,$from){
		
		$this->db->order_by('access','DESC');
		$this->db->order_by('signupdate','DESC');
		$this->db->order_by('id','DESC');
		$this->db->limit($count,$from);
		$query = $this->db->get('physical');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function search_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('physical');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_email_records($email){
		
		$this->db->select('id,login,cryptpassword,fio,signupdate');
		$this->db->where('email',$email);
		$this->db->where('access',1);
		$query = $this->db->get('physical');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function update_record($id,$data){
		
		$this->db->set('fio',$data['fio']);
		$this->db->set('fiodat',$data['fiodat']);
		$this->db->set('phones',$data['phones']);
		$this->db->set('inn',$data['inn']);
		$this->db->set('postaddress',strip_tags($data['postaddress']));
		$this->db->set('email',$data['email']);
		$this->db->where('id',$id);
		
		$this->db->update('physical');
		return $this->db->affected_rows();
	}
	
	function active_user($id){
		
		$this->db->set('online',1);
		$this->db->where('id',$id);
		$this->db->update('physical');
	}
	
	function deactive_user($id){
		
		$this->db->set('online',0);
		$this->db->where('id',$id);
		$this->db->update('physical');
	}
	
	function auth_user($login,$password){
		
		$this->db->where('login',$login);
		$this->db->where('access',1);
		$this->db->where('password',md5($password));
		$query = $this->db->get('physical',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('physical',1);
		$data = $query->result_array();
		if(count($data) > 0) return $data[0]['id'];
		return FALSE;
	}
	
	function user_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('physical',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['id'];
		return FALSE;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('physical',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('physical');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('physical');
		return $this->db->affected_rows();
	}
	
	function search_physical($customer){
		
		$query = "SELECT physical.id,physical.fio FROM physical WHERE physical.fio LIKE '%$customer%'";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function set_access($customer,$access){
		
		$this->db->set('access',$access);
		$this->db->where('id',$customer);
		
		$this->db->update('physical');
		return $this->db->affected_rows();
	}
}