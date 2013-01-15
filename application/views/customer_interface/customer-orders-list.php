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
				<div class="alert alert-info" id="msgialert">
					<a class="close" id="msgiclose">×</a>
					<h4 class="alert-heading">Информация</h4>
				<?php if(count($orders)):?>
					Ниже находятся список Ваших заказов.<br/>Для подробного просмотра информации и доступа к документам нажмите на номер заказа.<br/>
					<strong>Если есть не оформленные заказы, нажав на номер заказа, Вы можете закончить его оформление!</strong>
				<?php else:?>
					Заказы отсутствуют!<br/>
					<?=anchor('customer/registration/ordering','<span class="label label-important">Оформить заказ &rarr;</span>')?>
				<?php endif;?>
				</div>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
			<?php if(count($orders)):?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="centerized">№ п\п</th>
							<th class="centerized">Номер</th>
							<th class="centerized">Дата</th>
							<th class="centerized">Документы</th>
							<th class="centerized">Активность</th>
							<th class="centerized">Оплаты</th>
							<th class="centerized">Оформление</th>
							<th class="short centerized">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<td class="short centerized"><?=$num;?></td>
							<td class="centerized">
							<?=anchor('customer/audience/orders/order-information/id/'.$orders[$i]['id'],'<strong><nobr>Заказ №'.number_order($orders[$i]['number'],$orders[$i]['year']).'</nobr></strong>')?>
							</td>
							<td class="centerized"><?=$orders[$i]['orderdate'];?></td>
							<td class="centerized">
							<?=anchor('customer/audience/orders/order-information/id/'.$orders[$i]['id'].'/invoice-for-payment','<img src="'.$baseurl.'img/icon/document-attribute-i.png" />',array('title'=>'Счет на оплату','target'=>'_blank'));?>
							<?=anchor('customer/audience/orders/order-information/id/'.$orders[$i]['id'].'/contract','<img src="'.$baseurl.'img/icon/document-attribute-c.png" />',array('title'=>'Договор на оказание образовательных услуг','target'=>'_blank'));?>
							<?=anchor('customer/audience/orders/order-information/id/'.$orders[$i]['id'].'/act-to-contract','<img src="'.$baseurl.'img/icon/document-attribute-a.png" />',array('title'=>'Акт к договору на оказание услуг','target'=>'_blank'));?>
							</td>
						<?php if($orders[$i]['numbercompletion']!=''):?>
							<td class="short centerized"><span class="label label-success">Заказ закрыт</span></td>
						<?php else:?>
							<td class="short centerized"><span class="label label-info">Заказ активен</span></td>
						<?php endif;?>
						<?php if($orders[$i]['paid']):?>
							<td class="short centerized"><span class="label label-success">Заказ оплачен</span></td>
						<?php else:?>
							<td class="short centerized"><span class="label label-important">Заказ не оплачен</span></td>
						<?php endif;?>
						<?php if($orders[$i]['finish']):?>
							<td class="short centerized"><span class="label label-success">Заказ оформлен</span></td>
							<td class="short centerized">&nbsp;</td>
						<?php else:?>
							<td class="short centerized"><span class="label label-important">Не оформлен</span></td>
							<td class="short centerized"><a class="close deleteOrder" title="Удалить" data-toggle="modal" href="#deleteOrder" idorder="<?=$orders[$i]['id'];?>">&times;</a></td>
						<?php endif;?>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
					</tbody>
				</table>
			<?php endif;?>
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		<?php $this->load->view('customer_interface/modal/customer-delete-order');?>
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
