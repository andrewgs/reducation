<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>
			Контактные данные
		</legend>
		<div class="control-group" id="cgemail">
			<label for="personemail" class="control-label">E-mail</label>
			<div class="controls">
				<input type="text" id="personemail" class="input-xlarge inpval" name="personemail" value="<?=$this->session->userdata('personemail')?>">
				<span class="help-inline" id="email" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="person" class="control-label">Контактное лицо</label>
			<div class="controls">
				<input type="text" id="person" class="input-xlarge inpval" name="person" value="<?=$this->session->userdata('person')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="phones" class="control-label">Номер конт.телефона</label>
			<div class="controls">
				<input type="text" id="person" class="input-xlarge inpval" name="phones" value="<?=$this->session->userdata('phones')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
		<?=anchor('registration/customer/step/2','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-info'));?>
	</div>
<?= form_close(); ?>