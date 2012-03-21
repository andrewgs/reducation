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
						<?php if($orders[$i]['paid']):?>
							<td class="short"><input type="checkbox" value="1" checked="checked" ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
							<td><a href="" title="Дата оплаты" class="none"><?=$orders[$i]['paiddate'];?></a></td>
						<?php else:?>
							<td class="short"><input type="checkbox" value="1" ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
							<td><a href="" title="Дата оплаты" class="none" id="paiddate">00-00-0000</a></td>
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
			var order = $(this).attr('ord');
			if($(this).attr("checked") == 'checked'){
				check = 1;
				$.post('<?=$baseurl;?>admin-panel/messages/orders/paid-order',{'order': order,'access':check});
				$("#paiddate").html('<?=date("d.m.Y");?>')
			}else{
				$(this).attr("checked","checked");
			}
		});
	</script>
</body>
</html>
