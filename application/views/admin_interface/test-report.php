<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h3><small>Тест:</small> <?=$test['ttitle'];?></h3>
				<div class="accordion-inner">
					<div style="margin-top: 10px;">
					<pre><h4>Результат теста</h4>
	Слушатель: <u> <?=$audience;?> </u>					
	Попыток: <?=$test['attempt'];?>
	
	Дата: <?=$test['attemptdate'];?>
	
	Затрачено: <?=$test['time'];?> мин.
	Результат: <?=$test['result'];?>% <?=($test['result'] > 60)?'<font style="color:#0000ff">(зачет)</font>':'<font style="color:#ff0000">(незачет)</font>';?>
					</pre>
					</div>
				</div>
				<?php for($i=0;$i<count($questions);$i++):?>
					<div>
						<h4><small>Вопрос №<?=$i+1;?>.</small> <span><?=$questions[$i]['title'];?></span></h4>
						<table class="table table-condensed">
							<tbody>
						<?php for($j=0,$num=1;$j<count($answers);$j++):?>
							<?php if($answers[$j]['testquestion'] == $questions[$i]['id']):?>
							<?php if($answers[$j]['correct']):?>
								<tr bgcolor="#00ff00" class="correct-answer">
									<td style="width: 10px;"><?=$num;?>.</td>
									<td style="width: 300px;"><?=$answers[$j]['title'];?></td>
								<?php if($report['dataresult'][$questions[$i]['id']] == $answers[$j]['id']):?>
									<td style="width: 80px;"><span class="label label-success">Ваш ответ (верный)</span></td>
								<?php else: ?>
									<td style="width: 80px;"><span class="label label-warning">Правильный ответ</span></td>
								<?php endif;?>
								</tr>
							<?php elseif($report['dataresult'][$questions[$i]['id']] == $answers[$j]['id']):?>
								<tr bgcolor="#ff0000" class="noncorrect-answer">
									<td style="width: 10px;"><?=$num;?>.</td>
									<td style="width: 150px;"><?=$answers[$j]['title'];?></td>
									<td style="width: 80px;"><span class="label label-important">Ваш ответ (не верный)</span></td>
								</tr>
							<?php else:?>
								<tr>
									<td style="width: 10px;"><?=$num;?>.</td>
									<td style="width: 300px;"><?=$answers[$j]['title'];?></td>
									<td style="width: 80px;">&nbsp;</td>
								</tr>
							<?php endif;?>
								<?php $num++;?>
							<?php else:?>
								<?php continue; ?>
							<?php endif;?>
						<?php endfor;?>
							</tbody>
						</table>
					</div>
				<?php endfor;?>
				<hr/>
				<pre><h4>Условные обозначения</h4>
<table class="table table-condensed">
	<tbody>
		<tr>
			<td><span class="label label-success">Ваш ответ (верный)</span>	- Отображается если Вы ответили верно</td>
		</tr>
		<tr>
			<td><span class="label label-warning">Правильный ответ</span>		- Отображается правильный ответ если Вы ответили не верно</td>
		</tr>
		<tr>
			<td><span class="label label-important">Ваш ответ (не верный)</span>	- Отображается если Вы ответили не верно</td>
		</tr>
	</tbody>
</table></pre>
			</div>
		</div>
	</div>
</body>
</html>
