<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span4" style="margin-left:0px;">
			<div class="control-group">
				<label for="organization" class="control-label">Наименование</label>
				<div class="controls">
					<input type="text" id="title" class="input-xlarge inpval" name="organization" value="<?=$customer['organization'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="inn" class="control-label">ИНН</label>
				<div class="controls">
					<input type="text" id="inn" class="input-small inpval digital" name="inn" value="<?=$customer['inn'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="kpp" class="control-label">КПП</label>
				<div class="controls">
					<input type="text" id="kpp" class="input-small inpval digital" name="kpp" value="<?=$customer['kpp'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="manager" class="control-label">Должность</label>
				<div class="controls">
					<input type="text" id="manager" class="input-xlarge inpval" name="manager" value="<?=$customer['manager'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
					<p class="help-block"><nobr>Дожность руководителя в родительном падеже</nobr></p>
				</div>
			</div>
			<div class="control-group">
				<label for="fiomanager" class="control-label">Ф.И.О. руководителя</label>
				<div class="controls">
					<input type="text" id="fiomanager" class="input-xlarge inpval" name="fiomanager" value="<?=$customer['fiomanager'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
					<p class="help-block"><nobr>Заполняется в родительном падеже</nobr></p>
				</div>
			</div>
			<div class="control-group">
				<label for="statutory" class="control-label">Уставной документ</label>
				<div class="controls">
					<input type="text" id="statutory" class="input-xlarge inpval" name="statutory" value="<?=$customer['statutory'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
					<p class="help-block"><nobr>Название документа в родительном падеже</nobr></p>
				</div>
			</div>
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
					<input type="text" id="accountnumber" class="input-xlarge inpval digital" name="accountnumber" maxlength="20" value="<?=$customer['accountnumber'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="bank" class="control-label">Наименование<br/>банка</label>
				<div class="controls">
					<textarea rows="3" id="textarea" class="input-xlarge inpval" name="bank"><?=$customer['bank'];?></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
				<div class="controls">
					<input type="text" id="accountkornumber" class="input-xlarge inpval digital" name="accountkornumber" maxlength="20" value="<?=$customer['accountkornumber'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="bik" class="control-label">БИК</label>
				<div class="controls">
					<input type="text" id="bik" class="input-small inpval digital" name="bik" maxlength="10" value="<?=$customer['bik'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		<!--</div>
		<div class="span4" style="margin-left: 60px;">-->
			<div class="control-group">
				<label for="uraddress" class="control-label">Юридический<br/>адрес</label>
				<div class="controls">
					<textarea rows="3" id="uraddress" class="input-xlarge inpval" name="uraddress"><?=$customer['uraddress'];?></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="postaddress" class="control-label">Почтовый<br/>адрес</label>
				<div class="controls">
					<textarea rows="3" id="postaddress" class="input-xlarge inpval" name="postaddress"><?=$customer['postaddress'];?></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group" id="cgemail">
				<label for="personemail" class="control-label">E-mail</label>
				<div class="controls">
					<input type="text" id="personemail" class="input-xlarge inpval" name="personemail" value="<?=$customer['personemail'];?>">
					<span class="help-inline" id="email" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="person" class="control-label">Контактное лицо</label>
				<div class="controls">
					<input type="text" id="person" class="input-xlarge inpval" name="person" value="<?=$customer['person'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<?php if(!$readonly):?>
			<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Сохранить</button>	
		<?else:?>
			<div class="alert alert-info">
				Вы не можете изменять персональные данные после оформления заказа.<br/>Если вы обнаружили ошибку, то позвоните по контактному телефону и объясните свою проблему.
			</div>
		<?php endif;?>
	</div>
<?= form_close(); ?>