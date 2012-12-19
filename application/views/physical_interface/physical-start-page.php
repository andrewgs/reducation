<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('physical_interface/includes/head');?>
<body>
	<?php $this->load->view('physical_interface/includes/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb" style="margin-top:20px;">
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Начальная страница');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<p>
					<strong>Здравствуйте, <?=$userinfo['fullname'];?></strong>
				</p>
				<p>
					Вы находитесь в Вашем личном кабинете, где вы можете оформить заказ на повышение 
					квалификации. После оформления заказа вам необходимо его оплатить.
				</p>
				<p>
					Сейчас у вас оформлено <strong><?=$orders;?> заказов</strong>. 
				</p>
				<p>
					<?=anchor('physical/registration/ordering','Оформить заказ &rarr;', array('class' => 'btn btn-small btn-info'));?>
				</p>
			</div>
		<?php $this->load->view('users_interface/rightbarfiz');?>
		</div>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('physical_interface/includes/scripts');?>
</body>
</html>
