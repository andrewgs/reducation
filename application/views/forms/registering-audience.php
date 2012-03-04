<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span4" style="margin-left:0px;">
			<legend>ФИО</legend>
			<div class="control-group">
				<label for="lastname" class="control-label">Фамилия</label>
				<div class="controls">
					<input type="text" id="lastname" class="input-xlarge inpval" name="lastname" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="name" class="control-label">Имя</label>
				<div class="controls">
					<input type="text" id="name" class="input-xlarge inpval" name="name" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="middlename" class="control-label">Отчество</label>
				<div class="controls">
					<input type="text" id="middlename" class="input-xlarge inpval" name="middlename" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Адрес</legend>
			<div class="control-group">
				<label for="address" class="control-label">Область, город, улица, дом, корпус, квартира, индекс</label>
				<div class="controls">
					<textarea rows="3" id="address" class="input-xlarge inpval" name="address"></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Контактные данные</legend>
			<div class="control-group" id="cgemail">
				<label for="personaemail" class="control-label">E-mail</label>
				<div class="controls">
					<input type="text" id="personaemail" class="input-xlarge inpval" name="personaemail" value="">
					<span class="help-inline" id="email" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="personaphone" class="control-label">Телефон</label>
				<div class="controls">
					<input type="text" id="personaphone" class="input-xlarge inpval" name="personaphone" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
		<div class="span4" style="margin-left: 60px;">
			<legend>Данные о предыдущем образовании</legend>
			<div class="control-group">
				<label for="graduated" class="control-label">Наименование<br/>учебного заведения</label>
				<div class="controls">
					<textarea rows="2" id="graduated" class="input-xlarge inpval" name="graduated"></textarea>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="year" class="control-label">Год окончания</label>
				<div class="controls">
					<input type="text" id="year" class="input-small inpval digital" name="year" value="" maxlength="4">
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
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="specialty" class="control-label">Специальность</label>
				<div class="controls">
					<input type="text" id="specialty" class="input-xlarge inpval" name="specialty" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="qualification" class="control-label">Квалификация</label>
				<div class="controls">
					<input type="text" id="qualification" class="input-xlarge inpval" name="qualification" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Сохранить</button>
	</div>
<?= form_close(); ?>