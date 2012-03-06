<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<?php $this->load->view('audience_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Регистрационные данные слушателя');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<?php $this->load->view('forms/audience-profile');?>
			</div>
		<?php $this->load->view('users_interface/rightbaraud');?>
		</div>
	</div>
	<?php $this->load->view('audience_interface/scripts');?>
</body>
</html>
