<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<div class="container">
		<div class="row">
			<div class="span9">
				<pre>
<b>Организатор тестирования (физическое/юридическое лицо): </b><br/><u>АНО ДПО "Южно-окружной центр повышения квалификации"</u>

<b>Дата тестирования: </b><?=$info['dateover'];?>

<b>Ф.И.О.: </b><u><?=$info['lastname'].' '.$info['name'].' '.$info['middlename'];?></u>
<b>Занимаемая должность: </b><?=$info['position'];?>

<b>Место работы (наименование организации): </b><?=$info['organization'];?>

<b>Email: </b><a href="mailto:<?=$info['personaemail'];?>" target="_blank"><?=$info['personaemail'];?></a>
<b>Наименование программы: </b><?=$info['ccode'].' '.$info['ctitle'];?>

<b>Наименование теста: </b><?=$info['ttitle'];?>

<b>Результат итогового тестирования: </b><?=$info['result'];?>%
				</pre>
			</div>
		</div>
	</div>
</body>
</html>