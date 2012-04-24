<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<style type="text/css">
		body { padding: 20px 0 0; }
		@media print {
			body, p { font-family: Tahoma, sans-serif; font-size: 16px; line-height: 24px; margin-bottom: 14px; }
		}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
				<p class="center">
					<strong>Автономная некоммерческая организация дополнительного профессионального образования
					«Южно-окружной центр повышения квалификации и переподготовки кадров
			       	для строительного и жилищно-коммунального комплекса»</strong>
		       	</p>
				<p class="center">
					<strong>Ведомость итогового тестирования слушателей  по программам повышения квалификации</strong>
				</p>
				<div class="clearfix" style="margin-top: 20px;">
		  	  		<p class="pull-left">
						Срок обучения:  с  «____»  ________2012 г <br />
		  	  		</p>
		  	  		<p class="pull-right">
		  	  			по   «___» _________  2012 г.
		  	  		</p>
				</div>
				<p>
					Объем ____ час
				</p>
				<p>
					Комиссия:
				</p>
				<table class="table" style="margin-top: 20px;">
					<tbody>
						<tr>
							<td>Председатель комиссии</td>
							<td>Евкин Максим Александрович, директор АНО ДПО «Южно-окружной центр повышения квалификации»</td>
						</tr>
						<tr>
							<td>Заместитель председателя комиссии</td>
							<td>Климова Ольга Владимировна, заместитель директора по учебно-методической работе АНО ДПО «Южно-окружной центр повышения квалификации»</td>
						</tr>
						<tr>
							<td>Члены комиссии</td>
							<td>Чукланов Александр Юрьевич, преподаватель технических наук АНО ДПО «Южно-окружной центр повышения квалификации»</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>Панков Вячеслав Николаевич, заслуженный учитель Россиии, преподаватель технических наук  АНО ДПО «Южно-окружной центр повышения квалификации»</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>№ п/п</td>
							<td>Фамилия, имя, отчество</td>
							<td>Наименование программы</td>
							<td>Дата итогового тестирования</td>
							<td>%</td>
						</tr>
					<?php for($i=0;$i<count($courses);$i++):?>	
						<tr>
							<td><?=$i+1;?></td>
							<td><?=$courses[$i]['lastname'].' '.$courses[$i]['name'].' '.$courses[$i]['middlename'];?></td>
							<td><?=$courses[$i]['ccode'].' '.$courses[$i]['ctitle'];?></td>
							<td><?=$courses[$i]['dateover'];?></td>
							<td><?=$courses[$i]['result'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<table class="table" style="margin-top: 40px;">
					<tbody>
						<tr>
							<td>Председатель комиссии</td>
							<td>___________________________ Евкин М.А. <br /> (подпись)</td>
						</tr>
						<tr>
							<td>Заместитель председателя комиссии</td>
							<td>___________________________ Климова О.В. <br /> (подпись)</td>
						</tr>
						<tr>
							<td>Члены комиссии</td>
							<td>___________________________ Чукланов А.Ю. <br /> (подпись)</td>
						</tr>
						<tr>
							<td>Члены комиссии</td>
							<td>___________________________ Панков В.Н. <br /> (подпись)</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
