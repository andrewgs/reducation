<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div class="hero-unit">
					<h2>РосЦентр ДПО</h2>
					<p>Система дистанционного обучения позволяет организовать образовательный процесс с помощью электронных учебных курсов в дистанционной форме через Интернет.</p>
					<p><a class="btn btn-primary btn-large">Узнать больше &raquo;</a></p>
				</div>
				<div class="row">
					<div class="span3">
						<h2>Об академии</h2>
						<p>Российский Центр Дополнительного Профессионального Обучения является государственным образовательным учреждением дополнительного профессионального образования.</p>
						<p>Академия учреждена в 2012 году Распоряжением Правительства Российской Федерации от 21.02.2012 №709-р и находится в ведении Министерства регионального развития России.</p>
						<p><a class="btn" href="#">Подробнее &raquo;</a></p>
					</div>
					<div class="span3">
						<h2>Документы</h2>
						<p>Документ о повышении квалификации – Удостоверение государственного образца. Документы заказа (счёт и договор) заказчик получает автоматически, по завершению оформления заявки.</p>
						<p>Все документы заказа можно получить в оригинале – для этого обращайтесь к консультантам.</p>
						<p><a class="btn" href="#">Подробнее &raquo;</a></p>
					</div>
					<div class="span3">
						<h2>СРО</h2>
						<p>Центр предлагает СРО строителей, проектировщиков, изыскателей и энергоаудиторов заключить Соглашение о сотрудничестве.</p>
						<p><a class="btn" href="#">Подробнее &raquo;</a></p>
					</div>
				</div>
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
		<hr>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
</body>
</html>
