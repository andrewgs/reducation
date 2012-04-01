<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>
			Юридический адрес
		</legend>
		<div class="control-group">
			<label for="uraddress" class="control-label">Область, город, улица, дом, корпус, квартира, индекс</label>
			<div class="controls">
				<textarea rows="3" id="uraddress" class="input-xlarge inpval" name="uraddress"><?=$this->session->userdata('uraddress');?></textarea>
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
				<textarea rows="3" id="postaddress" class="input-xlarge inpval" name="postaddress"><?=$this->session->userdata('postaddress');?></textarea>
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
	</fieldset>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
		<?=anchor('registration/customer/step/1','<i class="icon-backward icon-white"></i> Назад',array('class'=>'btn btn-info'));?>
	</div>
<?= form_close(); ?>