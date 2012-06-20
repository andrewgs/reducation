<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div id="addDate" class="modal hide fade">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление праздничной даты</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Дата: </label>
					<div class="controls">
						<input type="text" id="dateval" class="input-small dainput" name="date">
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Например: 01.01.2012</p>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" id="AddDateCancel">Отменить</button>
			<button class="btn btn-success" type="submit" id="dasend" name="adddate" value="send">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>