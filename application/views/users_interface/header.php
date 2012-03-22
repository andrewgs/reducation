<header>
	<div class="container">
		<div class="row">
			<div class="span7">
				<a href="<?= base_url(); ?>" id="logo">Образовательный портал <br />АНО ДПО <span>Система Дистанционного Образования</span></a>
			</div>
			<div class="span5">
			<? if($loginstatus['status']):?>
				<p class="authorized-user">
					Вы вошли как <i><?= $userinfo['ulogin']; ?></i>
				<?php
					if($loginstatus['status'] && $loginstatus['cus']):
						$this->load->view('users_interface/rightbarcus');
					endif;
					if($loginstatus['status'] && $loginstatus['aud']):
						$this->load->view('users_interface/rightbaraud');
					endif;
					if($loginstatus['status'] && $loginstatus['adm']):
						$this->load->view('users_interface/rightbaradm');
					endif;
				?>
				</p>
			<? else: ?>
				<div class="form-header">Вход в личный кабинет</div>
				<?=form_open('main-page',array('class'=>'form-inline right')); ?>
					<?php $this->load->view('alert_messages/alert-error');?>
					<?php $this->load->view('alert_messages/alert-success');?>
					<input type="text" id="login" class="input span2 focused" name="login" placeholder="Имя пользователя">
					<span class="help-inline" style="display:none; padding-left: 0px;">&nbsp;</span>
					<input type="password" id="password" class="input-small focused" name="password" placeholder="Пароль">
					<span class="help-inline" style="display:none; padding-left: 0px;">&nbsp;</span>
					<button class="btn" type="submit" id="lsend" name="lsubmit" value="lsend">Войти</button>
				<?= form_close(); ?>	
			<? endif;?>
				<div id="top-contacts">
					<span class="desc">Телефон для справок:</span>
					<b>(863)</b> 295-52-10
				</div>			
			</div>
		</div>
		<div class="row">
			<nav class="span12">
				<ul>
					<li><?=anchor('','Главная');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<? if($this->session->userdata('regcustomer')): ?>	
					<li nav="registration"><?=anchor('registration/customer/step/'.$this->session->userdata('step'),'Оформление заявки');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<? else: ?>
						<li nav="registration"><?=anchor('registration/customer','Оформление заявки');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<? endif; ?>
					<li><?=anchor('catalog/courses','Каталог курсов');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<li><?=anchor('information','Информация');?> <span class="lsep"> </span><span class="rsep"> </span></li>
					<li><?=anchor('contacts','Контакты');?></li>
				</ul>
			</nav>
		</div>
	</div>
</header>