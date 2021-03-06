<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Customersmodel extends CI_Model{

	var $id				= 0;
	var $login			= '';
	var $password		= '';
	var $organization	= '';
	var $phones			= '';
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
	var $access			= 0;
	var $cryptpassword	= '';
	var $manager		= '';
	var $fiomanager		= '';
	var $statutory		= '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->login 			= '';
		$this->password			= '';
		$this->organization 	= $data['organization'];
		$this->phones 			= $data['phones'];
		$this->inn 				= $data['inn'];
		$this->kpp				= $data['kpp'];
		$this->uraddress		= $data['uraddress'];
		$this->postaddress		= $data['postaddress'];
		$this->bik				= $data['bik'];
		$this->bank				= $data['bank'];
		$this->person			= $data['person'];
		$this->personemail		= $data['personemail'];
		$this->accounttype		= 1;
		$this->signupdate 		= date("Y-m-d");
		$this->online 			= 0;
		$this->accountnumber	= $data['accountnumber'];
		$this->accountkornumber	= $data['accountkornumber'];
		$this->access			= 1;
		$this->cryptpassword	= '';
		$this->manager			= $data['manager'];
		$this->fiomanager		= $data['fiomanager'];
		$this->statutory		= $data['statutory'];
		
		$this->db->insert('customers',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->select("customers.*,person AS fullname",FALSE);
		$this->db->where('id',$id);
		$query = $this->db->get('customers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
		
		$this->db->order_by('access','DESC');
		$this->db->order_by('signupdate','DESC');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('customers');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_records_pages($count,$from){
		
		$this->db->order_by('access','DESC');
		$this->db->order_by('signupdate','DESC');
		$this->db->order_by('id','DESC');
		$this->db->limit($count,$from);
		$query = $this->db->get('customers');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function search_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('customers');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_email_records($email){
		
		$this->db->select('id,login,cryptpassword,organization,person,signupdate');
		$this->db->where('personemail',$email);
		$this->db->where('access',1);
		$query = $this->db->get('customers');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function update_record($id,$data){
		
		$this->db->set('organization',$data['organization']);
		$this->db->set('phones',$data['phones']);
		$this->db->set('organization',htmlspecialchars($data['organization']));
		$this->db->set('inn',$data['inn']);
		$this->db->set('kpp',$data['kpp']);
		$this->db->set('uraddress',strip_tags($data['uraddress']));
		$this->db->set('postaddress',strip_tags($data['postaddress']));
		$this->db->set('bik',$data['bik']);
		$this->db->set('bank',strip_tags($data['bank']));
		$this->db->set('person',htmlspecialchars($data['person']));
		$this->db->set('personemail',$data['personemail']);
		$this->db->set('accounttype',1);
		$this->db->set('accountnumber',$data['accountnumber']);
		$this->db->set('accountkornumber',$data['accountkornumber']);
		$this->db->set('manager',$data['manager']);
		$this->db->set('fiomanager',$data['fiomanager']);
		$this->db->set('statutory',$data['statutory']);
		$this->db->where('id',$id);
		
		$this->db->update('customers');
		return $this->db->affected_rows();
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
		$this->db->where('password',md5($password));
		$this->db->where('access',1);
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
	
	function set_access($customer,$access){
		
		$this->db->set('access',$access);
		$this->db->where('id',$customer);
		
		$this->db->update('customers');
		return $this->db->affected_rows();
	}

	function search_customers($customer){
		
		$query = "SELECT customers.id,customers.organization FROM customers WHERE customers.organization LIKE '%$customer%'";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}