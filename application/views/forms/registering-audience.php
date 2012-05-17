<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span9">
			<legend>Личные данные</legend>
			<div class="control-group">
				<label for="lastname" class="control-label">Фамилия</label>
				<div class="controls">
					<input type="text" id="lastname" class="input-xlarge inpval" name="lastname" value="">
					<p class="help-block">Например: Петров</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="name" class="control-label">Имя</label>
				<div class="controls">
					<input type="text" id="name" class="input-xlarge inpval" name="name" value="">
					<p class="help-block">Например: Иван</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="middlename" class="control-label">Отчество</label>
				<div class="controls">
					<input type="text" id="middlename" class="input-xlarge inpval" name="middlename" value="">
					<p class="help-block">Например: Сергеевич</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
				<div class="controls">
					<input type="text" id="fiodat" class="input-xlarge inpval" name="fiodat" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
					<p class="help-block">Например: Петрову Ивану Сергеевичу</p>
				</div>
			</div>
			<div class="control-group">
				<label for="position" class="control-label">Должность</label>
				<div class="controls">
					<input type="text" id="position" class="input-xlarge inpval" name="position" value="">
					<p class="help-block">Например: инженер-программист</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Адрес</legend>
			<div class="control-group">
				<label for="address" class="control-label">Область, город, улица, дом, корпус, квартира, индекс</label>
				<div class="controls">
					<textarea rows="3" id="address" class="input-xlarge inpval" name="address"></textarea>
					<p class="help-block">Например: 344001, г.Ростов-на-Дону, ул.Республиканская, д.86</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Контактные данные</legend>
			<div class="control-group" id="cgemail">
				<label for="personaemail" class="control-label">E-mail</label>
				<div class="controls">
					<input type="text" id="personaemail" class="input-xlarge inpval" name="personaemail" value="">
					<p class="help-block">Например: info@roscentrdpo.ru</p>
					<span class="help-inline" id="email" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="personaphone" class="control-label">Телефон</label>
				<div class="controls">
					<input type="text" id="personaphone" class="input-xlarge inpval" name="personaphone" value="">
					<p class="help-block">Например: (863) 273-66-61</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Данные о предыдущем образовании</legend>
			<div class="control-group">
				<label for="graduated" class="control-label">Наименование<br/>учебного заведения</label>
				<div class="controls">
					<textarea rows="2" id="graduated" class="input-xlarge inpval" name="graduated"></textarea>
					<p class="help-block">Например: КГПУ им. Остроградского</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="year" class="control-label">Год окончания</label>
				<div class="controls">
					<input type="text" id="year" class="input-small inpval digital" name="year" value="" maxlength="4">
					<p class="help-block">Например: 2006</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="typedocument" class="control-label">Документ<br/>об образовании</label>
				<div class="controls">
					<select id="typedocument" name="typedocument">
						<option value="1">Диплом</option>
						<option value="2">Аттестат</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label for="documentnumber" class="control-label">Номер выданного<br/>документа</label>
				<div class="controls">
					<input type="text" id="documentnumber" class="input-xlarge inpval" name="documentnumber" value="">
					<p class="help-block">Например: ВСА 1234567</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="specialty" class="control-label">Специальность</label>
				<div class="controls">
					<input type="text" id="specialty" class="input-xlarge inpval" name="specialty" value="">
					<p class="help-block">Например: Компьютерные системы и сети</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="qualification" class="control-label">Квалификация</label>
				<div class="controls">
					<input type="text" id="qualification" class="input-xlarge inpval" name="qualification" value="">
					<p class="help-block">Например: Инженер компьютерных систем и сетей</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Сохранить</button>
	</div>
<?= form_close(); ?>