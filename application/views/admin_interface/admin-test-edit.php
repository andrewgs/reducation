<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div>
					<ul class="breadcrumb">
						<li>
							<?=anchor('admin-panel/references/courses','Все направления');?> <span class="divider">/</span>
						</li>
						<li>
							<?=$trend;?> <span class="divider">/</span>
						</li>
						<li>
							<?=anchor('admin-panel/references/trend/'.$this->uri->segment(4).'/course/'.$this->uri->segment(6),$course);?> <span class="divider">/</span>
						</li>
						<li>
							<?=anchor($this->uri->uri_string(),$test['title']);?>
						</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
					<h5>Тест: <?=$test['title'];?></h5>
					<hr size="2">
				<?php for($i=0;$i<count($questions);$i++):?>
					<div>
						Вопрос №<?=$i+1;?>.<h5><span idquestion="<?=$questions[$i]['id'];?>" numb="<?=$questions[$i]['number'];?>"><?=$questions[$i]['title'];?></span></h5>
						<table class="table table-striped table-bordered">
							<tbody>
						<?php for($j=0,$num=1;$j<count($answers);$j++):?>
							<?php if($answers[$j]['testquestion'] == $questions[$i]['id']):?>
								<tr>
									<td><a href="#editAnswer" title="Редактировать" class="editAnswer" idanswer="<?=$answers[$j]['id'];?>" data-toggle="modal"><i class="icon-pencil"></i></a></td>
									<td><?=$num;?></td>
									<td><span idspan="st<?=$answers[$j]['id'];?>" numb="<?=$answers[$j]['number'];?>"><?=$answers[$j]['title'];?></span></td>
								<?php if($answers[$j]['correct']):?>
									<td><i class="icon-ok-sign" title="Верный ответ" idi="i<?=$answers[$j]['id'];?>" correct="1"></i></td>
								<?php else:?>
									<td><i class="icon-remove-sign" title="Не верный ответ" idi="i<?=$answers[$j]['id'];?>" correct="0"></i></td>
								<?php endif;?>
									<td><a class="close deleteAnswer" idanswer="<?=$answers[$j]['id'];?>" data-toggle="modal" href="#deleteAnswer">&times;</a></td>
								</tr>
								<?php $num++;?>
							<?php else:?>
								<?php continue; ?>
							<?php endif;?>
						<?php endfor;?>
							</tbody>
						</table>
						<p>
							<a class="btn addAnswer" data-toggle="modal" idquestion="<?=$questions[$i]['id'];?>" href="#addAnswer"><i class="icon-plus"></i> Добавить ответ</a>
							<a class="btn btn-info editQuestion" data-toggle="modal" href="#editQuestion" idquestion="<?=$questions[$i]['id'];?>"><i class="icon-pencil icon-white"></i> Редактировать вопрос</a>
							<a class="btn btn-danger deleteQuestion" idquestion="<?=$questions[$i]['id'];?>" data-toggle="modal" href="#deleteQuestion"><i class="icon-trash icon-white"></i> Удалить вопрос</a>
						</p>
					</div>
				<?php endfor;?>
					<hr size="2"/>
					<p><a class="btn btn-primary" data-toggle="modal" href="#addQuestion"><i class="icon-plus"></i> Добавить вопрос</a></p>
					<?php $this->load->view('admin_interface/modal/admin-add-question');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-question');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-question');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-answer');?>
					<?php $this->load->view('admin_interface/modal/admin-add-answer');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-answer');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DQuestion = -1; var DAnswer = -1;
			$("#qsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".aqinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#asend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".aainput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			
			$(".editQuestion").click(function(){
				$("#msgalert").remove();
				DQuestion = $(this).attr('idquestion');
				var title  = $("span[idquestion="+DQuestion+"]").html();
				var numb  = $("span[idquestion="+DQuestion+"]").attr('numb');
				$(".idQuestion").val(DQuestion);
				$("#eTitleQuestion").val(title);
				$("#eNumberQuestion").val(numb);
			});
			
			$(".editAnswer").click(function(){
				$("#msgalert").remove();
				DAnswer = $(this).attr('idanswer');
				var title  = $("span[idspan=st"+DAnswer+"]").html();
				var numb  = $("span[idspan=st"+DAnswer+"]").attr('numb');
				var correct  = $("i[idi=i"+DAnswer+"]").attr('correct');
				$(".idAnswer").val(DAnswer);
				$("#eTitleAnswer").val(title);
				$("#eNumberAnswer").val(numb);
				$("#eNumberAnswer").val(numb);
				if(correct == 1){$("#eCorrectAnswer").attr('checked','checked');}else{$("#eCorrectAnswer").removeAttr('checked');}
			});
			
			$(".addAnswer").click(function(){$("#msgalert").remove();$(".idQuestion").val($(this).attr('idquestion'));});
			
			$(".deleteQuestion").click(function(){DQuestion = $(this).attr('idquestion');});
			
			$(".deleteAnswer").click(function(){DAnswer = $(this).attr('idanswer');});
			
			$("#eqsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".eqinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			
			$("#DelQuestion").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/chapter/<?=$this->uri->segment(8);?>/testing/<?=$this->uri->segment(10);?>/delete-question/'+DQuestion;});
			$("#DelAnswer").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/chapter/<?=$this->uri->segment(8);?>/testing/<?=$this->uri->segment(10);?>/delete-answer/'+DAnswer;});
			
			$(".dmodal").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');$(".input-file").val('');$("#СorrectAnswer").removeAttr('checked');});
			$("#msgclose").click(function(){$("#msgalert").fadeOut(1000,function(){$(this).remove();});});
		});
	</script>
</body>
</html>
