<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<style type="text/css">
	h4 { margin: 0 0 10px; }
</style>
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
						<li>
							<?=anchor('audience/courses/current/course/'.$this->uri->segment(5).'/lectures',$course['code'].'. '.$course['title']);?> <span class="divider">/</span>
						</li>
						<li class="active">
							<?=anchor($this->uri->uri_string(),'Тест: '.$test['ttitle']);?>
						</li>
					</ul>
				</div>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<h3><small>Тест:</small> <?=$test['ttitle'];?></h3>
			<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
				<input type="hidden" name="time" id="time" value=""/>
				<fieldset>
				<?php for($i=0;$i<count($questions);$i++):?>
					<div>
						<h4><small>Вопрос №<?=$i+1;?>.</small> <span><?=$questions[$i]['title'];?></span></h4>
						<table class="table table-condensed">
							<tbody>
						<?php for($j=0,$num=1;$j<count($answers);$j++):?>
							<?php if($answers[$j]['testquestion'] == $questions[$i]['id']):?>
								<tr>
									<td style="width: 10px;"><?=$num;?>.</td>
									<td><?=$answers[$j]['title'];?></td>
									<td style="width: 10px;">
									<div class="controls">
										<label class="radio">
										<?php if($num == 1):?>
											<input type="radio" name="<?=$questions[$i]['id'];?>" class="optRadios" value="<?=$answers[$j]['id'];?>" checked="checked">
										<?php else:?>
											<input type="radio" name="<?=$questions[$i]['id'];?>" class="optRadios" value="<?=$answers[$j]['id'];?>">
										<?php endif;?>
										</label>
									</div>
									</td>
								</tr>
								<?php $num++;?>
							<?php else:?>
								<?php continue; ?>
							<?php endif;?>
						<?php endfor;?>
							</tbody>
						</table>
					</div>
				<?php endfor;?>
					<div class="form-actions">
						<label class="checkbox"><input type="checkbox" value="valid" id="validTest">Варианты верны</label>
						<button class="btn btn-success disabled" id="send" type="submit" name="submit" value="send">Завершить тестирование</button>
					</div>
				</fieldset>
			<?= form_close(); ?>
			</div>
		<?php $this->load->view('users_interface/rightbaraud');?>
		</div>
	</div>
	<?php $this->load->view('audience_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var TotalTime = 0;
			var Timer = window.setInterval(function(){TotalTime = TotalTime + 1;},1000);

			$("#validTest").removeAttr('checked');
			$("#validTest").click(function(){
				if($(this).attr("checked") == 'checked'){$("#send").removeClass('disabled');}else{$("#send").addClass('disabled');};
			});
			$("#send").click(function(event){
				if($("#validTest").attr("checked") != 'checked'){event.preventDefault();
				}else{$("#time").val(TotalTime);}
			});
			
			$('input.optRadios').click(function(){
				$(this).parents('div').eq(1).find('h4').css({'background': '#fff2b7', 'padding' : '4px 6px'});
			});
		});
	</script>
</body>
</html>
