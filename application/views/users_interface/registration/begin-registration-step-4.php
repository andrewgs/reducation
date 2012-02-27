<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
			<?php if(!$finishreg):?>
				<h5>Регистрация заказчика (Шаг 4)</h5>
			<?php else:?>
				<h5>Регистрация заказчика завершена успешно</h5>
				<h5>На Ваш E-mail выслано уведомлени.</h5>
				<h5>Доступ к личному кабинету будет открыт после проверки указанной Вами информации администраторами сайта</h5>
				<h5>Спасибо что пользуетесь нашим ресурсом.</h5>
				<p><?=anchor('registration/customer/close-registration','<i class="icon-arrow-right"></i> Продолжить',array('class'=>'btn btn-info'));?></p>
			<?php endif;?>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
			<?php if(!$finishreg):?>
				<?php $this->load->view('users_interface/registration/customer-form-4');?>
			<?php else:?>
				
			<?php endif;?>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#msgclose").click(function(){$("#msgalert").fadeOut(1000,function(){$(this).remove();});});
		});
	</script>
</body>
</html>