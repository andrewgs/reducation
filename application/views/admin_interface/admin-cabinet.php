<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="nav nav-pills">
					<li><?=anchor('','<i class="icon-home"></i> Главная');?></li>
					<li><?=anchor('admin-panel',' <i class="icon-cog"></i>Панель администрирования');?></li>
					<li class="active"><?=anchor('admin-cabinet','<i class="icon-user"></i> Личный кабинет');?></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-book"></i> Справочники <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><?=anchor('admin-panel/references/trends','<i class="icon-chevron-right"></i> Список направлений');?></li>
							<li><?=anchor('admin-panel/references/courses','<i class="icon-chevron-right"></i> Список курсов');?></li>
						</ul>
					</li>
					<li><?=anchor('admin-logoff','<i class="icon-off"></i> Завершить сеанс');?></li>
				</ul>
			</div>
			<div class="span3">
				sdsd
			</div>
		</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?=$baseurl;?>js/libs/jquery-1.7.1.min.js"><\/script>')</script>
	<script src="<?=$baseurl;?>js/bootstrap.js"></script>
</body>
</html>
