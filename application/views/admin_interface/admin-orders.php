<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li tnum="active">
						<?=anchor('admin-panel/messages/orders/active','Активные заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="deactive">
						<?=anchor('admin-panel/messages/orders/deactive','Закрытые заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="all">
						<?=anchor('admin-panel/messages/orders/all','Все заказы');?>
					</li>
				</ul>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>№ заказа</th>
							<th>Дата</th>
							<th>Заказчик</th>
							<!--th>Статус</th-->
							<th>Дата оплаты</th>
							<th>Оплата</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<!--td class="short"><?=$num;?></td-->
							<td>Заказ №<?=$orders[$i]['id'];?></td>
							<td><?=$orders[$i]['orderdate'];?></td>
							<td><?=$orders[$i]['organization'];?></td>
						<?php if($orders[$i]['online']):?>
							<!--td>В сети</td-->
						<?php else:?>
							<!--td>Не в сети</td-->
						<?php endif;?>
						<?php if($orders[$i]['paid']):?>
							<td><?=$orders[$i]['paiddate'];?></td>
							<td class="short centerized"><input type="checkbox" value="1" checked="checked" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td>Не оплачен</td>
							<td class="short centerized"><input type="checkbox" value="1" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php endif; ?>
						</tr>
						<?php $num++; ?>
					<?php endfor; ?>
					</tbody>
				</table>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$("li[tnum='<?=$this->uri->segment(4);?>']").addClass('active');
		$(".none").click(function(event){event.preventDefault();});
		$(".chAccess").click(function(){
			var check = 0;
			var order = $(this).attr('data-ord');
			if($(this).attr("checked") == 'checked'){
				check = 1;
				$(".paiddate[data-ord = "+order+"]").html('<?=date("d.m.Y");?>');
			}else{
				check = 0;
				$(".paiddate[data-ord = "+order+"]").html('Не оплачен');
			}
			$.post('<?=$baseurl;?>admin-panel/messages/orders/paid-order',{'order': order,'access':check});
		});
	</script>
</body>
</html>
