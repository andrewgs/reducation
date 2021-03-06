<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_interface extends MY_Controller{

	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'','fullname'=>'');
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('customersmodel');
		$this->load->model('audiencemodel');
		$this->load->model('trendsmodel');
		$this->load->model('coursesmodel');
		$this->load->model('chaptermodel');
		$this->load->model('lecturesmodel');
		$this->load->model('testsmodel');
		$this->load->model('testquestionsmodel');
		$this->load->model('testanswersmodel');
		$this->load->model('unionmodel');
		$this->load->model('ordersmodel');
		$this->load->model('fizordersmodel');
		$this->load->model('courseordermodel');
		$this->load->model('audienceordermodel');
		$this->load->model('calendarmodel');
		
		if($this->session->userdata('logon') !== FALSE):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				if($this->session->userdata('utype') != 'zak'):
					redirect('');
				endif;
				$userinfo = $this->customersmodel->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= '';
					$this->user['utype'] 			= $this->session->userdata('utype');
					$this->user['fullname']			= $userinfo['organization'];
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
					'audience'		=> $this->audiencemodel->count_audience($this->user['uid']),
					'orders'		=> $this->ordersmodel->count_orders($this->user['uid']),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("customer_interface/customer-start-page",$pagevar);
	}
	
	public function customer_profile(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Профиль заказчика',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> $this->customersmodel->read_record($this->user['uid']),
					'readonly'		=> FALSE,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if(count($this->ordersmodel->read_customer_record($this->user['uid']))):
			$pagevar['readonly'] = TRUE;
		endif;
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('organization',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('kpp',' ','required|trim');
			$this->form_validation->set_rules('accountnumber',' ','required|trim');
			$this->form_validation->set_rules('bank',' ','required|trim');
			$this->form_validation->set_rules('accountkornumber',' ','required|trim');
			$this->form_validation->set_rules('bik',' ','required|trim');
			$this->form_validation->set_rules('uraddress',' ','required|trim');
			$this->form_validation->set_rules('postaddress',' ','required|trim');
			$this->form_validation->set_rules('personemail',' ','required|valid_email|trim');
			$this->form_validation->set_rules('person',' ','required|trim');
			$this->form_validation->set_rules('manager',' ','required|trim');
			$this->form_validation->set_rules('fiomanager',' ','required|trim');
			$this->form_validation->set_rules('statutory',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$this->customersmodel->update_record($this->user['uid'],$_POST);
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		$this->load->view("customer_interface/customer-profile",$pagevar);
	}
	
	public function audience_list(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Список слушателей',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'audience'		=> $this->audiencemodel->read_customer_record($this->user['uid']),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("customer_interface/customer-audience-list",$pagevar);
	}
	
	public function orders_list(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои заказы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'orders'		=> $this->ordersmodel->read_customer_record($this->user['uid']),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
		endfor;
		$this->load->view("customer_interface/customer-orders-list",$pagevar);
	}
	
	public function orders_order_information(){
	
		$order = $this->uri->segment(6);
		if($this->ordersmodel->owner_order_nonfinish($order,$this->user['uid'])):
			$optRadio = $this->ordersmodel->read_field($order,'trend');
			$this->session->set_userdata(array('regordering'=>TRUE,'step'=>2,'ordering'=>$optRadio,'order'=>$order));
			redirect('customer/registration/ordering/step/2');
		elseif(!$this->ordersmodel->owner_order_finish($order,$this->user['uid'])):
			$this->session->set_userdata('msgr','Заказ отсутствует или удален.');
			redirect('customer/audience/orders');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои заказы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'order'			=> $this->ordersmodel->read_record($order),
					'course'		=> $this->unionmodel->read_corder_records($order),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['course']);$i++):
			$pagevar['course'][$i]['caud'] = $this->audienceordermodel->count_course_record($pagevar['course'][$i]['id']);
			$pagevar['course'][$i]['price'] = $pagevar['course'][$i]['price']-$pagevar['course'][$i]['discount'];
			$pagevar['course'][$i]['tprice'] = $pagevar['course'][$i]['price']*$pagevar['course'][$i]['caud'];
			$pagevar['course'][$i]['audience'] = $this->unionmodel->audience_course($pagevar['course'][$i]['id']);
			for($j=0;$j<count($pagevar['course'][$i]['audience']);$j++):
				$pagevar['course'][$i]['audience'][$j]['dateover'] = $this->operation_dot_date($pagevar['course'][$i]['audience'][$j]['dateover']);
			endfor;
		endfor;
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		
		$this->load->view("customer_interface/customer-order-information",$pagevar);
	}
	
	public function orders_order_invoice(){
		
		if(!$this->ordersmodel->owner_order_finish($this->uri->segment(6),$this->user['uid'])):
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
				'order'			=> $this->ordersmodel->read_record($this->uri->segment(6)),
				'course'		=> $this->unionmodel->read_corder_group_records($this->uri->segment(6)),
				'customer'		=> array(),
				'msgs'			=> $this->session->userdata('msgs'),
				'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->customersmodel->read_record($pagevar['order']['customer']);
		$pagevar['title'] .= 'Счет на оплату № '.number_order($pagevar['order']['number'],$pagevar['order']['year']).' от '.$pagevar['order']['orderdate'].' года';
		$this->load->view("customer_interface/customer-order-invoice",$pagevar);
	}
	
	public function orders_order_contract(){
		
		if(!$this->ordersmodel->owner_order_finish($this->uri->segment(6),$this->user['uid'])):
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
					'order'			=> $this->ordersmodel->read_record($this->uri->segment(6)),
					'course'		=> $this->unionmodel->read_corder_group_records($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['order']['date'] = $pagevar['order']['orderdate'];
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->customersmodel->read_record($pagevar['order']['customer']);
		$pagevar['title'] .= 'Договор № '.number_order($pagevar['order']['number'],$pagevar['order']['year']).' от '.$pagevar['order']['orderdate'].' года';
		$this->load->view("customer_interface/customer-order-contract",$pagevar);
	}
	
	public function orders_order_act(){
		
		if(!$this->ordersmodel->owner_order_finish($this->uri->segment(6),$this->user['uid'])):
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
					'order'			=> $this->ordersmodel->read_record($this->uri->segment(6)),
					'course'		=> $this->unionmodel->read_corder_group_records($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if(!$pagevar['order']['numbercompletion']):
			show_404();
		endif;
		$pagevar['order']['date'] = $pagevar['order']['orderdate'];
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		if($pagevar['order']['closedate'] != "0000-00-00"):
			$pagevar['order']['closedate'] = $this->operation_date($pagevar['order']['closedate']);
		else:
			$pagevar['order']['closedate'] = nbs(20).date("Y").' г.';
		endif;
		$pagevar['customer'] = $this->customersmodel->read_record($pagevar['order']['customer']);
		$pagevar['title'] .= 'АКТ об оказании услуг по договору № '.number_order($pagevar['order']['number'],$pagevar['order']['year']).' от '.$pagevar['order']['orderdate'].' года';
		
		$this->load->view("customer_interface/customer-order-act",$pagevar);
	}
	
	public function orders_delete_order(){
	
		$order = $this->uri->segment(5);
		if($order):
			$this->ordersmodel->update_field($order,'deleted',1);
			$this->session->set_userdata('msgs','Заказ удален.');
		else:
			$this->session->set_userdata('msgr','Заказ не удален.');
		endif;
		redirect('customer/audience/orders');
	}
	
	public function registration_audience(){
		
		$pagevar = array(
			'description'	=> '',
			'author'		=> '',
			'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Регистрация слушателей',
			'baseurl' 		=> base_url(),
			'loginstatus'	=> $this->loginstatus,
			'userinfo'		=> $this->user,
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('lastname',' ','required|trim');
			$this->form_validation->set_rules('name',' ','required|trim');
			$this->form_validation->set_rules('middlename',' ','required|trim');
			$this->form_validation->set_rules('fiodat',' ','required|trim');
			$this->form_validation->set_rules('position',' ','required|trim');
			$this->form_validation->set_rules('address',' ','required|trim');
			$this->form_validation->set_rules('personaemail',' ','required|valid_email|trim');
			$this->form_validation->set_rules('personaphone',' ','required|trim');
			$this->form_validation->set_rules('graduated',' ','required|trim');
			$this->form_validation->set_rules('year',' ','required|trim');
			$this->form_validation->set_rules('typedocument',' ','required|trim');
			$this->form_validation->set_rules('documentnumber',' ','required|trim');
			$this->form_validation->set_rules('specialty',' ','required|trim');
			$this->form_validation->set_rules('qualification',' ','required|trim');
			if($this->form_validation->run() == FALSE):
				$this->session->set_userdata('msgr','Ошибка. Повторите ввод.');
			else:
				$id = $this->audiencemodel->insert_record($this->user['uid'],$_POST);
				$login = 'slu_'.$id;
				$password = $this->randomPassword(8);
				$this->audiencemodel->update_field($id,'login',$login);
				$this->audiencemodel->update_field($id,'password',md5($password));
				$this->audiencemodel->update_field($id,'cryptpassword',$this->encrypt->encode($password));
				ob_start();
				?>
				<img src="<?=base_url('img/logo_small.png')?>" alt="" /><br/>
				<?=anchor('','roscentrdpo.ru');?>
				<p>Система дистанционного обучения АНО ДПО «Южно-окружной центр повышения квалификации»</p>
				<p>Здравствуйте, <?=$_POST['lastname'].' '.$_POST['name'].' '.$_POST['middlename'];?></p>
				<p>
					Поздравляем! Вас успешно зарегистрировали в статусе слушателя на Образовательном портале 
					АНО ДПО «Южно-окружной центр повышения квалификации»<br/>
					Обучение будет осуществляться через личный кабинет.<br/>
					Для входа в личный кабинет используйте присвоенные вам логин и пароль.
				</p>
				<p><strong>Логин: <span style="font-size: 18px;"><?=$login;?></span> Пароль: <span style="font-size: 18px;"><?=$password;?></span></strong></p>
				<br/><br/>
				<p>
					Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
					Контактные данные: Тел.:(863) 246-43-54 Эл.почта: info@roscentrdpo.ru<br/>
					С уважением, Администрация Образовательного портала АНО ДПО «Южно-окружной центр повышения квалификации»
				</p>
				<?
				$mailtext = ob_get_clean();
				$this->sendMail($_POST['personaemail'],'info@roscentrdpo.ru','АНО ДПО','Данные для доступа к личному кабинету',$mailtext);
				$this->session->set_userdata('msgs','Слушатель зарегистрирован.<br/>Вы можете зарегистрировать еще слушателя или приступить к оформлению заказа.<br/>Для этого необходимо перейти по ссылке '.anchor("customer/registration/ordering",'"Оформление заказа"'));
			endif;
			redirect(uri_string().'?register=successful');
		endif;
		
		$this->load->view("customer_interface/registration-audience",$pagevar);
	}
	
	public function registration_ordering(){
		
		if($this->session->userdata('regordering')):
			redirect('customer/registration/ordering/step/'.$this->session->userdata('step'));
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
		
		$this->load->view("customer_interface/ordering/registration-ordering",$pagevar);
	}
	
	public function registration_ordering_step1(){
		
		if($this->session->userdata('step')):
			if($this->session->userdata('step') != 1):
				redirect('customer/registration/ordering/step/'.$this->session->userdata('step'));
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
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('optRadio',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не указано направление обучения.');
			else:
				$ur_id = $this->ordersmodel->next_order();
				$fiz_id = $this->fizordersmodel->next_order();
				$order_id = max($ur_id,$fiz_id);
				if($order_id):
					$this->session->set_userdata('msgs','Направление обучения выбрано.');
					$order = $this->ordersmodel->insert_record($order_id,$_POST['optRadio'],$this->user['uid']);
					$this->session->set_userdata(array('regordering'=>TRUE,'step'=>2,'ordering'=>$_POST['optRadio'],'order'=>$order));
				else:
					$this->session->set_userdata('msgr','Ошибка. Невозможно создать заказ.');
					redirect($this->uri->uri_string());
				endif;
			endif;
			redirect('customer/registration/ordering/step/2');
		endif;
		
		$this->load->view("customer_interface/ordering/registration-ordering-step1",$pagevar);
	}
	
	public function registration_ordering_step2(){
		
		if(!$this->session->userdata('regordering')):
			redirect('customer/registration/ordering');
		endif;
		if($this->session->userdata('step')):
			if($this->session->userdata('step') != 2):
				redirect('customer/registration/ordering/step/'.$this->session->userdata('step'));
			endif;
		endif;
		$pagevar = array(
			'description'	=> '',
			'author'		=> '',
			'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Оформление заказа - Выбор направления обучения - Шаг 2',
			'baseurl' 		=> base_url(),
			'loginstatus'	=> $this->loginstatus,
			'userinfo'		=> $this->user,
			'price'			=> $this->ordersmodel->read_field($this->session->userdata('order'),'price'),
			'courses'		=> $this->coursesmodel->read_trend_records($this->session->userdata('ordering')),
			'courseorder'	=> $this->unionmodel->read_corder_records($this->session->userdata('order')),
			'courseaudience'=> $this->unionmodel->read_caudience_records($this->session->userdata('order')),
			'audience'		=> $this->audiencemodel->read_view_record($this->user['uid']),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('course[]',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не указан курс обучения.');
			else:
				for($i=0;$i<count($_POST['course']);$i++):
					if($course = $this->coursesmodel->read_record($_POST['course'][$i],array('view'=>1))):
						if(!$this->courseordermodel->exist_course_order($_POST['course'][$i],$this->session->userdata('order'),$this->user['uid'])):
							$corder = $this->courseordermodel->insert_record($this->session->userdata('order'),$_POST['course'][$i],$this->user['uid'],$course['price']);
							$this->session->set_userdata('msgs','Курсы обучения добавлены в заказ.');
						endif;
					endif;
				endfor;
			endif;
			redirect(uri_string());
		endif;
		if($this->input->post('ssubmit')):
			$_POST['ssubmit'] = NULL;
			$this->form_validation->set_rules('idcur',' ','required|trim');
			$this->form_validation->set_rules('audience[]',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не указаны слушатели.');
			else:
				$price = 0;
				if(count($_POST['audience']) > 0):
					for($i=0,$cnt=0;$i<count($_POST['audience']);$i++):
						if(!$this->audienceordermodel->exist_course_audience($_POST['audience'][$i],$_POST['idcur'],$this->session->userdata('order'),$this->user['uid'])):
							$this->audienceordermodel->insert_record($_POST['idcur'],$_POST['audience'][$i],$this->session->userdata('order'),$this->user['uid']);
							$this->session->set_userdata('msgs','Слушатели добавлены успешно.');
							$cnt++;
						else:
							$this->session->set_userdata('msgr','Ошибка. Указанные слушатели уже прикреплены к данному курсу');
						endif;
					endfor;
				endif;
				$course = $this->courseordermodel->read_field($_POST['idcur'],'course');
				$price = $this->coursesmodel->read_field($course,'price')*$cnt;
				$this->ordersmodel->add_price($this->session->userdata('order'),$price);
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("customer_interface/ordering/registration-ordering-step2",$pagevar);
	}
	
	public function registration_ordering_step3(){
		
		if(!$this->session->userdata('regordering')):
			redirect('customer/registration/ordering');
		endif;
		$aud = $this->audienceordermodel->count_order_record($this->session->userdata('order'));
		if($aud == 0):
			redirect('customer/registration/ordering/step/'.$this->session->userdata('step'));
		endif;
		
		$validcourse = $this->unionmodel->valid_empty_course($this->session->userdata('order'));
		for($i=0;$i<count($validcourse);$i++):
			if($validcourse[$i]['cnt'] == 0):
				$this->session->set_userdata('msgr','Вами выбраны курсы на которые не назначены слушатели');
				redirect('customer/registration/ordering/step/'.$this->session->userdata('step'));
			endif;
		endfor;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Оформление заказа - Выбор направления обучения - Шаг 3',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'order'			=> $this->trendsmodel->read_field($this->session->userdata('ordering'),'title'),
					'price'			=> $this->ordersmodel->read_field($this->session->userdata('order'),'price'),
					'courses'		=> $this->unionmodel->read_courseorder_title($this->session->userdata('order')),
					'corder'		=> $this->courseordermodel->read_order_records($this->session->userdata('order')),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['corder']);$i++):
			$pagevar['courses'][$i]['audience'] = $this->audienceordermodel->count_course_record($pagevar['corder'][$i]['id']);
		endfor;
		
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->session->set_userdata('msgs','Заказ оформлен.');
			$this->ordersmodel->close_order($this->session->userdata('order'));
			$order = $this->session->userdata('order');
			$this->session->unset_userdata(array('regordering'=>'','step'=>'','ordering'=>'','order'=>''));
			redirect('customer/audience/orders/order-information/id/'.$order);
		endif;
		
		$this->load->view("customer_interface/ordering/registration-ordering-step3",$pagevar);
	}
	
	public function registration_delete_course(){
		
		$ccourse = $this->uri->segment(7);
		if($ccourse):
			if(!$this->courseordermodel->owner_corder($ccourse,$this->user['uid'])):
				$this->session->set_userdata('msgr','Курс не отменен.');
				redirect('customer/registration/ordering/step/2');
			endif;
			$course = $this->courseordermodel->read_field($ccourse,'course');
			$result = $this->courseordermodel->delete_record($ccourse);
			if($result):
				$audience = $this->audienceordermodel->delete_records($ccourse);
				$price = $this->coursesmodel->read_field($course,'price')*$audience;
				$this->ordersmodel->sub_price($this->session->userdata('order'),$price);
				$this->session->set_userdata('msgs','Курс отменен успешно.');
			else:
				$this->session->set_userdata('msgr','Курс не отменен.');
			endif;
			redirect('customer/registration/ordering/step/2');
		else:
			show_404();
		endif;
	}
	
	public function registration_delete_audience(){
		
		$ccourse = $this->uri->segment(7);
		$caudience = $this->uri->segment(9);
		if($caudience || $ccourse):
			if(!$this->audienceordermodel->owner_acorder($caudience,$ccourse,$this->user['uid'])):
				$this->session->set_userdata('msgr','Слушатель с заказа не удален.');
				redirect('customer/registration/ordering/step/2');
			endif;
			$result = $this->audienceordermodel->delete_record($caudience);
			if($result):
				$course = $this->courseordermodel->read_field($ccourse,'course');
				$price = $this->coursesmodel->read_field($course,'price');
				$this->ordersmodel->sub_price($this->session->userdata('order'),$price);
				$this->session->set_userdata('msgs','Слушатель удален с заказа.');
			else:
				$this->session->set_userdata('msgr','Слушатель с заказа не удален.');
			endif;
			redirect('customer/registration/ordering/step/2');
		else:
			show_404();
		endif;
	}
	
	public function registration_ordering_cancel(){
		
		$this->session->set_userdata('msgs','Заказ отменен.');
		$this->ordersmodel->update_field($this->session->userdata('order'),'deleted',1);
//		$this->audienceordermodel->delete_order_records($this->session->userdata('order'));
//		$this->courseordermodel->delete_order($this->session->userdata('order'));
//		$this->ordersmodel->delete_record($this->session->userdata('order'));
//		$maxrecid = $this->ordersmodel->last_id();
//		$this->ordersmodel->set_autoincrement($maxrecid+1);
		$this->session->unset_userdata(array('regordering'=>'','step'=>'','ordering'=>'','order'=>''));
		redirect('customer/registration/ordering');
	}
	
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