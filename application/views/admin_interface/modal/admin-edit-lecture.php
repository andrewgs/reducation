<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idChapter" value="" name="idchp" />
	<input type="hidden" class="idLecture" value="" name="idlec" />
	<div id="editLecture" class="modal hide dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Редактирование лекции</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="eTitleLecture" class="input-xlarge elinput" name="title" value="">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="number" class="control-label">Порядковый номер: </label>
					<div class="controls">
						<input type="text" id="eNumberLecture" class="input-xlarge elinput" name="number">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="DocumentFile" class="control-label">Документ</label>
					<div class="controls">
						<input type="file" id="eDocumentFile" class="input-file" name="document" size="30">
						<p class="help-block">Загружаемый документ заменит текущий</p>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="elsend" name="elsubmit" value="lsend">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>