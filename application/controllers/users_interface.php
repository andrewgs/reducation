<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends CI_Controller{
	
	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'','fullname'=>'');
	var $loginstatus = array('zak'=>FALSE,'slu'=>FALSE,'adm'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('adminmodel');
		$this->load->model('customersmodel');
		$this->load->model('trendsmodel');
		$this->load->model('coursesmodel');
		$this->load->model('audiencemodel');
		$this->load->model('audienceordermodel');
		
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$model = $this->definition_model($this->session->userdata('utype'));
				$userinfo = $this->$model->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= '';
					$this->user['utype'] 			= $this->session->userdata('utype');
					switch ($this->user['utype']):
						case 'zak': $this->user['fullname'] = $userinfo['organization'];
									break;
						case 'slu': $this->user['fullname'] = $this->audiencemodel->read_full_name($this->user['uid']);
									break;
						case 'adm': $this->user['fullname'] = 'Администратор';
									break;
					endswitch;
					$this->loginstatus['status'] 	= TRUE;
					$this->loginstatus[$this->user['utype']] = TRUE;
				endif;
			endif;
			
			if($this->session->userdata('logon') != md5($userinfo['login'])):
				$this->loginstatus['status'] = FALSE;
				$this->user = array();
			endif;
		endif;
	}
	
	public function index(){
		
		$pagevar = array(
			'title'			=> 'Повышение квалификации и переподготовка кадров | Дистанционное обучение | Ростов, Краснодар, Ставрополь, Сочи, Пятигорск, Астрахань, Волгоград',
			'description'	=> 'Учебный центр по повышению квалификации кадров в сфере строительства, проектирования, инженерных изысканий, коммунального хозяйства и энергетического менеджмента. Курсы, дистанционное обучение, переподготовка. После окончания обучения  выдается удостоверение о повышении квалификации.',
			'author'		=> '',					
			'baseurl' 		=> base_url(),
			'loginstatus'	=> $this->loginstatus,
			'userinfo'		=> $this->user,
			'newcourses'	=> $this->coursesmodel->read_new_courses(3),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr'),
			'msgauth'		=> $this->session->userdata('msgauth')
		);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('lsubmit')):
			$login = trim($this->input->post('login'));
			$pass = trim($this->input->post('password'));
			if(!$login || !$pass):
				$this->session->set_userdata('msgauth','Ошибка. Не заполены необходимые поля.');
				redirect($_SERVER['HTTP_REFERER']);
			else:
				$utype = substr(strtolower($login),0,3);
				switch ($utype):
					case 'zak':  
								$user = $this->customersmodel->auth_user($login,$pass);
								if(!$user):
									$this->session->set_userdata('msgauth','Не верные данные для авторизации.<br/>В доступе отказано.');
									redirect($_SERVER['HTTP_REFERER']);
								endif;
                   				$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id'],'utype'=>'zak'));
								$this->customersmodel->active_user($this->session->userdata('userid'));
                   				redirect($_SERVER['HTTP_REFERER']);
								break;
					case 'slu': 
								$user = $this->audiencemodel->auth_user($login,$pass);
								if(!$user):
									$this->session->set_userdata('msgauth','Не верные данные для авторизации.<br/>В доступе отказано.');
									redirect($_SERVER['HTTP_REFERER']);
								endif;
                   				$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id'],'utype'=>'slu'));
								$this->audiencemodel->active_user($this->session->userdata('userid'));
                   				redirect($_SERVER['HTTP_REFERER']);
								break;
					default : 
								$this->session->set_userdata('msgauth','Не верные данные для авторизации.');
								redirect($_SERVER['HTTP_REFERER']);break;
				endswitch;
				exit; 
			endif;
		endif;
		$this->load->view("users_interface/index",$pagevar);
	}
	
	public function information(){
		
		$pagevar = array(
			'title'			=> 'Повышение квалификации Ростов, Астрахань, Волгоград | Курсы повышения квалификации инженеров, проектировщиков, строителей, энергетиков | Дистанционное обучение',					
			'description'	=> 'Учебный центр по повышению квалификации кадров в сфере строительства, проектирования, инженерных изысканий, коммунального хозяйства и энергетического менеджмента. После окончания обучения выдается удостоверение о повышении квалификации.',
			'author'		=> '',
			'baseurl' 		=> base_url(),
			'loginstatus'	=> $this->loginstatus,
			'userinfo'		=> $this->user,
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr'),
			'msgauth'		=> $this->session->userdata('msgauth')
		);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("users_interface/information",$pagevar);
	}
	
	public function admin_login(){
	
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Панель администрирования',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus['status'],
					'userinfo'		=> $this->user,
					'form_title'	=> 'Введите логин и пароль для входа в панель администрирования',
					'msg'			=> $this->session->userdata('msg')
			);
		$this->session->unset_userdata('msg');
		if($this->input->post('submit')):
			$_POST['submit'] == NULL;
			$userinfo = $this->adminmodel->auth_user($this->input->post('login'),$this->input->post('password'));
			if(!$userinfo):
				$this->session->set_userdata('msg','Имя пользователя и пароль не совпадают');
				redirect($this->uri->uri_string());
			else:
				$session_data = array('logon'=>md5($userinfo['login']),'userid'=>$userinfo['id'],'utype'=>'adm');
				$this->adminmodel->active_user($userinfo['id']);
                $this->session->set_userdata($session_data);
                redirect("admin-panel/actions/control");
			endif;
		endif;
		if($this->loginstatus['status']):
			if($this->loginstatus['adm']):
				redirect('admin-panel/actions/control');
			elseif($this->loginstatus['zak']):
				redirect('');
			elseif($this->loginstatus['slu']):
				redirect('');
			endif;
		endif;
		$this->load->view("users_interface/admin-login",$pagevar);
	}
	
	public function logoff(){
		
		$model = $this->definition_model($this->session->userdata('utype'));
		$this->$model->deactive_user($this->session->userdata('userid'));
		$this->session->sess_destroy();
		redirect('');
	}
	
	public function password_restore(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr'),
					'msgauth'		=> $this->session->userdata('msgauth')
			);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			$_POST['submit'] == NULL;
			$this->form_validation->set_rules('email',' ','required|valid_email|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка не верно заполнены необходимые поля.');
			else:
				switch ($_POST['usertype']):
					case 'zak':  
								$user = $this->customersmodel->read_email_records($_POST['email']);
								if(!$user):
									$this->session->set_userdata('msgr','Указанный E-mail не найден.');
									redirect($this->uri->uri_string());
								endif;
								if(count($user)>1):
									$this->session->set_userdata('msgr','Ошибка. Обратитесь к администрации сайта');
									redirect($this->uri->uri_string());
								endif;
								$name = $user[0]['organization'];
								break;
					case 'slu': 
								$user = $this->audiencemodel->read_email_records($_POST['email']);
								if(!$user):
									$this->session->set_userdata('msgr','Указанный E-mail не найден.');
									redirect($this->uri->uri_string());
								endif;
								if(count($user)>1):
									$this->session->set_userdata('msgr','Ошибка. Обратитесь к администрации сайта');
									redirect($this->uri->uri_string());
								endif;
								$name = $user[0]['lastname'].' '.$user[0]['name'].' '.$user[0]['middlename'];
								break;
					default : 
								$this->session->set_userdata('msgauth','Ошибка. Обратитесь к администрации сайта');
								redirect($this->uri->uri_string());break;
				endswitch;
				if(count($user)):
					$email = $_POST['email'];
					$login = $user[0]['login'];
					$password = $this->encrypt->decode($user[0]['cryptpassword']);
					ob_start();
					?>
					<p><strong>Здравствуйте,  <?=$name;?></strong></p>
					<p>Вами был произведен запрос на восстановления данных для аторизации:</p>
					<p><strong>Логин: <span style="font-size: 18px;"><?=$login;?></span> Пароль: <span style="font-size: 18px;"><?=$password;?></span></strong></p>
					<p>Желаем Вам удачи!</p> 
					<?
					$mailtext = ob_get_clean();
					
					$this->email->clear(TRUE);
					$config['smtp_host'] = 'localhost';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					
					$this->email->initialize($config);
					$this->email->to($email);
					$this->email->from('admin@roscentrdpo.ru','АНО ДПО');
					$this->email->bcc('');
					$this->email->subject('Данные для доступа к личному кабинету');
					$this->email->message($mailtext);	
					$this->email->send();
				endif;
				$this->session->set_userdata('msgs','На адрес '.$email.' высланы логин и пароль.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("users_interface/password_restore",$pagevar);
	}
	
	public function registration_customer(){
		
		$pagevar = array(
			'title'			=> 'Оформление заявки на повышение квалификации | Дистанционное обучение | Удаленное образование',
			'description'	=> 'Для оформления заявки необходимо пройти систему регистрации. Учебный центр по повышению квалификации кадров в сфере строительства, проектирования, инженерных изысканий, коммунального хозяйства и энергетического менеджмента.',
			'author'		=> '',
			'baseurl' 		=> base_url(),
			'loginstatus'	=> $this->loginstatus,
			'userinfo'		=> $this->user,
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr'),
			'msgauth'		=> $this->session->userdata('msgauth')
		);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("users_interface/registration/begin-registration",$pagevar);
		
	}
	
	public function registration_customer_step_1(){
		
		if($this->session->userdata('logon')):
			$this->session->set_userdata('msgr','Авторизованные пользователи не могут оформлять заявки на регистрацию');
			redirect('registration/customer');
		endif;
		
		$pagevar = array(
				'title'			=> 'Шаг 1. Оформление заявки на дистанционное образование. ',
				'description'	=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров. Оформление заявки на дистанционное образование. Шаг 1.',
				'author'		=> '',
				'baseurl' 		=> base_url(),
				'loginstatus'	=> $this->loginstatus,
				'userinfo'		=> $this->user,
				'msgs'			=> $this->session->userdata('msgs'),
				'msgr'			=> $this->session->userdata('msgr'),
				'msgauth'		=> $this->session->userdata('msgauth')
		);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
	
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('organization',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('kpp',' ','required|trim');
			$this->form_validation->set_rules('accounttype',' ','required|trim');
			$this->form_validation->set_rules('accountnumber',' ','required|trim');
			$this->form_validation->set_rules('bank',' ','required|trim');
			$this->form_validation->set_rules('accountkornumber',' ','required|trim');
			$this->form_validation->set_rules('bik',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$this->session->set_userdata(array('regcustomer'=>TRUE,'step'=>2,'organization'=>htmlspecialchars($_POST['organization']),'inn'=>$_POST['inn'],'kpp'=>$_POST['kpp'],'accounttype'=>$_POST['accounttype'],'accountnumber'=>$_POST['accountnumber'],'bank'=>htmlspecialchars($_POST['bank']),'accountkornumber'=>$_POST['accountkornumber'],'bik'=>$_POST['bik'],'manager'=>htmlspecialchars($_POST['manager']),'fiomanager'=>htmlspecialchars($_POST['fiomanager']),'statutory'=>htmlspecialchars($_POST['statutory'])));
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect('registration/customer/step/2');
		endif;
		$this->load->view("users_interface/registration/begin-registration-step-1",$pagevar);
	}
	
	public function registration_customer_step_2(){
	
		if(!$this->session->userdata('regcustomer')):
			redirect('registration/customer');
		endif;
		if($this->session->userdata('logon')):
			$this->session->set_userdata('msgr','Авторизованные пользователи не могут оформлять заявки на регистрацию');
			redirect('registration/customer');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr'),
					'msgauth'		=> $this->session->userdata('msgauth')
			);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
	
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('uraddress',' ','required|trim');
			$this->form_validation->set_rules('postaddress',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$this->session->set_userdata(array('regcustomer'=>TRUE,'step'=>3,'uraddress'=>strip_tags($_POST['uraddress']),'postaddress'=>strip_tags($_POST['postaddress'])));
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect('registration/customer/step/3');
		endif;
		$this->load->view("users_interface/registration/begin-registration-step-2",$pagevar);
	}
	
	public function registration_customer_step_3(){
		
		if(!$this->session->userdata('regcustomer')):
			redirect('registration/customer');
		endif;
		if($this->session->userdata('logon')):
			$this->session->set_userdata('msgr','Авторизованные пользователи не могут оформлять заявки на регистрацию');
			redirect('registration/customer');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr'),
					'msgauth'		=> $this->session->userdata('msgauth')
			);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
	
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('personemail',' ','required|valid_email|trim');
			$this->form_validation->set_rules('person',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$user = $this->customersmodel->read_email_records($_POST['personemail']);
				if($user):
					$this->session->set_userdata('msgr','Внимание. E-mail: '.$_POST['personemail'].' уже существует!');
//					redirect($this->uri->uri_string());
				endif;
				$this->session->set_userdata(array('regcustomer'=>TRUE,'step'=>4,'personemail'=>$_POST['personemail'],'person'=>htmlspecialchars($_POST['person']),'phones'=>htmlspecialchars($_POST['phones'])));
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect('registration/customer/step/4');
		endif;
		$this->load->view("users_interface/registration/begin-registration-step-3",$pagevar);
	}

	public function registration_customer_step_4(){
	
		$finish = $this->session->userdata('finishregcustomer');
		if(!$finish):
			if(!$this->session->userdata('regcustomer')):
				redirect('registration/customer');
			endif;
		endif;
		if($this->session->userdata('logon')):
			$this->session->set_userdata('msgr','Авторизованные пользователи не могут оформлять заявки на регистрацию');
			redirect('registration/customer');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr'),
					'finishreg'		=> $this->session->userdata('finishregcustomer'),
					'msgauth'		=> $this->session->userdata('msgauth')
			);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$customer = $this->session->all_userdata();
			$id = $this->customersmodel->insert_record($customer);
			$login = 'zak_'.$id;
			$password = $this->randomPassword(8);
			$this->session->set_userdata('cuslogin',$login);
			$this->session->set_userdata('cuspassword',$password);
			$this->customersmodel->update_field($id,'login',$login);
			$this->customersmodel->update_field($id,'password',md5($password));
			$this->customersmodel->update_field($id,'cryptpassword',$this->encrypt->encode($password));
			
			$email = $this->session->userdata('personemail');
			ob_start();
			?>
			<p><strong>Здравствуйте,  <?=$this->session->userdata('organization');?></strong></p>
			<p>Поздравляем! Вы успешно завершили оформление заявки. Вам доступны следующие документы:</p>
			<ol>
				<li>Счёт</li>
				<li>Договор на оказание образовательных услуг</li>
			</ol>
			<p>
				После оплаты заказа мы оформим весь пакет документов, а слушатели будут зачислены на обучение. 
				Обучение будет осуществляться через личный кабинет слушателя. Для входа в личный кабинет используйте 
				созданный для вас логин и пароль.
			</p>
			<p><strong>Логин: <span style="font-size: 18px;"><?=$login;?></span> Пароль: <span style="font-size: 18px;"><?=$password;?></span></strong></p>
			<p>Пользуйтесь разделом «Мои заказы» на правой панели, чтобы следить за состоянием Ваших заказов.</p>
			<p>Желаем Вам удачи!</p> 
			<?
			$mailtext = ob_get_clean();
			
			$this->email->clear(TRUE);
			$config['smtp_host'] = 'localhost';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
			$list = array($this->session->userdata('personemail'),'admin@roscentrdpo.ru');
			$this->email->to($list);
			$this->email->from('admin@roscentrdpo.ru','АНО ДПО');
			$this->email->bcc('');
			$this->email->subject('Данные для доступа к личному кабинету');
			$this->email->message($mailtext);	
			$this->email->send();
			
			$this->session->unset_userdata(array('regcustomer'=>'','step'=>'','organization'=>'','phones'=>'','inn'=>'','kpp'=>'','accounttype'=>'','accountnumber'=>'','uraddress'=>'','bank'=>'','accountkornumber'=>'','bik'=>'','uraddress'=>'','postaddress'=>'','personemail'=>'','person'=>'','manager'=>'','fiomanager'=>'','statutory'=>''));
			$this->session->set_userdata('finishregcustomer',TRUE);
			redirect('registration/customer/finish');
		endif;
		$this->load->view("users_interface/registration/begin-registration-step-4",$pagevar);
	}
	
	public function registration_close(){
		
		$finish = $this->session->userdata('finishregcustomer');
		if($finish):
			$this->session->unset_userdata('finishregcustomer');
			$this->session->userdata('cuslogin');
			$user = $this->customersmodel->auth_user($this->session->userdata('cuslogin'),$this->session->userdata('cuspassword'));
			if(!$user):
				redirect('');
			endif;
			$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id'],'utype'=>'zak'));
			$this->customersmodel->active_user($this->session->userdata('userid'));
			$this->session->unset_userdata('cuslogin');
			$this->session->unset_userdata('cuspassword');
			redirect('customer/information/start-page');
		else:
			redirect('registration/customer');
		endif;	
	}
	
	public function registration_cancel(){
	
		$this->session->unset_userdata(array('finishregcustomer'=>'','regcustomer'=>'','step'=>'','organization'=>'','phones'=>'','inn'=>'','kpp'=>'','accounttype'=>'','accountnumber'=>'','uraddress'=>'','bank'=>'','accountkornumber'=>'','bik'=>'','uraddress'=>'','postaddress'=>'','personemail'=>'','person'=>'','manager'=>'','fiomanager'=>'','statutory'=>''));
		redirect('registration/customer');
	}
	
	public function catalog_courses(){
		
		$pagevar = array(
					'title'			=> 'Курсы повышения квалификации работников, инженеров, проектировщиков, строителей, энергетиков | Дистанционное повышение квалификации',
					'description'	=> 'Каталог курсов по повышению квалификации инженеров, проектировщиков, строителей, энергетиков. Дистанционное обучение Ростов-на-Дону, Краснодар, Ставрополь, Сочи, Астрахань, Волгоград.',
					'author'		=> '',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'trends'		=> $this->trendsmodel->read_view_records(),
					'courses'		=> $this->coursesmodel->read_view_records(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr'),
					'msgauth'		=> $this->session->userdata('msgauth')
			);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("users_interface/catalog-courses",$pagevar);
		
	}

	public function contacts(){
		
		$pagevar = array(
			'title'			=> 'Контактная информация | Южно-окружной центр повышения квалификации и переподготовки кадров',
			'description'	=> 'Контактная информация южного окружного регионального центра повышения квалификации инженеров, проектировщиков, строителей, энергетиков. Дистанционное обучение. Ростов-на-Дону, Краснодар, Ставрополь,Сочи, Пятигорск, Астрахань, Волгоград.',
			'author'		=> '',
			'baseurl' 		=> base_url(),
			'loginstatus'	=> $this->loginstatus,
			'userinfo'		=> $this->user,
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr'),
			'msgauth'		=> $this->session->userdata('msgauth')
		);
		$this->session->unset_userdata('msgauth');
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("users_interface/contacts",$pagevar);
	}
	
	public function definition_model($utype){
		
		$model = '';
		switch ($utype):
			case 'adm': $model = 'adminmodel'; break;
			case 'zak': $model = 'customersmodel'; break;
			case 'slu': $model = 'audiencemodel'; break;
		endswitch;
		return $model;
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
}