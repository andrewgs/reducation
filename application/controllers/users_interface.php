<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends CI_Controller{
	
	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'');
	var $loginstatus = array('cus'=>FALSE,'aud'=>FALSE,'adm'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('adminmodel');
		$this->load->model('customersmodel');
		$this->load->model('trendsmodel');
		$this->load->model('coursesmodel');
		$this->load->model('audiencemodel');
		
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
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('lsubmit')):
			$login = trim($this->input->post('login'));
			$pass = trim($this->input->post('password'));
			if(!$login || !$pass):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
				redirect($this->uri->uri_string());
			else:
				$utype = substr(strtolower($login),0,3);
				switch ($utype):
					case 'cus':  
								$user = $this->customersmodel->auth_user($login,$pass);
								if(!$user):
									$this->session->set_userdata('msgr','Ошибка. Не верные данные для авторизации. В доступе отказано.');
									redirect($this->uri->uri_string());
								endif;
                   				$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id'],'utype'=>'cus'));
								$this->customersmodel->active_user($this->session->userdata('userid'));
                   				redirect($this->uri->uri_string());
								break;
					case 'aud': 
								$user = $this->audiencemodel->auth_user($login,$pass);
								if(!$user):
									$this->session->set_userdata('msgr','Ошибка. Не верные данные для авторизации. В доступе отказано.');
									redirect($this->uri->uri_string());
								endif;
                   				$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id'],'utype'=>'aud'));
								$this->audiencemodel->active_user($this->session->userdata('userid'));
                   				redirect($this->uri->uri_string());
								break;
					default : 
								$this->session->set_userdata('msgr','Ошибка. Не верные данные для авторизации.');
								redirect($this->uri->uri_string());break;
				endswitch;
				exit; 
			endif;
		endif;
		$this->load->view("users_interface/index",$pagevar);
	}
	
	public function information(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
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
			elseif($this->loginstatus['cus']):
				redirect('');
			elseif($this->loginstatus['aud']):
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
	
	public function registration_customer(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
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
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
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
				$this->session->set_userdata(array('regcustomer'=>TRUE,'step'=>2,'organization'=>htmlspecialchars($_POST['organization']),'inn'=>$_POST['inn'],'kpp'=>$_POST['kpp'],'accounttype'=>$_POST['accounttype'],'accountnumber'=>$_POST['accountnumber'],'bank'=>htmlspecialchars($_POST['bank']),'accountkornumber'=>$_POST['accountkornumber'],'bik'=>$_POST['bik']));
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
					'msgr'			=> $this->session->userdata('msgr')
			);
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
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
	
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('personemail',' ','required|valid_email|trim');
			$this->form_validation->set_rules('person',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$this->session->set_userdata(array('regcustomer'=>TRUE,'step'=>4,'personemail'=>$_POST['personemail'],'person'=>htmlspecialchars($_POST['person'])));
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
					'finishreg'		=> $this->session->userdata('finishregcustomer')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$customer = $this->session->all_userdata();
			$id = $this->customersmodel->insert_record($customer);
			$login = 'cus000'.$id;
			$password = $this->randomPassword(8);
			$this->session->set_userdata('cuslogin',$login);
			$this->session->set_userdata('cuspassword',$password);
			$this->customersmodel->update_field($id,'login',$login);
			$this->customersmodel->update_field($id,'password',md5($password));
			$this->customersmodel->update_field($id,'cryptpassword',$this->encrypt->encode($password));
			
			$email = $this->session->userdata('personemail');
			ob_start();
			?>
			<p>Здравствуйте,  <?=$this->session->userdata('person');?></p>
			<p>Поздравляем! Вы успешно завершили оформление заявки. Вам доступны следующие документы:</p>
			<ul>
				<li>Счёт</li>
				<li>Договор на оказание образовательных услуг</li>
			</ul>
			<p>
				После оплаты заказа мы оформим весь пакет документов, а абитуриенты будут зачислены на обучение. 
				Обучение будет осуществляться через личный кабинет слушателя. Для входа в личный кабинет используйте 
				созданный для вас логин и пароль.
			</p>
			<p><strong>Логин:</strong> <?=$login;?> <strong>Пароль:</strong> <?=$password;?></p>
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
			$this->email->to($this->session->userdata('personemail'));
			$this->email->from('admin@roscentrdpo.ru','АНО ДПО');
			$this->email->bcc('');
			$this->email->subject('Данные для доступа к личному кабинету');
			$this->email->message($mailtext);	
			$this->email->send();
			
			$this->session->unset_userdata(array('regcustomer'=>'','step'=>'','organization'=>'','inn'=>'','kpp'=>'','accounttype'=>'','accountnumber'=>'','uraddress'=>'','bank'=>'','accountkornumber'=>'','bik'=>'','uraddress'=>'','postaddress'=>'','personemail'=>'','person'=>''));
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
			$this->session->set_userdata(array('logon'=>md5($user['login']),'userid'=>$user['id'],'utype'=>'cus'));
			$this->customersmodel->active_user($this->session->userdata('userid'));
			$this->session->unset_userdata('cuslogin');
			$this->session->unset_userdata('cuspassword');
			redirect('customer/registration/ordering');
		else:
			redirect('registration/customer');
		endif;	
	}
	
	public function registration_cancel(){
	
		$this->session->unset_userdata(array('finishregcustomer'=>'','regcustomer'=>'','step'=>'','organization'=>'','inn'=>'','kpp'=>'','accounttype'=>'','accountnumber'=>'','uraddress'=>'','bank'=>'','accountkornumber'=>'','bik'=>'','uraddress'=>'','postaddress'=>'','personemail'=>'','person'=>''));
		redirect('registration/customer');
	}
	
	public function catalog_courses(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
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
		
		$this->load->view("users_interface/catalog-courses",$pagevar);
		
	}

	public function contacts(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("users_interface/contacts",$pagevar);
	}
	
	public function definition_model($utype){
		
		$model = '';
		switch ($utype):
			case 'adm': $model = 'adminmodel'; break;
			case 'cus': $model = 'customersmodel'; break;
			case 'aud': $model = 'audiencemodel'; break;
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