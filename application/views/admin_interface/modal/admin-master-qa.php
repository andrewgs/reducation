<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal'));?>
<div id="addQA" class="modal hide fade">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Вопрос №<span id="nQ">1</span></h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label for="title" class="control-label">Вопрос: </label>
				<div class="controls">
					<textarea rows="1" id="mTitleQuestion" class="input-xlarge mqinput"></textarea>
					<span class="help-inline"  style="display:none;">&nbsp;</span>
				</div>
			</div>
			<?php for ( $i = 0; $i < 5; $i++ ): ?>
			<div class="control-group">
				<label for="answer<?=$i?>" class="control-label">Ответ: </label>
				<div class="controls">
					<input type="text" class="input-xlarge mainput" num="<?=$i;?>" name="answer<?=$i?>">
					<input type="checkbox" value="1" class="MCAnswer" name="correct" title="Установите если ответ является верным">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<?php endfor;?>
			<div id="chError" style="display:none;" class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">×</a>
				<strong>Ошибка!</strong> <span class="error-text">Должен быть выбран хотя бы один правильный ответ.</span>
			</div>
		</fieldset>
	</div>
	<div class="modal-footer">
		<a class="btn" id="MasterStop" data-dismiss="modal">Закрыть мастер</a>
		<a class="btn btn-success" id="MasterNext">Продолжить</a>
	</div>
<div id="resQA"></div>
</div>
<?= form_close(); ?>
