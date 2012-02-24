<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idQuestion" value="" name="idqes" />
	<div id="addAnswer" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление ответа</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Ответ: </label>
					<div class="controls">
						<input type="text" id="TitleAnswer" class="input-xlarge aainput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="number" class="control-label">Порядковый номер: </label>
					<div class="controls">
						<input type="text" id="NumberAnswer" class="input-xlarge aainput" name="number">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="correct" class="control-label">Правильный ответ: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" value="1" class="CorrectAnswer" name="correct">
							Установите если ответ является верным
						</label>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="asend" name="asubmit" value="send">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>