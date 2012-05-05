<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<style type="text/css">
		@media print {
			body, p { font-family: Tahoma, sans-serif; font-size: 16px; line-height: 24px; margin-bottom: 14px; }
		}
	</style>
	<div class="container-fluid" style="position: relative; ">
		<div class="row">
			<div class="span12">
				<p class="center title">
           			<strong>Акт об оказании услуг</strong>
           		</p>
           		<div class="clearfix">
		  	  		<p class="pull-left">
						г. Ростов-на-Дону
		  	  		</p>
		  	  		<p class="pull-right">
		  	  			«____» _________________ <?=date("Y");?> года
		  	  		</p>
	  	  		</div>
				<p>
			      Автономная некоммерческая организация дополнительного профессионального образования 
			      «Южно-окружной центр повышения квалификации и переподготовки кадров для строительства 
			      и жилищно-коммунального комплекса» (лицензия Региональной службы по надзору и контролю 
			      в сфере образования Ростовской области №2248 от 2 апреля 2012 года) именуемая в 
			      дальнейшем «Исполнитель» в лице заместителя директора Климовой Ольги Владимировны, 
			      действующей на основании доверенности (№1 от 10.04.2012 г.), с одной стороны, и 
			      <?=$customer['organization'];?>, в лице <?=$customer['manager'];?> <?=$customer['fiomanager'];?>, действующего на 
			      основании <?=$customer['statutory'];?> именуемое в дальнейшем «Заказчик», с другой 
			      стороны, в дальнейшем при совместном упоминании именуемые Стороны, составили настоящий 
			      Акт об оказании услуг о нижеследующем:
			    </p>
				<?php $summ = 0;?>
				<table class="table table-bordered">
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
							<td>Повышение квалификации по Договору №<?=$order['id'];?><br/>"<?=$course[$i]['code'];?>. <?=$course[$i]['title'];?>"</td>
							<td><?=$course[$i]['cnt'];?></td>
							<td><?=$course[$i]['price']-$course[$i]['discount'];?></td>
	 						<td><?=($course[$i]['cnt']*($course[$i]['price']-$course[$i]['discount']));?></td>
							<?php $summ+=($course[$i]['cnt']*($course[$i]['price']-$course[$i]['discount']))?>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<p class="align-right">
					<strong>
                        Итого: <?=$summ;?> руб. <br />
			    		НДС: не облагается (ст. 149 п.2 пп14 НК РФ) <br /> 	
						Всего к оплате: <?=$summ;?> руб.
					</strong>
				</p>
				<p>
					1. Стоимость оказанных услуг составляет <?=$order['price'];?> руб. <br />
					2. Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и срокам оказания услуг не имеет.
				</p>
				<table class="table">
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
							<td>Юридический адрес:<br/><?=$customer['uraddress'];?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>Почтовый адрес:<br/><?=$customer['postaddress'];?></td>
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
				<p>
					<table class="table no-border">
						<tbody>
							<tr>
								<td>Заместитель директора</td>
								<td>Климова О.В.</td>
							</tr>
						</tbody>
					</table>
				</p>
			</div>
		</div>
	</div>
</body>
</html>
