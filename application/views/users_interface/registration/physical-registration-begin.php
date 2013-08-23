<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Оформление заявки на повышение квалификации для Физического Лица</h1>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<p>
					Уважаемый заказчик! Для оформления заявок на повышение квалификации Вам необходимо пройти систему регистрации.<br/>
					Заполните Все обязательные поля. После заполнения полей нажмите кнопку "Зарегистрироваться".<br/>
					По завершении регистрации будет выслано письмо-уведомление на указанный Вами E-mail.
				</p>
				<p>Желаем Вам удачи!</p>
				<p><?=anchor('registration/physical-registration','<i class="icon-arrow-right icon-white"></i> Начать оформление',array('class'=>'btn btn-info'));?></p>
			</div>
		<?php if($this->loginstatus['status'] && $this->loginstatus['zak']):?>
			<?php $this->load->view('users_interface/rightbarcus');?>
		<?php endif;?>
		<?php if($this->loginstatus['status'] && $this->loginstatus['slu']):?>
			<?php $this->load->view('users_interface/rightbaraud');?>
		<?php endif;?>
		<?php if($this->loginstatus['status'] && $this->loginstatus['adm']):?>
			<?php $this->load->view('users_interface/rightbaradm');?>
		<?php endif;?>
		<?php if($this->loginstatus['status'] && $this->loginstatus['fiz']):?>
			<?php $this->load->view('users_interface/rightbarfiz');?>
		<?php endif;?>
		</div>
		<hr>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
</body>
</html>