<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<style type="text/css">
		@media print {body, p { font-family: Tahoma, sans-serif; font-size: 16px; line-height: 24px; margin-bottom: 14px; }}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
           		<p><strong>Организатор тестирования (физическое/юридическое лицо):<br/><u>АНО ДПО "Южно-окружной центр повышения квалификации"</u></strong></p>
				<table class="table">
					<tbody>
						<tr>
							<td>Дата тестирования:</td>
							<td><?=$info['dateover'];?></td>
						</tr>
						<tr>
							<td>Ф.И.О.:</td>
							<td><?=$info['fio'];?></td>
						</tr>
						<tr>
							<td>Email: </td>
							<td><a href="mailto:<?=$info['email'];?>" target="_blank"><?=$info['email'];?></a></td>
						</tr>
						<tr>
							<td>Наименование программы:</td>
							<td><?=$info['ccode'].' '.$info['ctitle'];?></td>
						</tr>
						<tr>
							<td>Результат итогового тестирования: </td>
							<td><?=$info['result'];?>%</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
