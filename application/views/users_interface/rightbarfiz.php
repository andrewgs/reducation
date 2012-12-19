<div class="span3" style="margin-top:20px;">
	<div class="well sidebar-nav">
		<h5 style="margin: 0 0 10px 15px;"><u><?=$userinfo['fullname'];?></u></h5>	
		<ul class="nav nav-list">
			<li class="nav-header">Личный кабинет</li>
			<li num="current"><?=anchor('physical/courses/current','Мои текущие курсы');?></li>
			<li num="completed"><?=anchor('physical/courses/completed','Пройденные курсы');?></li>
			<li class="nav-header">Настройка</li>
			<li num="start-page"><?=anchor('physical/information/start-page','Начальная страница');?></li>
			<li num="ordering"><?=anchor('physical/registration/ordering','Оформление заказа');?></li>
			<li num="orders"><?=anchor('physical/information/orders','Мои заказы');?></li>
			<li num="profile"><?=anchor('physical/edit/profile','Редактировать данные');?></li>
		</ul>
	</div>
</div>