<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span4" style="margin-left:0px;">
			<div class="control-group">
				<label for="organization" class="control-label">Наименование</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['organization'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="inn" class="control-label">ИНН</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['inn'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="kpp" class="control-label">КПП</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['kpp'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="manager" class="control-label">Должность</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['manager'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="fiomanager" class="control-label">Ф.И.О. руководителя</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['fiomanager'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="statutory" class="control-label">Уставной документ</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['statutory'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="accountnumber" class="control-label">Номер счёта</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['accountnumber'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="bank" class="control-label">Наименование<br/>банка</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['bank'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['accountkornumber'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="bik" class="control-label">БИК</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['bik'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="uraddress" class="control-label">Юридический<br/>адрес</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['uraddress'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="postaddress" class="control-label">Почтовый<br/>адрес</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['postaddress'];?></span>
				</div>
			</div>
			<div class="control-group" id="cgemail">
				<label for="personemail" class="control-label">E-mail</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['personemail'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="person" class="control-label">Контактное лицо</label>
				<div class="controls">
					<span class="help-inline"><?=$customer['person'];?></span>
				</div>
			</div>
		</div>
	</fieldset>
<?= form_close(); ?>