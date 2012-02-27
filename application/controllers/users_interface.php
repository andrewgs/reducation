<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends CI_Controller{
	
	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'');
	var $loginstatus = array('cus'=>FALSE,'aud'=>FALSE,'adm'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('adminmodel');
		$this->load->model('customersmodel');
		
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
			
			if($this->session->userdata('logon') != md5($userinfo['login'].$userinfo['password'])):
				$this->loginstatus['status'] = FALSE;
				$this->user = array();
			endif;
		endif;
	}
	
	public function index(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user
			);
		$this->load->view("users_interface/index",$pagevar);
	}

	public function admin_login(){
	
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Панель администрирования',
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
				$session_data = array('logon'=>md5($userinfo['login'].$userinfo['password']),'userid'=>$userinfo['id'],'utype'=>substr($userinfo['login'],0,3));
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

	public function definition_model($utype){
		
		$model = '';
		switch ($utype):
			case 'adm': $model = 'adminmodel'; break;
			case 'cus': $model = 'companymodel'; break;
			case 'aud': $model = 'audiencemodel'; break;
		endswitch;
		return $model;
	}

	public function registration_customer(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user
			);
		$this->load->view("users_interface/registration/begin-registration",$pagevar);
		
	}
	
	public function registration_customer_step_1(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
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
	
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
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
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
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
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
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
			$login = 'CUS000'.$id;
			$password = $this->randomPassword(8);
			$this->customersmodel->update_field($id,'login',$login);
			$this->customersmodel->update_field($id,'password',$password);
			
			$email = $this->session->userdata('personemail');
			ob_start();
			?>
	Здравствуйте  <?=$this->session->userdata('person');?>
	Вами была произведена регистрация на сайте reducation.ru.
	
	Ваши данные для доступа к личному кабинету: 
	Логин: <?=$login;?>
	Пароль: <?=$password;?>
	
	Активация учетной записи займет не более суток.
	По ее завершению Вы будете проинформированы по E-mail. Спасибо что пользуетесь нашим ресурсом.
			<?
			$mess['msg'] = ob_get_clean();
			
			$this->email->clear(TRUE);
			$config['smtp_host'] = 'localhost';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$this->email->initialize($config);
			$this->email->to($this->session->userdata('personemail'));
			$this->email->from('admin@reducation.ru','Админстрация сайта REDUCATION.RU');
			$this->email->bcc('');
			$this->email->subject('REDUCATION.RU Данные для доступа к личному кабинету.');
			$textmail = strip_tags($mess['msg']);
			$this->email->message($textmail);	
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
			redirect('');
		else:
			redirect('registration/customer');
		endif;	
	}
	
	public function catalog_courses(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user
			);
		$this->load->view("users_interface/catalog-courses",$pagevar);
		
	}

	public function contacts(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user
			);
		$this->load->view("users_interface/contacts",$pagevar);
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