<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container" style="position: relative; ">
		<div class="row">
			<div class="span9">
			<pre>
					<strong>АКТ об оказании услуг</strong>
					
	г. Ростов-на-Дону						_<u><?=$order['orderdate'];?></u>_

Автономная некоммерческая организация дополнительного профессионального образования «Южно-окружной центр повышения квалификации и переподготовки кадров для строительства и жилищно-коммунального комплекса», именуемое в дальнейшем Учебный центр (лицензия №_<u>2248</u>_, выданная _<u>2 апреля 2012 г.</u>_, в лице Директора Климовой Ольги Владимировны, действующего на основании Устава, с одной стороны, и_<u><?=$customer['organization'];?></u>, в лице _<u><?=$customer['fiomanager'];?></u>_, действующего на основании _<u><?=$customer['statutory'];?></u>_ именуемое в дальнейшем «Заказчик», с другой стороны, в дальнейшем при совместном упоминании именуемые Стороны, составили настоящий Акт об оказании услуг о нижеследующем:
</pre>
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th>№ п/п</th>
						<th>Наименование оказанных услуг </th>
						<th>Кол-во</th>
						<th>Цена, руб. </th>
						<th>Стоимость </th>
					</tr>
				</thead>
				<tbody>
				<?php for($i=0;$i<count($course);$i++):?>
					<tr>
						<td><?=$i+1;?></td>
						<td>"Обучение по курсу <?=$course[$i]['code'];?>. <?=$course[$i]['title'];?>"</td>
						<td><?=$course[$i]['cnt'];?></td>
						<td><?=$course[$i]['price'];?></td>
 						<td><?=$course[$i]['price'];?></td>
					</tr>
				<?php endfor;?>
				</tbody>
			</table>
<pre>

1. Стоимость оказанных услуг составляет:
                                                                         <strong>Итого:     <u> <?=$order['price'];?> руб.	</u>
				    НДС: не облагается (ст. 149 п.2 пп14 НК РФ) 	
								Всего к оплате:     <u> <?=$order['price'];?> руб.	</u></strong>




Итого стоимость оказанных услуг : <u> <?=$order['price'];?> руб.	</u>
___________________________________________________________________________________________

2. Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и срокам оказания услуг не имеет.



					<strong>ПОДПИСИ СТОРОН:</strong>
</pre>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Исполнитель:</th>
			<th>Заказчик:</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>АНО ДПО «Южно-окружной центр повышения квалификации»</td>
			<td><?=$customer['organization'];?></td>
		</tr>
		<tr>
			<td>ИНН: 6162990031</td>
			<td>ИНН: <?=$customer['inn'];?></td>
		</tr>
		<tr>
			<td>КПП: 616201001</td>
			<td>КПП: <?=$customer['kpp'];?></td>
		</tr>
		<tr>
			<td>Юридический адрес:<br/>344001, г.Ростов-на-Дону, ул.Республиканская, 86</td>
			<td>Юридический адрес:<br/><?=$customer['postaddress'].', '.$customer['uraddress'];?></td>
		</tr>
		<tr>
			<td>e-mail: <?=mailto('roscentrdpo@roscentrdpo.ru');?></td>
			<td>e-mail: <?=mailto($customer['personemail']);?></td>
		</tr>
		<tr>
			<td>Банковские реквизиты:<br/>р/с 40703810600000001104, в банке ОАО КБ «Центр-Инвест» г.Ростов-на-Дону, БИК 046015762, к/с 30101810100000000762</td>
			<td>Банковские реквизиты:<br/>р/с <?=$customer['accountnumber'];?>, в банке <?=$customer['bank'];?>, БИК <?=$customer['bik'];?>, к/с <?=$customer['accountkornumber'];?></td>
		</tr>
	</tbody>
</table>
<pre>


	_________________/<u>   М.А.Евкин </u>               ________________/______________
				</pre>
			</div>
		</div>
		<div id="#pechat" style="position: absolute; bottom: -5px; left: 250px;">
			<img src="<?=base_url()?>img/pechat.png"/>
		</div>
	</div>
</body>
</html>
