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
						<li class="active">
							<?=anchor($this->uri->uri_string(),'Курсы');?>
						</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				<?php for($i=0;$i<count($trends);$i++):?>
					<h5 idtrend="<?=$trends[$i]['id'];?>">
						<a href="#" class="slider-plus" idtrend="<?=$trends[$i]['id'];?>"><i class="icon-plus"></i></a>
						<span idtrend="<?=$trends[$i]['id'];?>"><?=$trends[$i]['title'];?></span>
						<small>(курсов: <?=$trends[$i]['courses'];?>)</small>
					</h5>
					<div id="tbl<?=$trends[$i]['id'];?>" style="display:none;">
						<table class="table table-striped table-bordered table-condensed">
							<tbody>
						<?php for($j=0;$j<count($courses);$j++):?>
							<?php if($courses[$j]['trend'] == $trends[$i]['id']):?>
								<tr>
									<td><a href="#editCourse" class="editCourse" data-toggle="modal" title="Редактировать" idcourse="<?=$courses[$j]['id'];?>"><i class="icon-pencil"></i></a></td>
									<td><?=anchor('admin-panel/references/trend/'.$trends[$i]['id'].'/course/'.$courses[$j]['id'],'<span idspan="cs'.$courses[$j]['id'].'">'.$courses[$j]['code'].'</span>. <span idspan="ts'.$courses[$j]['id'].'">'.$courses[$j]['title'].'</span>');?></td>
									<td><nobr><span idspan="sp<?=$courses[$j]['id'];?>"><?=$courses[$j]['price'];?></span> руб.</nobr></td>
									<td><nobr><span idspan="sh<?=$courses[$j]['id'];?>"><?=$courses[$j]['hours'];?></span> час.</nobr></td>
								<?php if($courses[$j]['view']):?>
									<td><i class="icon-eye-open" title="Виден" idcourse="<?=$courses[$j]['id'];?>" view="1"></i></td>
								<?php else:?>
									<td><i class="icon-eye-close" title="Не виден" idcourse="<?=$courses[$j]['id'];?>" view="0"></i></td>
								<?php endif;?>
								<td><a class="close" data-toggle="modal" href="#deleteCourse" idcourse="<?=$courses[$j]['id'];?>">&times;</a></td>
								</tr>
							<?php else:?>
								<?php continue; ?>
							<?php endif;?>
						<?php endfor;?>
							</tbody>
						</table>
						<p><a class="btn btn-primary addCourse" data-toggle="modal" href="#addCourse" idtrend="<?=$trends[$i]['id'];?>"><i class="icon-plus"></i> Добавить курс</a></p>
					</div>
				<?php endfor;?>
					<?php $this->load->view('admin_interface/modal/admin-add-course');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-course');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-course');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DTrend = -1;
			var DCourse = -1;
			$(".slider-plus").click(function(event){
				var slider = $(this);
				DTrend = $(this).attr('idtrend');
				$("#tbl"+DTrend).fadeToggle('100',function(){
					if($("#tbl"+DTrend).is(':hidden')){
						$(slider).html('<i class="icon-plus"></i>');
					}else{
						$(slider).html('<i class="icon-minus"></i>');
					}
				});
				event.preventDefault();
			});
			$(".addCourse").click(function(){
				$("#msgalert").remove();
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".input-xlarge").val('');
				$("#ViewCourse").removeAttr('checked');
				$("#idTrend").val($(this).attr('idtrend'));
			});
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
			$(".editCourse").click(function(){
				DCourse = $(this).attr('idcourse');
				var title = $("span[idspan = ts"+DCourse+"]").html();
				var code = $("span[idspan = cs"+DCourse+"]").html();
				var price = $("span[idspan = sp"+DCourse+"]").html();
				var hours = $("span[idspan = sh"+DCourse+"]").html();
				var view = $("i[idcourse = "+DCourse+"]").attr('view');
				$("#idCourse").val(DCourse);
				$("#eTitleCourse").val(title);
				$("#eCodeCourse").val(code);
				$("#ePriceCourse").val(price);
				$("#eHoursCourse").val(hours);
				if(view == 1){$("#eViewCourse").attr('checked','checked');}else{$("#eViewCourse").removeAttr('checked');}
			});
			$(".close").click(function(){DCourse = $(this).attr('idcourse');});
			$(".close").alert();
			$("#DelCourse").click(function(){location.href='<?=$baseurl;?>admin-panel/references/courses/delete-course/'+DCourse+'/trend/'+DTrend;});
			$("#addCourse").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');$("#ViewTrend").removeAttr('checked');});
			$("#msgclose").click(function(){$("#msgalert").fadeOut(1000,function(){$(this).remove();});});
		});
	</script>
</body>
</html>
