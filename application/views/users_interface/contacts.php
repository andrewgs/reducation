<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Контакты</h1>
				<p>
					Южно-окружной центр повышения квалификации и переподготовки кадров 
					для строительного и жилищно-коммунального комплекса
				</p>
				<p>
					344001, г.Ростов-на-Дону, ул.Республиканская, 86 <br />
					тел.: (499) 184-14-01, (499) 186-13-47 <br />
					электронная почта: info@roscentrdpo.ru <br />
				</p>
				<p>
					Режим работы: пн-чт - 9:00-18:00, пт - 9:00-16:00, обед - 13:00-14:00
				</p>
				<h4>Схема проезда</h4>
				<p>
					На автомобиле: по Кольской улице, поворот на Ивовую улицу, либо поворот на Вересковую улицу до пересечения с Игарским проездом.
				</p>
				<p> 
					Пешком (от метро Свиблово): первый вагон из центра, выход налево. Прямо и налево 1 минуту до Игарского проезда, затем прямо 10-15 минут.
				</p>
			</div>
		<?php if($loginstatus['status'] && $loginstatus['cus']):?>
			<?php $this->load->view('users_interface/rightbarcus');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['aud']):?>
			<?php $this->load->view('users_interface/rightbaraud');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['adm']):?>
			<?php $this->load->view('users_interface/rightbaradm');?>
		<?php endif;?>
		</div>
 	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
</body>
</html>
