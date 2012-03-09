<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<?php $this->load->view('audience_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Мои текущие курсы');?>
					</li>
				</ul>
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


<?php if($courses[$i]['start']):?>
	<?php if($courses[$i]['lectures']):?>											<?=anchor('audience/courses/current/course/'.$courses[$i]['aud'].'/lectures/','Читать лекции',array('class'=>'btn btn-info'));?>
	<?php endif;?>
	<?php else:?>
	
												<?=anchor($this->uri->uri_string().'/start-training/'.$courses[$i]['aud'],'Начать обучение',array('class'=>'btn btn-success'));?>
<?php endif;?>
</pre>
							</div>
						</div>
					</div>
				<?php endfor;?>
				</div>
			</div>
		<?php $this->load->view('users_interface/rightbaraud');?>
		</div>
	</div>
	<?php $this->load->view('audience_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			
		});
	</script>
</body>
</html>
