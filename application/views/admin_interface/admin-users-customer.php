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
						<?=anchor('admin-panel/users/customer','Заказчики');?>
					</li>
				</ul>
				<table class="table table-striped table-bordered">
					<tbody>
					<?php for($i=0,$num=1;$i<count($customers);$i++):?>
						<tr>
							<td class="short"><a title="Название" class="none"><?=$num;?></a></td>
							<td><a href="" title="Название" class="none"><?=$customers[$i]['organization'];?></a></td>
							<td><a href="" title="Представитель" class="none"><?=$customers[$i]['person'].' ('.$customers[$i]['personemail'].')';?></a></td>
						<?php if($customers[$i]['access']):?>
							<td class="short"><input type="checkbox" value="1" checked="checked" cus="<?=$customers[$i]['id'];?>" id="ch<?=$customers[$i]['id'];?>" class="chAccess"></td>
						<?php else:?>
							<td class="short"><input type="checkbox" value="1" cus="<?=$customers[$i]['id'];?>" id="ch<?=$customers[$i]['id'];?>" class="chAccess"></td>
						<?php endif;?>
							<td class="short"><a class="close" data-toggle="modal" href="#deleteCustomer" cus="<?=$customers[$i]['id'];?>">&times;</a></td>
						</tr>
						<?php $num++;?>
					<?php endfor;?>
					</tbody>
				</table>
				<?php $this->load->view('admin_interface/modal/admin-delete-customer');?>
			</div>
			<?php $this->load->view('admin_interface/rightbarmsg');?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var Customer = 0;
			$(".none").click(function(event){event.preventDefault();});
			$(".close").click(function(){Customer = $(this).attr('cus');});
			$(".chAccess").click(function(){
				var check = 0;
				Customer = $(this).attr('cus');
				if($(this).attr("checked") == 'checked'){check = 1;};
				$.post('<?=$baseurl.$this->uri->uri_string();?>/set-customer-access',{'customer': Customer,'access':check});
			});
			$("#DelCustomer").click(function(){location.href='<?=$baseurl.$this->uri->uri_string();?>/delete-customer/'+Customer;});
		});
	</script>
</body>
</html>
