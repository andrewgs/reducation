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
							<?=anchor('admin-panel/references/courses',$trend);?> <span class="divider">/</span>
						</li>
						<li class="active">
							<?=anchor($this->uri->uri_string(),$course);?>
						</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				<?php for($i=0;$i<count($chapters);$i++):?>
					<div id="d<?=$chapters[$i]['id'];?>">
						<h5 idchapter="<?=$chapters[$i]['id'];?>"><?=$chapters[$i]['title'];?></h5>
						<table class="table table-striped table-bordered">
							<tbody>
						<?php for($j=0,$num=1;$j<count($lectures);$j++):?>
							<?php if($lectures[$j]['chapter'] == $chapters[$i]['id']):?>
								<tr>
									<td><?=$num;?></td>
									<td><a href="#">Лекция: <span idlecture="st<?=$lectures[$j]['id'];?>"><?=$lectures[$j]['title']?></span></a></td>
									<td><a class="close" data-toggle="modal" href="#deleteLecture" idlecture="<?=$lectures[$j]['id'];?>">&times;</a></td>
									<td><a href="#editLectures" class="editLectures" data-toggle="modal" title="Редактировать" idcourse="<?=$lectures[$j]['id'];?>"><i class="icon-pencil"></i></a></td>
								</tr>
								<?php $num++;?>
							<?php else:?>
								<?php continue; ?>
							<?php endif;?>
						<?php endfor;?>
							</tbody>
						</table>
						<p>
							<a class="btn addLecture" data-toggle="modal" href="#addLecture" idchapter="<?=$chapters[$i]['id'];?>"><i class="icon-plus"></i> Добавить лекцию</a>
							<a class="btn btn-warning deleteChapter" data-toggle="modal" href="#deleteChapter" idchapter="<?=$chapters[$i]['id'];?>">Удалить главу</a>
						</p>
						<div class="btn-toolbar">
							<div class="btn-group">
								<a href="#" class="btn btn-info">Промежуточное тестирование</a>
								<a href="#" class="btn"><i class="icon-pencil"></i></a>
								<a href="#" class="btn"><i class="icon-trash"></i></a>
							</div>
						</div>
					</div>
				<?php endfor;?>
					<hr size="2"/>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a href="#" class="btn btn-info">Итоговое тестирование</a>
							<a href="#" class="btn"><i class="icon-pencil"></i></a>
							<a href="#" class="btn"><i class="icon-trash"></i></a>
						</div>
					</div>
					<p><a class="btn btn-primary" data-toggle="modal" href="#addChapter"><i class="icon-plus"></i> Добавить главу</a></p>
					<?php $this->load->view('admin_interface/modal/admin-add-chapter');?>
					<?php $this->load->view('admin_interface/modal/admin-add-lecture');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-lecture');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-chapter');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DTrend = -1; var DCourse = -1;
			var DChapter = -1; var DLecture = -1;
			$("#send").click(function(event){
				var err = false;
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".ainput").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(err){event.preventDefault();}
			});
			$("#lsend").click(function(event){
				var err = false;
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".linput").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(err){event.preventDefault();}
			});
			$(".deleteChapter").click(function(){DChapter = $(this).attr('idchapter');});
			$(".addLecture").click(function(){
				$("#msgalert").remove();
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".input-xlarge").val('');
				$("#idChapter").val($(this).attr('idchapter'));
			});
			$(".close").click(function(){DLecture = $(this).attr('idlecture');});
			$("#DelLecture").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/delete-lecture/'+DLecture;});
			$("#DelChapter").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trend/<?=$this->uri->segment(4);?>/course/<?=$this->uri->segment(6);?>/delete-chapter/'+DChapter;});
			$("#addChapter").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');});
			$("#msgclose").click(function(){$("#msgalert").fadeOut(1000,function(){$(this).remove();});});
		});
	</script>
</body>
</html>
