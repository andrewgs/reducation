<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="breadcrumb">
					<li class="active">
						<?=anchor('admin-panel/actions/control','Панель управления');?>
					</li>
				</ul>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>
							<td class="short">1</td>
							<td><i>Загрузить список каталогов курсов</i></td>
							<td>
							<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
								<input type="file" id="DocumentFile" class="input-file linput" name="document" size="50"><br/>
								<div style="float:left; margin-top:10px;">
									<strong><em>Новый документ заменит старый</em></strong><br/>
									<i><u>Документ должен быть книгой MS Excel 2003</u></i>
								</div>
								<div style="float:right; margin-top:10px;">
									<button class="btn btn-success" type="submit" id="catkurs" name="catkurs" value="catkurs">Загрузить</button>
								</div>
							<?= form_close(); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
</body>
</html>
