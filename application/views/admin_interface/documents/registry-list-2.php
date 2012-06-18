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
			body, p { font-family: "Times New Roman", serif; font-size: 14px; line-height: 21px; margin-bottom: 18px; }
			.title_ { font-size: 18px; line-height: 23px; margin: 0 0 18px; }
			table td, table th { font-size: 12px; }
			.page-break  { display: block; page-break-before: always;  }
			div.page { page-break-after: always; page-break-inside: avoid; }
		    table { page-break-inside: auto; }
		    tr    { page-break-inside: avoid; page-break-after: auto; }
		    thead { display: table-header-group; }
		    tfoot { display: table-footer-group; }			
		}
	</style>
	<div class="container-fluid" style="position: relative;">
		<div class="row">
			<div class="span12">
				<div class="page">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>№</td>
								<td>Фамилия</td>
								<td><nobr>Имя, Отчество</nobr></td>
								<td><nobr>По программе</nobr></td>
							</tr>
						<?php for($i=0;$i<count($info);$i++):?>	
							<tr>
								<td><?=$i+1;?></td>
								<?php $fio = preg_split("/[ ]+/",$info[$i]['fiodat']);?>
								<td><?php if(isset($fio[0])): echo $fio[0]; endif;?></td>
								<td><?php if(isset($fio[1])&&isset($fio[2])): echo $fio[1].' '.$fio[2]; endif;?></td>
								<td><?=$info[$i]['ccode'].' '.$info[$i]['ctitle'];?></td>
							</tr>
						<?php endfor;?>
						</tbody>
					</table>		
				</div>										
			</div>
		</div>
	</div>
</body>
</html>
