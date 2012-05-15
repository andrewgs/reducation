<div class="span3">
	<div class="well sidebar-nav">
		<h5 style="margin: 0 0 10px 15px;"><u><?=$userinfo['fullname'];?></u></h5>	
		<ul class="nav nav-list">
			<li class="nav-header">Личный кабинет</li>
			<li num="list"><?=anchor('customer/audience/list','Список слушателей');?></li>
			<li class="nav-header">Настройка</li>
			<li num="start-page"><?=anchor('customer/information/start-page','Начальная страница');?></li>
			<li num="audience"><?=anchor('customer/registration/audience','Регистрация слушателей');?></li>
			<li num="ordering"><?=anchor('customer/registration/ordering','Оформление заказа');?></li>
			<li num="orders"><?=anchor('customer/audience/orders','Мои заказы');?></li>
			<li num="profile"><?=anchor('customer/edit/profile','Редактировать данные');?></li>
		</ul>
	</div>
</div>