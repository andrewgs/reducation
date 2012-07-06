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
						<?=anchor('admin-panel/users/audience','Слушатели');?>
					</li>
				</ul>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<table class="table table-striped table-bordered">
					<tbody>
					<?php for($i=0,$num=$this->uri->segment(5)+1;$i<count($audience);$i++):?>
						<tr>
							<td class="short"><?=$num;?></td>
							<td>
								<?php $fio = $audience[$i]['lastname'].' '.$audience[$i]['name'].' '.$audience[$i]['middlename'];?>
								<?=anchor('admin-panel/users/audience/info/id/'.$audience[$i]['id'],$fio);?><br/>
								<strong>Логин:</strong> <?=$audience[$i]['login'].' <strong>Пароль:</strong> '.$audience[$i]['cryptpassword'];?>
							</td>
							<td><?=$audience[$i]['organization'].'<br/>('.$audience[$i]['person'].')';?></td>
							<td><?=anchor('admin-panel/actions/send-user-email/audience/'.$audience[$i]['id'],'<i class="icon-envelope"></i>',array('class'=>'btn','title'=>'Выслать повторно регистрационные данные'));?></td>
						<?php if($audience[$i]['access']):?>
							<td class="short"><input type="checkbox" value="1" checked="checked" cus="<?=$audience[$i]['id'];?>" id="ch<?=$audience[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td class="short"><input type="checkbox" value="1" cus="<?=$audience[$i]['id'];?>" id="ch<?=$audience[$i]['id'];?>" class="chAccess"></td>
						<?php endif;?>
							<td class="short"><a class="close" data-toggle="modal" href="#deleteAudience" cus="<?=$audience[$i]['id'];?>">&times;</a></td>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
					</tbody>
				</table>
			<?php if($pages): ?>
				<?=$pages;?>
			<?php endif;?>
				<?php $this->load->view('admin_interface/modal/admin-delete-audience');?>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var Audience = 0;
			$(".none").click(function(event){event.preventDefault();});
			$(".close").click(function(){Audience = $(this).attr('cus');});
			$(".chAccess").click(function(){
				var check = 0;
				Audience = $(this).attr('cus');
				if($(this).attr("checked") == 'checked'){check = 1;};
				$.post('<?=$baseurl.$this->uri->uri_string();?>/set-audience-access',{'audience': Audience,'access':check});
			});
			$("#DelAudience").click(function(){location.href='<?=$baseurl.$this->uri->uri_string();?>/delete-audience/'+Audience;});
		});
	</script>
</body>
</html>
