<?php if(!count($orders)):?>
	<span class="label label-info">Заказчик не делал заказов</span>
<?php else:?>
	<table class="table table-striped table-bordered">
		<tbody>
		<?php for($i=0,$num=1;$i<count($orders);$i++,$num++):?>
			<tr>
				<td><?=$num;?></td>
				<td>Заказ №<?=$orders[$i]['id'];?></td>
				<td>Дата заказа: <?=$orders[$i]['orderdate'];?></td>
			<?php if($orders[$i]['paid']):?>
				<td><span class="label label-success"><?=$orders[$i]['paiddate'];?></span></td>
			<?php else:?>
				<td><span class="label label-warning">Не оплачен</span></td>
			<?php endif;?>
			</tr>
		<?php endfor;?>
		</tbody>
	</table>
<?php endif;?>