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
			<pre><strong>Уважаемый заказчик</strong> 
Поздравляем! Вы успешно завершили процедуру регистрации.

Для входа в кабинет заказчика используйте соответствующий логин и пароль, который был выслан Вам на E-mail.

<strong>Желаем Вам удачи!</strong> 
</pre>
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
		<?php $this->load->view('users_interface/modal/registration-cancel');?>
		</div>
		<hr>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#YesCancel").click(function(){location.href="<?=$baseurl;?>registration/customer/cancel-registration"});
		});
	</script>
</body>
</html>