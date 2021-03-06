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
							<?=$trend;?><span class="divider">/</span>
						</li>
						<li class="active">
							<?=anchor($this->uri->uri_string(),$course);?>
						</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				<?php for($i=0;$i<count($chapters);$i++):?>
					<div id="d<?=$chapters[$i]['id'];?>">
						<h2 class="level-<?=$chapters[$i]['level'];?>" idchapter="<?=$chapters[$i]['id'];?>" numb="<?=$chapters[$i]['number'];?>" level="<?=$chapters[$i]['level'];?>"><?=$chapters[$i]['title'];?></h2>
						<table class="table table-striped table-bordered">
							<tbody>
						<?php for($j=0,$num=1;$j<count($lectures);$j++):?>
							<?php if($lectures[$j]['chapter'] == $chapters[$i]['id']):?>
								<tr>
									<td class="short"><a href="#editLecture" title="Редактировать" class="editLecture" data-toggle="modal" idlecture="<?=$lectures[$j]['id'];?>" idchapter="<?=$chapters[$i]['id'];?>"><i class="icon-pencil"></i></a></td>
									<td class="short"><?=$num;?></td>
									<td><?=anchor('admin-panel/references/trend/'.$this->uri->segment(4).'/course/'.$this->uri->segment(6).'/lecture/'.$lectures[$j]['id'],'<span idlecture="st'.$lectures[$j]['id'].'" numb="'.$lectures[$j]['number'].'"> '.$lectures[$j]['title'].'</span>');?><a href="#"></a></td>
									<td class="short"><a class="close" data-toggle="modal" href="#deleteLecture" idlecture="<?=$lectures[$j]['id'];?>">&times;</a></td>
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
								<a class="btn addLecture" data-toggle="modal" href="#addLecture" idchapter="<?=$chapters[$i]['id'];?>"><i class="icon-plus"></i> Добавить лекцию</a>
								<a class="btn editChapter" data-toggle="modal" href="#editChapter" idchapter="<?=$chapters[$i]['id'];?>"><i class="icon-pencil"></i> Редак. главу</a>
								<a class="btn deleteChapter" data-toggle="modal" href="#deleteChapter" idchapter="<?=$chapters[$i]['id'];?>"><i class="icon-trash"></i> Удалить главу</a>
							<?php if(!$chapters[$i]['test']):?>
								<a data-toggle="modal" href="#addMTest" idchapter="<?=$chapters[$i]['id'];?>" class="btn addMTest">Создать промежуточное тестирование</a>
							<?php else:?>
								<?=anchor('admin-panel/references/trend/'.$this->uri->segment(4).'/course/'.$this->uri->segment(6).'/chapter/'.$chapters[$i]['id'].'/testing/'.$chapters[$i]['test']['id'],'Промежуточное тестирование',array('class'=>'btn'));?>
								<a class="btn editMTest" idchapter="<?=$chapters[$i]['id'];?>" idtest="<?=$chapters[$i]['test']['id'];?>" ttitle="<?=$chapters[$i]['test']['title'];?>" ttime="<?=$chapters[$i]['test']['timetest'];?>" tcount="<?=$chapters[$i]['test']['count'];?>" data-toggle="modal" href="#editMTest" title="Редактировать"><i class="icon-pencil"></i></a>
								<a class="btn deleteTest" idtest="<?=$chapters[$i]['test']['id'];?>" idchapter="<?=$chapters[$i]['id'];?>" title="Обновить" data-toggle="modal" href="#deleteTest"><i class="icon-trash"></i></a>
							<?php endif;?>
							</div>
						</div>
					</div>
				<?php endfor;?>
					<hr size="2"/>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a class="btn btn-success" data-toggle="modal" href="#addChapter"><i class="icon-plus icon-white"></i> Новая глава</a>
						</div>
						<div class="btn-group">
							<a class="btn btn-success" data-toggle="modal" href="#addDoc"><i class="icon-plus icon-white"></i> Литература</a>
						<?php if($document):?>
							<a class="btn btn-download" data-toggle="modal" href="#getDocument" title="Скачать"><i class="icon-download-alt">&nbsp;</i></a>
						<?php endif;?>
						</div>
						<div class="btn-group">
							<a class="btn btn-success" data-toggle="modal" href="#addCurriculum"><i class="icon-plus icon-white"></i> Учебный план</a>
						<?php if($curriculum):?>
							<a class="btn btn-download" data-toggle="modal" href="#getCurriculum" title="Скачать"><i class="icon-download-alt"></i></a>
						<?php endif;?>
						</div>
						<div class="btn-group">
							<a class="btn btn-success" data-toggle="modal" href="#addMetodical"><i class="icon-plus icon-white"></i> Метод.рекомендации</a>
						<?php if($metodical):?>
							<a class="btn btn-download" data-toggle="modal" href="#getMetodical" title="Скачать"><i class="icon-download-alt"></i></a>
						<?php endif;?>
						</div>
						<div class="clear"></div><br/>
						<div class="btn-group">
							<?=anchor('admin-panel/references/trend/'.$this->uri->segment(4).'/course/'.$this->uri->segment(6).'/chapter/0/testing/'.$finaltest['id'],'Итоговое тестирование',array('class'=>'btn'));?>
							<a class="btn editFTest" idtest="<?=$finaltest['id'];?>" ttitle="<?=$finaltest['title'];?>" ttime="<?=$finaltest['timetest'];?>" tcount="<?=$finaltest['count'];?>" data-toggle="modal" href="#editFTest" title="Редактировать"><i class="icon-pencil"></i></a>
							
							
							<a class="btn refreshFTest" idtest="<?=$finaltest['id'];?>" data-toggle="modal" href="#refreshTest" title="Обновить"><i class="icon-refresh"></i></a>
						
						</div>
					</div>
					<?php $this->load->view('admin_interface/modal/admin-add-chapter');?>
					<?php $this->load->view('admin_interface/modal/admin-add-libraries');?>
					<?php $this->load->view('admin_interface/modal/admin-add-curriculum');?>
					<?php $this->load->view('admin_interface/modal/admin-add-metodical');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-chapter');?>
					<?php $this->load->view('admin_interface/modal/admin-add-lecture');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-lecture');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-lecture');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-chapter');?>
					<?php $this->load->view('admin_interface/modal/admin-add-middle-test');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-middle-test');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-middle-test');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-finish-test');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-final-test');?>
					<?php $this->load->view('users_interface/modal/user-get-document');?>
					<?php $this->load->view('users_interface/modal/user-get-curriculum');?>
					<?php $this->load->view('users_interface/modal/user-get-metodical');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DTrend = -1; var DCourse = -1; var DChapter = -1; var DLecture = -1; var DTest = -1; var CChapter = <?=$cntchapter+1;?>;
			$("#send").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".achinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#lsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".linput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#elsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".elinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#mtsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".amtinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#emtsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".emtinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#eftsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".eftinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$(".deleteChapter").click(function(){DChapter = $(this).attr('idchapter');});
			$(".addLecture").click(function(){$("#msgalert").remove();$(".idChapter").val($(this).attr('idchapter'));});
			$(".addMTest").click(function(){$("#msgalert").remove();$(".idChapter").val($(this).attr('idchapter'));});
			$(".editLecture").click(function(){$("#msgalert").remove();DLecture  = $(this).attr('idlecture');var title = $("span[idlecture = st"+DLecture+"]").html();var numb = $("span[idlecture = st"+DLecture+"]").attr('numb');$(".idLecture").val(DLecture);$(".idChapter").val($(this).attr('idchapter'));$("#eTitleLecture").val(title);$("#eNumberLecture").val(numb);});
			
			$("#echsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".echinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#lbsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".lbinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#crsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".crinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$("#mdsend").click(function(event){var err = false;$(".control-group").removeClass('error');$(".help-inline").hide();$(".mdinput").each(function(i,element){if($(this).val()==''){$(this).parents(".control-group").addClass('error');$(this).siblings(".help-inline").html("Поле не может быть пустым").show();err = true;}});if(err){event.preventDefault();}});
			$(".editChapter").click(function(){
				$("#msgalert").remove();
				var chapter = $(this).attr('idchapter');
				$(".idChapter").val(chapter);
				$("#eTitleChapter").val($("h2[idchapter = "+chapter+"]").html());
				$("#eNumberChapter").val($("h2[idchapter = "+chapter+"]").attr('numb'));
				$("#eLevelChapter").val($("h2[idchapter = "+chapter+"]").attr('level'));
				});
			$(".editMTest").click(function(){$("#msgalert").remove();$(".idTest").val($(this).attr('idtest'));$(".idChapter").val($(this).attr('idchapter'));$("#eTitleMTest").val($(this).attr('ttitle'));$("#eСountMTest").val($(this).attr('tcount'));$("#eTimeMTest").val($(this).attr('ttime'));});
			$(".editFTest").click(function(){$("#msgalert").remove();$(".idTest").val($(this).attr('idtest'));$(".idChapter").val($(this).attr('idchapter'));$("#eTitleFTest").val($(this).attr('ttitle'));$("#eСountFTest").val($(this).attr('tcount'));$("#eTimeFTest").val($(this).attr('ttime'));});
			$("#download").click(function(){$("#msgalert").remove(); window.open("<?=$baseurl.$document;?>")});
			$("#dwlCur").click(function(){$("#msgalert").remove(); window.open("<?=$baseurl.$curriculum;?>")});
			$("#dwlMet").click(function(){$("#msgalert").remove(); window.open("<?=$baseurl.$metodical;?>")});
			
			$("#addChapter").on("show",function(){$("#NumberChapter").val(CChapter);});
			$(".addLecture").click(function(){$("#NumberLecture").val($(this).attr('clectures'));})
			$(".deleteTest").click(function(){DChapter = $(this).attr('idchapter'); DTest = $(this).attr('idtest');});
			$(".refreshFTest").click(function(){DChapter = 0; DTest = $(this).attr('idtest');});
			
			$(".close").click(function(){DLecture = $(this).attr('idlecture');});
			$("#DelLecture").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/delete-lecture/'+DLecture;});
			$("#DelMTest").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/chapter/'+DChapter+'/delete-test/'+DTest;});
			$("#RefTest").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/chapter/'+DChapter+'/delete-test/'+DTest;});
			$("#DelChapter").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/delete-chapter/'+DChapter;});
			$(".dmodal").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');$(".input-file").val('');});
		});
	</script>
</body>
</html>
