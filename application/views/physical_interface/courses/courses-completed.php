<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('physical_interface/includes/head');?>
<body>
	<?php $this->load->view('physical_interface/includes/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Мои пройденные курсы');?>
					</li>
				</ul>
			<?php if(!count($courses)):?>
				<div class="alert alert-info" id="msgialert">
					<a class="close" id="msgiclose">×</a>
					<h4 class="alert-heading">Информация</h4>
					Курсы отсутствуют!<br/>
				</div>
			<?php endif;?>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				 <div class="accordion" id="accordion">
				 <?php for($i=0;$i<count($courses);$i++):?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i;?>">
								Курс: <?=$courses[$i]['code'].'. '.$courses[$i]['title'];?>
							</a>
						</div>
					<?php if(!$i):?>	
						<div id="collapse<?=$i;?>" class="accordion-body collapse in">
					<?php else:?>
						<div id="collapse<?=$i;?>" class="accordion-body collapse">
					<?php endif;?>
							<div class="accordion-inner">
<pre>
Длительность курса: <?=$courses[$i]['hours'];?> час.
Количество глав: <?=$courses[$i]['chapter'];?>

Количество промежуточных тестов: <?=$courses[$i]['tests'];?>

Количество лекций: <?=$courses[$i]['lectures'];?>

</pre>	
					<?php if(isset($courses[$i]['test']['attempt'])):?>
						<?php if($courses[$i]['test']['attempt'] > 0):?>
								<div style="margin-top: 10px;">
<pre><strong>Результат теста</strong>                                                      <?=anchor('physical/courses/'.$courses[$i]['aud'].'/test-report/id/'.$courses[$i]['test']['tresid'],'Просмотреть результат',array('class'=>'btn btn-success','target'=>'_blank'));?>

Попытка: <?=$courses[$i]['test']['attempt'];?> из <?=$courses[$i]['test']['count'];?>
	
Затрачено: <?=$courses[$i]['test']['time'];?> мин.
Результат: <?=$courses[$i]['test']['result'];?>% <?=($courses[$i]['test']['result'] > 60) ? '<font style="color:#0000ff">(зачет)</font>' : '<font style="color:#ff0000">(незачет)</font>';?>
</pre>
								</div>
						<?php endif;?>
					<?php endif;?>
							</div>
						</div>
					</div>
				<?php endfor;?>
				</div>
			</div>
		<?php $this->load->view('users_interface/rightbarfiz');?>
		</div>
	</div>
	<?php $this->load->view('physical_interface/includes/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			
		});
	</script>
</body>
</html>
