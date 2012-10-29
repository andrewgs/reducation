<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" id="idTrend" value="" name="idt" />
	<div id="editTrend" class="modal hide" >
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование направления обучения</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="login" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="eTitleTrend" class="input-xlarge einput" name="title" value="">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="password" class="control-label">Код: </label>
					<div class="controls">
						<input type="text" id="eCodeTrend" class="input-xlarge einput" name="code" value="">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="ViewTrend" class="control-label">Видимость: </label>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" value="1" id="ViewTrend" class="disabled" name="view" checked="chacked" disabled="disabled">
							Паправление отображается в зависимости от курсов
							<!--Показывать направление пользователям-->
						</label>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="saveTrend" name="esubmit" value="esend">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>