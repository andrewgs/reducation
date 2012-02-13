<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ordersmodel extends CI_Model {

    var $id   		= 0;
    var $company 	= '';
    var $orderdate  = '';
    var $price  	= '';
    var $view    	= '';
    var $invoice   	= '';
    var $contract  	= '';
    var $act   		= '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->company 	= $data['login'];
		$this->orderdate= $data['orderdate'];
		$this->price 	= $data['price'];
		$this->view 	= 0;
		$this->invoice 	= $data['invoice'];
		$this->contract = $data['contract'];
		$this->act 		= $data['act'];
		
		$this->db->insert('orders',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('orders');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('orders');
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('orders',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('orders',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('orders');
		return $this->db->affected_rows();
	}	
}