<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Вход в личный кабинет</li>
			<li>
			<?=form_open($this->uri->uri_string(),array('class'=>'form-inline')); ?>
				<fieldset>
					<div class="control-group">
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">Логин:&nbsp;&nbsp;</span>
								<input type="text" id="login" class="input-medium focused" name="login">
								<span class="help-inline" style="display:none; padding-left: 0px;">&nbsp;</span>
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on">Пароль:</span>
								<input type="password" id="password" class="input-medium focused" name="password">
								<span class="help-inline" style="display:none; padding-left: 0px;">&nbsp;</span>
							</div>
						</div>
					</div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
					<div class="form-actions">
						<button class="btn btn-info" type="submit" id="lsend" name="lsubmit" value="lsend">Авторизация</button>
						<button class="btn" type="reset" id="authCancel">Отмена</button>
					</div>
				</fieldset>
			<?= form_close(); ?>
			</li>
		</ul>
	</div>
</div>