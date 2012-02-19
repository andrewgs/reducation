<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idChapter" value="" name="chapter" />
	<input type="hidden" class="idTest" value="" name="idt" />
	<div id="editMTest" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование промежуточного тестирования</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="eTitleMTest" class="input-xlarge emtinput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="count" class="control-label">Количество попыток: </label>
					<div class="controls">
						<input type="text" id="eСountMTest" class="input-xlarge emtinput" name="count">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="time" class="control-label">Время на тест (мин): </label>
					<div class="controls">
						<input type="text" id="eTimeMTest" class="input-xlarge emtinput" name="time">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="emtsend" name="emtsubmit" value="send">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>