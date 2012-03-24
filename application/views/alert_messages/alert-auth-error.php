<?php if($msgauth):?>
	<div class="alert alert-error" id="msgdealert">
		<a class="close" id="msgeclose">×</a>
		<h4 class="alert-heading">Внимание!</h4>
		<?=$msgauth;?>
	</div>
<?php endif; ?>