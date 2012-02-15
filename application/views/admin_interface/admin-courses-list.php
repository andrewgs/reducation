<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div>
					<ul class="nav nav-pills">
						<li class="active"><?=anchor('admin-panel/references/courses','<i class="icon-list-alt"></i> Список курсов');?></li>
					</ul>
					<h5>
						<a href="#"><i class="icon-minus"></i></a>
						Безопасность и качество строительства. Строительство зданий и сооружений 
						<small>(19 курсов)</small> 
					</h5>
					<table class="table table-striped table-bordered table-condensed">
						<tbody>
							<tr>
								<td><a href="#"><i class="icon-pencil" title="Редактировать"></i></a></td>
								<td><a href="#">П-01. Проектирование зданий и сооружений. Схемы планировочной организации земельного участка</a></td>
								<td><i class="icon-eye-open" title="Виден"></i></td>
								<td><a class="close" title="Удалить">&times;</a></td>
							</tr>
							<tr>
								<td><a href="#"><i class="icon-pencil" title="Редактировать"></i></a></td>
								<td><a href="#">П-02. Проектирование зданий и сооружений. Архитектурные решения</a></td>
								<td><i class="icon-eye-open" title="Виден"></i></td>
								<td><a class="close" title="Удалить">&times;</a></td>
							</tr>
							<tr>
								<td><a href="#"><i class="icon-pencil" title="Редактировать"></i></a></td>
								<td><a href="#">П-03. Проектирование зданий и сооружений. Конструктивные решения</a></td>
								<td><i class="icon-eye-open" title="Виден"></i></td>
								<td><a class="close" title="Удалить">&times;</a></td>
							</tr>
							<tr>
								<td><a href="#"><i class="icon-pencil" title="Редактировать"></i></a></td>
								<td><a href="#">П-04. Проектирование зданий и сооружений. Внутренние инженерные системы отопления, вентиляции, водоснабжения и канализации</a></td>
								<td><i class="icon-eye-close" title="Не виден"></i></td>
								<td><a class="close" title="Удалить">&times;</a></td>
							</tr>
						</tbody>
					</table>
					<p><a href="#" class="btn btn-primary"><i class="icon-plus"></i> Добавить курс</a></p>
					<h5><a href="#"><i class="icon-plus"></i></a> Подготовка проектной документации <small>(21 курс)</small></h5>
					<h5><a href="#"><i class="icon-plus"></i></a> Инженерные изыскания <small>(9 курсов)</small></h5>
					<h5><a href="#"><i class="icon-plus"></i></a> Градостроительство и охрана объектов культурного наследия <small>(1 курс)</small></h5>
					<h5><a href="#"><i class="icon-plus"></i></a> Охрана труда <small>(2 курса)</small></h5>
					<h5><a href="#"><i class="icon-plus"></i></a> Энергетический менеджмент и энергоаудит <small>(4 курса)</small></h5>
					<h5><a href="#"><i class="icon-plus"></i></a> Бухгалтерский учет и аудит в строительстве и ЖКХ <small>(1 курс)</small></h5>
					<h5><a href="#"><i class="icon-plus"></i></a> Менеджмент городского хозяйства <small>(1 курс)</small></h5>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
</body>
</html>
