<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Восстановление данных для авторизации</h1>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<?=form_open($this->uri->uri_string(),array('class'=>'form-inline')); ?>
					<div class="control-group">
						<label for="email" class="control-label">Введите адрес E-mail указанный при регистрации:</label>
						<div class="controls">
							<input type="text" id="email" class="input focused" name="email" placeholder="Введите E-mail">
							<button class="btn" type="submit" id="send" name="submit" value="send">Восстановить</button>
							<div><span id="errvalid" style="display:none; padding-left: 0px; color: #B94A48;">&nbsp;</span></div>
						</div>
						<div class="controls">
							<label class="radio"><input type="radio" name="usertype" value="zak" checked>Я заказчик</label>
							<label class="radio"><input type="radio" name="usertype" value="slu">Я слушатель</label>
						</div>
					</div>
				<?= form_close(); ?>
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
		</div>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#lsend").attr('disabled','disabled');
			$("#lsend").click(function(event){event.preventDefault();});
			$("#send").click(function(event){var err = false;var email = $("#email").val();	$(".control-group").removeClass('error');$("#errvalid").hide();if(email == ''){$(".control-group").addClass('error');$("#errvalid").html("Поле не может быть пустым").show();err = true;}if(err){event.preventDefault();};if(!err && !isValidEmailAddress(email)){$("#errvalid").html("Не верный адрес E-Mail").show();event.preventDefault();}});
			function isValidEmailAddress(emailAddress){var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);return pattern.test(emailAddress);};
		});
	</script>
</body>
</html>
