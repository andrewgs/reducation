<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span4" style="margin-left:0px;">
			<div class="control-group">
				<label for="nborder" class="control-label">Номер заказа</label>
				<div class="controls">
					<input type="text" id="nborder" class="input-xlarge inpval digital" autocomplete="off" name="nborder" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="customer" class="control-label">Заказчик</label>
				<div class="controls">
					<input type="text" id="customer" class="input-xlarge inpval" name="customer" value="" size="25" autocomplete="off">
					<div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="<?=$baseurl;?>/img/arrow.png" style="position: relative; top: -15px; left: 30px;" alt="upArrow" />
						<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
					</div>
					<p class="help-block">Поиск от 2-х символов</p>
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="nbpaiddoc" class="control-label">Номер платежного поручения</label>
				<div class="controls">
					<input type="text" id="nbpaiddoc" class="input-xlarge inpval digital" name="nbpaiddoc" autocomplete="off" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="nbadmission" class="control-label">Номер приказа о зачислени</label>
				<div class="controls">
					<input type="text" id="nbadmission" class="input-xlarge inpval digital" name="nbadmission" autocomplete="off" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="nbcompletion" class="control-label">Номер приказа о окончании</label>
				<div class="controls">
					<input type="text" id="nbcompletion" class="input-xlarge inpval digital" name="nbcompletion" autocomplete="off" value="">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<span class="help-inline" id="err" style="display:none;color: #B94A48;">&nbsp;</span>
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-search icon-white"></i> Найти</button>	</div>
<?= form_close(); ?>