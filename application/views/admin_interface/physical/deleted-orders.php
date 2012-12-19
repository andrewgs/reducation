<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<?php $sortby = '';?>
				<?php $from = $this->uri->segment(5);?>
				<?php if($this->uri->total_segments() >= 6):?>
					<?php $sortby = $this->uri->segment(6);?>
					<?php $from = $this->uri->segment(7);?>
				<?php endif;?>
				<ul class="breadcrumb">
					<li tnum="active">
						<?=anchor($this->uri->uri_string(),'Удаленные заказы',array('title'=>'Удаленные заказы'));?>
				</ul>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<?php if($sortby == 'asc'):?>
					<?php $sortby = 'desc';?>
				<?php elseif(empty($sortby)):?>
					<?php $sortby = 'asc';?>
				<?php elseif($sortby == 'desc'):?>
					<?php $sortby = 'asc';?>
				<?php endif;?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th class="centerized"><?=anchor('admin-panel/messages/physical-deleted/orders/id/'.$sortby.'/'.$from,'№ заказа');?><span id="id"></span></th>
							<th class="centerized"><nobr><?=anchor('admin-panel/messages/physical-deleted/orders/paiddate/'.$sortby.'/'.$from,'Заказ создан');?><span id="paiddate"></span></nobr><br/><nobr><?=anchor('admin-panel/messages/physical-deleted/orders/closedate/'.$sortby.'/'.$from,'Заказ закрыт');?><span id="closedate"></span></nobr></th>
							<th class="centerized"><?=anchor('admin-panel/messages/physical-deleted/orders/fio/'.$sortby.'/'.$from,'Заказчик');?><span id="fio"></span></th>
							<th class="centerized">
								<?=anchor('admin-panel/messages/physical-deleted/orders/userpaiddate/'.$sortby.'/'.$from,'Дата оплаты');?><span id="userpaiddate"></span>
								<br/>Дата обучения
							</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php $delorders = FALSE;?>
					<?php $num = $count - $this->uri->segment(5)?>
					<?php if($this->uri->total_segments()==7):?>
						<?php $num=$this->uri->segment(7);?>
					<?php endif;?>
					
					<?php for($i=0;$i<count($orders);$i++):?>
						<tr>
							<td class="short"><?=$num-$i;?></td>
							<td style="max-width:135px;">
								<nobr>Заказ №<?=$orders[$i]['id'];?>
							<?php if($orders[$i]['finish']):?>
								&nbsp;<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/testing','<img src="'.$baseurl.'img/icon/document-task.png" />',array('title'=>'Итоговые тесты'));?></nobr><br/><br/>
								<nobr><?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/statement','<img src="'.$baseurl.'img/icon/blog-blue.png" />',array('target'=>'_blank','title'=>'Ведомость'));?>&nbsp;
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/completion','<img src="'.$baseurl.'img/icon/document.png" />',array('target'=>'_blank','title'=>'Приказ об окончании'));?>&nbsp;
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/admission','<img src="'.$baseurl.'img/icon/document-bookmark.png" />',array('target'=>'_blank','title'=>'Приказ о зачислении'));?>&nbsp;
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/reference','<img src="'.$baseurl.'img/icon/address-book.png" />',array('target'=>'_blank','title'=>'Справка'));?></nobr><br/>
								<nobr>
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/registry/list-1','<img src="'.$baseurl.'img/icon/document-horizontal-text.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?>&nbsp;
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/registry/list-2','<img src="'.$baseurl.'img/icon/application-list.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?></nobr>
								<span class="listeners-count">[<?=$orders[$i]['regnum'];?>]</span><br/>
								<nobr>
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/invoice','<img src="'.$baseurl.'img/icon/document-attribute-i.png" />',array('target'=>'_blank','title'=>'Счет на оплату'));?>
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/contract','<img src="'.$baseurl.'img/icon/document-attribute-c.png" />',array('target'=>'_blank','title'=>'Договор на оказание образовательных услуг'));?>
								<?=anchor('admin-panel/messages/physical-orders/id/'.$orders[$i]['id'].'/act','<img src="'.$baseurl.'img/icon/document-attribute-a.png" />',array('target'=>'_blank','title'=>'Акт к договору на оказание услуг'));?>
								</nobr>
							<?php else:?>
								<br/><span class="red">Заказ не оформлен</span>
							<?php endif;?>
							</td>
							<td class="centerized">
								<?=$orders[$i]['orderdate'];?>
							<?php if($orders[$i]['closedate'] != '0000-00-00'):?>
								<br/><?=$orders[$i]['closedate'];?>
							<?php endif;?>
							</td>
							<td style="max-width:180px;">
								<?=anchor('admin-panel/users/physical/info/id/'.$orders[$i]['cid'],$orders[$i]['fio']);?><br/>
								№ тел.: <?=$orders[$i]['phones'];?>
							</td>
						<?php if($orders[$i]['paid']):?>
							<td class="PaidDate centerized" data-order="<?=$orders[$i]['id'];?>">
								<?=$orders[$i]['userpaiddate'];?><br/>
								<span class="green"><?=$orders[$i]['paiddate'];?></span>
							</td>
						<?php else:?>
							<td class="PaidDate centerized" data-order="<?=$orders[$i]['id'];?>">Не оплачен</td>
						<?php endif; ?>
							<td style="max-width:35px;" class="centerized">
							<a class="btn btn-success RestoreOrder" data-toggle="modal" href="#restoreOrder" title="Восстановить заказ" data-order="<?=$orders[$i]['id'];?>"><i class="icon-share-alt icon-white"></i></a>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
			<?php $this->load->view('admin_interface/modal/admin-restore-order');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
		<?php if($this->uri->segment(6) == 'asc'):?>
			$("#<?=$this->uri->segment(5);?>").addClass("sortasc");
		<?php else:?>
			$("#<?=$this->uri->segment(5);?>").addClass("sortdesc");
		<?php endif;?>
			var Order = 0;
			$(".RestoreOrder").click(function(){Order = $(this).attr('data-order');});
			$("#ResOrder").click(function(){location.href='<?=$baseurl;?>admin-panel/messages/physical-orders/restore-order/'+Order;});
		});
	</script>
</body>
</html>
