<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
	<?php if($readonly):?>
		<div class="alert alert-info">
			Вы не можете изменять персональные данные после оформления заказа.<br/>Если вы обнаружили ошибку, то позвоните по контактному телефону и объясните свою проблему.
		</div>
	<?php endif;?>
		<div class="span9" style="margin-left:0px;">
			<legend>
				Общие данные
			</legend>
			<div class="control-group">
				<label for="fio" class="control-label">Ф.И.О.</label>
				<div class="controls">
					<input type="text" id="fio" class="span4 inpval" name="fio" value="<?=$physical['fio'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
					<p class="help-block">Петров Иван Сергеевич</p>
				</div>
			</div>
			<div class="control-group">
					<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
					<div class="controls">
						<input type="text" id="fiodat" class="span4 inpval" name="fiodat" value="<?=$physical['fiodat'];?>">
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Петрову Ивану Сергеевичу</p>
					</div>
				</div>
			<div class="control-group">
				<label for="inn" class="control-label">ИНН</label>
				<div class="controls">
					<input type="text" id="inn" class="span4 inpval digital" name="inn" value="<?=$physical['inn'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="phones" class="control-label">Номер телефона</label>
				<div class="controls">
					<input type="text" id="phone" class="span4 inpval" name="phones" value="<?=$physical['phones'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="postaddress" class="control-label">Почтовый адрес</label>
				<div class="controls">
					<input type="text" class="span4 inpval" name="postaddress" value="<?=$physical['postaddress'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
					<p class="help-block">344001, г.Ростов-на-Дону, ул.Республиканская, д.86</p>
				</div>
			</div>
			<div class="control-group">
				<label for="email" class="control-label">Email</label>
				<div class="controls">
					<input type="text" id="email" class="span4 inpval" name="email" value="<?=$physical['email'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
		</div>
	</fieldset>
	<?php if(!$readonly):?>
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Сохранить</button>
	</div>
	<?php endif;?>
<?= form_close(); ?>