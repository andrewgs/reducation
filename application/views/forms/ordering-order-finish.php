<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
			<pre>Поздравляем! Вы успешно завершили оформление заказа. Номер заказа: <strong><?=$this->session->userdata('order');?></strong>

Направление обучения: <strong><?=$order;?></strong>
Выбранные курсы:
	<?php for($i=0;$i<count($courses);$i++):?>
&rarr; <strong><?=$courses[$i]['code'];?>. <?=$courses[$i]['title'];?></strong> (Слушателей: <?=$courses[$i]['audience']?>)
	<?php endfor;?>
	
Стоимость заказа: <strong><?=$price;?> рублей</strong>

Вам доступны следующие документы:
 &ndash; Счёт
 &ndash; Договор на оказание образовательных услуг

После оплаты заказа мы оформим весь пакет документов, а абитуриенты будут зачислены на обучение. Обучение будет осуществляться через личный кабинет слушателя.
Для входа в кабинет слушателя используется логин и пароль, который был получен при регистрации слушателя и был выслан по E-mail.
Зайдите в раздел «Мои заказы» на правой панели, чтобы следить за состоянием Вашего заказа.

<strong>Желаем Вам удачи!</strong> 
</pre>
	<h5>Нажмите "Завершить" для завершения процедуры регистрации.</h5>
	</fieldset>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Завершить</button>
		<?=anchor('customer/registration/ordering/step/2','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-primary'));?>
	</div>
<?= form_close(); ?>