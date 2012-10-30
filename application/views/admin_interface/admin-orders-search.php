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
						<?=anchor('admin-panel/messages/orders/active','В работе',array('title'=>'Обучение разрешено'));?> <span class="divider">/</span>
					</li><li tnum="noactive">
						<?=anchor('admin-panel/messages/orders/noactive','Не в работе',array('title'=>'Обучение не разрешено'));?> <span class="divider">/</span>
					</li>
					<li tnum="noclosed">
						<?=anchor('admin-panel/messages/orders/noclosed','Не активные',array('title'=>'Обучение не начато'));?> <span class="divider">/</span>
					</li>
					<li tnum="deactive">
						<?=anchor('admin-panel/messages/orders/deactive','Закрытые',array('title'=>'Обучение окончено'));?> <span class="divider">/</span>
					</li>
					<li tnum="unpaid">
						<?=anchor('admin-panel/messages/orders/unpaid','Неоплаченные',array('title'=>'Обучение не оплачено'));?> <span class="divider">/</span>
					</li>
					<li tnum="sponsored">
						<?=anchor('admin-panel/messages/orders/sponsored','Оплаченные',array('title'=>'Обучение оплачено'));?> <span class="divider">/</span>
					</li>
					<li tnum="all">
						<?=anchor('admin-panel/messages/orders/all','Все');?>
					</li>
				</ul>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
			<?php if(count($orders)):?>
				<div>
					<?=anchor($this->uri->uri_string().'/new-search','Повторить поиск');?>
				</div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="centerized">№ заказа</th>
							<th class="centerized"><nobr>Заказ создан</nobr><br/><nobr>Заказ закрыт</nobr></th>
							<th class="centerized">Заказчик</th>
							<!--th>Статус</th-->
							<th class="centerized"><nobr>Дата оплаты</nobr><br/>Дата обучения</th>
							<th class="centerized">Оплата</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php $delorders = FALSE;?>
					<?php for($i=0;$i<count($orders);$i++):?>
						<tr>
							<td style="min-width:135px;">
								<nobr>Заказ №<?=$orders[$i]['id'];?>&nbsp;<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/testing','<img src="'.$baseurl.'img/icon/document-task.png" />',array('title'=>'Итоговые тесты'));?></nobr><br/>
								<nobr><?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/statement','<img src="'.$baseurl.'img/icon/blog-blue.png" />',array('target'=>'_blank','title'=>'Ведомость'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/completion','<img src="'.$baseurl.'img/icon/document.png" />',array('target'=>'_blank','title'=>'Приказ об окончании'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/admission','<img src="'.$baseurl.'img/icon/document-bookmark.png" />',array('target'=>'_blank','title'=>'Приказ о зачислении'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/reference','<img src="'.$baseurl.'img/icon/address-book.png" />',array('target'=>'_blank','title'=>'Справка'));?></nobr><br/>
								<nobr>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry/list-1','<img src="'.$baseurl.'img/icon/document-horizontal-text.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?>&nbsp;
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/registry/list-2','<img src="'.$baseurl.'img/icon/application-list.png" />',array('target'=>'_blank','title'=>'Реестр слушателей'));?>
								<span class="listeners-count">[<?=$orders[$i]['regnum'];?>]</span><br/>
								</nobr>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/invoice','<img src="'.$baseurl.'img/icon/document-attribute-i.png" />',array('target'=>'_blank','title'=>'Счет на оплату'));?>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/contract','<img src="'.$baseurl.'img/icon/document-attribute-c.png" />',array('target'=>'_blank','title'=>'Договор на оказание образовательных услуг'));?>
								<?=anchor('admin-panel/messages/orders/id/'.$orders[$i]['id'].'/act','<img src="'.$baseurl.'img/icon/document-attribute-a.png" />',array('target'=>'_blank','title'=>'Акт к договору на оказание услуг'));?>
								<span class="listeners-count">[<?=$orders[$i]['audcnt'];?>]</span>
							</td>
							<td class="centerized">
								<?=$orders[$i]['orderdate'];?>
							<?php if($orders[$i]['closedate'] != '0000-00-00'):?>
								<br/><?=$orders[$i]['closedate'];?>
							<?php endif;?>
							</td>
							<td>
								<?=anchor('admin-panel/users/customer/info/id/'.$orders[$i]['cid'],$orders[$i]['organization']);?><br/>
								№ тел.: <?=$orders[$i]['phones'];?>
							</td>
						<?php if($orders[$i]['online']):?>
							<!--td>В сети</td-->
						<?php else:?>
							<!--td>Не в сети</td-->
						<?php endif;?>
						<?php if($orders[$i]['paid']):?>
							<td class="PaidDate centerized" data-order="<?=$orders[$i]['id'];?>">
								<?=$orders[$i]['userpaiddate'];?><br/>
								<span class="green"><?=$orders[$i]['paiddate'];?></span>
							</td>
							<td class="short centerized"><input type="checkbox" value="1" checked="checked" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td class="PaidDate" data-order="<?=$orders[$i]['id'];?>">Не оплачен</td>
							<td class="short centerized"><input type="checkbox" value="1" data-ord="<?=$orders[$i]['id'];?>" id="ch<?=$orders[$i]['id'];?>" class="chAccess"></td>
						<?php endif; ?>
							<td style="max-width:35px;" class="centerized">
								<a class="btn btn-success discbtn" data-order="<?=$orders[$i]['id'];?>" data-docnumber="<?=$orders[$i]['docnumber'];?>" data-placement="<?=$orders[$i]['numberplacement'];?>" data-completion="<?=$orders[$i]['numbercompletion'];?>" data-discountval="<?=$orders[$i]['discount'];?>" data-paiddate="<?=$orders[$i]['userpaiddate'];?>" data-toggle="modal" href="#discount"><i class="icon-pencil icon-white"></i></a>
								<a class="btn btn-info SendMail" data-order="<?=$orders[$i]['id'];?>"><i class="icon-envelope icon-white"></i></a>
						<?php if(!$orders[$i]['finish']):?>
							<?php $delorders = TRUE;?>
							<a class="btn btn-danger deleteOrder" data-toggle="modal" href="#deleteOrder" title="Заказ не оформлен" data-order="<?=$orders[$i]['id'];?>"><i class="icon-trash icon-white"></i></a>
						<?php endif;?>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
			<?php else:?>
				<?php $this->load->view('forms/search-orders');?>
			<?php endif;?>
			</div>
		<?php if(count($orders)):?>
			<?php $this->load->view('admin_interface/modal/user-set-discount');?>
		<?php endif;?>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("li[tnum='<?=$this->uri->segment(4);?>']").addClass('active');
			$(".none").click(function(event){event.preventDefault();});
		<?php if(count($orders)):?>
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
		<?php else:?>
			function suggest(inputString){
				if(inputString.length < 2){
					$("#suggestions").fadeOut();
				}else{
					$("#customer").addClass('load');
					$.post("<?=$baseurl;?>admin-panel/messages/search-customer",{squery: ""+inputString+""},
						function(data){
							if(data.status){
								$("#suggestions").fadeIn();
								$("#suggestionsList").html(data.retvalue);
								$(".custorg").live('click',function(){fill($(this).html());});
							}else{
								$('#suggestions').fadeOut();
							};
							$("#customer").removeClass('load');
					},"json");
				}
			};
			
			function fill(thisValue){
				$("#customer").val(thisValue);
				setTimeout("$('#suggestions').fadeOut();", 600);
			};
			
			$("#customer").keyup(function(){suggest(this.value)});
			$("#customer").focusout(function(){setTimeout("$('#suggestions').fadeOut();", 600);});
		<?php endif;?>
			$("#save").click(function(event){
				var err = false;
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".inpval").each(function(i,element){
					if($(this).val() != ''){err = true;}
				});
				if(!err){
					$("#err").parents(".control-group").addClass('error');
					$("#err").html("Не задан критерий поиска").show();
					event.preventDefault();
				}
			});
			
			$(".digital").keypress(function(e){
				if(e.which!=8 && e.which!=46 && e.which!=0 && (e.which<48 || e.which>57)){return false;}
			});
		});
	</script>
</body>
</html>
