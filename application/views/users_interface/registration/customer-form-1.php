<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>
			Общие данные
		</legend>
		<div class="control-group">
			<label for="organization" class="control-label">Наименование</label>
			<div class="controls">
				<input type="text" id="title" class="input-xlarge inpval" name="organization" value="<?=$this->session->userdata('organization')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="inn" class="control-label">ИНН</label>
			<div class="controls">
				<input type="text" id="inn" class="input-xlarge inpval digital" name="inn" value="<?=$this->session->userdata('inn')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="kpp" class="control-label">КПП</label>
			<div class="controls">
				<input type="text" id="kpp" class="input-xlarg inpval digital" name="kpp" value="<?=$this->session->userdata('kpp')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>
			Банковские реквизиты
		</legend>
		<div class="control-group">
			<label for="accounttype" class="control-label">Тип счёта</label>
			<div class="controls">
				<select id="accounttype" name="accounttype">
					<option value="1">Расчетный</option>
					<option value="2">Валютный</option>
					<option value="3">Текущий</option>
					<option value="4">Временный</option>
					<option value="5">Транзитный</option>
					<option value="6">Допозитный</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="accountnumber" class="control-label">Номер счёта</label>
			<div class="controls">
				<input type="text" id="accountnumber" class="input-xlarg inpval digital" name="accountnumber" maxlength="20" value="<?=$this->session->userdata('accountnumber')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="bank" class="control-label">Наименование банка</label>
			<div class="controls">
				<textarea rows="3" id="textarea" class="input-xlarge inpval" name="bank"><?=$this->session->userdata('bank');?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
			<div class="controls">
				<input type="text" id="accountkornumber" class="input-xlarg inpval digital" name="accountkornumber" maxlength="20" value="<?=$this->session->userdata('accountkornumber')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="bik" class="control-label">БИК</label>
			<div class="controls">
				<input type="text" id="bik" class="input-xlarg inpval digital" name="bik" maxlength="10" value="<?=$this->session->userdata('bik')?>">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-primary" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
	</div>
<?= form_close(); ?>