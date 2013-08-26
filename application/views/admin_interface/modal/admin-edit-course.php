<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" id="idCourse" value="" name="icrs" />
	<div id="editCourse" class="modal hide">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование курса обучения</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="eTitleCourse" class="input-xlarge einput" name="title" value="">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="code" class="control-label">Код: </label>
					<div class="controls">
						<input type="text" id="eCodeCourse" class="input-xlarge einput" name="code" value="">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="price" class="control-label">Цена (руб.): </label>
					<div class="controls">
						<input type="text" id="ePriceCourse" class="input-xlarge einput" name="price">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="hours" class="control-label">Время (час): </label>
					<div class="controls">
						<input type="text" id="eHoursCourse" class="input-xlarge einput" name="hours">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="note" class="control-label">Виды работ: </label>
					<div class="controls">
						<textarea name="note" rows="3" id="eNoteCourse" class="input-xlarge einput"></textarea>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="ViewCourse" class="control-label">Видимость: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" value="1" id="eViewCourse" name="view">
							Показывать курс пользователям
						</label>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="saveCourse" name="esubmit" value="esend">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>