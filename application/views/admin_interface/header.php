<header class="admin">
	<div class="container">
		<div class="row">
			<div class="span7">
				<a href="#" id="logo">Образовательный портал <br />АНО ДПО <span>Система Дистанционного Образования</span></a>
			</div>
			<div class="span5">
				<p class="authorized-user">
					Вы вошли как <i><?= $userinfo['ulogin']; ?></i>
					<?=anchor('admin-panel/logoff','Завершить сеанс', array('class'=>'auth-link'));?> 
				</p>
				<div id="top-contacts">
					<span class="desc">Телефон для справок:</span>
					<b>(863)</b> 295-52-10
				</div>			
			</div>
		</div>
	</div>
</header>