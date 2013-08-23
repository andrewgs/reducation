<header class="admin">
	<div class="container">
		<div class="row">
			<div class="span7">
				<?=anchor($this->uri->uri_string(),'Образовательный портал <br />АНО ДПО <span>Система Дистанционного Образования</span>',array('id'=>'logo'))?>
			</div>
			<div class="span5">
				<p class="authorized-user">
					Вы вошли как <i><?= $userinfo['ulogin']; ?></i>
					<?=anchor('admin-panel/logoff','Завершить сеанс', array('class'=>'auth-link link-off'));?> 
				</p>
				<div id="top-contacts">
					<span class="desc">Телефон для справок:</span>
					<b>(863)</b> 246-43-54
				</div>			
			</div>
		</div>
	</div>
</header>