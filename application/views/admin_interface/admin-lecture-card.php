<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin_interface/head');?>
<body>
	<?php $this->load->view('admin_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div>
					<ul class="breadcrumb">
						<li>
							<?=anchor('admin-panel/references/courses','Все направления');?> <span class="divider">/</span>
						</li>
						<li>
							<?=$trend;?> <span class="divider">/</span>
						</li>
						<li>
							<?=anchor('admin-panel/references/trend/'.$this->uri->segment(4).'/course/'.$this->uri->segment(6),$course);?> <span class="divider">/</span>
						</li>
						<li class="active">
							<?=anchor('admin-panel/references/trend/'.$this->uri->segment(4).'/course/'.$this->uri->segment(6).'/lecture/'.$this->uri->segment(8),$lecture['title']);?>
						</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
					<h3>Лекция: <?=$lecture['title'];?></h3>
					<div class="alert alert-success">
						<p><strong>Скачайте и прочтите лекцию.</strong> Лекция является самостоятельным модулем, включающим текст лекции, словарь терминов, справочник, активный список литературы и блок вопросов для самопроверки. Формат лекции - защищенный структурированный pdf-файл.</p>
					</div>
					<div>
						<p>Лекция: <?=$fileextension;?>, <?=$filesize;?></p>
						<a class="btn btn-info" data-toggle="modal" href="#getDocument" id="getDoc" doc="<?=$lecture['document'];?>"><i class="icon-download-alt icon-white"></i> Скачать лекцию</a>
					</div>
					<?php $this->load->view('admin_interface/modal/admin-get-document');?>
				</div>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#download").click(function(){window.open("<?=$baseurl.$document;?>")});
			$("#msgclose").click(function(){$("#msgalert").fadeOut(1000,function(){$(this).remove();});});
		});
	</script>
</body>
</html>
