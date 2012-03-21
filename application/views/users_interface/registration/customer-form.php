<form class="form-horizontal">
	<fieldset>
		<legend>
			Общие данные
		</legend>
		<div class="control-group">
			<label for="organization" class="control-label">Наименование</label>
			<div class="controls">
				<input type="text" id="title" class="input-xlarge inpval" name="organization">
			</div>
		</div>
		<div class="control-group">
			<label for="inn" class="control-label">ИНН</label>
			<div class="controls">
				<input type="text" id="inn" class="input-xlarge inpval" name="inn">
			</div>
		</div>
		<div class="control-group">
			<label for="kpp" class="control-label">КПП</label>
			<div class="controls">
				<input type="text" id="kpp" class="input-xlarg inpval" name="kpp">
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>
			Юридический адрес
		</legend>
		<div class="control-group">
			<label for="country" class="control-label">Страна</label>
			<div class="controls">
				<select id="country" name="country">
					<option>Россия</option>
					<option>Украина</option>
					<option>Белоруссия</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="area" class="control-label">Область, край</label>
			<div class="controls">
				<select id="area" name="area">
					<option>Москва</option>
					<option>Санкт-Петербург</option>
					<option>Ростов-на-Дону</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label for="optionsCheckbox" class="control-label">Checkbox</label>
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" value="option1" id="optionsCheckbox">
					Option one is this and that&mdash;be sure to include why it's great </label>
			</div>
		</div>					
		<div class="control-group">
			<label for="fileInput" class="control-label">File input</label>
			<div class="controls">
				<input type="file" id="fileInput" class="input-file">
			</div>
		</div>
		<div class="control-group">
			<label for="textarea" class="control-label">Textarea</label>
			<div class="controls">
				<textarea rows="3" id="textarea" class="input-xlarge"></textarea>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit">
				Зарегистрировать заявку
			</button>
			<button class="btn" type="reset">
				Отменить
			</button>
		</div>
	</fieldset>
</form>