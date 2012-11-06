<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div id="addQuestion" class="modal hide dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление вопроса</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Вопрос: </label>
					<div class="controls">
						<input type="text" id="TitleQuestion" class="input-xlarge aqinput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="number" class="control-label">Порядковый номер: </label>
					<div class="controls">
						<input type="text" id="NumberQuestion" class="input-xlarge aqinput" name="number">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="qsend" name="qsubmit" value="send">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>