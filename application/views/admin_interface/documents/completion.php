<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
<pre>				<strong>Автономная некоммерческая организация
			   дополнительного профессионального образования
		«Южно-окружной центр повышения квалификации и переподготовки кадров
			для строительного и жилищно-коммунального комплекса»</strong>

					    ПРИКАЗ
             
«____» _________________ 201__ г.	                            №_________________


					г.Ростов-на-Дону


                       <strong>Об окончании обучения слушателей и выдаче удостоверений</strong>

	В связи с завершением обучения в АНО ДПО «Южно-окружной центр повышения квалификации» группы слушателей, скомплектованной в АНО ДПО «Южно-окружной центр повышения квалификации»по программам повышения квалификации по очно-заочной форме обучения с использованием дистанционных технологий объемом <u> 72 </u> часов в период с «___»  ___________ по  «____» ____________ 201___ г.


ПРИКАЗЫВАЮ:

Выдать удостоверения повышения квалификации  следующим слушателям:

<table class="table table-striped table-bordered table-condensed">
	<tbody>
		<tr>
			<td>№ п/п</td>
			<td>Фамилия, имя, отчество</td>
			<td>Наименование программы</td>
			<td>Рег. №</td>
		</tr>
	<?php for($i=0;$i<8;$i++):?>	
		<tr>
			<td><?=$i+1;?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>

Директор 								М.А.Евкин

</pre>
			</div>
		</div>
	</div>
</body>
</html>
