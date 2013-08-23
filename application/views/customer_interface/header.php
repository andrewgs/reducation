<header class="admin">
	<div class="container">
		<div class="row">
			<div class="span7">
				<a href="<?=$baseurl;?>" id="logo">Образовательный портал <br />АНО ДПО <span>Система Дистанционного Образования</span></a>
			</div>
			<div class="span5">
			<? if($this->loginstatus['status']):?>
				<p class="authorized-user">
					Вы вошли как <i><?= $userinfo['ulogin']; ?></i>
					<?=anchor('logoff','Выход', array('class'=>'auth-link link-off'));?> 
				</p>
			<? endif;?>
				<div id="top-contacts">
					<span class="desc">Телефон для справок:</span>
					<b>(863)</b> 246-43-54
				</div>			
			</div>
		</div>
		<div class="row">
			<nav class="span12">
				<ul>
					<li><?=anchor('','Главная');?> <span class="lsep"> </span><span class="rsep"> </span></li>
				<?php if($this->session->userdata('regcustomer')): ?>
					<li nav="registration"><?=anchor('registration/customer/step/'.$this->session->userdata('step'),'Оформление заявки');?> <span class="lsep"> </span><span class="rsep"> </span></li>
				<?php else: ?>
					<li nav="registration"><?=anchor('registration/customer','Оформление заявки ЮЛ');?> <span class="lsep"> </span><span class="rsep"> </span></li>
				<?php endif; ?>
					<li nav="registration"><?=anchor('registration/physical-person','Оформление заявки ФЛ');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<li><?=anchor('catalog/courses','Каталог курсов');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<li><?=anchor('information','Информация');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<li><?=anchor('contacts','Контакты');?></li>
				</ul>
			</nav>
		</div>
	</div>
</header>