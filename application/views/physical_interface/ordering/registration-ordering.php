<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('physical_interface/includes/head');?>
<body>
	<?php $this->load->view('physical_interface/includes/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Оформление заказа');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<pre><strong>Уважаемый заказчик!</strong>
				
Процедура подачи заявки состоит из 3-х шагов:

 - 1-й шаг. Необходимо выбрать направление обучения.
 - 2-й шаг. Выбрать интересующие Вас курсы.
 - 3-й шаг. Подтвердить завершение оформления заказа.
 
Внимание! Вернуться и изменить направление обучения сделанном на 1-м шаге невозможно.
Будьте внимательны. Для отмены оформления заказа воспользуйтесь кнопкой "Отмена".

По завершению оформления Вам будет выслано письмо-уведомление на указанный Вами E-mail.
Так же будут уведомлены по почте все абитуриенты, зачисленные на повышение квалификации.
</pre>
				<p><?=anchor('physical/registration/ordering/step/1','<i class="icon-arrow-right icon-white"></i> Начать оформление',array('class'=>'btn btn-info'));?></p>
			</div>
		<?php $this->load->view('users_interface/rightbarfiz');?>
		</div>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('physical_interface/includes/scripts');?>
</body>
</html>
