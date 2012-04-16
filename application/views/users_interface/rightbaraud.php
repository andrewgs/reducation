<div class="span3">
	<div class="well sidebar-nav">
		<h5 style="margin: 0 0 10px 15px;"><u><?=$userinfo['fullname'];?></u></h5>
		<ul class="nav nav-list">
			<li class="nav-header">Личный кабинет</li>
			<li num="current"><?=anchor('audience/courses/current','Мои текущие курсы');?></li>
			<li num="completed"><?=anchor('audience/courses/completed','Пройденные курсы');?></li>
			<li class="nav-header">Настройка</li>
			<li num="profile"><?=anchor('audience/view/profile','Регистрационные данные');?></li>
		</ul>
	</div>
</div>