<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span16">
					<pre style="position: relative;">					
										<strong>АНО ДПО «Южно-окружной центр повышения квалификации»</strong>
						
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
			<td><nobr>Наименование организации,</nobr><br/><nobr>ННН, КПП, юрид. адрес</nobr></td>
			<td><nobr>Фамилия, Имя, Отчество</nobr></td>
			<td>Должность</td>
			<td>Наименование программы</td>
			<td><nobr>Объем учебного</nobr><br/><nobr>плана, час</nobr></td>
			<td>П/П ПКО</td>
			<td>ОПЛАТА Сумма</td>
			<td>Дата</td>
			<td>&nbsp;№&nbsp;</td>
			<td>Сумма</td>
			<td>Дата</td>
			<td>&nbsp;№&nbsp;</td>
			<td><nobr>Дата выдачи</nobr></td>
			<td><nobr>Роспись в получении</nobr></td>
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

												Директор 	________________________/__<u>Евкин М.А.</u>__
												
												
<table class="table table-striped table-bordered table-condensed">
	<tbody>
		<tr>
			<td>№</td>
			<td><nobr>Фамилия</nobr></td>
			<td><nobr>Имя, Отчество</nobr></td>
			<td>Дата с</td>
			<td>Месяц с</td>
			<td>Год с</td>
			<td>Дата по</td>
			<td>Месяц по</td>
			<td>Год по</td>
			<td>По программе</td>
		</tr>
	<?php for($i=0;$i<count($info);$i++):?>	
		<tr>
			<td><?=$i+1;?></td>
			<td><?=$info[$i]['lastname'];?></td>
			<td><?=$info[$i]['name'].' '.$info[$i]['middlename'];?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?=$info[$i]['ccode'].' '.$info[$i]['ctitle'];?></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>												
												
</pre>
			</div>
		</div>
	</div>
</body>
</html>
