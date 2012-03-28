<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li tnum="all">
						<?=anchor('admin-panel/messages/orders/all','Все заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="active">
						<?=anchor('admin-panel/messages/orders/active','Активные заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="deactive">
						<?=anchor('admin-panel/messages/orders/deactive','Закрытые заказы');?>
					</li>
				</ul>
				<table class="table table-striped table-bordered">
					<tbody>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<td class="short"><a title="Порядковый номер" class="none"><?=$num;?></a></td>
							<td><a href="" title="Номер заказа" class="none">Заказ №<?=$orders[$i]['id'];?></a></td>
							<td><a href="" title="Дата заказа" class="none"><?=$orders[$i]['orderdate'];?></a></td>
							<td><a href="" title="Заказчик" class="none"><?=$orders[$i]['organization'];?></a></td>
						<?php if($orders[$i]['online']):?>
							<td><a href="" title="В сети" class="none">В сети</a></td>
						<?php else:?>
							<td><a href="" title="В сети" class="none">Не в сети</a></td>
						<?php endif;?>
						<?php if($orders[$i]['paid']):?>
							<td class="short"><input type="checkbox" value="1" checked="checked" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
							<td><a href="" title="Дата оплаты" class="none paiddate" data-ord="<?=$orders[$i]['id'];?>"><?=$orders[$i]['paiddate'];?></a></td>
						<?php else:?>
							<td class="short"><input type="checkbox" value="1" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
							<td><a href="" title="Дата оплаты" class="none paiddate" data-ord="<?=$orders[$i]['id'];?>">Не оплачен</a></td>
						<?php endif;?>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
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
