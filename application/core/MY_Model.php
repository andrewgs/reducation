<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{

	protected $table = NULL;
	protected $primary_key = 'id';
	protected $fields = array();
	protected $order_by = 'id';
	
	function __construct(){
		date_default_timezone_set('Europe/Moscow');
		parent::__construct();
	}
	
	/****************************************************************************************************************/
	
	function clearOldSession(){

		$last_activity = strtotime("-1 day");
		$this->db->delete('sessions',array('last_activity <'=>$last_activity));
	}
	
	function activeUserData(){
	
		$last_activity = strtotime("now")-900; //15 минут не активен
		$this->db->select('user_data');
		$query = $this->db->get_where('sessions',array('last_activity >='=>$last_activity));
		if($data = $query->result_array()):
			return $data;
		endif;
		return FALSE;
	}
	
	function getWhere($primary_key = NULL,$where = NULL,$manyRecords = FALSE){
		
		if(!is_null($primary_key)):
			$this->db->select($this->_fields());
			$this->db->order_by($this->order_by);
			if(is_null($where)):
				$query = $this->db->get_where($this->table,array($this->primary_key=>$primary_key),1);
			elseif(is_array($where)):
				$this->db->where($this->primary_key,$primary_key);
				$this->db->where($where);
				$query = $this->db->get($this->table,1);
			endif;
		else:
			if(!is_null($where) && is_array($where)):
				$this->db->select($this->_fields());
				$this->db->order_by($this->order_by);
				$this->db->where($where);
				$query = $this->db->get($this->table);
			endif;
		endif;
		if(isset($query) && !empty($query)):
			$data = $query->result_array();
			if($manyRecords == FALSE && count($data) > 0):
				return $data[0];
			elseif(count($data) > 0):
				return $data;
			endif;
		endif;
		return NULL;
	}
	
	function getWhereIN(){
	
		$arguments = &func_get_args();
		$primary_key = (isset($arguments[0]['primary_key']))?$arguments[0]['primary_key']:NULL;
		$field = (isset($arguments[0]['field']))?$arguments[0]['field']:$this->primary_key;
		$whereIN = (isset($arguments[0]['where_in']))?$arguments[0]['where_in']:NULL;
		$where = (isset($arguments[0]['where']))?$arguments[0]['where']:NULL;
		$manyRecords = (isset($arguments[0]['many_records']))?$arguments[0]['many_records']:FALSE;
		$orderBy = (isset($arguments[0]['order_by']))?$arguments[0]['order_by']:$this->order_by;
		
		$this->db->select($this->_fields());
		$this->db->order_by($orderBy);
		if(!is_null($primary_key)):
			$this->db->where($this->primary_key,$primary_key);
		endif;
		if(!is_null($where) && is_array($where)):
			$this->db->where($where);
		endif;
		if(!is_null($whereIN) && is_array($whereIN) && !is_null($field)):
			$this->db->where_in($field,$whereIN);
		endif;
		$query = $this->db->get($this->table);
		$data = $query->result_array();
		if($manyRecords == FALSE && count($data) > 0):
			return $data[0];
		elseif(count($data) > 0):
			return $data;
		endif;
		return NULL;
	}
	
	function getAll($orderby = NULL){
		
		if(is_null($orderby)):
			$orderby = $this->order_by;
		endif;
		$this->db->select($this->_fields())->order_by($orderby);
		$query = $this->db->get($this->table);
		$data = $query->result_array();
		if($data):
			return $data;
		endif;
		return NULL;
	}
	
	function limit($limit = NULL,$offset = NULL,$orderby = NULL,$where = NULL,$field_where_in = NULL){
		
		if(is_null($orderby)):
			$orderby = $this->order_by;
		endif;
		$this->db->select($this->_fields());
		$this->db->order_by($orderby);
		if(is_numeric($limit) && is_numeric($offset)):
			$this->db->limit($limit,$offset);
		elseif(is_numeric($limit)):
			$this->db->limit($limit);
		endif;
		if(!is_null($where) && is_array($where)):
			$this->db->where($where);
		endif;
		if(!is_null($field_where_in)):
			$this->db->where_in($field_where_in['field'],$field_where_in['value']);
		endif;
		$query = $this->db->get($this->table);
		$data = $query->result_array();
		if($data):
			return $data;
		endif;
		return NULL;
	}
	
	function search($search_field = NULL,$search_parameter = NULL,$where = NULL){
		
		if(!is_null($search_field) || !is_null($search_parameter)):
			$this->db->where($search_field,$search_parameter);
			if(!is_null($where) && is_array($where)):
				$this->db->where($where);
			endif;
			$query = $this->db->get($this->table,1);
			$data = $query->result_array();
			if($data):
				return $data[0][$this->primary_key];
			endif;
		endif;
		return FALSE;
	}
	
	function value($primary_key = NULL,$field = NULL,$where = NULL){
		
		if(!is_null($primary_key) || !is_null($field)):
			$this->db->where($this->primary_key,$primary_key);
			if(!is_null($where) && is_array($where)):
				$this->db->where($where);
			endif;
			$query = $this->db->get($this->table,1);
			$data = $query->result_array();
			if($data):
				return $data[0][$field];
			endif;
		endif;
		return FALSE;
	}
	
	function searchTranslit($translit = NULL,$field = NULL){
		
		if(!is_null($translit) || !is_null($field)):
			$query = $this->db->get_where($this->table,array('translit'=>$translit),1);
			$data = $query->result_array();
			if($data):
				return $data[0][$field];
			endif;
		endif;
		return FALSE;
	}
	
	function updateField($primary_key = NULL,$field = NULL,$value = NULL,$where = NULL){
		
		if(!is_null($primary_key) || !is_null($field) || !is_null($value)):
			$this->db->set($field,$value);
			$this->db->where($this->primary_key,$primary_key);
			if(!is_null($where)):
				$this->db->where($where);
			endif;
			$this->db->update($this->table);
			return $this->db->affected_rows();
		endif;
		return FALSE;
	}
	
	function delete($primary_key = NULL,$where = NULL){
		
		if(!is_null($primary_key)):
			$this->db->where($this->primary_key,$primary_key);
		endif;
		if(!is_null($where) && is_array($where)):
			$this->db->where($where);
		endif;
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}
	
	function deleteWhereIN(){
		
		$arguments = &func_get_args();
		$primary_key = (isset($arguments[0]['primary_key']))?$arguments[0]['primary_key']:NULL;
		$field = (isset($arguments[0]['field']))?$arguments[0]['field']:$this->primary_key;
		$whereIN = (isset($arguments[0]['where_in']))?$arguments[0]['where_in']:NULL;
		$where = (isset($arguments[0]['where']))?$arguments[0]['where']:NULL;
		
		if(!is_null($primary_key)):
			$this->db->where($this->primary_key,$primary_key);
		endif;
		if(!is_null($whereIN) && is_array($whereIN) && !is_null($field)):
			$this->db->where_in($field,$whereIN);
		endif;
		if(!is_null($where) && is_array($where)):
			$this->db->where($where);
		endif;
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}
	
	function countAllResults($where = NULL){
		
		if(!is_null($where) && is_array($where)):
			$this->db->where($where);
			return $this->db->count_all_results($this->table);
		else:
			return $this->db->count_all($this->table);
		endif;
	}
	
	function getImage($primary_key = NULL,$field = NULL){
		
		if(!is_null($primary_key) || !is_null($field)):
			$this->db->select($field)->where($this->primary_key,$primary_key)->limit(1);
			$query = $this->db->get($this->table);
			if($data = $query->result_array()):
				return $data[0][$field];
			endif;
		endif;
		return NULL;
	}

	function execute($query = NULL,$parameters = NULL){
		
		if(!is_null($query)):
			if(!is_null($parameters)):
				$query .= $parameters;
			endif;
			$result = $this->db->query($query);
			if(is_object($result)):
				$data = $result->result_array();
				if($data):
					return $data;
				endif;
			endif;
		endif;
		return NULL;
	}
	
	/****************************************************************************************************************/
	
	function insertRecord($data = NULL){
		
		if(!is_null($data)):
			$fields = array();
			foreach($data as $field => $value):
				$fields[$field] = $value;
			endforeach;
			$this->db->insert($this->table,$fields);
			return $this->db->insert_id();
		endif;
		
		return FALSE;
	}
	
	function updateRecord($data = NULL){
		
		if(!is_null($data)):
			foreach($data as $field => $value):
				if($this->primary_key != $field):
					$this->db->set($field,$value);
				endif;
			endforeach;
			$this->db->where($this->primary_key,$data['id']);
			$this->db->update($this->table);
			return $this->db->affected_rows();
		endif;
		return FALSE;
	}
	
	function multiInsertRecords($data = NULL){
		
		if(!is_null($data) && is_array($data) && !empty($data)):
			$this->db->insert_batch($this->table,$data);
			return TRUE;
		endif;
		return FALSE;
	}
	
	function _fields(){
		
		if(empty($this->fields)):
			return '*';
		else:
			return implode(",",$this->fields);
		endif;
	}

	function getNextNumber($where = NULL){
		
		$this->db->select_max('number','max_number');
		if(!is_null($where) && is_array($where)):
			$this->db->where($where);
		endif;
		$query = $this->db->get($this->table);
		$data = $query->result_array();
		if($data[0]['max_number']) return $data[0]['max_number'];
		return 1;
	}
}