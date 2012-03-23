<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<table class="table table-striped table-bordered table-condensed">
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>БИК</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">Банк получателя </td>
							<td>Сч. №</td>
							<td></td>
						</tr>
						<tr>
							<td>ИНН</td>
							<td>КПП</td>
							<td>Сч. №</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">Получатель</td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
				<pre><strong>Счет на оплату №    от       2012 г</strong>
_________________________________________________________________________________________________

Поставщик: 	Автономная некоммерческая организация дополнительного профессионального 
	        образования «Южно-окружной центр повышения квалификации и переподготовки кадров
	        для строительства и жилищно-коммунального комплекса»
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
						<td>работа <?=$i;?></td>
						<td>количество <?=$i;?></td>
						<td>единица <?=$i;?></td>
						<td>Цена <?=$i;?></td>
						<td>Сумма <?=$i;?></td>
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


<strong>Директор</strong>	        ____________________________________________ 

<strong>Главный бухгалтер</strong>	____________________________________________
				</pre>
			</div>
		</div>
	</div>
</body>
</html>
