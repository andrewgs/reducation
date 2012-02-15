<header>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="nav nav-tabs">
					<li class="active"><?=anchor('#','Главная');?></li>
					<li><?=anchor('#','Каталог курсов');?></li>
					<li><?=anchor('#','Контакты');?></li>
				</ul>
			</div>
		<?php if($loginstatus['status']):?>
			<div class="span3">
				<p class="navbar-text pull-right">Вы вошли как <?=anchor('#',$userinfo['ulogin']);?></p>
			</div>
		<?php endif;?>
		</div>
	</div>
</header>