<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Crontab_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function emailNotification(){
		
		$this->load->helper('date');
		$query = "SELECT orders.id AS orderid,orders.number,orders.year,orders.closedate,orders.orderdate,customers.id AS customerid,customers.organization,customers.personemail FROM orders INNER JOIN customers ON orders.customer = customers.id WHERE orders.paid = 1 AND orders.userpaiddate != '0000-00-00' AND orders.numbercompletion = '' AND '".date("Y-m-d",now())."' >= SUBDATE(orders.closedate,2)";
		$query = $this->db->query($query);
		$customers = $query->result_array();
		for($i=0;$i<count($customers);$i++):
			ob_start();?>
<img src="<?=base_url('img/logo_small.png')?>" alt="" /><br/>
<?=anchor('','roscentrdpo.ru');?>
<p>Система дистанционного обучения АНО ДПО «Южно-окружной центр повышения квалификации»</p>
<p>Здравствуйте, <?=$customers[$i]['organization'];?></p>
<p>
	Система дистанционного обучения АНО ДПО «Южно-окружной центр повышения квалификации» 
	напоминает: 
	<h4>Ваш период сдачи итогового тестированя по заказу №<?=$customers[$i]['number'].'/'.$customers[$i]['year'];?> от <?=swap_dot_date($customers[$i]['orderdate']);?><br/>
	 наступает с <?=swap_dot_date($customers[$i]['closedate']);?> по <?=date("d.m.Y",future_days(10,$customers[$i]['closedate']));?></h4>
</p>
<br/><br/>
<p>
	Наш адрес:<br/>
	г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
	Тел.:(863) 246-43-54<br/>
	Эл.почта: info@roscentrdpo.ru<br/>
	<br/>С уважением,<br/>Администрация Образовательного портала<br/>АНО ДПО «Южно-окружной центр повышения квалификации»
</p>
		<?php
			$mailtext = ob_get_clean();
			if($this->input->get('mode') == 'test'):
				echo $customers[$i]['personemail']."<br/>--------------------------<br/>";
				echo 'Текст письма:<br/>';
				echo $mailtext;
				echo '<br/>';
			else:
				$this->sendMail($customers[$i]['personemail'],'admin@roscentrdpo.ru','АНО ДПО','Уведомление о итоговом тестировании',$mailtext);
			endif;
		endfor;
		echo 'OK';
	}
	
}
?>