<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>
			Здравстуйте <?=$this->session->userdata('person');?>. Все необходимые данные заполнены.<br/>
			Нажмите "Завершить" для завершения процедуры регистрации.
		</legend>
	</fieldset>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Завершить</button>
		<?=anchor('registration/customer/step/3','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-primary'));?>
	</div>
<?= form_close(); ?>