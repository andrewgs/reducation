<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div id="addDoc" class="modal hide dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Добавление списока литературы</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="DocumentFile" class="control-label">Документ</label>
					<div class="controls">
						<input type="file" id="elDocumentFile" class="input-file lbinput" name="document" size="30">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="lbsend" name="lbsubmit" value="lbsend">Добавить</button>
		</div>
	</div>
<?= form_close(); ?>