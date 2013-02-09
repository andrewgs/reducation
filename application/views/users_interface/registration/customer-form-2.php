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
					Юридический адрес
				</legend>
				<div class="control-group">
					<label for="uraddress" class="control-label">Область, город, улица, дом, корпус, квартира, индекс</label>
					<div class="controls">
						<textarea rows="3" id="uraddress" class="span4 input-popover inpval" data-content="Введите полный юридический адрес Вашей организации.<br/><strong>Например:</strong> 344001, Ростовская область, г.Ростов-на-Дону, ул.Республиканская, д.86" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="uraddress"><?=$this->session->userdata('uraddress');?></textarea> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
						<p class="help-block">
							<label class="checkbox">
								<input id="check-address" type="checkbox"> Совпадает с почтовым адресом
							</label>
						</p>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>
					Почтовый адрес
				</legend>
				<div class="control-group">
					<label for="postaddress" class="control-label">Область, город, улица, дом, корпус, квартира, индекс</label>
					<div class="controls">
						<textarea rows="3" id="postaddress" class="span4 input-popover inpval" data-content="Введите полный почтовый адрес Вашей организации.<br/><strong>Например:</strong> 344001, Ростовская область, г.Ростов-на-Дону, ул.Республиканская, д.86" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-original-title="Обязательное поле" name="postaddress"><?=$this->session->userdata('postaddress');?></textarea> <span class="badge badge-info">!</span>
						<span class="help-inline" style="display:none;">&nbsp;</span>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="clear"></div>
	<div class="modal-footer span11">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
		<?=anchor('registration/customer/step/1','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-info'));?>
	</div>
<?= form_close(); ?>