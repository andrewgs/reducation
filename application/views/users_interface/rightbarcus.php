<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Личный кабинет</li>
			<li num="list"><?=anchor('customer/audience/list','Список слушателей');?></li>
			<li num="1"><a href="#">Пройденные курсы</a></li>
			<li num="2"><a href="#">Полученные сертификаты</a></li>
			<li><?=anchor('logoff','Выйти из кабинета');?></li>
			<li class="nav-header">Настройка</li>
			<li num="audience"><?=anchor('customer/registration/audience','Регистрация слушателей');?></li>
			<li num="ordering"><?=anchor('customer/registration/ordering','Оформление заказа');?></li>
			<li num="orders"><?=anchor('customer/audience/orders','Мои заказы');?></li>
			<li num="profile"><?=anchor('customer/edit/profile','Редактировать данные');?></li>
			<li class="nav-header">Информация</li>
			<li num="6"><a href="#">Рейтинг курсов</a></li>
			<li num="7"><a href="#">Курсы в разработке</a></li>
		</ul>
	</div>
</div>