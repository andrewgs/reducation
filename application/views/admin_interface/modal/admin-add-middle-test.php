<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idChapter" value="" name="chapter" />
	<div id="addMTest" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление промежуточного тестирования</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="TitleMTest" class="input-xlarge amtinput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="count" class="control-label">Количество попыток: </label>
					<div class="controls">
						<input type="text" id="СountMTest" class="input-xlarge amtinput" name="count">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="time" class="control-label">Время на тест (мин): </label>
					<div class="controls">
						<input type="text" id="timeMTest" class="input-xlarge amtinput" name="time">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="mtsend" name="mtsubmit" value="send">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>