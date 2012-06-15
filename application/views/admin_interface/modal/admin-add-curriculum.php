<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" class="idLecture" value="" name="idlec" />
	<div id="addCurriculum" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление учебного плана</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="DocumentFile" class="control-label">Документ</label>
					<div class="controls">
						<input type="file" id="ecDocumentFile" class="input-file crinput" name="document" size="30">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="crsend" name="crsubmit" value="crsend">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>