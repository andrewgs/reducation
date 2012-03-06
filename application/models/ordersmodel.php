<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ordersmodel extends CI_Model {

    var $id   		= 0;
    var $trend 		= 0;
    var $customer 	= '';
    var $orderdate  = '';
    var $price  	= '';
    var $invoice   	= '';
    var $contract  	= '';
    var $act   		= '';
    var $finish		= 0;
    var $paid		= 0;
    var $paiddate	= 0;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($trend,$customer){
			
		$this->trend	= $trend;
		$this->customer	= $customer;
		$this->orderdate= date("Y-m-d");
		$this->price 	= '';
		$this->invoice 	= '';
		$this->contract = '';
		$this->act 		= '';
		$this->finish	= 0;
		$this->paid		= 0;
		$this->paiddate	= '';
		
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
	
	function read_customer_record($customer){
		
		$this->db->order_by('orderdate','DESC');
		$this->db->order_by('id','DESC');
		$this->db->where('customer',$customer);
		$query = $this->db->get('orders');
		$data = $query->result_array();
		if(count($data)>0) return $data;
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

	function add_price($order,$price){
		
		$this->db->set('price','price+'.$price,FALSE);
		$this->db->where('id',$order);
		$this->db->update('orders');
		return $this->db->affected_rows();
	}
	
	function sub_price($order,$price){
		
		$this->db->set('price','price-'.$price,FALSE);
		$this->db->where('id',$order);
		$this->db->update('orders');
		return $this->db->affected_rows();
	}

	function close_order($id){
		
		$this->db->set('finish',1);
		$this->db->where('id',$id);
		$this->db->update('orders');
		return $this->db->affected_rows();
	}
	
	function owner_order_nonfinish($id,$customer){
		
		$this->db->where('id',$id);
		$this->db->where('customer',$customer);
		$this->db->where('finish',0);
		$query = $this->db->get('orders',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_order_finish($id,$customer){
		
		$this->db->where('id',$id);
		$this->db->where('customer',$customer);
		$this->db->where('finish',1);
		$query = $this->db->get('orders',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function paid_order($id,$status){
		
		$this->db->set('paid',$status);
		$this->db->set('paiddate',date("Y-m-d"));
		$this->db->where('id',$id);
		$this->db->update('orders');
		return $this->db->affected_rows();
	}
}