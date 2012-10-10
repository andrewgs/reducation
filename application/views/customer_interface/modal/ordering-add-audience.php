<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal'));?>
	<input type="hidden" id="idCourse" value="" name="idcur" />
	<div id="addAudience" class="modal hide">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Укажите слушателей курса</h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<?php for($i=0;$i<count($audience);$i++): ?>
				<div class="control-group">
					<div class="controls" style="margin-left:20px;">
						<label class="checkbox">
							<input type="checkbox" value="<?=$audience[$i]['id']?>" class="audList" name="audience[]">
							<?=$audience[$i]['lastname'].' '.$audience[$i]['name'].' '.$audience[$i]['middlename'].' ('.$audience[$i]['specialty'].')';?>
						</label>
					</div>
				</div>
				<?php endfor;?>
				<?php if(!count($audience)):?>
					<span class="label label-warning">Отсутствуют слушатели.<br/>Перед началом оформления заказов обедитесь в наличии слушателей</span>
					<div style="margin-top:20px;"></div>
					<?=anchor('customer/registration/audience','Регистрировать слушателя',array('class'=>'btn btn-primary'));?>
					<?=anchor('customer/audience/list','Список слушателей',array('class'=>'btn btn-info'));?>
				<?php endif;?>
				<div id="chError" style="display:none;" class="alert alert-error">
					<span class="error-text">Должен быть выбран хотя бы один слушатель.</span>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<a class="btn" id="CloseSelect" data-dismiss="modal">Закрыт</a>
		<?php if(count($audience)):?>
			<button class="btn btn-success" type="submit" name="ssubmit" value="ssubmit" id="Select">Выбрать</button>
		<?php endif;?>
		</div>
	</div>
<?= form_close(); ?>