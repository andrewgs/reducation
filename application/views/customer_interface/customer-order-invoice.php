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
				<pre><strong>Счет на оплату № ______  от ____________ 2012 г</strong>
_________________________________________________________________________________________________

Поставщик: 	<strong>АНО ДПО «Южно-окружной центр повышения квалификации», ИНН 6162990031,
	        КПП 616201001,344001, г.Ростов-на-Дону, ул.Республиканская, 86</strong>

Плательщик: 	</pre>
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
				<?php for($i=0;$i<5;$i++):?>
					<tr>
						<td><?=$i+1;?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				<?php endfor;?>
				</tbody>
			</table>
				<pre>
									 <strong>Итого: 	
				    НДС: не облагается (ст. 149 п.2 пп14 НК РФ) 	
								Всего к оплате: 	</strong>


Всего наименований                      , на сумму 

_________________________________________________________________________________________________


<strong>Директор</strong>	        ____________________________________________ М.А.Евкин 

<strong>Главный бухгалтер</strong>	____________________________________________




<strong>В платежном поручении в графе «назначение платежа» обязательно должно быть указано <i>«Оплата за Повышение квалификации по Договору №_______ по счету № ________ НДС не облагается»</i></strong>
				</pre>
			</div>
		</div>
		<div id="#pechat" style="position: absolute; bottom: 70px; left: 150px;">
			<img src="<?=base_url()?>img/pechat.png"/>
		</div>
	</div>
</body>
</html>
