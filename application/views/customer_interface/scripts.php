<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=$baseurl;?>js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script src="<?=$baseurl;?>js/bootstrap.js"></script>
<script type="text/javascript">
	$("li[num='<?=$this->uri->segment(3);?>']").addClass('active');
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgiclose").click(function(){$("#msgialert").fadeOut(1000,function(){$(this).remove();});});
</script>