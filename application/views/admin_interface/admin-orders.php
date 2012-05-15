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
							<th>Заказ создан<br/>Заказ закрыт</th>
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
								Заказ №<?=$orders[$i]['id'];?><br/><?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/testing','Итоговые тесты');?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/statement','Ведомость',array('target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/completion','Приказ об окончании',array('target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/admission','Приказ о зачислении',array('target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry','Реестр слушателей',array('target'=>'_blank'));?><br/>
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
							<td class="PaidDate" data-order="<?=$orders[$i]['id'];?>"><?=$orders[$i]['paiddate'];?></td>
							<td class="short centerized"><input type="checkbox" value="1" checked="checked" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td class="PaidDate" data-order="<?=$orders[$i]['id'];?>">Не оплачен</td>
							<td class="short centerized"><input type="checkbox" value="1" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php endif; ?>
							<td>
								<a class="btn btn-success discbtn" data-order="<?=$orders[$i]['id'];?>" data-docnumber="<?=$orders[$i]['docnumber'];?>" data-discountval="<?=$orders[$i]['discount'];?>" data-paiddate="<?=$orders[$i]['userpaiddate'];?>" data-toggle="modal" href="#discount" idcourse=""><nobr><i class="icon-pencil icon-white"></i> Параметры</nobr></a>
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
			$(".chAccess").click(function(){
				var check = 0;
				var order = $(this).attr('data-ord');
				if($(this).attr("checked") == 'checked'){
					check = 1;
					$(".discbtn[data-order="+order+"]").attr("data-paiddate",'<?=date("d m Y");?>');
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
				if($(".chAccess[data-ord="+order+"]").attr("checked")=="checked"){
					$("#PaidDate").removeAttr("disabled").removeClass("disabled");
				}else{
					$("#PaidDate").attr("disabled","disabled").addClass("disabled");
				}
				$("#PaidDate").val($(this).attr('data-paiddate'));
			});
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
