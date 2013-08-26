<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Регистрация заказчика (Шаг 1)</h1>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<?php $this->load->view('users_interface/registration/customer-form-1');?>
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
		<?php $this->load->view('users_interface/modal/registration-cancel');?>
		</div>
		<hr>
	<?php $this->load->view('users_interface/footer');?>
	</div>
	<?php $this->load->view('users_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#send").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".inpval").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$(".digital").keypress(function(e){
				if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
			$("#input-consent").click(function(){
				if($(this).is(':checked') == true){
					$("#send").removeAttr('disabled');
				}else{
					$("#send").attr('disabled','disabled');
				}
			});
		<?php if($this->session->userdata('regcustomer')):?>
			$("#accounttype").val("<?=$this->session->userdata('accounttype');?>");
		<?php endif;?>
			$(".input-popover").popover();
			$("#YesCancel").click(function(){location.href="<?=$baseurl;?>registration/customer/cancel-registration"});
		});
	</script>
</body>
</html>