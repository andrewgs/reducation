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
							<?=anchor($this->uri->uri_string(),'Направления');?>
						</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
					<table class="table table-striped">
						<thead>
							<th>&nbsp;</th>
							<th>Код</th>
							<th>Название</th>
							<th>&nbsp;</th>
						</thead>
						<tbody>
						<?php for($i=0;$i<count($trends);$i++):?>
							<tr>
								<td><a href="#editTrend" class="editTrend" data-toggle="modal" title="Редактировать" idtrend="<?=$trends[$i]['id'];?>"><i class="icon-pencil"></i></a></td>
								<td idtrend="<?=$trends[$i]['id'];?>"><?=$trends[$i]['code'];?></td>
								<td><h5><span idtrend="<?=$trends[$i]['id'];?>"><?=$trends[$i]['title'];?></span> <small>(курсов: <?=$trends[$i]['courses'];?>)</small></h5></td>
								<?php if($trends[$i]['view']):?>
									<td><i class="icon-eye-open" title="Виден" idtrend="<?=$trends[$i]['id'];?>" view="1"></i></td>
								<?php else:?>
									<td><i class="icon-eye-close" title="Не виден" idtrend="<?=$trends[$i]['id'];?>" view="0"></i></td>
								<?php endif;?>
								<td><a class="close" data-toggle="modal" href="#deleteTrend" idtrend="<?=$trends[$i]['id'];?>">&times;</a></td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
					<p><a class="btn btn-info" data-toggle="modal" href="#addTrend"><i class="icon-plus icon-white"></i> Добавить направление</a></p>
					<?php $this->load->view('admin_interface/modal/admin-add-trend');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-trend');?>
					<?php $this->load->view('admin_interface/modal/admin-edit-trend');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var DTrend = -1;
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
			$("#saveTrend").click(function(event){
				var err = false;
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".einput").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(err){event.preventDefault();}
			});
			$(".close").click(function(){DTrend = $(this).attr('idtrend');});
			$(".editTrend").click(function(){
				DTrend = $(this).attr('idtrend');
				var title = $("span[idtrend = "+DTrend+"]").html();
				var code = $("td[idtrend = "+DTrend+"]").html();
				var view = $("i[idtrend = "+DTrend+"]").attr('view');
				$("#idTrend").val(DTrend);
				$("#eTitleTrend").val(title);
				$("#eCodeTrend").val(code);
				if(view == 1){$("#eViewTrend").attr('checked','checked');}else{$("#eViewTrend").removeAttr('checked');}
			});
			$("#DelTrend").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trends/delete-trend/'+DTrend;});
			$("#addTrend").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-xlarge").val('');$("#ViewTrend").removeAttr('checked');});
			$("#editTrend").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();});
			$(".close").alert();
		});
	</script>
</body>
</html>
