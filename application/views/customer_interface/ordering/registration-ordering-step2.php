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
						<?=anchor($this->uri->uri_string(),'Оформление заказа');?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<?php $this->load->view('forms/ordering-courses-list');?>
			<?php for($i=0;$i<count($courseorder);$i++):?>
				<div id="d<?=$courseorder[$i]['id'];?>">
					<h2 idcorder="<?=$courseorder[$i]['id'];?>"><?=$courseorder[$i]['title'];?></h2>
					<table class="table table-striped table-bordered">
						<tbody>
					<?php for($j=0,$num=1;$j<count($courseaudience);$j++):?>
						<?php if($courseaudience[$j]['course'] == $courseorder[$i]['id']):?>
							<tr>
								<td class="short"><?=$num;?></td>
								<td><?=$courseaudience[$j]['lastname'].' '.$courseaudience[$j]['name'].' '.$courseaudience[$j]['middlename'].' ('.$courseaudience[$j]['specialty'].')';?></td>
								<td class="short"><a class="close delAud" data-toggle="modal" href="#deleteAudience" idAudience="<?=$courseaudience[$j]['id'];?>" idcorder="<?=$courseorder[$i]['id'];?>">&times;</a></td>
							</tr>
							<?php $num++;?>
						<?php else:?>
							<?php continue; ?>
						<?php endif;?>
					<?php endfor;?>
						</tbody>
					</table>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a class="btn addAudience" data-toggle="modal" href="#addAudience" idcorder="<?=$courseorder[$i]['id'];?>"><i class="icon-plus"></i> Добавить слушателя</a>
							<a class="btn deleteCOrder" data-toggle="modal" href="#deleteCOrder" idcorder="<?=$courseorder[$i]['id'];?>"><i class="icon-trash"></i> Удалить курс</a>
						</div>
					</div>
				</div>
			<?php endfor;?>
				<div class="modal-footer">
					<span>Цена заказа: <strong><u><?=$price;?> рублей.</u></strong></span>
					<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
				<?php if(count($courseaudience)>0):?>
					<?=anchor('customer/registration/ordering/step/3','Далее <i class="icon-forward icon-white"></i>',array('class'=>'btn btn-primary','id'=>'next'));?>
				<?php else:?>
					<button class="btn btn-primary disabled">Далее <i class="icon-forward icon-white"></i></button>
				<?php endif;?>
				</div>	
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		</div>
		<?php $this->load->view('customer_interface/modal/ordering-cancel');?>
		<?php $this->load->view('customer_interface/modal/ordering-delete-corder');?>
		<?php $this->load->view('customer_interface/modal/ordering-add-audience');?>
		<?php $this->load->view('customer_interface/modal/ordering-delete-audience');?>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('customer_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var COrder = -1; var Audience = -1;
			$("#send").click(function(event){var trend = $(":radio[name=optRadio]").filter(":checked").val();if(trend == undefined){event.preventDefault();}});
			$("#Select").click(function(event){
				if($(".audList:checked").length == 0){
					$("#chError").find("span.error-text").html("Должен быть выбран хотя бы один слушатель.").end().show();
					event.preventDefault();
				}
			});
			$(".delAud").click(function(){Audience = $(this).attr('idAudience');COrder = $(this).attr('idcorder');});
			
			$("#CloseSelect").click(function(){$(".audList").removeAttr('checked');$("#chError").hide();});
			$("#DelAudience").click(function(){location.href='<?=$baseurl;?><?=$this->uri->uri_string();?>/course/'+COrder+'/delete-audience/'+Audience;});
			$(".deleteCOrder").click(function(){COrder = $(this).attr('idcorder');});
			$("#DelCOrder").click(function(){location.href='<?=$baseurl;?><?=$this->uri->uri_string();?>/delete-course/'+COrder;});
			$(".addAudience").click(function(){$("#idCourse").val($(this).attr('idcorder'));});
			$(".redioTrends").click(function(){$("#send").removeClass('disabled');});
			$("#YesCancel").click(function(){location.href="<?=$baseurl;?>customer/registration/ordering/cancel-registration"});
		});
	</script>
</body>
</html>
