<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Последние добавленные курсы</li>
		<?php for($i=0;$i<count($newcourses);$i++):?>
			<li><?=anchor('admin-panel/references/trend/'.$newcourses[$i]['trend'].'/course/'.$newcourses[$i]['id'],$newcourses[$i]['code']);?></li>			
		<?php endfor;?>
			<li class="nav-header">Справочники</li>
			<li num="trends"><?=anchor('admin-panel/references/trends','Направления');?></li>
			<li num="courses"><?=anchor('admin-panel/references/courses','Курсы');?></li>
			<li class="nav-header">Сообщения</li>
			<li num="private"><?=anchor('admin-panel/messages/private','Личные сообщения');?></li>
			<li num="support"><?=anchor('admin-panel/messages/support','Техническая поддержка');?></li>
			<li class="nav-header">Пользователи</li>
			<li num="customer"><?=anchor('admin-panel/users/customer','Заказчики');?></li>
			<li num="audience"><?=anchor('admin-panel/users/audience','Слушатели');?></li>
			<li class="nav-header">Действия</li>
			<li><?=anchor('','Главная');?></li>
			<li num="orders"><?=anchor('admin-panel/messages/orders/active','Заказы');?></li>
			<li num="control"><?=anchor('admin-panel/actions/control','Панель управления');?></li>
			<li num="cabinet"><?=anchor('admin-panel/actions/cabinet','Личный кабинет');?></li>
			<li><?=anchor('admin-panel/logoff','Завершить сеанс');?></li>
		</ul>
	</div>
</div>