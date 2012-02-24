<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=$baseurl;?>js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script src="<?=$baseurl;?>js/bootstrap.js"></script>
<script type="text/javascript">
		<?php if($this->uri->segment(1)!=''):?>
			<?php $nav = $this->uri->segment(1);?>	
		<?php else:?>
			<?php $nav = 'main';?>
		<?php endif;?>
		$("li[nav='<?=$nav;?>']").addClass('active');
</script>