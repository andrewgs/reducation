<header>
	<div class="container">
		<div class="row">
			<div class="span9">
				<ul class="nav nav-tabs">
					<li nav="main"><?=anchor('','Главная');?></li>
					<li nav="catalog"><?=anchor('catalog/courses','Каталог курсов');?></li>
				<?php if($this->session->userdata('regcustomer')):?>	
					<li nav="registration"><?=anchor('registration/customer/step/'.$this->session->userdata('step'),'Оформление заявки');?></li>
				<?php else:?>
					<li nav="registration"><?=anchor('registration/customer','Оформление заявки');?></li>
				<?php endif;?>
					<li nav="contacts"><?=anchor('contacts','Контакты');?></li>
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