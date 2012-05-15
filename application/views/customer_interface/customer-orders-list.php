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
						<?=anchor($this->uri->uri_string(),'Мои заказы');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>№ п\п</th>
							<th>№ заказа</th>
							<th>Статус активности</th>
							<th>Статус оплаты</th>
							<th>Статус офрмления</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<td class="short"><?=$num;?></td>
							<td>
							<?=anchor('customer/audience/orders/order-information/id/'.$orders[$i]['id'],'<strong> №'.$orders[$i]['id'].' от ('.$orders[$i]['orderdate'].')</strong>')?>
							</td>
						<?php if($orders[$i]['closedate']!='0000-00-00'):?>
							<td class="short"><span class="label label-success">Закрыт</span></td>
						<?php else:?>
							<td class="short"><span class="label label-important">Открыт</span></td>
						<?php endif;?>
						<?php if($orders[$i]['paid']):?>
							<td class="short"><span class="label label-success">Оплачен</span></td>
						<?php else:?>
							<td class="short"><span class="label label-important">Не оплачен</span></td>
						<?php endif;?>
						<?php if($orders[$i]['finish']):?>
							<td class="short"><span class="label label-success">Оформлен</span></td>
							<td class="short">&nbsp;</td>
						<?php else:?>
							<td class="short"><span class="label label-important">Не оформлен</span></td>
							<td class="short"><a class="close deleteOrder" title="Удалить" data-toggle="modal" href="#deleteOrder" idorder="<?=$orders[$i]['id'];?>">&times;</a></td>
						<?php endif;?>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
					</tbody>
				</table>
				<?php $this->load->view('customer_interface/modal/customer-delete-order');?>
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		</div>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('customer_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var Order = -1;
			
			$(".deleteOrder").click(function(){Order = $(this).attr('idorder');});
			$("#DelOrder").click(function(){location.href='<?=$baseurl;?><?=$this->uri->uri_string();?>/delete-order/'+Order;});
			$(".none").click(function(event){event.preventDefault();});
		});
	</script>
</body>
</html>
