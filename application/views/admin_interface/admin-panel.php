<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="nav nav-pills">
					<li class="active"><?=anchor('admin-panel/actions/control','<i class="icon-cog"></i> Панель управления');?></li>
				</ul>
			</div>
		<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
</body>
</html>
