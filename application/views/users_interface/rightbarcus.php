<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Личный кабинет</li>
			<li num="list"><?=anchor('customer/audience/list','Список слушателей');?></li>
			<li><?=anchor('logoff','Выйти из кабинета');?></li>
			<li class="nav-header">Настройка</li>
			<li num="audience"><?=anchor('customer/registration/audience','Регистрация слушателей');?></li>
			<li num="ordering"><?=anchor('customer/registration/ordering','Оформление заказа');?></li>
			<li num="orders"><?=anchor('customer/audience/orders','Мои заказы');?></li>
			<li num="profile"><?=anchor('customer/edit/profile','Редактировать данные');?></li>
		</ul>
	</div>
</div>