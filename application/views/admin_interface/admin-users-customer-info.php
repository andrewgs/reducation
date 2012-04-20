<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li>
						<?=anchor('admin-panel/users/customer','Заказчики');?><span class="divider">/</span>
					</li>
					<li class="active">
						<?=anchor('admin-panel/users/customer/info/id/'.$this->uri->segment(6),'Карточка заказчика');?>
					</li>
				</ul>
				<?php $this->load->view('forms/customer-profile-readonly');?>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
</body>
</html>
