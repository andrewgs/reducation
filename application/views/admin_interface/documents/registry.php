<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<style type="text/css">
		body { padding: 20px 0 0; }
		@media all {
  			.page-break  { display:none; }
		}
		@media print {
			body, p { font-family: "Times New Roman", serif; font-size: 21px; line-height: 27px; margin-bottom: 18px; }
			.title_ { font-size: 24px; line-height: 28px; margin: 0 0 18px; }
			table td, table th { font-size: 14px; }
			.page-break  { display:block; page-break-before:always; }
		}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
				<p class="center title_">
					<strong>
						Автономная некоммерческая организация дополнительного профессионального образования 
						«<nobr>Южно-окружной центр</nobr> повышения квалификации и переподготовки кадров для строительного 
						и <nobr>жилищно-коммунального</nobr> комплекса»
					</strong>
				</p>
				<p class="center">
					    Сведения о слушателях и выданных удостоверениях <br />
						за период c «__» ___________ 201_ г. по «__» ___________ 201_ г.
				</p>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="9"></td>
							<td colspan="3" style="text-align:center;">Договор</td>
							<td colspan="3" style="text-align:center;">Удостоверения</td>
						</tr>
						<tr>
							<td>№</td>
							<td><nobr>Наименование организации,</nobr><br/><nobr>ННН, КПП, юрид. адрес</nobr></td>
							<td>Фамилия, Имя, Отчество</td>
							<td>Должность</td>
							<td>Наименование программы</td>
							<td>Объем учебного плана, час</td>
							<td>№ п/п</td>
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
							<td><?=$info[$i]['position'];?></td>
							<td><?=$info[$i]['ccode'].' '.$info[$i]['ctitle'];?></td>
							<td><?=$info[$i]['chours'];?></td>
							<!--<td><?=$i+1;?></td>-->
							<?php if(!empty($info[$i]['docnumber'])):?>
								<td><?=$info[$i]['docnumber'];?></td>
							<?php else:?>
								<td><input type="text" value="<?=$info[$i]['docnumber'];?>" class="inv"></td>	
							<?endif;?>
							<td><nobr><?=$info[$i]['сprice']-$info[$i]['discount'];?> руб.</nobr></td>
							<td><?=$info[$i]['paiddate'];?></td>
							<td><?=$info[$i]['order'];?></td>
							<!--<td><nobr><?=$info[$i]['ordprice'];?> руб.</nobr></td>-->
							<td><nobr><?=$info[$i]['сprice']-$info[$i]['discount'];?> руб.</nobr></td>
							<td><?=$info[$i]['paiddate'];?></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<table class="table no-border">
					<tbody>
						<tr>
							<td>Директор</td>
							<td>М.А.Евкин</td>
						</tr>
					</tbody>
				</table>
				<div class="page-break"></div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>№</td>
							<td><nobr>Фамилия, Имя, Отчество</nobr></td>
							<td><nobr>Дата с</nobr></td>
							<td><nobr>Месяц с</nobr></td>
							<td><nobr>Год с</nobr></td>
							<td><nobr>Дата по</nobr></td>
							<td><nobr>Месяц по</nobr></td>
							<td><nobr>Год по</nobr></td>
							<td><nobr>По программе</nobr></td>
						</tr>
					<?php for($i=0;$i<count($info);$i++):?>	
						<tr>
							<td><?=$i+1;?></td>
							<td><nobr><?=$info[$i]['fiodat'];?></nobr></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
							<td><input type="text" value="" class="inv"></td>
							<td><?=$info[$i]['ccode'].' '.$info[$i]['ctitle'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>												
			</div>
		</div>
	</div>
</body>
</html>
