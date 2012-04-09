<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<style type="text/css">
		.table-striped tbody tr:nth-child(2n+1) td, .table-striped tbody tr:nth-child(2n+1) th { background-color: #f3f3f3; }
		.table th, .table td { font-size: 13px; }
	</style>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Каталог курсов</h1>
				<div class="accordion" id="accordion2">
			<?for($i=0;$i<count($trends);$i++):?>
				<?php 
					$numCourses = 0;
					for($j=0;$j<count($courses);$j++):
						 if($courses[$j]['trend'] == $trends[$i]['id']):
						 	$numCourses++;
						 endif;
					endfor;
				?>
				<?php if($numCourses):?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$i;?>">
							
								<?=$trends[$i]['title'];?> <span class="small">(курсов: <?=$numCourses;?>)</span>
							</a>
						</div>
						<div id="collapse<?=$i;?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<table class="table table-striped">
									<thead>
										
										<tr>
											<!--th>№</th-->
											<th>Код</th>
											<th>Название</th>
											<th><nobr>Кол-во часов</nobr></th>
										</tr>
										
									</thead>
									<tbody>
								<? for($j=0,$num=1;$j<count($courses);$j++,$num++):
									 if($courses[$j]['trend'] == $trends[$i]['id']): ?>
										<tr>
											<!--td><?=$num;?>.</td-->
											<td><?= $courses[$j]['code']; ?></td>
											<td><span class="single-course"><?= $courses[$j]['title'] ?></span></td>
											<!--td><nobr><?= $courses[$j]['price']; ?> руб.</nobr></td-->
											<td class="centerized"><nobr><?= $courses[$j]['hours']; ?> ч.</nobr></td>
										</tr>
									<? endif; ?>
								<? endfor; ?>
									</tbody>
							</table>
							</div>
						</div>
					</div>
				<?php endif;?>
			<?php endfor;?>
				</div>
				<div class="btn-toolbar">
					<div class="btn-group">
						<a href="<?= base_url(); ?>courses_list.xls" class="btn btn-info"><i class="icon-th-list icon-white"></i> Cписок курсов</a>
					</div>
				</div>
			</div>
		<?php if($loginstatus['status'] && $loginstatus['zak']):?>
			<?php $this->load->view('users_interface/rightbarcus');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['slu']):?>
			<?php $this->load->view('users_interface/rightbaraud');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['adm']):?>
			<?php $this->load->view('users_interface/rightbaradm');?>
		<?php endif;?>
		</div>
		<hr>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
</body>
</html>
