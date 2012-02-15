<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div>
					<ul class="nav nav-pills">
						<li class="active"><?=anchor('admin-panel/references/trends','<i class="icon-list-alt"></i> Список направлений обучания');?></li>
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
								<td><?=anchor('#','<i class="icon-pencil" title="Редактировать"></i>');?></td>
								<td><?=$trends[$i]['code'];?></td>
								<td><h5><?=$trends[$i]['title'];?> <small>(курсов: <?=$trends[$i]['courses'];?>)</small></h5></td>
								<?php if($trends[$i]['view']):?>
									<td><i class="icon-eye-open" title="Виден"></i></td>
								<?php else:?>
									<td><i class="icon-eye-close" title="Не виден"></i></td>
								<?php endif;?>
								<td><a class="close" data-toggle="modal" href="#deleteTrend" idtrend="<?=$trends[$i]['id'];?>">&times;</a></td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
					<p><a class="btn btn-primary" data-toggle="modal" href="#addTrend"><i class="icon-plus"></i> Добавить направление</a></p>
					<?php $this->load->view('admin_interface/modal/admin-add-trend');?>
					<?php $this->load->view('admin_interface/modal/admin-delete-trend');?>
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
				$(".input-xlarge").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(err){event.preventDefault();}
			});
			$(".close").click(function(){DTrend = $(this).attr('idtrend');});
			$("#DelTrend").click(function(){location.href='<?=$baseurl;?>admin-panel/references/trends/delete-trend/'+DTrend;});
			$("#addTrend").on("hidden",function(){
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".input-xlarge").val('');
				$("#ViewTrend").removeAttr('checked');
			});
			$(".close").alert();
			$("#msgclose").click(function(){$("#msgalert").fadeOut(1000,function(){$(this).remove();});});
		});
	</script>
</body>
</html>
