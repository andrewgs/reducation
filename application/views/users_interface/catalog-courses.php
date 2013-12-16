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
			<div class="span<?=($this->loginstatus['status'])?'9':'12';?>">
				<h1 class="bordered courses">Курсы повышения квалификации руководителей и специалистов</h1>
				<div class="btn-toolbar inline-right">
					<div class="btn-group">
						<a href="<?= base_url(); ?>courses_list.xls" class="btn btn-info"><i class="icon-th-list icon-white"></i> Каталог курсов и прайс-лист (.xls)</a>
					</div>
				</div>
				<div class="clear"></div>
				<!--
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
					специалистом задач, а также от степени его общей подготовки и опыта. Новичкам в какой-либо области, желающим сменить 
					профессию или специализацию, как правило, рекомендуем пройти курсы повышения квалификации общей направленности.Курсы повышения 
					квалификации инженеров и строителей  — для тех, кому необходимо углубить и расширить уже имеющиеся профессиональные знания и навыки.
				</p>
				-->
			</div>
		<?php if($this->loginstatus['status'] && $this->loginstatus['zak']):?>
			<?php $this->load->view('users_interface/rightbarcus');?>
		<?php endif;?>
		<?php if($this->loginstatus['status'] && $this->loginstatus['slu']):?>
			<?php $this->load->view('users_interface/rightbaraud');?>
		<?php endif;?>
		<?php if($this->loginstatus['status'] && $this->loginstatus['adm']):?>
			<?php $this->load->view('users_interface/rightbaradm');?>
		<?php endif;?>
		<?php if($this->loginstatus['status'] && $this->loginstatus['fiz']):?>
			<?php $this->load->view('users_interface/rightbarfiz');?>
		<?php endif;?>
		</div>
		<div class="row">
			<div class="span12">
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
						<div id="collapse<?=$i;?>" class="accordion-body collapse <?=($i==0)?' in':'';?>">
							<div class="accordion-inner">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="centerized">№</th>
											<th class="span4 centerized">Название</th>
											<th class="centerized">Код</th>
											<th class="centerized">Виды работ</th>
											<th class="centerized"><nobr>Кол-во<br/>часов</nobr></th>
											<th class="centerized" width="80px"><nobr>Цена</nobr></th>
										</tr>
									</thead>
									<tbody>
								<? for($j=0,$num=1;$j<count($courses);$j++):
									if($courses[$j]['trend'] == $trends[$i]['id']): ?>
										<tr>
											<td><?=$num?></td>
											<td>
											<?php if(FALSE && !empty($courses[$j]['curriculum']) && is_file(getcwd().'/'.$courses[$j]['curriculum'])):?>
												<a href="<?=site_url('catalog/courses/getCurriculum?course='.$courses[$j]['id']);?>" class="">
													<?=$courses[$j]['title'];?>
												</a>
											<?php elseif($courses[$j]['curriculum_exist'] !== FALSE):?>
												<a href="<?=site_url('catalog/courses/curriculum?id='.$courses[$j]['curriculum_exist']);?>" class="">
													<?=$courses[$j]['title'];?>
												</a>
											<?php else:?>
												<?=$courses[$j]['title'];?>
											<?php endif;?>
											</td>
											<td><?= $courses[$j]['code']; ?></td>
											<td><?=nl2br($courses[$j]['note']);?></td>
											<td class="centerized"><nobr><?= $courses[$j]['hours']; ?> ч.</nobr></td>
											<td class="centerized">
												<?= $courses[$j]['price']; ?> руб. 
												<? if ( $j == 3 ): ?>
												<span class="old-price">6000 руб.</span>
												<? elseif ( $j == 33 || $j == 34 ): ?>
												<span class="old-price">2000 руб.</span>
												<? else: ?>
												<span class="old-price">5000 руб.</span>
												<? endif; ?>
											</td>
											<?php $num++;?>
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
				<!--
				<div class="btn-toolbar">
					<div class="btn-group">
						<a href="<?= base_url(); ?>courses_list.xls" class="btn btn-info"><i class="icon-th-list icon-white"></i> Каталог курсов с ценами</a>
					</div>
				</div>
				-->
			</div>
		
		</div>
		<hr>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
</body>
</html>
