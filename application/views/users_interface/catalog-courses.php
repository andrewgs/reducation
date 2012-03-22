<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div class="hero-unit">
					Каталог курсов
				</div>
				<div class="accordion" id="accordion2">
			<?for($i=0;$i<count($trends);$i++):?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$i;?>">
								<?=$trends[$i]['title'];?>
							</a>
						</div>
						<div id="collapse<?=$i;?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>№ п\п</th>
											<th>Код. Название</th>
											<th>Стоимость</th>
											<th>Количество часов</th>
										</tr>
									</thead>
									<tbody>
								<?php for($j=0,$num=1;$j<count($courses);$j++,$num++):?>
									<?php if($courses[$j]['trend'] == $trends[$i]['id']):?>
										<tr>
											<td><?=$num;?>.</td>
											<td><?=$courses[$j]['code'].'. '.$courses[$j]['title'];?></td>
											<td><?=$courses[$j]['price'];?> руб.</td>
											<td><?=$courses[$j]['hours'];?></td>
										</tr>
									<?php endif;?>
								<?php endfor;?>
									</tbody>
							</table>
							</div>
						</div>
					</div>
			<?php endfor;?>
				</div>
			</div>
		<?php if($loginstatus['status'] && $loginstatus['cus']):?>
			<?php $this->load->view('users_interface/rightbarcus');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['aud']):?>
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
