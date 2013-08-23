<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	var $loginstatus = array('zak'=>FALSE,'slu'=>FALSE,'adm'=>FALSE,'admin'=>FALSE,'fiz'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
	}
	
	/*************************************************************************************************************/
	
	public function pagination($url,$uri_segment,$total_rows,$per_page){
		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."$url/offset/";
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = 'В начало';
		$config['last_link'] = 'В конец';
		$config['next_link'] = 'Далее &raquo;';
		$config['prev_link'] = '&laquo; Назад';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	
	public function sendMail($to,$from_mail,$from_name,$subject,$text,$attach = NULL) {

		$this->load->library('phpmailer');
		$mail = new PHPMailer();
		$mail->IsSendmail();
		$mail->SetFrom($from_mail,'Климова Ольга');
		$mail->AddReplyTo($from_mail,'Климова Ольга');
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->MsgHTML($text);
		$mail->AltBody = strip_tags($text); 
		//$mail->AddAttachment('images/phpmailer-mini.gif');
		if(!$mail->Send()):
			$result = array('status' => 0,'request'=>$mail->ErrorInfo);
		else:
			$result = array('status' => 1,'request'=>'');
		endif;
		return $result;
		
		
		/*$this->load->library('email');
		$this->email->clear();
		$config['protocol'] = 'mail';
		$config['smtp_host'] = 'localhost';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->reply_to($from_mail,'Климова Ольга');
		$this->email->from($from_mail,'Климова Ольга');
		$this->email->subject($subject);
		for($i=0;$i<count($attach);$i++):
			$this->email->attach($attach[$i]['path']);
		endfor;
		$this->email->message($text);
		$status = $this->email->send();
		return $result = array('status'=>$status,'request'=>$this->email->print_debugger());*/
	 	
	}
	
}
?>