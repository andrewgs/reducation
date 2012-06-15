<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=$baseurl;?>js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script src="<?=$baseurl;?>js/bootstrap.js"></script>
<script type="text/javascript">
	$("#msgeclose").click(function(){$("#msgdealert").fadeOut(1000,function(){$(this).remove();});});
	$("#msgsclose").click(function(){$("#msgdsalert").fadeOut(1000,function(){$(this).remove();});});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#lsend").click(function(event){var err = false;$(".help-inline").hide();$("#top-restore").hide();$(".focused").each(function(i, element){if($(this).val() == ''){$(this).siblings(".help-inline").html('<i class="icon-exclamation-sign" title="Поле не может быть пустым"></i>').show();$("#top-restore").show();err = true;}});if(err){event.preventDefault();};});
	});
</script>