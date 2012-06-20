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
							<td class="short" style="width: 5px;">1</td>
							<td style="width:160px;"><i>Загрузить список каталогов курсов</i></td>
							<td>
							<?=form_open_multipart($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
								<input type="file" id="DocumentFile" class="input-file linput" name="document" size="64"><br/>
								<div style="float:left; margin-top:10px;">
									<strong><em>Новый документ заменит старый</em></strong><br/>
									<i><u>Документ должен быть книгой MS Excel 2003</u></i>
								</div>
								<div style="float:right; margin-top:10px;">
									<button class="btn btn-success" type="submit" id="catkurs" name="catkurs" value="catkurs">Загрузить</button>
								</div>
							<?= form_close(); ?>
							</td>
							<tr>
							<td class="short">2</td>
							<td><i>Список праздничных дней в году</i></td>
							<td>
								<div style="float:right; margin-top:10px;">
									<button class="btn btn-success" data-toggle="modal" href="#addDate">Добавить дату</button>
									<button class="btn btn-info" id="calshow">Показать/Скрыть</button>
								</div>
								<div id="caltablist" style="display: none; margin-top: 45px;">
									<table class="table table-striped table-bordered">
										<tbody>
										<?php for($i=0;$i<count($seldate);$i+=3):?>
											<tr>
												<td><?=$seldate[$i]['date'];?></td>
												<td class="short">
													<a class="close" data-toggle="modal" href="#deleteDate" data-iddate="<?=$seldate[$i]['id'];?>">&times;</a>
												</td>
											<?php if(isset($seldate[$i+1]['id'])):?>
												<td><?=$seldate[$i+1]['date'];?></td>
												<td class="short">
													<a class="close" data-toggle="modal" href="#deleteDate" data-iddate="<?=$seldate[$i+1]['id'];?>">&times;</a>
												</td>
											<?php else:?>
												<td>&nbsp;</td>
												<td class="short">&nbsp;</td>
											<?php endif;?>
											<?php if(isset($seldate[$i+2]['id'])):?>
												<td><?=$seldate[$i+2]['date'];?></td>
												<td class="short">
													<a class="close" data-toggle="modal" href="#deleteDate" data-iddate="<?=$seldate[$i+2]['id'];?>">&times;</a>
												</td>
											<?php else:?>
												<td>&nbsp;</td>
												<td class="short">&nbsp;</td>
											<?php endif;?>
											</tr>
										<?php endfor;?>	
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php $this->load->view('admin_interface/modal/admin-add-date');?>
				<?php $this->load->view('admin_interface/modal/admin-delete-date');?>
			</div>
		<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<?=$this->load->view('admin_interface/datepacker');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var dateID = 0;
			$("#calshow").click(function(){$("#caltablist").fadeToggle('slow');});
			$(".close").click(function(){dateID = $(this).attr('data-iddate');});
			$("#DelDate").click(function(){location.href='<?=$baseurl;?>admin-panel/actions/control/delete-date/'+dateID;});
			$("#AddDateCancel").click(function(){$("#dateval").val('');});
			$("#addDate").on("hidden",function(){$("#msgalert").remove();$(".control-group").removeClass('error');$(".help-inline").hide();$(".input-small").val('');});
			$("#dasend").click(function(event){
				var err = false;
				$(".control-group").removeClass('error');
				$(".help-inline").hide();
				$(".dainput").each(function(i,element){
					if($(this).val()==''){
						$(this).parents(".control-group").addClass('error');
						$(this).siblings(".help-inline").html("Поле не может быть пустым").show();
						err = true;
					}
				});
				if(err){event.preventDefault();}
			});
		});
	</script>
</body>
</html>
