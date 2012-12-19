<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('physical_interface/includes/head');?>
<body>
	<?php $this->load->view('physical_interface/includes/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li>Выбор направления (шаг 1) <span class="divider">/</span></li>
					<li class="active"><?=anchor($this->uri->uri_string(),'Выбор курсов (шаг 2)');?></li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<?php $this->load->view('forms/physical/ordering-courses-list');?>
				<?php $price = 0; ?>
			<?php if(count($courseorder)):?>
				<table class="table table-striped table-bordered">
					<caption>Список выбранных курсов</caption>
					<thead>
						<tr>
							<th><nobr>№ п/п</nobr></th>
							<th><nobr>Код курса</nobr></th>
							<th><nobr>Название курса</nobr></th>
							<th><nobr>Цена курса</nobr></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
				<?php for($i=0,$num=1;$i<count($courseorder);$i++,$num++):?>
						<tr>
							<td class="short"><?=$num;?></td>
							<td><?=$courseorder[$i]['code'];?></td>
							<td><?=$courseorder[$i]['title'];?></td>
							<td><?=$courseorder[$i]['price'];?></td>
							<td class="short"><a class="close deleteCOrder" data-toggle="modal" href="#deleteCOrder" idcorder="<?=$courseorder[$i]['id'];?>">&times;</a></td>
						</tr>
						<?php $price += $courseorder[$i]['price'] ?>
				<?php endfor;?>
					</tbody>
				</table>
			<?php endif;?>
				<div class="modal-footer">
					<span>Цена заказа: <strong><u><?=$price;?> рублей.</u></strong></span>
					<button class="btn" id="cancel" data-toggle="modal" href="#cancelRegistration">Отменить</button>
				<?php if(count($courseorder)>0):?>
					<?=anchor('physical/registration/ordering/step/3','Далее <i class="icon-forward icon-white"></i>',array('class'=>'btn btn-primary','id'=>'next'));?>
				<?php else:?>
					<button class="btn btn-primary disabled">Далее <i class="icon-forward icon-white"></i></button>
				<?php endif;?>
				</div>
			</div>
		<?php $this->load->view('users_interface/rightbarfiz');?>
		</div>
		<?php $this->load->view('physical_interface/modal/ordering-cancel');?>
		<?php $this->load->view('physical_interface/modal/ordering-delete-corder');?>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('physical_interface/includes/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var COrder = -1;
			$(".deleteCOrder").click(function(){COrder = $(this).attr('idcorder');});
			$("#DelCOrder").click(function(){location.href='<?=$baseurl;?><?=$this->uri->uri_string();?>/delete-course/'+COrder;});
			$("#YesCancel").click(function(){location.href="<?=$baseurl;?>physical/registration/ordering/cancel-registration"});
		});
	</script>
</body>
</html>
