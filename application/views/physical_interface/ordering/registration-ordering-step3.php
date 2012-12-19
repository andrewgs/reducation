<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('physical_interface/includes/head');?>
<body>
	<?php $this->load->view('physical_interface/includes/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li>Выбор направления (шаг 1) <span class="divider">/</span></li>
					<li>Выбор курсов (шаг 2) <span class="divider">/</span></li>
					<li class="active"><?=anchor($this->uri->uri_string(),'Подтверждение заказа (шаг 3)');?></li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<?php $this->load->view('forms/physical/ordering-order-finish');?>
			</div>
		<?php $this->load->view('users_interface/rightbarfiz');?>
		</div>
		<?php $this->load->view('users_interface/modal/registration-cancel');?>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('physical_interface/includes/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#YesCancel").click(function(){location.href="<?=$baseurl;?>physical/registration/ordering/cancel-registration"});
		});
	</script>
</body>
</html>
