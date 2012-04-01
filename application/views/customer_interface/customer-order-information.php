<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<?php $this->load->view('customer_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li>
						<?=anchor('customer/audience/orders','Мои заказы');?> <span class="divider">/</span>
					</li>
					<li class="active">
						<?=anchor($this->uri->uri_string(),'Заказ №'.$order['id']);?>
					</li>
				</ul>
				<div>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#documents" data-toggle="tab">Документы</a></li>
					<li><a href="#course" data-toggle="tab">Курсы</a></li>
					<li><a href="#audience" data-toggle="tab">Слушатели</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="documents">
						<h2>Заказ № <?=$order['id'];?> от <?=$order['orderddate'];?></h2>
						<div style="margin-top:15px;"></div>
						<ul class="thumbnails">
							<li class="span3">
								<div class="thumbnail">
									<img alt="" src="<?= base_url(); ?>img/doc-1.jpg">
									<hr />
									<div class="caption">
										<h5>Счет</h5>
										<p>Счет на оплату №<?=$order['id'];?> от <?=$order['orderdate'];?> года</p>
										<p><?=anchor($this->uri->uri_string().'/invoice-for-payment','Просмотр',array('class'=>'btn btn-primary','target'=>'_blank'));?></p>
									</div>
								</div>
							</li>
							<li class="span3">
								<div class="thumbnail">
									<img alt="" src="<?= base_url(); ?>img/doc-2.jpg">
									<hr />
									<div class="caption">
										<h5>Договор на оказание образовательных услуг</h5>
										<p>Договор №<?=$order['id'];?> об оказании образовательных услуг с применением дистанционных технологий.</p>
										<p><?=anchor($this->uri->uri_string().'/contract','Просмотр',array('class'=>'btn btn-primary','target'=>'_blank'));?></p>
									</div>
								</div>
							</li>
							<li class="span3">
								<div class="thumbnail">
									<img alt="" src="<?= base_url(); ?>img/doc-3.jpg">
									<hr />
									<div class="caption">
										<h5>Акт к договору на оказание услуг</h5>
										<p>Утвержденный акт об указании услуг в приложение к договору.</p>
										<p><?=anchor($this->uri->uri_string().'/act-to-contract','Просмотр',array('class'=>'btn btn-primary','target'=>'_blank'));?></p>
									</div>
								</div>
							</li>
						</ul>
						<p><strong>О документообороте</strong></p>
						<p>Нам потребуется два обязательных документа:Договор и Акт об оказании услуг. Договор Вы получили сразу после оформления заказа, Акт Вы получите после завершения обучения всеми слушателями в заказе. Для упрощения документооборота используйте следующую схему.</p>
						<p>Как только все слушатели в заказе завершат обучение, распечатайте Договор и Акт об оказании услуг в двух экземплярах. Подпишите, поставьте печати организации и отправьте оба оригинала в Центр обучения тому специалисту, который обслуживал Ваш заказ.</p>
					</div>
					<div class="tab-pane" id="course">
						<table class="table">
							<thead>
								<tr>
									<th>Заказанные курсы</th>
									<th>Количество</th>
									<th>Стоимость</th>
									<th>Сумма</th>
								</tr>
							</thead>
							<tbody>
							<?php $ccount = 0; $tsumm = 0;?>
							<?php for($i=0;$i<count($course);$i++):?>
								<tr>
									<td><strong><?=$course[$i]['code'];?></strong>. <?=$course[$i]['title'];?></td>
									<td><?=$course[$i]['caud'];?></td>
									<?php $ccount +=$course[$i]['caud'];?>
									<td><?=$course[$i]['price'];?>,00 руб.</td>
									<td><?=$course[$i]['tprice'];?>,00 руб.</td>
									<?php $tsumm +=$course[$i]['tprice'];?>
								</tr>
							<?php endfor;?>
							</tbody>
						</table>
						<hr/>
					<?php if($order['paid']):?>	
						<div class="span4"><span class="label label-success">Заказ оплачен <?=$order['paiddate'];?></span></div>
					<?php else:?>
						<div class="span4"><span class="label label-warning">Заказ еще не оплачен</span></div>
					<?php endif;?>
						<div class="span3" style="margin-left:200px;">
							<p>Количество заказанных курсов: <strong><?=$ccount;?></strong></p>
							<p>Сумма: <strong><?=$tsumm;?>,00 руб.</strong></p>
						</div>
					</div>
					<div class="tab-pane" id="audience">
					<?php for($i=0;$i<count($course);$i++):?>
						<strong><?=$course[$i]['code'];?></strong>. <?=$course[$i]['title'];?>
						<table class="table">
							<thead>
								<tr>
									<th>Слушатель</th>
									<th>Статус обучения</th>
									<th>Результат</th>
									<th>Дата окончания</th>
								</tr>
							</thead>
							<tbody>
							<?php for($j=0;$j<count($course[$i]['audience']);$j++):?>
								<tr>
									<td><?=$course[$i]['audience'][$j]['lastname'].' '.$course[$i]['audience'][$j]['name'].' '.$course[$i]['audience'][$j]['middlename'].' ('.$course[$i]['audience'][$j]['specialty'].')';?></td>
								<?php if($course[$i]['audience'][$j]['status']):?>
									<td class="short"><span class="label label-success">Завершено</span></td>
								<?php else:?>
									<td class="short"><span class="label label-important">Не завершено</span></td>
								<?php endif;?>
								<?php if($course[$i]['audience'][$j]['status']):?>
									<td class="short"><?=$course[$i]['audience'][$j]['result'];?></td>
								<?php else:?>
									<td class="short"><span class="label label-important">Не определено</span></td>
								<?php endif;?>
								<?php if($course[$i]['audience'][$j]['status']):?>
									<td class="short"><?=$course[$i]['audience'][$j]['dateover'];?></td>
								<?php else:?>
									<td class="short"><span class="label label-important">Не определено</span></td>
								<?php endif;?>
								</tr>
							<?php endfor;?>
							</tbody>
						</table>
					<?php endfor;?>
					</div>
				</div>
			</div>
		<?php $this->load->view('users_interface/rightbarcus');?>
		</div>
	</div>
	<? $this->load->view('users_interface/footer');?>
	<?php $this->load->view('customer_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tab").tab('show');
		});
	</script>
</body>
</html>
