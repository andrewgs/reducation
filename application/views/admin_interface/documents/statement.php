<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
<pre>			      <strong>Автономная некоммерческая организация
			   дополнительного профессионального образования
		«Южно-окружной центр повышения квалификации и переподготовки кадров
		       для строительного и жилищно-коммунального комплекса»</strong>

					<b>Ведомость
		      итогового тестирования слушателей  по программам
				  повышения квалификации</b>

Срок обучения: с «____»  ________2012 г                    по   «___» _________  2012 г.
Объем ____ час
					Комиссия:
					
Председатель комиссии-			Климова Ольга Владимировна, заместитель директора 
					по учебно-методической работе АНО ДПО «Южно- 
					окружной центр повышения квалификации»

Заместитель председателя		Панков Вячеслав Николаевич, заслуженный учитель России,
комиссии-				преподаватель технических наук АНО ДПО
					«Южно-окружной центр повышения квалификации»

Члены комиссии-				Чукланов Александр Юрьевич, преподаватель 
					технических наук АНО ДПО «Южно-окружной центр повышения 
					квалификации» Евкин Александр Владимирович, 
					преподаватель технических наук АНО ДПО
					«Южно-окружной центр повышения квалификации»

<table class="table table-striped table-bordered table-condensed">
	<tbody>
		<tr>
			<td>№ п/п</td>
			<td>Фамилия, имя, отчество</td>
			<td>Наименование программы</td>
			<td>Дата итогового тестирования</td>
			<td>%</td>
		</tr>
	<?php for($i=0;$i<8;$i++):?>	
		<tr>
			<td><?=$i+1;?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>

Председатель комиссии-   			___________________________/Климова О.В./
			           			(подпись)
Заместитель председателя
комиссии -					___________________________/Панков В.Н./
							(подпись)

Члены комиссии -				___________________________/Чукланов А.Ю./
							(подпись)

						___________________________/Евкин А.В./
							(подпись)
</pre>
			</div>
		</div>
	</div>
</body>
</html>
