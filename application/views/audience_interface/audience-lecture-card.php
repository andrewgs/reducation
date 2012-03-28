<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('audience_interface/head');?>
<body>
	<?php $this->load->view('audience_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<div>
					<ul class="breadcrumb">
						<li>
						<?=anchor('audience/courses/current','Мои текущие курсы');?> <span class="divider">/</span>
					</li>
					<li>
						<?=anchor('audience/courses/current/course/'.$this->uri->segment(5).'/lectures',$course['code'].'. '.$course['title']);?> <span class="divider">/</span>
					</li>
					<li class="active">
						<?=anchor($this->uri->uri_string(),$lecture['title']);?>
					</li>
					</ul>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
					<h3><?=$lecture['title'];?></h3>
<pre><strong>Скачайте и прочтите лекцию.</strong>

Лекция является самостоятельным модулем, включающим текст лекции, словарь терминов, справочник, активный список литературы и блок вопросов для самопроверки. Формат лекции - защищенный структурированный pdf-файл.

</pre>
					<div>
						<p><?=$fileextension;?>, <?=$filesize;?></p>
						<a class="btn btn-info" data-toggle="modal" href="#getDocument" id="getDoc" lec="<?=$lecture['id'];?>"><i class="icon-download-alt icon-white"></i> Скачать лекцию</a>
					</div>
					<?php $this->load->view('users_interface/modal/user-get-document');?>
				</div>
			</div>
			<?php $this->load->view('users_interface/rightbaraud');?>
		</div>
	</div>
	<?php $this->load->view('audience_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#download").click(function(event){
				window.open("<?=$baseurl.$this->uri->uri_string();?>/get-document");
				event.preventDefault();
			});
		});
	</script>
</body>
</html>
