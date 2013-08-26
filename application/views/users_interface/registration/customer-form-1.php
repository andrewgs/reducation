<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div class="span12" style="margin-left:0px;">
		<fieldset>
			<div class="control-group">
				<p class="help-block pull-left">Поля со знаком <span class="badge badge-info">!</span> обязательные для заполнения</p>
			</div>
		</fieldset>
		<div class="span6" style="margin-left:0px;">
			<fieldset>
				<legend>
					Общие данные
				</legend>
				<div class="control-group">
					<label for="organization" class="control-label">Наименование</label>
					<div class="controls">
						<input type="text" id="organization" class="span3 input-popover inpval" data-content="Наименование Вашей организации.<br/><strong>Например:</strong> АНО ДПО «Южно-окружной центр повышения квалификации»" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="organization" value="<?=$this->session->userdata('organization')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">АНО ДПО «Южно-окружной центр повышения квалификации»</p>
					</div>
				</div>
				<div class="control-group">
					<label for="fiomanager" class="control-label">Ф.И.О. руководителя</label>
					<div class="controls">
						<input type="text" id="fiomanager" class="span3 input-popover inpval" data-content="Введите Фамилию, Имя и Отчество руководителя Вашей организации в родительном падеже.<br/><strong>Например:</strong> Иванова Ивана Ивановича" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="fiomanager" value="<?=$this->session->userdata('fiomanager')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Иванова Ивана Ивановича</p>
					</div>
				</div>
				<div class="control-group">
					<label for="manager" class="control-label">Должность</label>
					<div class="controls">
						<input type="text" id="manager" class="span3 input-popover inpval" data-content="Введите должность руководителя Вашей организации в родительном падеже.<br/><strong>Например:</strong> Директору" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="manager" value="<?=$this->session->userdata('manager')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Директору</p>
					</div>
				</div>		
				<div class="control-group">
					<label for="statutory" class="control-label">Уставной документ</label>
					<div class="controls">
						<input type="text" id="statutory" class="span3 input-popover inpval" data-content="Введите название уставного документа Вашей организации в родительном падеже. <br/><strong>Например:</strong> Устава" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="statutory" value="<?=$this->session->userdata('statutory')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Устава</p>
					</div>
				</div>
				<div class="control-group">
					<label for="inn" class="control-label">ИНН</label>
					<div class="controls">
						<input type="text" id="inn" class="span3 input-popover inpval digital" data-content="Введите ИНН Вашей организации" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="inn" value="<?=$this->session->userdata('inn')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">ИНН Вашей организации</p>
					</div>
				</div>
				<div class="control-group">
					<label for="kpp" class="control-label">КПП</label>
					<div class="controls">
						<input type="text" id="kpp" class="span3 input-popover inpval digital" data-content="Введите КПП Вашей организации" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="kpp" value="<?=$this->session->userdata('kpp')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">КПП Вашей организации</p>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="span6" style="margin-left:0px;">
			<fieldset>
				<legend>
					Банковские реквизиты
				</legend>
				<div class="control-group">
					<label for="accounttype" class="control-label">Тип счёта</label>
					<div class="controls">
						<select class="span3 input-popover" autocomplete="off" id="accounttype" disabled="disabled" data-content="Выберите тип счета в банке для Вашей организации" data-trigger="hover" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Выберите из списка" name="accounttype">
							<option selected="selected" value="1">Расчетный</option>
							<option value="2">Валютный</option>
							<option value="3">Текущий</option>
							<option value="4">Временный</option>
							<option value="5">Транзитный</option>
							<option value="6">Депозитный</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label for="accountnumber" class="control-label">Номер счёта</label>
					<div class="controls">
						<input type="text" id="accountnumber" class="span3 input-popover inpval digital" data-content="Введите номер банковского счета Вашей организации" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="accountnumber" maxlength="20" value="<?=$this->session->userdata('accountnumber')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Номер банковского счета</p>
					</div>
				</div>
				<div class="control-group">
					<label for="bank" class="control-label">Наименование<br/>банка</label>
					<div class="controls">
						<textarea rows="3" id="textarea" class="span3 input-popover inpval" data-content="Введите наименование банка Вашей организации" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="bank"><?=$this->session->userdata('bank');?></textarea> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Наименование банка Вашей организации</p>
					</div>
				</div>
				<div class="control-group">
					<label for="accountkornumber" class="control-label">Номер кор. счёта</label>
					<div class="controls">
						<input type="text" id="accountkornumber" class="span3 input-popover inpval digital" data-content="Введите номер корреспондентского счета Вашей организации" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="accountkornumber" maxlength="20" value="<?=$this->session->userdata('accountkornumber')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
				<div class="control-group">
					<label for="bik" class="control-label">БИК</label>
					<div class="controls">
						<input type="text" id="bik" class="span3 input-popover inpval digital" data-content="Введите БИК банка Вашей организации" data-trigger="focus" data-placement="<?=POPUP_POSITION;?>" data-toggle="popover" data-original-title="Обязательное поле" name="bik" maxlength="10" value="<?=$this->session->userdata('bik')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">БИК банка Вашей организации</p>
					</div>
				</div>
				<div class="control-group">
					<input name="consent" id="input-consent" value="1" autocomplete="off" type="checkbox"> Даю согласие на обработку персональных данных
				</div>
			</fieldset>
		</div>
	</div>
	<div class="clear"></div>
	<div class="modal-footer span11">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info" disabled="disabled" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
	</div>
<?= form_close(); ?>