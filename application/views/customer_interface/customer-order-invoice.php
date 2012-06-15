<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<style type="text/css">
		@media print {
			body, p { font-family: Tahoma, sans-serif; font-size: 16px; line-height: 24px; margin-bottom: 14px; }
		}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="2">ОАО КБ «Центр-Инвест» г.Ростов-на-Дону</td>
							<td>БИК</td>
							<td>046015762</td>
						</tr>
						<tr>
							<td colspan="2">Банк получателя </td>
							<td>Сч. №</td>
							<td>30101810100000000762</td>
						</tr>
						<tr>
							<td>ИНН 6162990031</td>
							<td>КПП 616201001</td>
							<td>Сч. №</td>
							<td>40703810600000001104</td>
						</tr>
						<tr>
							<td colspan="2">АНО ДПО «Южно-окружной центр повышения квалификации»<br/><br/>Получатель</td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
				<p>
					<h3 class="inline">Счет на оплату </h3> <strong>№ <?=$order['id'];?> от <?=$order['orderdate'];?> </strong>
				</p>
				<p>
					Поставщик: 	<strong>АНО ДПО «Южно-окружной центр повышения квалификации» </strong>
				</p>
				<p> 
					344001, г.Ростов-на-Дону, ул.Республиканская, 86, ИНН 6162990031, КПП 616201001 
		        </p>
		        <p>
					Плательщик: <strong><?=$customer['organization'];?></strong>
				</p>
				<?php $summ = 0;?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>№</th>
							<th>Товары (работы, услуги)</th>
							<th>Количество</th>
							<th>Ед.</th>
							<th>Цена</th>
							<th>Сумма</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($course);$i++):?>
						<tr>
							<td><?=$i+1;?></td>
							<td>"Обучение по курсу <?=$course[$i]['code'];?>. <?=$course[$i]['title'];?>"</td>
							<td><?=$course[$i]['cnt'];?></td>
							<td>чел.</td>
							<td><?=$course[$i]['price']-$course[$i]['discount'];?></td>
							<td><?=($course[$i]['cnt']*($course[$i]['price']-$course[$i]['discount']));?></td>
							<?php $summ+=($course[$i]['cnt']*($course[$i]['price']-$course[$i]['discount']))?>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<p>
					Всего наименований  <strong><?=count($course);?> </strong>,   на сумму <strong> <?=$summ;?> руб. </strong>
				</p>
				<p class="align-right">
					<strong><nobr>Итого:     <u> <?=$summ;?> руб.	</u></nobr> <br />
				    <nobr>НДС: не облагается (ст. 149 п.2 пп14 НК РФ)</nobr> <br />
					<nobr>Всего к оплате:     <u> <?=$summ;?> руб. </u></nobr></strong>
				</p>
				<p>
					<table class="table no-border">
						<tbody>
							<tr>
								<td>Заместитель директора</td>
								<td>Климова О.В.</td>
							</tr>
							<tr>
								<td>Главный бухгалтер</td>
								<td>Петрищева Л.В.</td>
							</tr>
						</tbody>
					</table>
				</p>
				<p style="margin: 80px 0 0;">
					<strong>В платежном поручении в графе «назначение платежа» обязательно должно быть указано <i>«Оплата за Повышение квалификации по Договору №<?=$order['id'];?> от <?=$order['orderdate'];?> по счету № <?=$order['id'];?> от <?=$order['orderdate'];?> НДС не облагается»</i></strong>
				</p>
				<div id="#buhgl" style="position: absolute; bottom: 100px; left: 220px;">
					<img src="<?=base_url()?>img/buhgl.png"/>
				</div>
				<div id="#klimova" style="position: absolute; bottom: 144px; left: 220px;">
					<img src="<?=base_url()?>img/klimova.png"/>
				</div>				
			</div>
		</div>
		<div id="#pechat" style="position: absolute; bottom: 70px; left: 270px;">
			<img src="<?=base_url()?>img/pechat.png"/>
		</div>
	</div>
</body>
</html>
