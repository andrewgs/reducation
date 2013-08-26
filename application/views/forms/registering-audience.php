<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div class="span9" style="margin-left:0px;">
		<fieldset>
			<div class="control-group">
				<div class="controls">
					<p class="help-block pull-right">Поля с знаком <span class="badge badge-info">!</span> - обязательные для заполнения</p>
				</div>
			</div>
		</fieldset>
		<div class="span9" style="margin-left:0px;">
			<fieldset>
				<div class="span9">
					<legend>Личные данные</legend>
					<div class="control-group">
						<label for="lastname" class="control-label">Фамилия</label>
						<div class="controls">
							<input type="text" id="lastname" class="span4 input-popover inpval" data-content="Введите Фамилию слушателя.<br/><strong>Например:</strong> Иванов" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="lastname" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: Иванов</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="name" class="control-label">Имя</label>
						<div class="controls">
							<input type="text" id="name" class="span4 input-popover inpval" data-content="Введите Имя слушателя.<br/><strong>Например:</strong> Иван" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="name" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: Иван</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="middlename" class="control-label">Отчество</label>
						<div class="controls">
							<input type="text" id="middlename" class="span4 input-popover inpval" data-content="Введите Отчество слушателя.<br/><strong>Например:</strong> Иванович" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="middlename" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: Иванович</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
						<div class="controls">
							<input type="text" id="fiodat" class="span4 input-popover inpval" data-content="Введите Фамилию, Имя и Отчество слушателя в дательном падеже.<br/><strong>Например:</strong> Иванову Ивану Ивановичу" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="fiodat" value=""> <span class="badge badge-info">!</span>
							<span class="help-inline" style="display:none;">&nbsp;</span>
							<p class="help-block">Например: Иванову Ивану Ивановичу</p>
						</div>
					</div>
					<div class="control-group">
						<label for="position" class="control-label">Должность</label>
						<div class="controls">
							<input type="text" id="position" class="span4 input-popover inpval" data-content="Введите должность слушателя.<br/><strong>Например:</strong> инженер" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="position" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: инженер</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<legend>Адрес</legend>
					<div class="control-group">
						<label for="address" class="control-label">Область, город, улица, дом, корпус, квартира, индекс</label>
						<div class="controls">
							<textarea rows="3" id="address" class="span4 input-popover inpval" data-content="Введите почтовый адрес слушателя.<br/><strong>Например:</strong> Например: 344001, г.Ростов-на-Дону, ул.Республиканская, д.86" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="address"></textarea> <span class="badge badge-info">!</span>
							<p class="help-block">Например: 344001, г.Ростов-на-Дону, ул.Республиканская, д.86</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<legend>Контактные данные</legend>
					<div class="control-group" id="cgemail">
						<label for="personaemail" class="control-label">E-mail</label>
						<div class="controls">
							<input type="text" id="personaemail" class="span4 input-popover inpval" data-content="Введите адрес электронной почты (email) слушателя.<br/><strong>Например:</strong> info@roscentrdpo.ru" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="personaemail" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: info@roscentrdpo.ru</p>
							<span class="help-inline" id="email" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="personaphone" class="control-label">Телефон</label>
						<div class="controls">
							<input type="text" id="personaphone" class="span4 input-popover inpval" data-content="Введите контактный номер телефона слушателя.<br/><strong>Например:</strong> (863)273-66-61" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="personaphone" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: (863) 273-66-61</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<legend>Данные о предыдущем образовании</legend>
					<div class="control-group">
						<label for="graduated" class="control-label">Наименование<br/>учебного заведения</label>
						<div class="controls">
							<textarea rows="2" id="graduated" class="span4 input-popover inpval" data-content="Введите наименование учебного заведения где обучался слушатель" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="graduated"></textarea> <span class="badge badge-info">!</span>
							<p class="help-block">Например: КГПУ им. Остроградского</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="year" class="control-label">Год окончания</label>
						<div class="controls">
							<input type="text" id="year" class="span1 input-popover inpval digital" data-content="Введите год окончания обучения слушателя.<br/><strong>Например:</strong> 1996" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="year" value="" maxlength="4"> <span class="badge badge-info">!</span>
							<p class="help-block">Например: 1996</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="typedocument" class="control-label">Документ<br/>об образовании</label>
						<div class="controls">
							<select id="typedocument" class="span2 input-popover" data-content="Выберите название документа об образовании слушателя" data-trigger="hover" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Выберите из списка" name="typedocument">
								<option value="1">Диплом</option>
								<option value="2">Аттестат</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="documentnumber" class="control-label">Номер выданного<br/>документа</label>
						<div class="controls">
							<input type="text" id="documentnumber" class="span4 input-popover inpval" data-content="Введите номер документа об образвании слушателя.<br/><strong>Например:</strong> ВСА 1234567" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="documentnumber" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: ВСА 1234567</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="specialty" class="control-label">Специальность</label>
						<div class="controls">
							<input type="text" id="specialty" class="span4 input-popover inpval" data-content="Введите специальность слушателя.<br/><strong>Например:</strong> Компьютерные системы и сети" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="specialty" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: Компьютерные системы и сети</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
					<div class="control-group">
						<label for="qualification" class="control-label">Квалификация</label>
						<div class="controls">
							<input type="text" id="qualification" class="span4 input-popover inpval" data-content="Введите квалификацию слушателя.<br/><strong>Например:</strong> Инженер компьютерных систем и сетей" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="qualification" value=""> <span class="badge badge-info">!</span>
							<p class="help-block">Например: Инженер компьютерных систем и сетей</p>
							<span class="help-inline" style="display:none;">&nbsp;</span>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="clear"></div>
	<div class="modal-footer span9">
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Добавить</button>
	</div>
<?= form_close(); ?>