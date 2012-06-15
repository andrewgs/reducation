<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<style type="text/css">
	h4 { margin: 0 0 10px; }
</style>
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
					<h3><small>Тест:</small> <?=$test['title'];?></h3>
					<hr>
				<?php for($i=0;$i<count($questions);$i++):?>
					<div>
						<h4><small>Вопрос №<?=$i+1;?>.</small> <span idquestion="<?=$questions[$i]['id'];?>" numb="<?=$questions[$i]['number'];?>"><?=$questions[$i]['title'];?></span></h4>
						<table class="table table-condensed">
							<tbody>
						<?php for($j=0,$num=1;$j<count($answers);$j++):?>
							<?php if($answers[$j]['testquestion'] == $questions[$i]['id']):?>
								<tr>
									<td class="short"><a href="#editAnswer" title="Редактировать" class="editAnswer" idanswer="<?=$answers[$j]['id'];?>" idquestion="<?=$questions[$i]['id'];?>" data-toggle="modal"><i class="icon-pencil"></i></a></td>
									<td class="short"><?=$num;?></td>
									<td><span idspan="st<?=$answers[$j]['id'];?>" numb="<?=$answers[$j]['number'];?>"><?=$answers[$j]['title'];?></span></td>
								<?php if($answers[$j]['correct']):?>
									<td class="short"><i class="icon-ok-sign" title="Верный ответ" idi="i<?=$answers[$j]['id'];?>" correct="1"></i></td>
								<?php else:?>
									<td class="short"><i class="icon-remove-sign" title="Не верный ответ" idi="i<?=$answers[$j]['id'];?>" correct="0"></i></td>
								<?php endif;?>
									<td class="short"><a class="close deleteAnswer" idanswer="<?=$answers[$j]['id'];?>" data-toggle="modal" href="#deleteAnswer">&times;</a></td>
								</tr>
								<?php $num++;?>
							<?php else:?>
								<?php continue; ?>
							<?php endif;?>
						<?php endfor;?>
							</tbody>
						</table>
						<div class="btn-toolbar">
							<div class="btn-group">
								<a class="btn addAnswer" data-toggle="modal" idquestion="<?=$questions[$i]['id'];?>" href="#addAnswer"><i class="icon-plus"></i> Добавить ответ</a>
								<a class="btn editQuestion" data-toggle="modal" href="#editQuestion" idquestion="<?=$questions[$i]['id'];?>"><i class="icon-pencil"></i> Редактировать вопрос</a>
								<a class="btn deleteQuestion" idquestion="<?=$questions[$i]['id'];?>" data-toggle="modal" href="#deleteQuestion"><i class="icon-trash"></i> Удалить вопрос</a>
							</div>
						</div>
					</div>
				<?php endfor;?>
					<hr size="2"/>
					<p><a class="btn btn-info" data-toggle="modal" href="#addQA"><i class="icon-plus icon-white"></i> Добавить вопрос</a></p>
					<?php $this->load->view('admin_interface/modal/admin-delete-question');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-question');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-answer');?>
					<?php $this->load->view('admin_interface/modal/admin-add-answer');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-answer');?>
					<?php $this->load->view('admin_interface/modal/admin-master-qa');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DQuestion = -1; var DAnswer = -1; var MQuestion = <?=$cntquestions+1?>;
			$("#asend").click(function(event){var err = false;$(".control-group").removeClass("error");$(".help-inline").hide();$(".aainput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass("error");$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});

			$(".editQuestion").click(function(){$("#msgalert").remove();
				DQuestion = $(this).attr("idquestion");
				var title = $("span[idquestion="+DQuestion+"]").html();
				var numb = $("span[idquestion="+DQuestion+"]").attr("numb");
				$(".idQuestion").val(DQuestion);
				$("#eTitleQuestion").val(title);
				$("#eNumberQuestion").val(numb);});

			$(".editAnswer").click(function(){$("#msgalert").remove(); DAnswer = $(this).attr('idanswer'); var title = $("span[idspan=st"+DAnswer+"]").html(); var numb = $("span[idspan=st"+DAnswer+"]").attr("numb"); var correct = $("i[idi=i"+DAnswer+"]").attr("correct"); $(".idAnswer").val(DAnswer); $(".idQuestion").val($(this).attr('idquestion')); $("#eTitleAnswer").val(title); $("#eNumberAnswer").val(numb); $("#eNumberAnswer").val(numb); if(correct == 1){$("#eCorrectAnswer").attr('checked','checked');}else{$("#eCorrectAnswer").removeAttr("checked");}});
			
			$(".addAnswer").click(function(){$("#msgalert").remove();$(".idQuestion").val($(this).attr('idquestion'));});
			
			$(".deleteQuestion").click(function(){DQuestion = $(this).attr('idquestion');});
			
			$(".deleteAnswer").click(function(){DAnswer = $(this).attr('idanswer');});
			
			$("#MasterNext").click(function(event){
				
				if($(this).attr('disabled')){return false;}
				var cntans = 0;
				var err = false;
				$(".control-group").removeClass("error");$(".help-inline").hide();
				$(".mqinput").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				$(".mainput").each(function(i,element){
					if($(this).val()=='' && $(this).attr('num')<2){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(!err && $(".MCAnswer:checked").length == 0){
					$("#chError")
						.find("span.error-text").html("Должен быть выбран хотя бы один правильный ответ.")
						.end().show();
					err = true;
				}
				if(err){
					event.preventDefault();
				}else{
					var correct = $(".MCAnswer");
					var answers = {}; var count = 0;
					$(".mainput").each(function(i){
						answers['answers['+i+'][title]'] = $(this).val();
						if($(correct[i]).attr('checked')){$(correct[i]).val('1');}else{$(correct[i]).val('0');}
						answers['answers['+i+'][correct]'] = $(correct[i]).val();
						count++;
					});
					answers['answers['+count+'][question]'] = $("#mTitleQuestion").val();
					answers['answers['+count+'][numb]'] = MQuestion;
					$.ajax({
						url:'<?=$baseurl.$this->uri->uri_string();?>/create-master-test',
						type:'POST',
						data: answers,
						beforeSend: function(){
							$(this).html('Ожидайте');
							$(this).addClass('disabled');
							$(this).attr('disabled','disabled');
						},
						success: function(){
							MQuestion++;
							$(this).html('Продолжить');
							$(this).removeClass('disabled');
							$(this).removeAttr('disabled');
							$("#msgalert").remove();
							$(".control-group").removeClass('error');
							$(".help-inline").hide();
							$(".input-xlarge").val('');
							$(".MCAnswer").removeAttr('checked');
							$("#nQ").html(MQuestion);
						}
					})
				}
			});
			
			$("#addQA").on("hidden",function(){location.href="<?=$baseurl.$this->uri->uri_string();?>";});
			
			$("#addQA").on("show",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');$(".MCAnswer").removeAttr('checked'); $("#nQ").html(MQuestion);});
			
			$("#eqsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".eqinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			
			$("#DelQuestion").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/chapter/<?=$this->uri->segment(8);?>/testing/<?=$this->uri->segment(10);?>/delete-question/'+DQuestion;});
			$("#DelAnswer").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/chapter/<?=$this->uri->segment(8);?>/testing/<?=$this->uri->segment(10);?>/delete-answer/'+DAnswer;});
			
			$(".dmodal").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');$(".input-file").val('');$("#СorrectAnswer").removeAttr('checked');});
		});
	</script>
</body>
</html>
