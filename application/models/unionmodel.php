<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Unionmodel extends CI_Model{

    function __construct(){
        parent::__construct();
    }
	
	function read_audience(){
		
		$query = "SELECT audience.*,customers.organization,customers.person FROM customers INNER JOIN audience ON customers.id=audience.customer ORDER BY audience.access DESC,audience.signupdate DESC, audience.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_corder_records($order){
		
		$query = "SELECT courseorder.*,courses.title,courses.price,courses.code FROM courseorder INNER JOIN courses ON courseorder.course=courses.id WHERE courseorder.order = $order ORDER BY courseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_corder_group_records($order){
		
		$query = "SELECT courseorder.*,courses.title,courses.price,courses.code, count(audienceorder.id) AS cnt FROM courseorder INNER JOIN courses ON courseorder.course=courses.id INNER JOIN audienceorder ON courseorder.id = audienceorder.course WHERE courseorder.order = $order GROUP BY courseorder.course ORDER BY courseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_caudience_records($order){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.specialty FROM audienceorder INNER JOIN audience ON audienceorder.audience=audience.id WHERE audienceorder.order = $order ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_course_audience_records($order){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.fiodat, audience.specialty,courses.code AS ccode,courses.title AS ctitle,courses.hours AS chours FROM audienceorder INNER JOIN audience ON audienceorder.audience=audience.id INNER JOIN courseorder ON audienceorder.course=courseorder.id, courses WHERE audienceorder.order = $order AND courseorder.course = courses.id ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_fullinfo_audience($order){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.fiodat,audience.specialty,customers.organization,customers.inn,customers.kpp,customers.uraddress,orders.id AS ordid,orders.orderdate,orders.price AS ordprice,orders.paid,orders.paiddate,courses.code AS ccode,courses.title AS ctitle,courses.hours AS chours,courses.price AS сprice FROM audienceorder INNER JOIN audience ON audienceorder.audience=audience.id INNER JOIN courseorder ON audienceorder.course=courseorder.id INNER JOIN customers ON audienceorder.customer = customers.id INNER JOIN orders ON audienceorder.order = orders.id, courses WHERE audienceorder.order = $order AND courseorder.course = courses.id ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_fullinfo_report($course,$order,$audience){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.specialty,audience.personaemail,customers.organization,courses.code AS ccode,courses.title AS ctitle,tests.title AS ttitle FROM audienceorder INNER JOIN audience ON audienceorder.audience = audience.id INNER JOIN courseorder ON audienceorder.course=courseorder.id INNER JOIN customers ON audienceorder.customer = customers.id,courses,tests WHERE audienceorder.order = $order AND audienceorder.id = $course AND audienceorder.audience = $audience AND courseorder.course = courses.id AND audienceorder.status = 1 AND courses.id = tests.course ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}
	
	function audience_course($course){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.specialty FROM audienceorder INNER JOIN audience ON audienceorder.audience=audience.id WHERE audienceorder.course = $course ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_courseorder_title($order){
		
		$query = "SELECT courses.code, courses.title FROM courseorder INNER JOIN courses ON courseorder.course=courses.id WHERE courseorder.order = $order ORDER BY courseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function valid_empty_course($order){
		
		$query = "SELECT COUNT(audienceorder.id) AS cnt FROM courseorder LEFT JOIN audienceorder ON courseorder.id=audienceorder.course WHERE courseorder.order = $order GROUP BY courseorder.course";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_audience_courses($audience,$status){
		
		$query = "SELECT courses.id,courses.title,courses.code,courses.trend,courses.hours,audienceorder.start,audienceorder.id AS aud,audienceorder.order FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_audience_currect_course($audience,$course,$status){
		
		$query = "SELECT audienceorder.order AS ordid, courses.id,courses.title,courses.code,courses.trend,courses.hours,audienceorder.start,audienceorder.course FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.id = $course AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}
	
	function read_course_libraries($audience,$course,$status){
		
		$query = "SELECT courses.libraries FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.id = $course AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0]['libraries'];
		return NULL;
	}
	
	function read_course_curriculum($audience,$course,$status){
		
		$query = "SELECT courses.curriculum FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.id = $course AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0]['curriculum'];
		return NULL;
	}
	
	function get_courses_test($audorder,$audience,$status){
		
		$query = "SELECT tests.*, courseorder.id AS coid,audienceorder.id AS aoid,courseorder.order AS ordid,courseorder.customer AS ordcus FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN tests ON courses.id = tests.course INNER JOIN audienceorder ON courseorder.id = audienceorder.course WHERE audienceorder.id = $audorder AND audienceorder.audience = $audience AND audienceorder.status = $status AND tests.chapter > 0 AND audienceorder.start = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function get_courses_examination($audorder,$audience,$status){
		
		$query = "SELECT tests.*, courseorder.id AS coid,audienceorder.id AS aoid,courseorder.order AS ordid,courseorder.customer AS ordcus FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN tests ON courses.id = tests.course INNER JOIN audienceorder ON courseorder.id = audienceorder.course WHERE audienceorder.id = $audorder AND audienceorder.audience = $audience AND audienceorder.status = $status AND tests.chapter = 0 AND audienceorder.start = 1";
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

	function read_customer_orders($status){
		
		$query = "SELECT orders.*,customers.organization,customers.online FROM orders INNER JOIN customers ON orders.customer = customers.id WHERE orders.paid = $status ORDER BY orders.orderdate DESC,orders.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_customer_deacticve_orders(){
		
		$query = "SELECT orders.*,customers.organization,customers.online FROM orders INNER JOIN customers ON orders.customer = customers.id INNER JOIN audiencetest ON orders.id = audiencetest.order WHERE audiencetest.chapter = 0 AND audiencetest.result >= 60 ORDER BY orders.orderdate DESC,orders.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_customer_acticve_orders(){
		
		$query = "SELECT orders.*,customers.organization,customers.online,audiencetest.id AS audid FROM orders INNER JOIN customers ON orders.customer = customers.id INNER JOIN audiencetest ON orders.id = audiencetest.order WHERE audiencetest.chapter = 0 AND audiencetest.result < 60 ORDER BY orders.orderdate DESC,orders.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_customer_all_orders(){
		
		$query = "SELECT orders.*,customers.organization,customers.online FROM orders INNER JOIN customers ON orders.customer = customers.id ORDER BY orders.orderdate DESC,orders.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_testing_order($order){
		
		$query = "SELECT audienceorder.*,courses.code AS ccode,courses.title AS ctitle,audience.id AS audid,audience.lastname,audience.name,audience.middlename FROM audienceorder INNER JOIN audience ON audienceorder.audience = audience.id INNER JOIN courseorder ON audienceorder.course = courseorder.id, courses WHERE audienceorder.order = $order AND courseorder.course = courses.id ORDER BY audienceorder.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}