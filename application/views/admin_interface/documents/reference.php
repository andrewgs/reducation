<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('customer_interface/head');?>
<body>
	<style type="text/css">
		body { padding: 20px 0 0; }
		@media print {
			body, p { font-family: "Times New Roman", serif; font-size: 21px; line-height: 27px; margin-bottom: 18px; }
			.title_ { font-size: 28px; line-height: 34px; margin: 0 0 18px; }
			.title__ { font-size: 24px; line-height: 30px; margin: 8px 0 40px; }
			table td, table th { font-size: 20px; line-height: 26px; }
		}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
				<p class="center title_">
					<img src="<?=$baseurl;?>img/logo.jpg" alt="" width="400" height="129"/>
				</p>
				<p class="center title_">
					<strong>
						Автономная некоммерческая организация <br />дополнительного профессионального образования<br /> 
						«Южно-окружной центр повышения квалификации и <br /> переподготовки кадров для строительного <br /> 
						и жилищно-коммунального комплекса»<br/>
						г. Ростов-на-Дону,  ул.Республиканская, 86
					</strong>
				</p>
				<div class="clearfix" style="margin-top: 20px;">
		  	  		<p class="pull-left">
						« <u>&nbsp;<?=$datebegin['0']?>&nbsp;</u> »  <u>&nbsp;&nbsp;&nbsp;&nbsp;<?=$datebegin['1']?>&nbsp;&nbsp;&nbsp;&nbsp;</u> <?=$datebegin['2']?> г. <br />
		  	  		</p>
		  	  		<p class="pull-right">
		  	  			№ <u>&nbsp;&nbsp;&nbsp;&nbsp;<?=$this->uri->segment(5);?>&nbsp;&nbsp;&nbsp;&nbsp;</u>
		  	  		</p>
				</div>
				<p class="center title_">
					<strong>С П Р А В К А</strong>
				</p>
				<p style="margin-top: 20px;">
					Дана <?=$customer['organization'];?> в том, что нижеперечисленные сотрудники зачислены на обучение в АНО ДПО «Южно-окружной центр повышения квалификации» с <?=$datebegin['0'].' '.$datebegin['1'].' '.$datebegin['2'];?> г. по программам повышения квалификации по очно-заочной форме обучения с использованием дистанционных технологий в следующем составе:
				</p>
				<ol>
				<?php for($i=0;$i<count($courses);$i++):?>
					<li><?=$courses[$i]['lastname'].' '.$courses[$i]['name'].' '.$courses[$i]['middlename'];?> - по курсу: <?=$courses[$i]['ctitle'];?></li>
				<?php endfor;?>
				</ol>
				<p class="center">
					Справка дана по месту требования.
				</p>
				<table class="table no-border">
					<tbody>
						<tr>
							<td>Заместитель директора</td>
							<td>О.В. Климова.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
