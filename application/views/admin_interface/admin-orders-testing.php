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
						<?=anchor('admin-panel/messages/orders/unpaid','Неоплачанные заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="sponsored">
						<?=anchor('admin-panel/messages/orders/sponsored','Оплачанные заказы');?> <span class="divider">/</span>
					</li>
					<li tnum="all">
						<?=anchor('admin-panel/messages/orders/all','Все заказы');?>
					</li>
				</ul>
				<h4>Заказ №<?=$this->uri->segment(5);?></h4>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><nobr>№ п/п</nobr></th>
							<th>Код. Название курса</th>
							<th>Слушатель</th>
							<th>Результат</th>
							<th><nobr>Дата сдачи</nobr></th>
							<th width="150px;">Просмотр</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0,$num=1;$i<count($audcourses);$i++):?>
						<tr>
							<td><?=$num;?></td>
							<td style="min-width:250px;"><?=$audcourses[$i]['ccode'].'. '.$audcourses[$i]['ctitle'];?></td>
							<td><?=$audcourses[$i]['lastname'].' '.$audcourses[$i]['name'].' '.$audcourses[$i]['middlename'];?></td>
							<td><?=$audcourses[$i]['result'];?>%</td>
							<td><nobr><?=$audcourses[$i]['dateover'];?></nobr></td>
							<td>
							<?php if($audcourses[$i]['status']):?>
								<?=anchor('admin-panel/messages/orders/'.$this->uri->segment(5).'/audience/'.$audcourses[$i]['audid'].'/courses/'.$audcourses[$i]['id'].'/test-report/'.$audcourses[$i]['tresid'].'/full','Полный',array('class'=>'btn btn-success','target'=>'_blank'));?><br/>
								<?=anchor('admin-panel/messages/orders/'.$this->uri->segment(5).'/audience/'.$audcourses[$i]['audid'].'/courses/'.$audcourses[$i]['id'].'/test-report/'.$audcourses[$i]['tresid'].'/short','Краткий',array('class'=>'btn btn-success','target'=>'_blank'));?>
							<?php endif;?>
							</td>
						</tr>
						<?php $num++; ?>
					<?php endfor; ?>
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
