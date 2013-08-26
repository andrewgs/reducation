<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<div class="span12" style="margin-left:0px;">
		<fieldset>
			<div class="control-group">
				<div class="controls">
					<p class="help-block pull-right">Поля с знаком <span class="badge badge-info">!</span> - обязательные для заполнения</p>
				</div>
			</div>
		</fieldset>
		<div class="span12" style="margin-left:0px;">
			<fieldset>
				<legend>
					Контактные данные
				</legend>
				<div class="control-group" id="cgemail">
					<label for="personemail" class="control-label">E-mail</label>
					<div class="controls">
						<input type="text" id="personemail" class="span4 input-popover inpval" data-content="Ваш адрес электронной почты (email).<br/><strong>Например:</strong> info@roscentrdpo.ru" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="personemail" value="<?=$this->session->userdata('personemail')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" id="email" style="display:none;">&nbsp;</span>
						<p class="help-block">info@roscentrdpo.ru</p>
					</div>
				</div>
				<div class="control-group">
					<label for="person" class="control-label">Контактное лицо</label>
					<div class="controls">
						<input type="text" id="person" class="span4 input-popover inpval" data-content="Ваше Имя, Фамилия и Отчество.<br/><strong>Например:</strong> Иванов Иван Иванович" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="person" value="<?=$this->session->userdata('person')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">Иванов Иван Иванович</p>
					</div>
				</div>
				<div class="control-group">
					<label for="phones" class="control-label">Номер конт.телефона</label>
					<div class="controls">
						<input type="text" id="person" class="span4 input-popover inpval" data-content="Ваш контактный номер телефона.<br/><strong>Например:</strong> (863)273-66-61" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="phones" value="<?=$this->session->userdata('phones')?>"> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">(863)273-66-61</p>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="clear"></div>
	<div class="modal-footer span11">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
		<?=anchor('registration/customer/step/2','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-info'));?>
	</div>
<?= form_close(); ?>