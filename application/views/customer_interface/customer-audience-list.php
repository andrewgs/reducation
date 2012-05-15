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
						<?=anchor($this->uri->uri_string(),'Список слушателей');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<table class="table table-striped table-bordered">
					<tbody>
					<?php for($i=0,$num=1;$i<count($audience);$i++):?>
						<tr>
							<td class="short"><?=$num;?></td>
							<td><?=$audience[$i]['lastname'].' '.$audience[$i]['name'].' '.$audience[$i]['middlename'].' ('.$audience[$i]['position'].')';?></td>
							<td class="short"><?=$audience[$i]['personaphone'];?></td>
						<?php if($audience[$i]['access']):?>
							<td class="short"><span class="label label-success">Активный</span></td>
						<?php else:?>
							<td class="short"><span class="label label-important">Не активный</span></td>
						<?php endif;?>
						<?php if($audience[$i]['online']):?>
							<td class="short"><span class="label label-success">online</span></td>
						<?php else:?>
							<td class="short"><span class="label label-important">offline</span></td>
						<?php endif;?>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
					</tbody>
				</table>
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		</div>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('customer_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".none").click(function(event){event.preventDefault();});
		});
	</script>
</body>
</html>
