<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<?php $this->load->view('audience_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div>
					<ul class="breadcrumb">
						<li>
							<?=anchor('audience/courses/current','Мои текущие курсы');?> <span class="divider">/</span>
						</li>
						<li class="active">
							<?=anchor($this->uri->uri_string(),$course['code'].'. '.$course['title']);?>
						</li>
					</ul>
				</div>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				 <div class="accordion" id="accordion">
				 <?php for($i=0;$i<count($chapters);$i++):?> 
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i;?>">
								<?=($i+1).':&nbsp;'.$chapters[$i]['title'];?>
							</a>
						</div>
					<?php if(!$i):?>	
						<div id="collapse<?=$i;?>" class="accordion-body collapse in">
					<?php else:?>
						<div id="collapse<?=$i;?>" class="accordion-body collapse">
					<?php endif;?>
							<div class="accordion-inner">
								<table class="table table-striped table-bordered">
									<tbody>
								<?php for($j=0,$num=1;$j<count($chapters[$i]['lectures']);$j++):?>
										<tr>
											<td class="short"><?=$num;?></td>
											<td><?=anchor('audience/courses/current/course/'.$this->uri->segment(5).'/lecture/'.$chapters[$i]['lectures'][$j]['id'],$chapters[$i]['lectures'][$j]['title']);?><a href="#"></a></td>
										</tr>
										<?php $num++;?>
								<?php endfor;?>
									</tbody>
								</table>
							<?php if(!isset($chapters[$i]['test']['attempt'])):?>
								<?php $chapters[$i]['test']['attempt'] = 0; ?>
							<?php endif;?>
							<?php if(isset($chapters[$i]['test']['id'])):?>
								<?=anchor($this->uri->uri_string().'/testing/id/'.$chapters[$i]['test']['id'],'Промежуточное тестирование',array('class'=>'btn'));?>
								<?php if($chapters[$i]['test']['attempt'] > 0 ):?>
								<div style="margin-top: 10px;">
<pre><?php if($chapters[$i]['test']['attempt'] >= $chapters[$i]['test']['count']):?>Предложенный материал курса повышения квалификации в данной главе Вами изучен недостаточно.<?php endif;?>

<?php if($chapters[$i]['test']['attempt'] < $chapters[$i]['test']['count']): ?>
Попытка: <?=$chapters[$i]['test']['attempt'];?> из <?=$chapters[$i]['test']['count'];?> 
<?php else:?>
Попытка: <?=$chapters[$i]['test']['attempt'];?> 
<?php endif;?>
Затрачено: <?=$chapters[$i]['test']['time'];?> мин. 
Результат: <?=$chapters[$i]['test']['result'];?>% <?=($chapters[$i]['test']['result'] > 60) ? '<font style="color:#0000ff">(зачет)</font>' :'<font style="color:#ff0000">(незачет)</font>';?>
</pre>
								</div>
								<?php endif;?>
							<?php endif;?>
							</div>
						</div>
					</div>
				<?php endfor;?>
					<div class="btn-toolbar">
						<div class="btn-group">
						<?php if($curriculum):?>
							<button class="btn btn-success">Учебный план</button>
							<a class="btn" data-toggle="modal" href="#getCurriculum" title="Скачать"><i class="icon-download-alt"></i></a>
						<?php endif;?>
						</div>
						<div class="btn-group">
						<?php if($document):?>
							<button class="btn btn-success">Cписок литературы</button>
							<a class="btn" data-toggle="modal" href="#getDocument" title="Скачать"><i class="icon-download-alt"></i></a>
						<?php endif;?>
						</div>
					<?php if($testvalid):?>
						<div class="btn-group">
							<?=anchor($this->uri->uri_string().'/final-testing/id/'.$test['id'],'Итоговое тестирование',array('class'=>'btn'));?>
						</div>
					<?php endif;?>
					<?php if($test['attempt'] > 0 ):?>
						<div style="margin-top: 10px;">
								<pre>
<?php if($test['attempt'] >= $test['count']):?>Уважаемый слушатель! Предложенный материал курса повышения квалификации Вами изучен <nobr>недостаточно.</nobr>Пожалуйста,дополнительно изучите курс программы и повторите попытку итогового тестирования завтра<?php endif;?>
<?php if($test['attempt'] < $test['count']): ?>

Попытка: <?=$test['attempt'];?> из <?=$test['count'];?>
<?php else:?>

Попытка: <?=$test['attempt'];?>
<?php endif;?>

Затрачено: <?=$test['time'];?> мин.
Результат: <?=$test['result'];?>% <?=($test['result'] > 70) ? '<font style="color:#0000ff">(зачет)</font>' : '<font style="color:#ff0000">(незачет)</font>';?>
								</pre>
						</div>
					<?php endif;?>
					</div>
					<?php $this->load->view('users_interface/modal/user-get-document');?>
					<?php $this->load->view('users_interface/modal/user-get-curriculum');?>
				</div>
			</div>
		<?php $this->load->view('users_interface/rightbaraud');?>
		</div>
	</div>
	<?php $this->load->view('audience_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#download").click(function(event){
				window.open("<?=$baseurl.$this->uri->uri_string();?>/get-libraries");
				event.preventDefault();
			});
			$("#dwlCur").click(function(event){
				window.open("<?=$baseurl.$this->uri->uri_string();?>/get-curriculum");
				event.preventDefault();
			});
		});
	</script>
</body>
</html>
