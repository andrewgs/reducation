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
								<td><a class="close" title="Удалить">&times;</a></td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
					<p><a class="btn btn-primary" data-toggle="modal" href="#addTrend"><i class="icon-plus"></i> Добавить направление</a></p>
					<?php $this->load->view('admin_interface/modal/admin-add-trend');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	
</body>
</html>
