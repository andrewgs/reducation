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
						<input type="text" class="span3 input-popover inpval" data-content="Ваше Имя, Фамилия и Отчество.<br/><strong>Например:</strong> Иванов Иван Иванович" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="fio" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Иванов Иван Иванович</p>
					</div>
				</div>
				<div class="control-group">
					<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
					<div class="controls">
						<input type="text" class="span3 input-popover inpval" name="fiodat" data-content="Ваше Имя, Фамилия и Отчество в дательном падеже.<br/><strong>Например:</strong> Иванову Ивану Ивановичу" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Иванову Ивану Ивановичу</p>
					</div>
				</div>
				<div class="control-group">
					<label for="inn" class="control-label">ИНН</label>
					<div class="controls">
						<input type="text" id="inn" class="span3 input-popover inpval digital" data-content="Введите Ваш ИНН" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="inn" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Введите Ваш ИНН</p>
					</div>
				</div>
				<div class="control-group">
					<label for="phones" class="control-label">Номер телефона</label>
					<div class="controls">
						<input type="text" id="phone" class="span3 input-popover inpval" data-content="Введите Ваш контактный номер телефона.<br/><strong>Например:</strong> (919)789-78-78" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="phones" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">(919)789-78-78</p>
					</div>
				</div>
				<div class="control-group">
					<label for="postaddress" class="control-label">Почтовый адрес</label>
					<div class="controls">
						<input type="text" class="span3 input-popover inpval" name="postaddress" data-content="Введите Ваш полный почтовый адрес.<br/><strong>Например:</strong> 344001, Ростовская область, г.Ростов-на-Дону, ул.Республиканская, д.86" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">344001, г.Ростов-на-Дону,<br/>ул.Республиканская, д.86</p>
					</div>
				</div>
				<div class="control-group">
					<label for="email" class="control-label">Email</label>
					<div class="controls">
						<input type="text" id="email" class="span3 input-popover inpval" data-content="Введите Ваш адрес электронной почты (email).<br/><strong>Например:</strong> info@roscentrdpo.ru" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="email" value=""> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">info@roscentrdpo.ru</p>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="span6" style="margin-left:0px;">
			<fieldset>
				<legend>
					<br/>
				</legend>
			</fieldset>
		</div>
	</div>
	<div class="clear"></div>
	<div class="modal-footer span11">
		<label class="checkbox pull-right">
			<input name="consent" id="input-consent" value="1" autocomplete="off" type="checkbox"> Даю согласие на обработку персональных данных
		</label>
		<div class="clear"></div>
		<button class="btn btn-success" disabled="disabled" type="submit" id="send" name="submit" value="send">Зарегистрироваться <i class="icon-ok icon-white"></i></button>
	</div>
<?= form_close(); ?>