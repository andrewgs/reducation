<form class="form-horizontal" method="POST" action="<?=$this->uri->uri_string();?>">
	<fieldset>
		<legend>
			<?=$form_title;?>
		</legend>
	<?php if($msg):?>
		<div class="alert alert-block" id="msgalert">
			<a class="close" id="msgclose">×</a>
			<h4 class="alert-heading">Внимание!</h4>
			<?=$msg;?>
		</div>
	<?php endif; ?>
		<div class="control-group">
			<label for="login" class="control-label">Логин</label>
			<div class="controls">
				<input type="text" id="login" class="input-xlarge" name="login">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="password" class="control-label">Пароль</label>
			<div class="controls">
				<input type="password" id="password" class="input-xlarge" name="password">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-primary" type="submit" id="send" name="submit" value="send">Войти на сайт</button>
			<button class="btn" type="reset" id="reset">Отменить</button>
		</div>
	</fieldset>
</form>