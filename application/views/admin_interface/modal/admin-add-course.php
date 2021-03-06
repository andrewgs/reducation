<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" id="idTrend" value="" name="trend" />
	<div id="addCourse" class="modal hide">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление курса обучения</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="TitleCourse" class="input-xlarge ainput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="code" class="control-label">Код: </label>
					<div class="controls">
						<input type="text" id="CodeCourse" class="input-xlarge ainput" name="code">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="price" class="control-label">Цена (руб.): </label>
					<div class="controls">
						<input type="text" id="PriceCourse" class="input-xlarge" name="price">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="hours" class="control-label">Время (час): </label>
					<div class="controls">
						<input type="text" id="HoursCourse" class="input-xlarge ainput" name="hours">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="note" class="control-label">Виды работ: </label>
					<div class="controls">
						<textarea name="note" rows="3" id="NoteCourse" class="input-xlarge"></textarea>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="ViewTrend" class="control-label">Видимость: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" value="1" id="ViewCourse" name="view">
							Показывать курс пользователям
						</label>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="send" name="submit" value="send">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>