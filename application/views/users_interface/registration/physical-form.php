<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div class="span12" style="margin-left:0px;">
		<fieldset>
			<div class="control-group">
				<div class="controls">
					<p class="help-block pull-right">Поля с знаком <span class="badge badge-info">!</span> - обязательные для заполнения</p>
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
						<input type="text" class="span3 input-popover inpval" data-content="Ваше Имя, Фамилия и Отчество.<br/><strong>Например:</strong> Иванов Иван Иванович" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="fio" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Иванов Иван Иванович</p>
					</div>
				</div>
				<div class="control-group">
					<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
					<div class="controls">
						<input type="text" class="span3 input-popover inpval" name="fiodat" data-content="Ваше Имя, Фамилия и Отчество в дательном падеже.<br/><strong>Например:</strong> Иванову Ивану Ивановичу" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Иванову Ивану Ивановичу</p>
					</div>
				</div>
				<div class="control-group">
					<label for="inn" class="control-label">ИНН</label>
					<div class="controls">
						<input type="text" id="inn" class="span3 input-popover inpval digital" data-content="Введите Ваш ИНН" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="inn" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="phones" class="control-label">Номер телефона</label>
					<div class="controls">
						<input type="text" id="phone" class="span3 input-popover inpval" data-content="Введите Ваш контактный номер телефона.<br/><strong>Например:</strong> (919)789-78-78" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="phones" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="postaddress" class="control-label">Почтовый адрес</label>
					<div class="controls">
						<input type="text" class="span3 input-popover inpval" name="postaddress" data-content="Введите Ваш полный почтовый адрес.<br/><strong>Например:</strong> 344001, Ростовская область, г.Ростов-на-Дону, ул.Республиканская, д.86" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">344001, г.Ростов-на-Дону,<br/>ул.Республиканская, д.86</p>
					</div>
				</div>
				<div class="control-group">
					<label for="email" class="control-label">Email</label>
					<div class="controls">
						<input type="text" id="email" class="span3 input-popover inpval" data-content="Введите Ваш адрес электронной почты (email).<br/><strong>Например:</strong> info@roscentrdpo.ru" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="email" value=""> <span class="badge badge-info">!</span>
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
						<input type="text" id="passport" class="span3 input-popover inpval" data-content="Введите серию и номер Вашего паспорта" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="passport" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="issued" class="control-label">Кем, когда выдан</label>
					<div class="controls">
						<textarea rows="3" id="textarea" class="span3 input-popover inpval" data-content="Введите органицацию которая выдала паспорт и дату его выдачи" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="issued"></textarea> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="propiska" class="control-label">Прописка</label>
					<div class="controls">
						<input type="text" class="span3 input-popover inpval" data-content="Введите полный адрес Вашей прописки.<br/><strong>Например:</strong> 344001, Ростовская область, г.Ростов-на-Дону, ул.Республиканская, д.86" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="propiska" value=""> <span class="badge badge-info">!</span>
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
				<select id="accounttype" name="accounttype" class="span3 input-popover" data-content="Выберите тип счета в банке для Вашей организации" data-trigger="hover" data-placement="bottom" data-toggle="popover" data-original-title="Выберите из списка">
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
				<input type="text" id="accountnumber" class="span3 input-popover digital" data-content="Введите Ваш номер банковского счета" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Не обязательное поле" name="accountnumber" maxlength="20" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="bank" class="control-label">Наименование банка</label>
			<div class="controls">
				<textarea rows="3" id="textarea" class="span3 input-popover" data-content="Введите наименование Вашего банка" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Не обязательное поле" name="bank"></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
			<div class="controls">
				<input type="text" id="accountkornumber" class="span3 input-popover digital" data-content="Введите номер кор. счета Вашей организации" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Не обязательное поле" name="accountkornumber" maxlength="20" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="bik" class="control-label">БИК</label>
			<div class="controls">
				<input type="text" id="bik" class="span3 input-popover digital" data-content="Введите БИК Вашего банка" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Не обязательное поле" name="bik" maxlength="10" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Зарегистрироваться <i class="icon-ok icon-white"></i></button>
	</div>
<?= form_close(); ?>