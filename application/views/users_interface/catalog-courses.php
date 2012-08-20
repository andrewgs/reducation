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
			<div class="span12">
				<h1 class="bordered">Курсы повышения квалификации специалистов</h1>
			</div>
			<div class="span10">
				<p>
					В рамках программы подготовки специалистов для реального сектора экономики, Южно-окружной центр 
					повышения квалификации и переподготовки кадров для строительного и жилищно-коммунального комплекса, 
					производит набор в группы на:
				</p>
				<ul> 
					<li>курсы повышения квалификации инженеров проектировщиков;</li>
					<li>курсы повышения квалификации строителей;</li> 
					<li>курсы повышения квалификации изыскателей;</li>
					<li>курсы повышения квалификации энергоаудиторов;</li>
					<li>курсы повышения квалификации по программам пожарно-технического минимума.</li>
				</ul>
				<p>
					По окончании выдается документ установленного образца, удостоверяющий прохождение соответствующего обучения.
				</p>
				<p> 
					Курсы повышения квалификации 2012 отличаются, как по своей направленности, так и по степени специализации. Свои коррективы 
					внесли время и накопленный нами опыт. План курсов повышения квалификации этого года составлен с учетом масштабных 
					строительных работ, которые ведутся в Сочи, а в ближайшем будущем, по мере приближения к чемпионату мира по футболу, 
					охватят Ротов-на-Дону и другие города юга России. Выбор конкретной программы в нашем центре зависит от стоящих перед 
					специалистом задач, а также от степени его общей подготовки и опыта.  Новичкам в какой-либо области, желающим сменить 
					профессию или специализацию, как правило, рекомендуем пройти курсы повышения квалификации общей направленности. Курсы повышения 
					квалификации инженеров и строителей  — для тех, кому необходимо углубить и расширить уже имеющиеся профессиональные знания и навыки.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="span9">
				<h2>Каталог курсов</h2>
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
