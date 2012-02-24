<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div id="addTrend" class="modal hide fade">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление направления обучения</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="TitleTrend" class="input-xlarge ainput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="code" class="control-label">Код: </label>
					<div class="controls">
						<input type="text" id="CodeTrend" class="input-xlarge ainput" name="code">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="ViewTrend" class="control-label">Видимость: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" value="1" id="ViewTrend" name="view">
							Показывать направление пользователям
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