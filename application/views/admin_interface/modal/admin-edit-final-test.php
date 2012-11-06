<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idTest" value="" name="idt" />
	<div id="editFTest" class="modal hide dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование итогового тестирования</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="eTitleFTest" class="input-xlarge eftinput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="count" class="control-label">Количество попыток: </label>
					<div class="controls">
						<input type="text" id="eСountFTest" class="input-xlarge eftinput" name="count">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="time" class="control-label">Время на тест (мин): </label>
					<div class="controls">
						<input type="text" id="eTimeFTest" class="input-xlarge eftinput" name="time">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="eftsend" name="eftsubmit" value="send">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>