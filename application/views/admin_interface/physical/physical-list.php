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
						<?=anchor('admin-panel/users/physical','Заказчики (ФЛ)');?>
					</li>
				</ul>
				<div style="float:right; margin-top:-5px;">
				<?=form_open($this->uri->uri_string()); ?>
					<input type="hidden" id="srzakid" name="srzakid" value="">
					<input type="text" id="srzak" class="input-xlarge" name="srzak" value="" autocomplete="off">
					<div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="<?=$baseurl;?>/img/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
						<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
					</div>
					<button class="btn btn-success" type="submit" id="save" name="ssrzak" value="save" style="margin-top:-10px;"><i class="icon-search icon-white"></i> Найти</button>
				<?= form_close(); ?>
				</div>
				<div class="clear"></div>
				<?php $this->load->view('alert_messages/alert-error');?>
				<?php $this->load->view('alert_messages/alert-success');?>
				<table class="table table-striped table-bordered">
					<tbody>
					<?php for($i=0,$num=$this->uri->segment(5)+1;$i<count($customers);$i++):?>
						<tr>
							<td class="short"><?=$num;?></td>
							<td>
								<?=anchor('admin-panel/users/physical/info/id/'.$customers[$i]['id'],$customers[$i]['fio']);?><br/>
								№ тел.: <?=$customers[$i]['phones'];?>
							</td>
							<td>
								<?=$customers[$i]['email'];?><br/>
								<strong>Логин:</strong> <?=$customers[$i]['login'].' <strong>Пароль:</strong> '.$customers[$i]['cryptpassword'];?>
							</td>
							<td><?=anchor('admin-panel/actions/send-user-email/physical/'.$customers[$i]['id'],'<i class="icon-envelope"></i>',array('class'=>'btn','title'=>'Выслать повторно регистрационные данные'));?></td>
							<td><a href="#CoursesList" class="crsList" data-toggle="modal" data-cus="<?=$customers[$i]['id'];?>" title="Список заказов"><i class="icon-th-list"></i></a></td>
						<?php if($customers[$i]['access']):?>
							<td class="short"><input type="checkbox" value="1" checked="checked" data-cus="<?=$customers[$i]['id'];?>" id="ch<?=$customers[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td class="short"><input type="checkbox" value="1" data-cus="<?=$customers[$i]['id'];?>" id="ch<?=$customers[$i]['id'];?>" class="chAccess"></td>
						<?php endif;?>
							<td class="short"><a class="close" data-toggle="modal" href="#deleteCustomer" data-cus="<?=$customers[$i]['id'];?>">&times;</a></td>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
					</tbody>
				</table>
			<?php if($pages): ?>
				<?=$pages;?>
			<?php endif;?>
				<?php $this->load->view('admin_interface/modal/admin-delete-customer');?>
				<?php $this->load->view('admin_interface/modal/admin-courses-list');?>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var Customer = 0;
			$(".none").click(function(event){event.preventDefault();});
			$(".close").click(function(){Customer = $(this).attr('data-cus');});
			$(".chAccess").click(function(){
				var check = 0;
				Customer = $(this).attr('data-cus');
				if($(this).attr("checked") == 'checked'){check = 1;};
				$.post('<?=$baseurl.$this->uri->uri_string();?>/set-physical-access',{'customer': Customer,'access':check});
			});
			$("#DelCustomer").click(function(){location.href='<?=$baseurl.$this->uri->uri_string();?>/delete-physical/'+Customer;});
			
			$(".crsList").click(function(){
				Customer = $(this).attr('data-cus');
				$("#sourses-body").load('<?=$baseurl.$this->uri->uri_string();?>/load-courses',{'customer': Customer});
			});
			
			function suggest(inputString){
				if(inputString.length < 2){
					$("#suggestions").fadeOut();
				}else{
					$("#customer").addClass('load');
					$.post("<?=$baseurl;?>admin-panel/messages/search-customer",{squery: ""+inputString+""},
						function(data){
							if(data.status){
								$("#suggestions").fadeIn();
								$("#suggestionsList").html(data.retvalue);
								$(".custorg").live('click',function(){fill($(this).html(),$(this).attr("data-cusid"));});
							}else{
								$('#suggestions').fadeOut();
							};
							$("#customer").removeClass('load');
					},"json");
				}
			};
			
			function fill(cusname,cusid){
				$("#srzak").val(cusname);
				$("#srzakid").val(cusid);
				setTimeout("$('#suggestions').fadeOut();", 600);
			};
			
			$("#srzak").keyup(function(){suggest(this.value)});
			$("#srzak").focusout(function(){setTimeout("$('#suggestions').fadeOut();", 600);});
			
		});
	</script>
</body>
</html>
