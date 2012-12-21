<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div class="span12" style="margin-left:0px;">
		<fieldset>
			<div class="control-group">
				<div class="controls">
					<p class="help-block" style="float:right;">Поля с знаком <span class="badge badge-info">!</span> - обязательные для заполнения</p>
				</div>
			</div>
		</fieldset>
		<div class="span6" style="margin-left:0px;">
			<fieldset>
				<legend>
					Общие данные
				</legend>
				<div class="control-group">
					<label for="fio" class="control-label">Ф.И.О.</label>
					<div class="controls">
						<input type="text" class="span3 inpval" name="fio" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Петров Иван Сергеевич</p>
					</div>
				</div>
				<div class="control-group">
					<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
					<div class="controls">
						<input type="text" class="span3 inpval" name="fiodat" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Петрову Ивану Сергеевичу</p>
					</div>
				</div>
				<div class="control-group">
					<label for="inn" class="control-label">ИНН</label>
					<div class="controls">
						<input type="text" id="inn" class="span3 inpval digital" name="inn" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="phones" class="control-label">Номер телефона</label>
					<div class="controls">
						<input type="text" id="phone" class="span3 inpval" name="phones" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="postaddress" class="control-label">Почтовый адрес</label>
					<div class="controls">
						<input type="text" class="span3 inpval" name="postaddress" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">344001, г.Ростов-на-Дону,<br/>ул.Республиканская, д.86</p>
					</div>
				</div>
				<div class="control-group">
					<label for="email" class="control-label">Email</label>
					<div class="controls">
						<input type="text" id="email" class="span3 inpval" name="email" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="span6" style="margin-left:0px;">
			<fieldset>
				<legend>
					Паспортные данные
				</legend>
				<div class="control-group">
					<label for="passport" class="control-label">Серия и номер</label>
					<div class="controls">
						<input type="text" id="passport" class="span3 inpval" name="passport" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="issued" class="control-label">Кем, когда выдан</label>
					<div class="controls">
						<textarea rows="3" id="textarea" class="span3 inpval" name="issued"></textarea> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="propiska" class="control-label">Прописка</label>
					<div class="controls">
						<input type="text" class="span3 inpval" name="propiska" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">344001, г.Ростов-на-Дону,<br/>ул.Республиканская, д.86</p>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="clear"></div>
	<fieldset>
		<legend>
			Банковские реквизиты
		</legend>
		<div class="control-group">
			<label for="accounttype" class="control-label">Тип счёта</label>
			<div class="controls">
				<select id="accounttype" name="accounttype" class="span3">
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
				<input type="text" id="accountnumber" class="span3 digital" name="accountnumber" maxlength="20" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="bank" class="control-label">Наименование банка</label>
			<div class="controls">
				<textarea rows="3" id="textarea" class="span3" name="bank"></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
			<div class="controls">
				<input type="text" id="accountkornumber" class="span3 digital" name="accountkornumber" maxlength="20" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="bik" class="control-label">БИК</label>
			<div class="controls">
				<input type="text" id="bik" class="span3 digital" name="bik" maxlength="10" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Зарегистрироваться <i class="icon-ok icon-white"></i></button>
	</div>
<?= form_close(); ?>