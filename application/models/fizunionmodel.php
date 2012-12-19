<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fizunionmodel extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function order_total_summa($order){
		
		$query = "SELECT SUM(courses.price) AS price FROM fizcourseorder INNER JOIN courses ON fizcourseorder.course=courses.id INNER JOIN fizorders ON fizorders.id = fizcourseorder.order WHERE fizcourseorder.order = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if($data[0]['price']) return $data[0]['price'];
		return 0;
	}
	
	function read_corder_records($order){
		
		$query = "SELECT fizcourseorder.*,courses.title,courses.price,courses.code,fizorders.discount,fizorders.docnumber FROM fizcourseorder INNER JOIN courses ON fizcourseorder.course=courses.id INNER JOIN fizorders ON fizorders.id = fizcourseorder.order WHERE fizcourseorder.order = $order ORDER BY fizcourseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_corder_group_records($order){
		
		$query = "SELECT fizcourseorder.*,courses.title,courses.hours,courses.price,courses.code, count(fizcourse.id) AS cnt,fizorders.discount, fizorders.docnumber FROM fizcourseorder INNER JOIN courses ON fizcourseorder.course=courses.id INNER JOIN fizcourse ON fizcourseorder.id = fizcourse.course INNER JOIN fizorders ON fizorders.id = fizcourseorder.order WHERE fizcourseorder.order = $order GROUP BY fizcourseorder.course ORDER BY fizcourseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_caudience_records($order){
		
		$query = "SELECT fizcourse.*,audience.lastname,audience.name,audience.middlename,audience.specialty FROM fizcourse INNER JOIN audience ON fizcourse.audience=audience.id WHERE fizcourse.order = $order ORDER BY fizcourse.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_course_max_hours($order){
		
		$query = "SELECT MAX(courses.hours) AS chours FROM courses INNER JOIN fizcourseorder ON courses.id=fizcourseorder.course WHERE fizcourseorder.order = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0]['chours'];
		return NULL;
	}
	
	function read_course_physical_records($order){
		
		$query = "SELECT fizcourse.*,physical.fio,courses.code AS ccode,courses.title AS ctitle,courses.hours AS chours FROM fizcourse INNER JOIN physical ON fizcourse.physical=physical.id INNER JOIN fizcourseorder ON fizcourse.course=fizcourseorder.id, courses WHERE fizcourse.order = $order AND fizcourseorder.course = courses.id ORDER BY fizcourse.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_fullinfo_report($course,$order,$audience){
		
		$query = "SELECT fizcourse.*,audience.lastname,audience.name,audience.middlename,audience.specialty,audience.personaemail,audience.position,physical.fio,courses.code AS ccode,courses.title AS ctitle,tests.title AS ttitle FROM fizcourse INNER JOIN audience ON fizcourse.audience = audience.id INNER JOIN fizcourseorder ON fizcourse.course=fizcourseorder.id INNER JOIN physical ON fizcourse.physical = physical.id,courses,tests WHERE fizcourse.order = $order AND fizcourse.id = $course AND fizcourse.audience = $audience AND fizcourseorder.course = courses.id AND fizcourse.status = 1 AND courses.id = tests.course ORDER BY fizcourse.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}
	
	function result_course($course){
		
		$query = "SELECT fizcourse.*,audience.lastname,audience.name,audience.middlename,audience.specialty,audience.position FROM fizcourse INNER JOIN audience ON fizcourse.audience=audience.id WHERE fizcourse.course = $course ORDER BY fizcourse.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		return NULL;
	}
	
	function read_courseorder_title($order){
		
		$query = "SELECT courses.code,courses.price, courses.title FROM fizcourseorder INNER JOIN courses ON fizcourseorder.course=courses.id WHERE fizcourseorder.order = $order ORDER BY fizcourseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function valid_empty_course($order){
		
		$query = "SELECT COUNT(fizcourse.id) AS cnt FROM fizcourseorder LEFT JOIN fizcourse ON fizcourseorder.id=fizcourse.course WHERE fizcourseorder.order = $order GROUP BY fizcourseorder.course";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_physics_courses($physical,$status){
		
		$query = "SELECT courses.id,courses.title,courses.code,courses.trend,courses.hours,fizcourse.start,fizcourse.id AS aud,fizcourse.order FROM fizcourseorder INNER JOIN courses ON courses.id=fizcourseorder.course INNER JOIN fizcourse ON fizcourse.course = fizcourseorder.id INNER JOIN fizorders ON fizcourseorder.order=fizorders.id WHERE fizcourse.physical = $physical AND fizcourse.status = $status AND fizorders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_audience_currect_course($audience,$course,$status){
		
		$query = "SELECT fizcourse.order AS ordid, courses.id,courses.title,courses.code,courses.trend,courses.hours,fizcourse.start,fizcourse.course FROM fizcourseorder INNER JOIN courses ON courses.id=fizcourseorder.course INNER JOIN fizcourse ON fizcourse.course = fizcourseorder.id INNER JOIN fizorders ON fizcourseorder.order=fizorders.id WHERE fizcourse.audience = $audience AND fizcourse.id = $course AND fizcourse.status = $status AND fizorders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}
	
	function read_course_libraries($audience,$course,$status){
		
		$query = "SELECT courses.libraries FROM fizcourseorder INNER JOIN courses ON courses.id=fizcourseorder.course INNER JOIN fizcourse ON fizcourse.course = fizcourseorder.id INNER JOIN fizorders ON fizcourseorder.order=fizorders.id WHERE fizcourse.audience = $audience AND fizcourse.id = $course AND fizcourse.status = $status AND fizorders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0]['libraries'];
		return NULL;
	}
	
	function read_course_curriculum($audience,$course,$status){
		
		$query = "SELECT courses.curriculum FROM fizcourseorder INNER JOIN courses ON courses.id=fizcourseorder.course INNER JOIN fizcourse ON fizcourse.course = fizcourseorder.id INNER JOIN fizorders ON fizcourseorder.order=fizorders.id WHERE fizcourse.audience = $audience AND fizcourse.id = $course AND fizcourse.status = $status AND fizorders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0]['curriculum'];
		return NULL;
	}
	
	function get_courses_test($audorder,$audience,$status){
		
		$query = "SELECT tests.*, fizcourseorder.id AS coid,fizcourse.id AS aoid,fizcourseorder.order AS ordid,fizcourseorder.physical AS ordcus FROM fizcourseorder INNER JOIN courses ON courses.id=fizcourseorder.course INNER JOIN tests ON courses.id = tests.course INNER JOIN fizcourse ON fizcourseorder.id = fizcourse.course WHERE fizcourse.id = $audorder AND fizcourse.audience = $audience AND fizcourse.status = $status AND tests.chapter > 0 AND tests.active = 1 AND fizcourse.start = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function get_courses_examination($audorder,$audience,$status){
		
		$query = "SELECT tests.*, fizcourseorder.id AS coid,fizcourse.id AS aoid,fizcourseorder.order AS ordid,fizcourseorder.physical AS ordcus FROM fizcourseorder INNER JOIN courses ON courses.id=fizcourseorder.course INNER JOIN tests ON courses.id = tests.course INNER JOIN fizcourse ON fizcourseorder.id = fizcourse.course WHERE fizcourse.id = $audorder AND fizcourse.audience = $audience AND fizcourse.status = $status AND tests.chapter = 0 AND fizcourse.start = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}

	function read_audience_testing($id,$audience,$course){
		
		$query = "SELECT tests.id AS tid,tests.title AS ttitle,tests.count AS tcount,tests.timetest AS ttime, audiencetest.* FROM audiencetest INNER JOIN tests ON audiencetest.test = tests.id WHERE audiencetest.audience = $audience AND audiencetest.id = $id AND audiencetest.course = $course";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}

	function read_physical_orders($field,$sort,$status,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.paid = $status AND fizorders.deleted = 0 ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_physical_orders($status){
		
		$query = "SELECT fizorders.id FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.paid = $status AND fizorders.deleted = 0";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}
	
	function read_physical_deactive_orders($field,$sort,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id INNER JOIN audiencetest ON fizorders.id = audiencetest.order WHERE audiencetest.chapter = 0 AND audiencetest.result >= 60 AND fizorders.closedate != '0000-00-00' AND fizorders.numbercompletion != '' AND fizorders.deleted = 0 GROUP BY fizorders.id ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_physical_deactive_orders(){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id INNER JOIN audiencetest ON fizorders.id = audiencetest.order WHERE audiencetest.chapter = 0 AND audiencetest.result >= 60 AND fizorders.closedate != '0000-00-00' AND fizorders.numbercompletion != '' AND fizorders.deleted = 0 GROUP BY fizorders.id ORDER BY fizorders.orderdate DESC,fizorders.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}
	
	function read_physical_noclosed_orders($field,$sort,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.closedate = '0000-00-00' AND fizorders.numbercompletion = '' AND fizorders.deleted = 0 GROUP BY fizorders.id ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_physical_noclosed_orders(){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.closedate = '0000-00-00' AND fizorders.numbercompletion = '' AND fizorders.deleted = 0 GROUP BY fizorders.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}

	function count_deactive_order($order){
		
		$query = "SELECT COUNT(audiencetest.id) AS cnt FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id INNER JOIN audiencetest ON fizorders.id = audiencetest.order WHERE audiencetest.chapter = 0 AND audiencetest.result >= 70 AND fizorders.id = $order GROUP BY fizorders.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cnt'];
		return NULL;
	}
	
	function read_physical_active_orders($field,$sort,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id  WHERE fizorders.paid = 1 AND fizorders.closedate > '".date("Y-m-d")."' AND fizorders.numbercompletion = '' AND fizorders.deleted = 0 GROUP BY fizorders.id ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_physical_active_orders(){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id  WHERE fizorders.paid = 1 AND fizorders.closedate > '".date("Y-m-d")."' AND fizorders.numbercompletion = '' AND fizorders.deleted = 0 GROUP BY fizorders.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}
	
	function read_deleted_orders($field,$sort,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id  WHERE fizorders.deleted = 1 GROUP BY fizorders.id ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_deleted_orders(){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id  WHERE fizorders.deleted = 1 GROUP BY fizorders.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}
	
	function read_physical_noactive_orders($field,$sort,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id  WHERE fizorders.paid = 1 AND fizorders.closedate <= '".date("Y-m-d")."' AND fizorders.numbercompletion = '' AND fizorders.deleted = 0 GROUP BY fizorders.id ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_physical_noactive_orders(){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id  WHERE fizorders.paid = 1 AND fizorders.closedate <= '".date("Y-m-d")."' AND fizorders.numbercompletion = '' AND fizorders.deleted = 0 GROUP BY fizorders.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}
	
	function read_physical_all_orders($field,$sort,$count,$from){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.deleted = 0 GROUP BY fizorders.id ORDER BY $field $sort LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_physical_all_orders(){
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.deleted = 0 GROUP BY fizorders.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return count($data);
		return NULL;
	}
	
	function read_physical_info_order($order){
		
		$query = "SELECT fio,email,userpaiddate,orderdate,price,docnumber,closedate FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE fizorders.id = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_testing_order($order){
		
		$query = "SELECT fizcourse.*,courses.code AS ccode,courses.title AS ctitle,audience.id AS audid,audience.lastname,audience.name,audience.middlename FROM fizcourse INNER JOIN audience ON fizcourse.audience = audience.id INNER JOIN fizcourseorder ON fizcourse.course = fizcourseorder.id, courses WHERE fizcourse.order = $order AND fizcourseorder.course = courses.id ORDER BY fizcourse.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_physical_search_orders($nborder,$physical,$nbpaiddoc,$nbplacement,$nbcompletion){
		
		$physical = htmlspecialchars($physical);
		$ord = (!empty($nborder)) ? "fizorders.id = $nborder" : "FALSE";
		$org = (!empty($physical)) ? "physical.fio LIKE '%$physical%'" : "FALSE";
		$nplac = (!empty($nbplacement)) ? "fizorders.numberplacement LIKE '%$nbplacement%'" : "FALSE";
		$ncomp = (!empty($nbcompletion)) ? "fizorders.numbercompletion LIKE '%$nbcompletion%'" : "FALSE";
		$npd = (!empty($nbpaiddoc)) ? "fizorders.docnumber = $nbpaiddoc" : "FALSE";
		
		$query = "SELECT fizorders.*,physical.id AS cid,physical.fio,physical.email,physical.phones,physical.online FROM fizorders INNER JOIN physical ON fizorders.physical = physical.id WHERE $ord OR $org OR $npd OR $nplac OR $ncomp GROUP BY fizorders.id ORDER BY fizorders.orderdate DESC,fizorders.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
}