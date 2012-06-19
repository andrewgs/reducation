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
							<th><?=anchor('admin-panel/messages/orders/'.$this->uri->segment(4).'/id/'.$sortby.'/'.$from,'№ заказа');?><span id="id"></span></th>
							<th><nobr><?=anchor('admin-panel/messages/orders/'.$this->uri->segment(4).'/paiddate/'.$sortby.'/'.$from,'Заказ создан');?><span id="paiddate"></span></nobr><br/><nobr><?=anchor('admin-panel/messages/orders/'.$this->uri->segment(4).'/closedate/'.$sortby.'/'.$from,'Заказ закрыт');?><span id="closedate"></span></nobr></th>
							<th><?=anchor('admin-panel/messages/orders/'.$this->uri->segment(4).'/organization/'.$sortby.'/'.$from,'Заказчик');?><span id="organization"></span></th>
							<!--th>Статус</th-->
							<th><nobr><?=anchor('admin-panel/messages/orders/'.$this->uri->segment(4).'/userpaiddate/'.$sortby.'/'.$from,'Дата оплаты');?><span id="userpaiddate"></span></nobr></th>
							<th>Оплата</th>
							<th>Дополнительно</th>
						</tr>
					</thead>
					<tbody>
					<?php $delorders = FALSE;?>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<!--td class="short"><?=$num;?></td-->
							<td style="min-width:110px;">
								<nobr>Заказ №<?=$orders[$i]['id'];?>&nbsp;<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/testing','<img src="'.$baseurl.'img/icon/document-task.png" />',array('title'=>'Итоговые тесты'));?></nobr><br/><br/>
								<nobr><?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/statement','<img src="'.$baseurl.'img/icon/blog-blue.png" />',array('target'=>'_blank','title'=>'Ведомость'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/completion','<img src="'.$baseurl.'img/icon/document.png" />',array('target'=>'_blank','title'=>'Приказ об окончании'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/admission','<img src="'.$baseurl.'img/icon/document-bookmark.png" />',array('target'=>'_blank','title'=>'Приказ о зачислении'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/reference','<img src="'.$baseurl.'img/icon/address-book.png" />',array('target'=>'_blank','title'=>'Справка'));?></nobr><br/>
								<nobr>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry/list-1','<img src="'.$baseurl.'img/icon/document-horizontal-text.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry/list-2','<img src="'.$baseurl.'img/icon/application-list.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?></nobr>
							</td>
							<td>
								<?=$orders[$i]['orderdate'];?>
							<?php if($orders[$i]['closedate'] != '0000-00-00'):?>
								<br/><?=$orders[$i]['closedate'];?>
							<?php endif;?>
							</td>
							<td><?=$orders[$i]['organization'];?></td>
						<?php if($orders[$i]['online']):?>
							<!--td>В сети</td-->
						<?php else:?>
							<!--td>Не в сети</td-->
						<?php endif;?>
						<?php if($orders[$i]['paid']):?>
							<td class="PaidDate" data-order="<?=$orders[$i]['id'];?>"><?=$orders[$i]['userpaiddate'];?></td>
							<td class="short centerized"><input type="checkbox" value="1" checked="checked" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td class="PaidDate" data-order="<?=$orders[$i]['id'];?>">Не оплачен</td>
							<td class="short centerized"><input type="checkbox" value="1" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php endif; ?>
							<td style="max-width:80px;">
								<a class="btn btn-success discbtn" data-order="<?=$orders[$i]['id'];?>" data-docnumber="<?=$orders[$i]['docnumber'];?>" data-placement="<?=$orders[$i]['numberplacement'];?>" data-completion="<?=$orders[$i]['numbercompletion'];?>" data-discountval="<?=$orders[$i]['discount'];?>" data-paiddate="<?=$orders[$i]['userpaiddate'];?>" data-toggle="modal" href="#discount"><nobr><i class="icon-pencil icon-white"></i> Параметры</nobr></a>
								<a class="btn btn-info SendMail" data-order="<?=$orders[$i]['id'];?>"><nobr><i class="icon-envelope icon-white"></i>&nbsp;Уведомить&nbsp;</nobr></a>
						<?php if(!$orders[$i]['finish']):?>
							<?php $delorders = TRUE;?>
							<a class="btn btn-danger deleteOrder" data-toggle="modal" href="#deleteOrder" title="Заказ не оформлен" data-order="<?=$orders[$i]['id'];?>"><nobr><i class="icon-trash icon-white"></i>&nbsp;&nbsp;&nbsp;Удалить&nbsp;&nbsp;&nbsp;</nobr></a>
						<?php endif;?>
							</td>
						</tr>
						<?php $num++; ?>
					<?php endfor; ?>
					</tbody>
				</table>
				<?php if($pages): ?>
					<?=$pages;?>
				<?php endif;?>
			</div>
			<?php $this->load->view('admin_interface/modal/user-set-discount');?>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
			<?php $this->load->view('customer_interface/modal/customer-delete-order');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("li[tnum='<?=$this->uri->segment(4);?>']").addClass('active');
		<?php if($this->uri->segment(6) == 'asc'):?>
			$("#<?=$this->uri->segment(5);?>").addClass("sortasc");
		<?php else:?>
			$("#<?=$this->uri->segment(5);?>").addClass("sortdesc");
		<?php endif;?>
			$(".none").click(function(event){event.preventDefault();});
			$(".chAccess").click(function(){
				var check = 0;
				var order = $(this).attr('data-ord');
				if($(this).attr("checked") == 'checked'){
					check = 1;
					$(".discbtn[data-order="+order+"]").attr("data-paiddate",'<?=date("d.m.Y");?>');
					$(".PaidDate[data-order="+order+"]").html('<?=date("d.m.Y");?>');
				}else{
					check = 0;
					$(".discbtn[data-order="+order+"]").attr("data-paiddate",'Не оплачен');
					$(".PaidDate[data-order="+order+"]").html('Не оплачен');
				}
				$.post('<?=$baseurl;?>admin-panel/messages/orders/paid-order',{'order': order,'access':check});
			});
			$(".discbtn").click(function(){
				var order = $(this).attr('data-order');
				$("#idOrder").val(order);
				$("#DiscountValue").val($(this).attr('data-discountval'));
				$("#DocumentValue").val($(this).attr('data-docnumber'));
				$("#NumberPlacement").val($(this).attr('data-placement'));
				$("#NumberCompletion").val($(this).attr('data-completion'));
				if($(".chAccess[data-ord="+order+"]").attr("checked")=="checked"){
					$("#PaidDate").removeAttr("disabled").removeClass("disabled");
				}else{
					$("#PaidDate").attr("disabled","disabled").addClass("disabled");
				}
				$("#PaidDate").val($(this).attr('data-paiddate'));
			});
			$(".SendMail").click(function(){
				if(!confirm("Отправить уведомление?")) return false;
				var order = $(this).attr('data-order');
				var obj = $(this);
				$.post("<?=$baseurl;?>admin-panel/messages/orders/send-mail",{'order':order},function(data){$(obj).after(data.retvalue);},"json");
			});
			
		<?php if($delorders):?>
			var Order = 0;
			$(".deleteOrder").click(function(){Order = $(this).attr('data-order');});
			$("#DelOrder").click(function(){location.href='<?=$baseurl;?>admin-panel/messages/orders/delete-order/'+Order;});
		<?php endif;?>
			
			$("#dsend").click(function(event){
				var err = false;
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".dhinput").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(err){event.preventDefault();}
			});
			$("#discount").on("hidden",function(){$("#msgdsalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();});
			$(".digital").keypress(function(e){
				if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
		});
	</script>
</body>
</html>
