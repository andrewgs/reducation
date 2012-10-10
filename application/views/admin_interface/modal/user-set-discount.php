<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<input type="hidden" id="idOrder" value="" name="order" />
	<div id="discount" class="modal hide dmodal">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Управлением заказом</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<div class="control-group">
					<label for="discount" class="control-label">Сумма скидки: </label>
					<div class="controls">
						<input type="text" id="DiscountValue" class="input-xlarge dhinput digital" name="discount">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="paiddoc" class="control-label">Номер платежного поручения: </label>
					<div class="controls">
						<input type="text" id="DocumentValue" class="input-xlarge digital" name="paiddoc">
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="paiddate" class="control-label">Дата оплаты: </label>
					<div class="controls">
						<input type="text" id="PaidDate" class="input-xlarge" name="paiddate">
						<p class="help-block">Например: 01.01.2012</p>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="numberplacement" class="control-label">Номер приказа на зачисление: </label>
					<div class="controls">
						<input type="text" id="NumberPlacement" class="input-xlarge" name="numberplacement">
						<p class="help-block">Если Вы только что произвели оплату<br/>обновите страницу для изменения номера приказа</p>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="numbercompletion" class="control-label">Номер приказа о окончании: </label>
					<div class="controls">
						<input type="text" id="NumberCompletion" class="input-xlarge" name="numbercompletion">
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