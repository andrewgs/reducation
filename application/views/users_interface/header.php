<header>
	<div class="container">
		<div class="row">
			<div class="span7">
				<a href="<?=base_url();?>" id="logo">Образовательный портал <br />АНО ДПО <span>Система Дистанционного Образования</span></a>
			</div>
			<div class="span5">
			<?php if($this->loginstatus['status'] === TRUE):?>
				<p class="authorized-user">
					Вы вошли как <i><?= $userinfo['ulogin']; ?></i>
				<?php
					if($this->loginstatus['status'] && $this->loginstatus['zak']):
						echo anchor('customer/information/start-page','Личный кабинет', array('class'=>'auth-link'));
						echo anchor('logoff','Выход', array('class'=>'auth-link link-off'));
					endif;
					if($this->loginstatus['status'] && $this->loginstatus['slu']):
						echo anchor('audience/courses/current','Личный кабинет', array('class'=>'auth-link'));
						echo anchor('logoff','Выход', array('class'=>'auth-link link-off'));
					endif;
					if($this->loginstatus['status'] && $this->loginstatus['adm']):
						echo anchor('admin-panel/actions/control','Панель управления', array('class'=>'auth-link'));
						echo anchor('admin-panel/logoff','Выход', array('class'=>'auth-link link-off'));
					endif;
					if($this->loginstatus['status'] && $this->loginstatus['fiz']):
						echo anchor('physical/information/start-page','Личный кабинет', array('class'=>'auth-link'));
						echo anchor('logoff','Выход', array('class'=>'auth-link link-off'));
					endif;
				?>
				</p>
			<?php else:?>
				<div class="form-header">Вход в личный кабинет</div>
				<div id="top-restore" style="display:none;text-align: right;">
					<?=anchor('password-restore','Забыли пароль?');?>
				</div>
				<?=form_open('main-page',array('class'=>'form-inline right')); ?>
					<?php $this->load->view('alert_messages/alert-auth-error');?>
					<input type="text" id="login" class="input span2 focused" name="login" placeholder="Имя пользователя">
					<span class="help-inline" style="display:none; padding-left: 0px;">&nbsp;</span>
					<input type="password" id="password" class="input-small focused" name="password" placeholder="Пароль">
					<span class="help-inline" style="display:none; padding-left: 0px;">&nbsp;</span>
					<button class="btn" type="submit" id="lsend" name="lsubmit" value="lsend">Войти</button>
				<?= form_close(); ?>
			<? endif;?>
				<div id="top-contacts">
					8 800 707-00-97 <br/>
					<span class="desc">Звонок из всех регионов России бесплатно</span> 
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