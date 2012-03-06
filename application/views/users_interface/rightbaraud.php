<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Личный кабинет</li>
			<li num="current"><?=anchor('audience/courses/current','Мои текущие курсы');?></li>
			<li><?=anchor('audience/courses/completed','Пройденные курсы');?></li>
			<li><a href="#">Полученные сертификаты</a></li>
			<li><?=anchor('logoff','Выйти из кабинета');?></li>
			<li class="nav-header">Настройка</li>
			<li num="profile"><?=anchor('audience/view/profile','Регистрационные данные');?></li>
			<li class="nav-header">Информация</li>
			<li><a href="#">Рейтинг курсов</a></li>
			<li><a href="#">Курсы в разработке</a></li>
		</ul>
	</div>
</div>