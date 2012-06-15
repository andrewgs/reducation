<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Выберите предложенные курсы и назначьте по ним слушателей (Шаг 2)</legend>
		<div class="control-group">
			<div class="controls" style="margin-left:-60px;">
				<div class="control-group">
				<?php if(count($courses)):?>
					<label for="course" class="control-label">Курс</label>
					<div class="controls">
						<select id="course" style="width: 600px;" name="course">
						<?php for($i=0;$i<count($courses);$i++):?>
							<option name="opcourse" id="opcourse<?=$i;?>" cusid="<?=$courses[$i]['code'];?>" costitle="<?=$courses[$i]['title'];?>" cosprice="<?=$courses[$i]['price'];?>" value="<?=$courses[$i]['id'];?>">Код: <?=$courses[$i]['code'].'. '.$courses[$i]['title'].'. Цена: '.$courses[$i]['price'];?></option>
						<?php endfor;?>
						</select>
					</div>
				<?php endif;?>
				</div>
			</div>
		<?php if(!count($courses)):?>
			<div class="controls" style="margin-left:0px;">
				<div class="control-group">
				
					<span class="label label-warning">По какой-то не виданной причине отсутствуют курсы обучения.</span>
					<div style="margin-top:20px;"></div>
					<span class="label label-info">Свяжитесь с администрацией для выяснения причин. Спасибо за понимание.</span>
				</div>
			</div>
		<?php endif;?>
		</div>
	</fieldset>
<?php if(count($courses)):?>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit" id="addCourse" name="submit" value="send"><i class="icon-plus icon-white"></i> Выбрать</button>
	</div>	
<?php endif;?>
<?= form_close(); ?>