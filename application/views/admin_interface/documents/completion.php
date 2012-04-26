<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<style type="text/css">
		body { padding: 20px 0 0; }
		@media print {
			body, p { font-family: "Times New Roman", serif; font-size: 21px; line-height: 27px; margin-bottom: 18px; }
			.title_ { font-size: 28px; line-height: 34px; margin: 0 0 18px; }
			table td, table th { font-size: 20px; }
		}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
				<p class="center title_">
					<strong>
						Автономная некоммерческая организация <br />дополнительного профессионального образования<br /> 
						«Южно-окружной центр повышения квалификации и <br /> переподготовки кадров для строительного <br /> 
						и жилищно-коммунального комплекса»
					</strong>
				</p>
				<p class="center title title_">
					    ПРИКАЗ
				</p>
				<div class="clearfix" style="margin-top: 20px;">
		  	  		<p class="pull-left">
						«____» _________________ 201__ г.
		  	  		</p>
		  	  		<p class="pull-right">
		  	  			№_________________
		  	  		</p>
				</div>
				<p class="center">
             		г.Ростов-на-Дону
             	</p>
             	<p class="center" style="margin-top: 20px;">
                	<strong>Об окончании обучения слушателей и выдаче удостоверений</strong>
                </p>
				<p style="margin-top: 20px;">
					В связи с завершением обучения в АНО ДПО «Южно-окружной центр повышения квалификации» группы слушателей, 
					скомплектованной в АНО ДПО «Южно-окружной центр повышения квалификации»по программам повышения квалификации 
					по очно-заочной форме обучения с использованием дистанционных технологий объемом ___ часов в 
					период с «___»  ___________ по  «____» ____________ 201___ г.
				</p>
				<p class="center" style="margin: 20px 0;">
					ПРИКАЗЫВАЮ:
				</p>
				<p>
					Выдать удостоверения повышения квалификации  следующим слушателям:
				</p>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>№ п/п</td>
							<td><nobr>Фамилия, Имя, Отчество</nobr></td>
							<td>Наименование программы</td>
							<td>Рег. №</td>
						</tr>
					<?php for($i=0;$i<count($courses);$i++):?>	
						<tr>
							<td><?=$i+1;?></td>
							<td><?=$courses[$i]['fiodat'];?></td>
							<td><?=$courses[$i]['ccode'].' '.$courses[$i]['ctitle'];?></td>
							<td></td>
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
			</div>
		</div>
	</div>
</body>
</html>
