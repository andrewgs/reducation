<?php if($msgs):?>
	<div class="alert alert-success" id="msgalert">
		<a class="close" id="msgclose">×</a>
		<h4 class="alert-heading">Успешно!</h4>
		<?=$msgs;?>
	</div>
<?php endif; ?>