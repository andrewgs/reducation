<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
	<?php if($readonly):?>
		<div class="alert alert-info">
			Вы не можете изменять персональные данные после оформления заказа.<br/>Если вы обнаружили ошибку, то позвоните по контактному телефону и объясните свою проблему.
		</div>
	<?php endif;?>
		<div class="span9" style="margin-left:0px;">
			<legend>
				Общие данные
			</legend>
			<div class="control-group">
				<label for="fio" class="control-label">Ф.И.О.</label>
				<div class="controls">
					<input type="text" id="title" class="span4 inpval" name="fio" value="<?=$physical['fio'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="inn" class="control-label">ИНН</label>
				<div class="controls">
					<input type="text" id="inn" class="span4 inpval digital" name="inn" value="<?=$physical['inn'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="phones" class="control-label">Номер телефона</label>
				<div class="controls">
					<input type="text" id="phone" class="span4 inpval" name="phones" value="<?=$physical['phones'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="postaddress" class="control-label">Почтовый адрес</label>
				<div class="controls">
					<input type="text" class="span4 inpval" name="postaddress" value="<?=$physical['postaddress'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="email" class="control-label">Email</label>
				<div class="controls">
					<input type="text" id="email" class="span4 inpval" name="email" value="<?=$physical['email'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>
				Паспортные данные
			</legend>
			<div class="control-group">
				<label for="passport" class="control-label">Серия и номер</label>
				<div class="controls">
					<input type="text" id="passport" class="span4 inpval" name="passport" value="<?=$physical['passport'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="issued" class="control-label">Кем, когда выдан</label>
				<div class="controls">
					<textarea rows="3" id="textarea" class="span4 inpval" name="issued"><?=$physical['issued'];?></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="propiska" class="control-label">Прописка</label>
				<div class="controls">
					<input type="text" class="span4 inpval" name="propiska" value="<?=$physical['propiska'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>
				Паспортные данные
			</legend>
			<div class="control-group">
				<label for="accounttype" class="control-label">Тип счёта</label>
				<div class="controls">
					<select id="accounttype" name="accounttype" class="span4">
						<option value="1">Временный</option>
						<option value="2">Текущий</option>
						<option value="3">Карточный</option>
						<option value="4">Именной</option>
						<option value="5">Счет на физ.лицо</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label for="accountnumber" class="control-label">Номер счёта</label>
				<div class="controls">
					<input type="text" id="accountnumber" class="span4 digital" name="accountnumber" maxlength="20" value="<?=$physical['accountnumber'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="bank" class="control-label">Наименование<br/>банка</label>
				<div class="controls">
					<textarea rows="3" id="textarea" class="span4" name="bank"><?=$physical['bank'];?></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
				<div class="controls">
					<input type="text" id="accountkornumber" class="span4 digital" name="accountkornumber" maxlength="20" value="<?=$physical['accountkornumber'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="bik" class="control-label">БИК</label>
				<div class="controls">
					<input type="text" id="bik" class="span4 digital" name="bik" maxlength="10" value="<?=$physical['bik'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
	</fieldset>
	<?php if(!$readonly):?>
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Сохранить</button>
	</div>
	<?php endif;?>
<?= form_close(); ?>