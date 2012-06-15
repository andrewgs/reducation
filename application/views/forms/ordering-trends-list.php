<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Выберите один из предложенных направлений обучения (Шаг 1)</legend>
		<div class="control-group">
			<div class="controls" style="margin-left: 40px;">
			<?php for($i=0;$i<count($trends);$i++):?>
			<?php $numCourses = 0;
				for($j=0;$j<count($courses);$j++):
					 if($courses[$j]['trend'] == $trends[$i]['id']):
					 	$numCourses++;
					 endif;
				endfor; ?>
				<?php if($numCourses):?>
					<label class="radio">
						<input type="radio" class="redioTrends" name="optRadio" id="optRadios<?=$i;?>" value="<?=$trends[$i]['id'];?>">
						Код: <strong><?=$trends[$i]['code'];?></strong>. <?=$trends[$i]['title'];?>;
					</label>
					<p class="help-block" style="margin-left:18px;"><span class="small">(курсов: <?=$numCourses;?>)</span></p>
					<div style="margin-top:10px;"></div>
				<?php endif;?>
			<?php endfor;?>
			<?php if(!count($trends)):?>
				<span class="label label-warning">По какой-то не виданной причине отсутствуют направления обучения.</span>
				<div style="margin-top:20px;"></div>
				<span class="label label-info">Свяжитесь с администрацией для выяснения причин. Спасибо за понимание.</span>
			<?php endif;?>
			</div>
		</div>
	</fieldset>
<?php if(count($trends)):?>
	<div class="modal-footer">
		<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
		<button class="btn btn-info disabled" type="submit" id="send" name="submit" value="send">Далее <i class="icon-forward icon-white"></i></button>
	</div>	
<?php endif;?>
<?= form_close(); ?>