<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container" style="position: relative;">
		<div class="row">
			<div class="span9">
				<table class="table table-striped table-bordered table-condensed">
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
				<pre><strong>Счет на оплату № _<u><?=$order['id'];?></u>_  от _<u><?=$order['orderdate'];?></u>_</strong>
_________________________________________________________________________________________________

Поставщик: 	<strong>АНО ДПО «Южно-окружной центр повышения квалификации», ИНН 6162990031,
	        КПП 616201001,344001, г.Ростов-на-Дону, ул.Республиканская, 86</strong>

Плательщик: 	<strong><?=$customer['organization'];?></strong>
</pre>
			<table class="table table-striped table-bordered table-condensed">
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
						<td><?=$course[$i]['price'];?></td>
						<td><?=($course[$i]['cnt']*$course[$i]['price']);?></td>
					</tr>
				<?php endfor;?>
				</tbody>
			</table>
				<pre>
									 <strong><nobr>Итого:     <u> <?=$order['price'];?> руб.	</u></nobr>
				    <nobr>НДС: не облагается (ст. 149 п.2 пп14 НК РФ) 	</nobr>
								<nobr>Всего к оплате:     <u> <?=$order['price'];?> руб. </u></nobr></strong>


Всего наименований  <strong><u> <?=count($course);?> </u></strong>,   на сумму <strong><u> <?=$order['price'];?> руб. </u></strong>

_________________________________________________________________________________________________


<strong>Заместитель директора</strong>	        ____________________________________________ Климова О.В. 

<strong>Главный бухгалтер</strong>		   _________________________________________ Петрищева Л.В.




<strong>В платежном поручении в графе «назначение платежа» обязательно должно быть указано <i>«Оплата за Повышение квалификации по Договору №<?=$order['id'];?> от <?=$order['orderdate'];?> по счету № <?=$order['id'];?> от <?=$order['orderdate'];?> НДС не облагается»</i></strong>
	<div id="#klimova" style="position: absolute; bottom: 200px; left: 220px;">
		<img src="<?=base_url()?>img/klimova.png"/>
	</div>
	<div id="#buhgl" style="position: absolute; bottom: 140px; left: 220px;">
		<img src="<?=base_url()?>img/buhgl.png"/>
	</div>
				</pre>
			</div>
		</div>
		<div id="#pechat" style="position: absolute; bottom: 120px; left: 150px;">
			<img src="<?=base_url()?>img/pechat.png"/>
		</div>
	</div>
</body>
</html>
