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
					<li tnum="unpaid">
						<?=anchor('admin-panel/messages/orders/unpaid','Неоплаченные заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="sponsored">
						<?=anchor('admin-panel/messages/orders/sponsored','Оплаченные заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="all">
						<?=anchor('admin-panel/messages/orders/all','Все заказы');?>
					</li>
				</ul>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>№ заказа</th>
							<th>Дата создания</th>
							<th>Заказчик</th>
							<!--th>Статус</th-->
							<th>Дата оплаты</th>
							<th>Оплата</th>
							<th>Дополнительно</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<!--td class="short"><?=$num;?></td-->
							<td>
								Заказ №<?=$orders[$i]['id'];?> (<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/testing','Итоговые тесты');?>)<br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/statement','Ведомость',array('target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/completion','Приказ об окончании',array('target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/admission','Приказ о зачислении',array('target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry','Реестр слушателей',array('target'=>'_blank'));?><br/>
							</td>
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
							<td>
								<a class="btn btn-success discbtn" data-order="<?=$orders[$i]['id'];?>" data-docnumber="<?=$orders[$i]['docnumber'];?>" data-discountval="<?=$orders[$i]['discount'];?>" data-toggle="modal" href="#discount" idcourse=""><i class="icon-pencil icon-white"></i> Скидка</a>
							</td>
						</tr>
						<?php $num++; ?>
					<?php endfor; ?>
					</tbody>
				</table>
			</div>
			<?php $this->load->view('admin_interface/modal/user-set-discount');?>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("li[tnum='<?=$this->uri->segment(4);?>']").addClass('active');
			$(".none").click(function(event){event.preventDefault();});
			$(".chAccess").click(function(){var check = 0;var order = $(this).attr('data-ord');if($(this).attr("checked") == 'checked'){check = 1;$(".paiddate[data-ord = "+order+"]").html('<?=date("d.m.Y");?>');}else{check = 0;$(".paiddate[data-ord = "+order+"]").html('Не оплачен');}$.post('<?=$baseurl;?>admin-panel/messages/orders/paid-order',{'order': order,'access':check});});
			$(".discbtn").click(function(){
				$("#idOrder").val($(this).attr('data-order'));
				$("#DiscountValue").val($(this).attr('data-discountval'));
				$("#DocumentValue").val($(this).attr('data-docnumber'));
			});
		});
	</script>
</body>
</html>
