<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idChapter" value="" name="chapter" />
	<div id="addLecture" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление лекции</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="title" class="control-label">Название: </label>
					<div class="controls">
						<input type="text" id="TitleLecture" class="input-xlarge linput" name="title">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="number" class="control-label">Порядковый номер: </label>
					<div class="controls">
						<input type="text" id="NumberLecture" class="input-xlarge linput" name="number" value="">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="DocumentFile" class="control-label">Документ</label>
					<div class="controls">
						<input type="file" id="DocumentFile" class="input-file linput" name="document" size="30">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="lsend" name="lsubmit" value="lsend">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>