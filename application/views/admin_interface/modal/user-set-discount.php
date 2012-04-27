<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" id="idOrder" value="" name="order" />
	<div id="discount" class="modal hide fade dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Управлением заказом</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="discount" class="control-label">Сумма скидки: </label>
					<div class="controls">
						<input type="text" id="DiscountValue" class="input-xlarge dhinput" name="discount">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="paiddoc" class="control-label">Номер документа: </label>
					<div class="controls">
						<input type="text" id="DocumentValue" class="input-xlarge dhinput" name="paiddoc">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Отменить</button>
			<button class="btn btn-success" type="submit" id="dsend" name="dsubmit" value="dsend">Сохранить</button>
		</div>
	</div>
<?= form_close(); ?>