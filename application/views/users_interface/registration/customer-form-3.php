<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>
			Руководитель
		</legend>
		<div class="control-group">
			<label for="manager" class="control-label">Должность</label>
			<div class="controls">
				<input type="text" id="manager" class="input-xlarge inpval" name="manager" value="<?=$this->session->userdata('manager')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="fiomanager" class="control-label">ФИО</label>
			<div class="controls">
				<input type="text" id="fiomanager" class="input-xlarge inpval" name="fiomanager" value="<?=$this->session->userdata('fiomanager')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="statutory" class="control-label">Уставной документ</label>
			<div class="controls">
				<input type="text" id="statutory" class="input-xlarge inpval" name="statutory" value="<?=$this->session->userdata('statutory')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
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
	</fieldset>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
		<?=anchor('registration/customer/step/2','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-info'));?>
	</div>
<?= form_close(); ?>