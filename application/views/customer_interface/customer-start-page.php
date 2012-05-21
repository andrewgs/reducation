<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<?php $this->load->view('customer_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
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
					квалификации ваших сотрудников. После оформления заказа вам необходимо его оплатить.
				</p>
				<p>
					Для оформления заказа необходимо предварительно зарегистрировать одного или нескольких 
					слушателей. Сейчас у вас зарегистрировано <strong><?=$audience;?> слушателей</strong>.
				</p>
				<p>  
					<?=anchor('customer/registration/audience','Оформить нового слушателя &rarr;', array('class' => 'btn btn-small btn-info'));?>
				</p>
				<p>
					Если вы уже зарегистрировали всех необходимых слушателей, то вы можете сразу приступить к оформлению заказа.
					Сейчас у вас оформлено <strong><?=$orders;?> заказов</strong>. 
				</p>
				<p>
					<?=anchor('customer/registration/ordering','Оформить заказ &rarr;', array('class' => 'btn btn-small btn-info'));?>
				</p>
				<p>
					<strong>Внимание!</strong> На 2-м шаге оформления заказа Вам будет предложено выбрать слушателей, если 
					необходимый слушатель будет отсутствовать Вы можете его зарегистрировать воспользовавшись панелью справа 
					(ссылка "Регистрация слушателей"). После успешной регистрации слушателя Вы можете вернутся к оформлению 
					заказа (ссылка "Оформление заказа").
				</p>
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		</div>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('customer_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".none").click(function(event){event.preventDefault();});
		});
	</script>
</body>
</html>
