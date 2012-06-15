<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idAnswer" value="" name="idans" />
	<input type="hidden" class="idQuestion" value="" name="idqes" />
	<div id="editAnswer" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование ответа</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Ответ: </label>
					<div class="controls">
						<input type="text" id="eTitleAnswer" class="input-xlarge eainput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="number" class="control-label">Порядковый номер: </label>
					<div class="controls">
						<input type="text" id="eNumberAnswer" class="input-xlarge eainput" name="number">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="correct" class="control-label">Правильный ответ: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" value="1" id="eCorrectAnswer" name="correct">
							Установите если ответ является верным
						</label>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="easend" name="easubmit" value="send">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>