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
				<pre><strong>Здравствуйте, <?=$userinfo['fullname'];?></strong>
				
Вы находитесь в Вашем личном кабинете. Вам предоставлена возможность оформлять заказы на повышения квалификации Ваших работников. Для этого необходимо оформить заказ и оплатить его.

Чтобы начать оформления заказа необходимо предварительно зарегистрировать одного или нескольких слушателей. 
Чтобы начать регистрацию слушателей необходимо перейти по ссылке <?=anchor('customer/registration/audience','<i class="icon-arrow-right"></i> "Регистрация слушателей"');?>

Сейчас у Вас зарегистрировано <strong><?=0;?></strong> слушателей.

Если у Вас уже зарегистрированы слушатели Вы можете приступить к оформлению заказа.
Чтобы начать оформление заказа необходимо перейти по ссылке <?=anchor('customer/registration/ordering','<i class="icon-arrow-right"></i> "Оформление заказа"');?>

Сейчас у Вас оформлено <strong><?=0;?></strong> заказов.

<strong>Внимание!</strong> На 2-м шаге оформления заказа Вам будет предложено выбрать слушателей, если необходимый слушатель будет отсутствовать Вы можете его зарегистрировать воспользовавшись панелью справа (ссылка "Регистрация слушателей"). После успешной регистрации слушателя Вы можете вернутся к оформлению заказа (ссылка "Оформление заказа").

<strong>Желаем Вам удачи!</strong> 
</pre>
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
