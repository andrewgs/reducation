<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<?php $this->load->view('customer_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Оформление заказа');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<?php $this->load->view('forms/ordering-trends-list');?>
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		</div>
		<?php $this->load->view('users_interface/modal/registration-cancel');?>
	</div>
	<?php $this->load->view('customer_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#send").click(function(event){
				var trend = $(":radio[name=optRadio]").filter(":checked").val();
				if(trend == undefined){event.preventDefault();}
			});
			$(".redioTrends").click(function(){$("#send").removeClass('disabled');});
			$("#YesCancel").click(function(){location.href="<?=$baseurl;?>customer/registration/ordering/cancel-registration"});
		});
	</script>
</body>
</html>
