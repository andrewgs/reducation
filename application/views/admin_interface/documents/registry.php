<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span16">
<pre style="position: relative;">					<strong>АНО ДПО «Южно-окружной центр повышения квалификации»</strong>
	
				 	 Сведения о слушателях и выданных удостоверениях
			  	за период с_________________2012 г. по_________________ 2012 г.
				
				
<table class="table table-striped table-bordered table-condensed">
	<tbody>
		<tr>
			<td colspan="9"></td>
			<td colspan="3" style="text-align:center;">Договор</td>
			<td colspan="3" style="text-align:center;">Удостоверения</td>
		</tr>
		<tr>
			<td>№</td>
			<td>Наименование организации, ННН, КПП, юрид. адрес</td>
			<td>Фамилия, Имя, Отчество</td>
			<td>Должность</td>
			<td>Наименование программы</td>
			<td>Объем учебного плана, час</td>
			<td>П/П ПКО</td>
			<td>ОПЛАТА Сумма</td>
			<td>Дата</td>
			<td>№</td>
			<td>Сумма</td>
			<td>Дата</td>
			<td>№</td>
			<td>Дата выдачи</td>
			<td>Роспись в получении</td>
		</tr>
	<?php for($i=0;$i<count($info);$i++):?>	
		<tr>
			<td><?=$i+1;?></td>
			<td><?=$info[$i]['organization'];?><br/><?=$info[$i]['inn'].'/'.$info[$i]['kpp'];?><br/><?=$info[$i]['uraddress'];?></td>
			<td><?=$info[$i]['lastname'].' '.$info[$i]['name'].' '.$info[$i]['middlename'];?></td>
			<td><?=$info[$i]['specialty'];?></td>
			<td><?=$info[$i]['ccode'].' '.$info[$i]['ctitle'];?></td>
			<td><?=$info[$i]['chours'];?></td>
			<td><?=$i+1;?></td>
			<td><nobr><?=$info[$i]['сprice'];?> руб.</nobr></td>
			<td><?=$info[$i]['paiddate'];?></td>
			<td><?=$info[$i]['order'];?></td>
			<td><nobr><?=$info[$i]['ordprice'];?> руб.</nobr></td>
			<td><?=$info[$i]['paiddate'];?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>

Заместитель директора 											Климова О.В.
	<div id="#pechat" style="position: absolute; bottom: -15px; left: 150px;">
		<img src="<?=base_url()?>img/pechat.png"/>
	</div>
</pre>
			</div>
		</div>
	</div>
</body>
</html>
