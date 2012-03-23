<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idChapter" value="" name="idchp" />
	<div id="editChapter" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование главы</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="eTitleChapter" class="input-xlarge echinput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="number" class="control-label">Порядковый номер: </label>
					<div class="controls">
						<input type="text" id="eNumberChapter" class="input-xlarge echinput" name="number">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="level" class="control-label">Уровень вложенности</label>
					<div class="controls">
						<select id="eLevelChapter" name="level">
							<option value="0">Уровень первый</option>
							<option value="1">Уровень вротой</option>
							<option value="2">Уровень третий</option>
						</select>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="echsend" name="echsubmit" value="send">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>