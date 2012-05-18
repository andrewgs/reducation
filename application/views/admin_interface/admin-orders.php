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
							<th><nobr>Заказ создан</nobr><br/><nobr>Заказ закрыт</nobr></th>
							<th>Заказчик</th>
							<!--th>Статус</th-->
							<th><nobr>Дата оплаты</nobr></th>
							<th>Оплата</th>
							<th>Дополнительно</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0,$num=1;$i<count($orders);$i++):?>
						<tr>
							<!--td class="short"><?=$num;?></td-->
							<td>
								<nobr>Заказ №<?=$orders[$i]['id'];?>&nbsp;<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/testing','<img src="'.$baseurl.'img/icon/document-task.png" />',array('title'=>'Итоговые тесты'));?></nobr><br/><br/>
								<nobr><?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/statement','<img src="'.$baseurl.'img/icon/blog-blue.png" />',array('target'=>'_blank','title'=>'Ведомость'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/completion','<img src="'.$baseurl.'img/icon/document.png" />',array('target'=>'_blank','title'=>'Приказ об окончании'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/admission','<img src="'.$baseurl.'img/icon/document-bookmark.png" />',array('target'=>'_blank','title'=>'Приказ о зачислении'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry','<img src="'.$baseurl.'img/icon/document-horizontal-text.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?></nobr>
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
							<td>
								<a class="btn btn-success discbtn" data-order="<?=$orders[$i]['id'];?>" data-docnumber="<?=$orders[$i]['docnumber'];?>" data-placement="<?=$orders[$i]['numberplacement'];?>" data-completion="<?=$orders[$i]['numbercompletion'];?>" data-discountval="<?=$orders[$i]['discount'];?>" data-paiddate="<?=$orders[$i]['userpaiddate'];?>" data-toggle="modal" href="#discount"><nobr><i class="icon-pencil icon-white"></i> Параметры</nobr></a><br/><br/>
								<a class="btn btn-success SendMail" data-order="<?=$orders[$i]['id'];?>"><nobr><i class="icon-envelope icon-white"></i> Уведомить&nbsp;</nobr></a>
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
