<?=form_open(uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="control-group">
			<div class="controls" style="margin-left:-160px;">
				<div class="control-group">
				<?php if(count($courses)):?>
					<div class="controls">
						<table class="table table-striped">
							<thead>
								<tr>
									<th></th>
									<th>Код</th>
									<th>Название</th>
									<th><nobr>Кол-во часов</nobr></th>
								</tr>
							</thead>
							<tbody>
							<?php for($i=0;$i<count($courses);$i++):?>
								<tr>
									<td><input type="checkbox" name="course[]" value="<?=$courses[$i]['id']?>" /></td>
									<td><?= $courses[$i]['code']; ?></td>
									<td><span class="single-course"><?= $courses[$i]['title'] ?></span></td>
									<td class="centerized"><nobr><?= $courses[$i]['hours']; ?> ч.</nobr></td>
								</tr>
							<? endfor; ?>
							</tbody>
						</table>
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