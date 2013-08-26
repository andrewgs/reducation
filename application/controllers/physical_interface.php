<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Physical_interface extends MY_Controller{

	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'','fullname'=>'');
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('physicalmodel');
		$this->load->model('trendsmodel');
		$this->load->model('coursesmodel');
		$this->load->model('chaptermodel');
		$this->load->model('lecturesmodel');
		$this->load->model('testsmodel');
		$this->load->model('testquestionsmodel');
		$this->load->model('testanswersmodel');
		$this->load->model('fizunionmodel');
		$this->load->model('ordersmodel');
		$this->load->model('fizordersmodel');
		$this->load->model('fizcourseordermodel');
		$this->load->model('fizcoursemodel');
		$this->load->model('fiztestmodel');
		$this->load->model('fiztestresultsmodel');
		$this->load->model('calendarmodel');
		
		if($this->session->userdata('logon') !== FALSE):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				if($this->session->userdata('utype') != 'fiz'):
					redirect('');
				endif;
				$userinfo = $this->physicalmodel->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= $userinfo['email'];
					$this->user['utype'] 			= $this->session->userdata('utype');
					$this->user['fullname']			= $userinfo['fio'];
					$this->loginstatus['status'] 	= TRUE;
					$this->loginstatus[$this->user['utype']] = TRUE;
				endif;
			endif;
			if($this->session->userdata('logon') != md5($userinfo['login'])):
				$this->loginstatus['status'] = FALSE;
				$this->user = array();
			endif;
		else:
			redirect('');
		endif;
	}
	
	public function start_page(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Начальная страница',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'orders'		=> $this->fizordersmodel->count_orders($this->user['uid']),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("physical_interface/physical-start-page",$pagevar);
	}
	
	public function profile(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Профиль заказчика',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'physical'		=> $this->physicalmodel->read_record($this->user['uid']),
					'readonly'		=> FALSE,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if(count($this->fizordersmodel->read_physical_record($this->user['uid']))):
			$pagevar['readonly'] = TRUE;
		endif;
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('fio',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','required|trim');
			$this->form_validation->set_rules('postaddress',' ','required|trim');
			$this->form_validation->set_rules('email',' ','required|valid_email|trim');
			$this->form_validation->set_rules('accountnumber',' ','trim');
			$this->form_validation->set_rules('bank',' ','trim');
			$this->form_validation->set_rules('accountkornumber',' ','trim');
			$this->form_validation->set_rules('bik',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Повторите ввод.');
				redirect($this->uri->uri_string());
			else:
				$update = $this->input->post();
				$this->physicalmodel->update_record($this->user['uid'],$update);
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("physical_interface/profile",$pagevar);
	}
	
	/******************************************************************************************************************/
	
	public function orders_list(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои заказы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'orders'		=> $this->fizordersmodel->read_physical_record($this->user['uid']),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
		endfor;
		$this->load->view("physical_interface/orders-list",$pagevar);
	}
	
	public function orders_order_information(){
	
		$order = $this->uri->segment(6);
		if($this->fizordersmodel->owner_order_nonfinish($order,$this->user['uid'])):
			$optRadio = $this->fizordersmodel->read_field($order,'trend');
			$this->session->set_userdata(array('regordering'=>TRUE,'step'=>2,'ordering'=>$optRadio,'order'=>$order));
			redirect('physical/registration/ordering/step/2');
		elseif(!$this->fizordersmodel->owner_order_finish($order,$this->user['uid'])):
			$this->session->set_userdata('msgr','Заказ отсутствует или удален.');
			redirect('physical/information/orders');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои заказы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'order'			=> $this->fizordersmodel->read_record($order),
					'course'		=> $this->fizunionmodel->read_corder_records($order),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($pagevar['order']['paid']):
			for($i=0;$i<count($pagevar['course']);$i++):
				$pagevar['course'][$i]['result'] = $this->fizunionmodel->result_course($pagevar['course'][$i]['id']);
				$pagevar['course'][$i]['result']['dateover'] = $this->operation_dot_date($pagevar['course'][$i]['result']['dateover']);
			endfor;
		else:
			for($i=0;$i<count($pagevar['course']);$i++):
				$pagevar['course'][$i]['result'] = array('status'=>FALSE);
				$pagevar['course'][$i]['result']['dateover'] = '0000-00-00';
			endfor;
		endif;
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		
		$this->load->view("physical_interface/order-information",$pagevar);
	}
	
	public function orders_order_invoice(){
		
		if(!$this->fizordersmodel->owner_order_finish($this->uri->segment(6),$this->user['uid'])):
			$this->session->set_userdata('msgr','Заказ отсутствует или удален.');
			redirect('physical/information/orders');
		endif;
		$pagevar = array(
				'description'	=> '',
				'author'		=> '',
				'title'			=> 'РосЦентр ДПО - ',
				'baseurl' 		=> base_url(),
				'loginstatus'	=> $this->loginstatus,
				'userinfo'		=> $this->user,
				'order'			=> $this->fizordersmodel->read_record($this->uri->segment(6)),
				'course'		=> $this->fizunionmodel->read_corder_group_records($this->uri->segment(6)),
				'customer'		=> array(),
				'msgs'			=> $this->session->userdata('msgs'),
				'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'Счет на оплату № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->physicalmodel->read_record($pagevar['order']['physical']);
		$this->load->view("physical_interface/documents/invoice",$pagevar);
	}
	
	public function orders_order_contract(){
		
		if(!$this->fizordersmodel->owner_order_finish($this->uri->segment(6),$this->user['uid'])):
			$this->session->set_userdata('msgr','Заказ отсутствует или удален.');
			redirect('customer/audience/orders');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> array(),
					'order'			=> $this->fizordersmodel->read_record($this->uri->segment(6)),
					'course'		=> $this->fizunionmodel->read_corder_group_records($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'Договор № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		$pagevar['order']['date'] = $pagevar['order']['orderdate'];
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->physicalmodel->read_record($pagevar['order']['physical']);
		
		$this->load->view("physical_interface/documents/contract",$pagevar);
	}
	
	public function orders_order_act(){
		
		if(!$this->fizordersmodel->owner_order_finish($this->uri->segment(6),$this->user['uid'])):
			$this->session->set_userdata('msgr','Заказ отсутствует или удален.');
			redirect('physical/information/orders');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> array(),
					'order'			=> $this->fizordersmodel->read_record($this->uri->segment(6)),
					'course'		=> $this->fizunionmodel->read_corder_group_records($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if(!$pagevar['order']['numbercompletion']):
			show_404();
		endif;
		$pagevar['title'] .= 'АКТ об оказании услуг по договору № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		$pagevar['order']['date'] = $pagevar['order']['orderdate'];
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		if($pagevar['order']['closedate'] != "0000-00-00"):
			$pagevar['order']['closedate'] = $this->operation_date($pagevar['order']['closedate']);
		else:
			$pagevar['order']['closedate'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("Y").' г.';
		endif;
		$pagevar['customer'] = $this->physicalmodel->read_record($pagevar['order']['physical']);
		
		$this->load->view("physical_interface/documents/act",$pagevar);
	}
	
	public function orders_delete_order(){
	
		$order = $this->uri->segment(5);
		if($order):
			$this->fizordersmodel->update_field($order,'deleted',1);
			$this->session->set_userdata('msgs','Заказ удален.');
		else:
			$this->session->set_userdata('msgr','Заказ не удален.');
		endif;
		redirect('physical/information/orders');
	}
	
	/******************************************************************************************************************/
	
	public function registration_ordering(){
		
		if($this->session->userdata('regordering')):
			redirect('physical/registration/ordering/step/'.$this->session->userdata('step'));
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Оформление заказа',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("physical_interface/ordering/registration-ordering",$pagevar);
	}
	
	public function registration_ordering_step1(){
		
		if($this->session->userdata('step')):
			if($this->session->userdata('step') != 1):
				redirect('physical/registration/ordering/step/'.$this->session->userdata('step'));
			endif;
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Оформление заказа - Выбор направления обучения - Шаг 1',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'trends'		=> $this->trendsmodel->read_view_records(),
					'courses'		=> $this->coursesmodel->read_view_records(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('optRadio',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не указано направление обучения.');
				redirect($this->uri->uri_string());
			else:
				$ur_id = $this->ordersmodel->next_order();
				$fiz_id = $this->fizordersmodel->next_order();
				$_POST['id'] = max($ur_id,$fiz_id);
				if($_POST['id']):
					$this->session->set_userdata('msgs','Направление обучения выбрано.');
					$order = $this->fizordersmodel->insert_record($_POST['id'],$_POST['optRadio'],$this->user['uid']);
					$this->session->set_userdata(array('regordering'=>TRUE,'step'=>2,'ordering'=>$_POST['optRadio'],'order'=>$order));
				else:
					$this->session->set_userdata('msgr','Ошибка. Невозможно создать заказ.');
					redirect($this->uri->uri_string());
				endif;
			endif;
			redirect('physical/registration/ordering/step/2');
		endif;
		
		$this->load->view("physical_interface/ordering/registration-ordering-step1",$pagevar);
	}
	
	public function registration_ordering_step2(){
		
		if(!$this->session->userdata('regordering')):
			redirect('physical/registration/ordering');
		endif;
		if($this->session->userdata('step')):
			if($this->session->userdata('step') != 2):
				redirect('physical/registration/ordering/step/'.$this->session->userdata('step'));
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Оформление заказа - Выбор направления обучения - Шаг 2',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'courses'		=> $this->coursesmodel->read_trend_records($this->session->userdata('ordering')),
					'courseorder'	=> $this->fizunionmodel->read_corder_records($this->session->userdata('order')),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');

		for($i=0;$i<count($pagevar['courses']);$i++):
			if(mb_strlen($pagevar['courses'][$i]['title'],'UTF-8') > 65):
				$pagevar['courses'][$i]['title'] = mb_substr($pagevar['courses'][$i]['title'],0,65,'UTF-8');
				$pagevar['courses'][$i]['title'] .= ' ... ';
			endif;
		endfor;
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('course',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не указан курс обучения.');
				redirect($this->uri->uri_string());
			else:
				if(!$this->coursesmodel->read_field($_POST['course'],'view')):
					$this->session->set_userdata('msgr','Ошибка. Указанного курса не существует.');
					redirect($this->uri->uri_string());
				endif;
				if(!$this->fizcourseordermodel->exist_course_order($_POST['course'],$this->session->userdata('order'),$this->user['uid'])):
					$corder = $this->fizcourseordermodel->insert_record($this->session->userdata('order'),$_POST['course'],$this->user['uid']);
					$this->fizcoursemodel->insert_record($corder,$this->user['uid'],$this->session->userdata('order'));
					$this->session->set_userdata('msgs','Курс обучения добавлен в заказ.');
				else:
					$this->session->set_userdata('msgr','Ошибка. Указанный курс уже прикреплен к данному заказу');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("physical_interface/ordering/registration-ordering-step2",$pagevar);
	}
	
	public function registration_ordering_step3(){
		
		if(!$this->session->userdata('regordering')):
			redirect('physical/registration/ordering');
		endif;
		$fco = $this->fizcourseordermodel->count_order_record($this->session->userdata('order'));
		if($fco == 0):
			redirect('physical/registration/ordering/step/'.$this->session->userdata('step'));
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Оформление заказа - Выбор направления обучения - Шаг 3',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'order'			=> $this->trendsmodel->read_field($this->session->userdata('ordering'),'title'),
					'courses'		=> $this->fizunionmodel->read_courseorder_title($this->session->userdata('order')),
					'corder'		=> $this->fizcourseordermodel->read_order_records($this->session->userdata('order')),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->session->set_userdata('msgs','Заказ оформлен.');
			$price = $this->fizunionmodel->order_total_summa($this->session->userdata('order'));
			$this->fizordersmodel->update_field($this->session->userdata('order'),'price',$price);
			$this->fizordersmodel->close_order($this->session->userdata('order'));
			$order = $this->session->userdata('order');
			$this->session->unset_userdata(array('regordering'=>'','step'=>'','ordering'=>'','order'=>''));
			redirect('physical/information/orders/order-information/id/'.$order);
		endif;
		
		$this->load->view("physical_interface/ordering/registration-ordering-step3",$pagevar);
	}
	
	public function registration_delete_course(){
		
		$ccourse = $this->uri->segment(7);
		if($ccourse):
			if(!$this->fizcourseordermodel->owner_corder($ccourse,$this->user['uid'])):
				$this->session->set_userdata('msgr','Курс не отменен.');
				redirect('physical/registration/ordering/step/2');
			endif;
			$course = $this->fizcourseordermodel->read_field($ccourse,'course');
			$result = $this->fizcourseordermodel->delete_record($ccourse);
			if($result):
				$price = $this->coursesmodel->read_field($course,'price');
				$this->fizordersmodel->sub_price($this->session->userdata('order'),$price);
				$this->session->set_userdata('msgs','Курс отменен успешно.');
			else:
				$this->session->set_userdata('msgr','Курс не отменен.');
			endif;
			redirect('physical/registration/ordering/step/2');
		else:
			show_404();
		endif;
	}
	
	public function registration_ordering_cancel(){
		
		$order = $this->session->userdata('order');
		if($order):
			$this->session->set_userdata('msgs','Заказ отменен.');
			$this->fizordersmodel->update_field($this->session->userdata('order'),'deleted',1);
			$this->session->unset_userdata(array('regordering'=>'','step'=>'','ordering'=>'','order'=>''));
		endif;
		redirect('physical/registration/ordering');
	}
	
	/******************************************************************************************************************/
	
	public function courses_currect(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои текущие курсы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'courses'		=> $this->fizunionmodel->read_physics_courses($this->user['uid'],0),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['courses']);$i++):
			$pagevar['courses'][$i]['chapter'] = $this->chaptermodel->count_records($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['tests'] = $this->testsmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['lectures'] = $this->lecturesmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['test'] = $this->fiztestmodel->read_exam_test_info($pagevar['courses'][$i]['order'],$pagevar['courses'][$i]['aud'],$this->user['uid']);
			$pagevar['courses'][$i]['test']['count'] = $this->testsmodel->read_field($pagevar['courses'][$i]['test']['test'],'count');
		endfor;
		$this->load->view("physical_interface/courses/courses-currect",$pagevar);
	}
	
	public function courses_completed(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои текущие курсы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'courses'		=> $this->fizunionmodel->read_physics_courses($this->user['uid'],1),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['courses']);$i++):
			$pagevar['courses'][$i]['chapter'] = $this->chaptermodel->count_records($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['tests'] = $this->testsmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['lectures'] = $this->lecturesmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['test'] = $this->fiztestmodel->read_exam_test_info($pagevar['courses'][$i]['order'],$pagevar['courses'][$i]['aud'],$this->user['uid']);
			$pagevar['courses'][$i]['test']['count'] = $this->testsmodel->read_field($pagevar['courses'][$i]['test']['test'],'count');
			$pagevar['courses'][$i]['test']['tresid'] = $this->fizcoursemodel->read_field($pagevar['courses'][$i]['aud'],'tresid');
		endfor;
		$this->load->view("physical_interface/courses/courses-completed",$pagevar);
	}
	
	public function test_report(){
		
		$reptest = $this->uri->segment(6);
		$course = $this->uri->segment(3);
		if(!$this->fizcoursemodel->read_status($course)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('physical/courses/completed');
		endif;
		
		if(!$this->fiztestresultsmodel->exist_report($this->user['uid'],$course,$reptest)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('physical/courses/completed');
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Отчет о итоговом тестировании',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'report'		=> $this->fiztestresultsmodel->read_record($reptest),
					'test'			=> array(),
					'questions'		=> array(),
					'answers'		=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['report']['dataresult'] = unserialize($pagevar['report']['dataresult']);
		$pagevar['test'] = $this->fizunionmodel->read_physical_testing($pagevar['report']['test'],$this->user['uid'],$pagevar['report']['course']);
		$pagevar['questions'] = $this->testquestionsmodel->read_records($pagevar['test']['tid']);
		$pagevar['answers'] = $this->testanswersmodel->read_records($pagevar['test']['tid']);
		$pagevar['test']['attemptdate'] = $this->operation_date($pagevar['test']['attemptdate']);
		$this->load->view("physical_interface/courses/test-report",$pagevar);
	}
	
	public function start_training(){
		
		$training = $this->uri->segment(5);
		if($training):
			if(!$this->fizcoursemodel->owner_audience($training,$this->user['uid'],0)):
				$this->session->set_userdata('msgr','Не возможно начать обучение.');
				redirect('physical/courses/current');
			endif;
			if($this->fizcoursemodel->read_field($training,'start')):
				$this->session->set_userdata('msgr','Обучение уже начато.');
				redirect('physical/courses/current');
			endif;
			$this->session->set_userdata('msgs','Обучение начато! Теперь Вам доступны лекции для ознакомления.<br/>Читайте лекции и сдавайте тесты.');
			$this->fizcoursemodel->update_field($training,'start',1);
			$tests = $this->fizunionmodel->get_courses_test($training,$this->user['uid'],0);
			for($i=0;$i<count($tests);$i++):
				$this->fiztestmodel->insert_record($tests[$i]['fcid'],$this->user['uid'],$tests[$i]['foid'],$tests[$i]['chapter'],$tests[$i]['id']);
			endfor;
			$test = $this->fizunionmodel->get_courses_examination($training,$this->user['uid'],0);
			$this->fiztestmodel->insert_record($test['fcid'],$this->user['uid'],$test['foid'],0,$test['id']);
		endif;
		redirect('physical/courses/current');
	}
	
	public function courses_lectures(){
		
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('physical/courses/current');
		endif;
		
		if(!$this->fizcoursemodel->read_field($course,'start')):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('physical/courses/current');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Список лекций',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'course'		=> $this->fizunionmodel->read_physical_currect_course($this->user['uid'],$course,0),
					'chapters'		=> array(),
					'test'			=> array(),
					'finaltest'		=> 0,
					'testvalid'		=> FALSE,
					'docvalue'		=> 'Список литературы',
					'document'		=> $this->fizunionmodel->read_course_libraries($this->user['uid'],$course,0),
					'curriculum'	=> $this->fizunionmodel->read_course_curriculum($this->user['uid'],$course,0),
					'metodical'		=> $this->fizunionmodel->read_course_metodical($this->user['uid'],$course,0),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['chapters'] = $this->chaptermodel->read_records($pagevar['course']['id']);
		
		$testday = $this->fizordersmodel->read_field($pagevar['course']['ordid'],'closedate');
		if(strtotime(date("Y-m-d")) >= strtotime($testday)):
			$pagevar['testvalid'] = TRUE;
		endif;
		for($i=0;$i<count($pagevar['chapters']);$i++):
			$pagevar['chapters'][$i]['lectures'] = $this->lecturesmodel->read_views_records($pagevar['course']['id'],$pagevar['chapters'][$i]['id']);
			$pagevar['chapters'][$i]['test'] = $this->fiztestmodel->read_records($course,$pagevar['course']['ordid'],$pagevar['chapters'][$i]['id'],$this->user['uid']);
			$pagevar['chapters'][$i]['test']['count'] = $this->testsmodel->read_field($pagevar['chapters'][$i]['test']['test'],'count');
		endfor;
		$pagevar['test'] = $this->fiztestmodel->read_records($course,$pagevar['course']['ordid'],0,$this->user['uid']);
		if(!count($pagevar['test'])):
			$pagevar['testvalid'] = FALSE;
		endif;
		$pagevar['test']['count'] = $this->testsmodel->read_field($pagevar['test']['test'],'count');

		$date_test = $this->fiztestmodel->read_field($pagevar['test']['id'],'attemptnext');
		if($date_test != '0000-00-00'):
			if($date_test == date("Y-m-d")):
				$this->fiztestmodel->reset_attempt($pagevar['test']['id']);
				$pagevar['test']['attempt'] = 0;
			else:
				$pagevar['testvalid'] = FALSE;
			endif;
		endif;
		if($pagevar['test']['attempt'] == $pagevar['test']['count']):
			$this->fiztestmodel->update_field($pagevar['test']['id'],'attemptnext',date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y"))));
			$pagevar['testvalid'] = FALSE;
		endif;
		$this->load->view("physical_interface/courses/courses-lectures",$pagevar);
	}
	
	public function testing(){
		
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к к лекциям курса.');
			redirect('physical/courses/current');
		endif;
		
		if(!$this->fizcoursemodel->read_field($course,'start')):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('physical/courses/current');
		endif;
		
		$test = $this->uri->segment(9);
		if(!$this->fiztestmodel->owner_testing($test,$course,$this->user['uid'])):
			$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
		if($this->uri->segment(7) == 'final-testing'):
			if(!$this->fiztestmodel->owner_final_testing($test,$course,$this->user['uid'])):
				$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
				redirect('physical/courses/current/course/'.$course.'/lectures');
			endif;
		endif;
		if($this->uri->segment(7) == 'testing'):
			if(!$this->fiztestmodel->owner_nonfinal_testing($test,$course,$this->user['uid'])):
				$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
				redirect('physical/courses/current/course/'.$course.'/lectures');
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Тестирование',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'course'		=> $this->fizunionmodel->read_physical_currect_course($this->user['uid'],$course,0),
					'test'			=> $this->fizunionmodel->read_physical_testing($test,$this->user['uid'],$course),
					'questions'		=> array(),
					'answers'		=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->uri->segment(7) == 'final-testing'):
			$testday = $this->fizordersmodel->read_field($pagevar['course']['ordid'],'closedate');
			if(strtotime(date('Y-m-d')) < strtotime($testday)):
				$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
				redirect('physical/courses/current/course/'.$course.'/lectures');
			endif;
			$date_test = $this->fiztestmodel->read_field($pagevar['test']['id'],'attemptnext');
			if(($date_test != '0000-00-00') && ($date_test != date("Y-m-d"))):
				$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
				redirect('physical/courses/current/course/'.$course.'/lectures');
			endif;
		endif;
		$pagevar['questions'] = $this->testquestionsmodel->read_records($pagevar['test']['test']);
		$pagevar['answers'] = $this->testanswersmodel->read_records($pagevar['test']['test']);
		
		if(!$pagevar['questions'] || !$pagevar['answers']):
			$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
		
		shuffle($pagevar['questions']);
		shuffle($pagevar['answers']);
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$ttime = $_POST['time'];
			unset($_POST['time']);
			$corranswers = $this->testanswersmodel->read_correct_answers($pagevar['test']['test']);
			$ccanswer = 0; $i = 0;
			foreach ($_POST AS $id=>$corr):
				for($i=0;$i<count($corranswers);$i++):
					if($id == $corranswers[$i]['numb']):
						if($corr == $corranswers[$i]['id']):
							$ccanswer++;
						endif;
					endif;
				endfor;
			endforeach;
			$ccanswer = round($ccanswer/count($corranswers)*100);
			$this->fiztestmodel->update_result($test,$ccanswer,round($ttime/60));
			if($ccanswer > 70):
				$this->session->set_userdata('msgs','Тест завершен!<br/>Поздравляем Вы успешно прошли тест и ответили верно на '.$ccanswer.'% вопросов.');
				if($this->uri->segment(7) == 'final-testing'):
					$this->fizcoursemodel->over_course($course,1,$ccanswer);
					$order = $this->fizcoursemodel->read_field($course,'order');
					$customer = $this->fizcoursemodel->read_field($course,'order');
					$dataresult = serialize($_POST);
					$id = $this->fiztestresultsmodel->insert_record($course,$this->user['uid'],$order,$test,$dataresult,$ccanswer);
					$this->fizcoursemodel->update_field($course,'tresid',$id);
					
					$cntcurclose = $this->fizunionmodel->count_deactive_order($order);
					$cnttotal = $this->fizcoursemodel->count_physical_by_order($order);
					if($cntcurclose == $cnttotal):
						$this->load->model('audienceordermodel');
						$allcourses = $this->fizcoursemodel->read_record_by_order($order);
						$max_aud_idnumber = $this->audienceordermodel->max_idnumber();
						$max_fiz_isnumber = $this->fizcoursemodel->max_idnumber();
						$max_idnumber = max($max_aud_idnumber,$max_fiz_isnumber);
						for($i=0;$i<count($allcourses);$i++):
							$max_idnumber++;
							$max_idnumber = str_pad($max_idnumber,6,"0",STR_PAD_LEFT);
							$this->fizcoursemodel->update_field($allcourses[$i]['id'],'idnumber',$max_idnumber);
						endfor;
						$this->load->model('ordersmodel');
						$next_aud_numbers = $this->ordersmodel->next_numbers();
						$next_fiz_numbers = $this->fizordersmodel->next_numbers();
						$next_numbers['completion'] = max($next_aud_numbers['completion'],$next_fiz_numbers['completion']);
						$next_numbers['placement'] = max($next_aud_numbers['placement'],$next_fiz_numbers['placement']);
						if(!$next_numbers['completion']):
							$next_numbers['completion'] = 1;
						endif;
						if(!$next_numbers['placement']):
							$next_numbers['placement'] = 1;
						endif;
						$year = $this->fizordersmodel->read_field($order,'year');
						$this->fizordersmodel->update_field($order,'numbercompletion',number_order($next_numbers['completion'],$year).'-О');
						$this->fizordersmodel->update_field($order,'closedate',date("Y-m-d"));
						
						ob_start();
						?>
						<p>АНО ДПО «Южно-окружной центр повышения квалификации»</p>
						<p>
							Заказ №<?=$order;?> закрылся.<br/>
							Дата закрытия: <?=date("d.m.Y");?>
						</p>
						<br/><br/>
						<p>
							Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
							Контактные данные: Тел.:(863) 246-43-54 Эл.почта: info@roscentrdpo.ru<br/>
							С уважением, Администрация Образовательного портала АНО ДПО «Южно-окружной центр повышения квалификации»
						</p>
						<?php
						$mailtext = ob_get_clean();
						$this->sendMail('info@roscentrpdo.ru','admin@roscentrdpo.ru','АНО ДПО',"Заказ №".$order." закрылся.",$mailtext);
					endif;
					redirect('physical/courses/completed');
				endif;
			else:
				$this->session->set_userdata('msgr','Тест не завершен!<br/>Вы не прошли тест и ответили верно только на '.$ccanswer.'% вопросов.');
			endif;
			redirect('physical/courses/current/course/'.$this->uri->segment(5).'/lectures');
		endif;
		$this->load->view("physical_interface/courses/testing",$pagevar);
	}
	
	public function courses_lecture(){
		
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('physical/courses/current');
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'lecture'		=> $this->lecturesmodel->read_record($this->uri->segment(7)),
					'course'		=> $this->fizunionmodel->read_physical_currect_course($this->user['uid'],$course,0),
					'file_exist'	=> TRUE,
					'filesize'		=> 'Размер не определен',
					'filename'		=> 'Имя не определено. Возможно файл отсутствует на диске или не доступен',
					'fileextension'	=> 'Hасширение не определено',
					'docvalue'		=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['title'] .= 'Содержание курса "'.$pagevar['course']['code'].'. '.$pagevar['course']['title'].'"';
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');

		$file = getcwd().'/'.$pagevar['lecture']['document'];
		$pagevar['document'] = $pagevar['lecture']['document'];
		$pagevar['docvalue'] = $pagevar['lecture']['title'];
		if(file_exists($file)):
			$pagevar['filesize'] = filesize($file);
			$fileexp = explode('/',$pagevar['lecture']['document']);
			if($fileexp && isset($fileexp[2])):
				$pagevar['filename'] = $fileexp[2];
				$fileextension = explode('.',$pagevar['filename']);
				$pagevar['fileextension'] = $fileextension[1];
			endif;
		else:
			$pagevar['file_exist'] = FALSE;
			$pagevar['msgr'] = 'Не возможно получить доступ к лекции. Возможно файл отсутствует на диске или не доступен.';
		endif;
		
		if(is_numeric($pagevar['filesize']) && $pagevar['filesize'] > 1048576):
			$pagevar['filesize'] = round($pagevar['filesize']/1048576,2).' Мбайт';
		elseif(is_numeric($pagevar['filesize']) && $pagevar['filesize'] > 1024):
			$pagevar['filesize'] = round($pagevar['filesize']/1024,1).' кбайт';
		elseif(is_numeric($pagevar['filesize']) && $pagevar['filesize'] < 1024):
			$pagevar['filesize'] = $pagevar['filesize'].' байт';
		endif;
		
		$this->load->view("physical_interface/courses/lecture-card",$pagevar);
	}
	
	public function get_document(){
		
		$lecture = $this->uri->segment(7);
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекции курса.');
			redirect('physical/courses/current');
		endif;
		$this->load->helper('download');
		$file = getcwd().'/'.$this->lecturesmodel->read_field($lecture,'document');
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке лекции.<br/>Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lecture/'.$lecture);
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->lecturesmodel->read_field($lecture,'document'));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке лекции. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lecture/'.$lecture);
		endif;
	}
	
	public function get_libraries(){
		
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к списку литературы курса.');
			redirect('physical/courses/current');
		endif;
		
		$this->load->helper('download');
		$file = getcwd().'/'.$this->fizunionmodel->read_course_libraries($this->user['uid'],$course,0);
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке списка литературы.<br/>Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->fizunionmodel->read_course_libraries($this->user['uid'],$course,0));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке списка литературы. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
	}
	
	public function get_curriculum(){
		
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к учебному плану курса.');
			redirect('physical/courses/current');
		endif;
		
		$this->load->helper('download');
		$file = getcwd().'/'.$this->fizunionmodel->read_course_curriculum($this->user['uid'],$course,0);
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке учебного плана.<br/>Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->fizunionmodel->read_course_curriculum($this->user['uid'],$course,0));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке учебного плана. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
	}
	
	public function get_metodical(){
		
		$course = $this->uri->segment(5);
		if(!$this->fizcoursemodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к учебному плану курса.');
			redirect('physical/courses/current');
		endif;
		
		$this->load->helper('download');
		$file = getcwd().'/'.$this->fizunionmodel->read_course_metodical($this->user['uid'],$course,0);
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке методических рекомендаций.<br/>Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->fizunionmodel->read_course_metodical($this->user['uid'],$course,0));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке методических рекомендаций. Обратитесь к администрации сайта.');
			redirect('physical/courses/current/course/'.$course.'/lectures');
		endif;
	}
	
	/******************************************************************************************************************/
	
	public function randomPassword($length,$allow="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ0123456789"){
	
		$i = 1;
		$ret = '';
		while($i<=$length):
			$max   = strlen($allow)-1;
			$num   = rand(0, $max);
			$temp  = substr($allow, $num, 1);
			$ret  .= $temp;
			$i++;
		endwhile;
		return $ret;
	}

	function operation_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 г."; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_dot_date($field){
			
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5.$3.\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
}