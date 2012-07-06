<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<!--<li class="nav-header">Последние добавленные курсы</li>-->
		<?php //for($i=0;$i<count($newcourses);$i++):?>
			<!--<li><?=anchor('admin-panel/references/trend/'.$newcourses[$i]['trend'].'/course/'.$newcourses[$i]['id'],$newcourses[$i]['code']);?></li>-->
		<?php //endfor;?>
			<li class="nav-header">Справочники</li>
			<li num="trends"><?=anchor('admin-panel/references/trends','Направления');?></li>
			<li num="courses"><?=anchor('admin-panel/references/courses','Курсы');?></li>
			<li class="nav-header">Пользователи</li>
			<li num="customer"><?=anchor('admin-panel/users/customer','Заказчики');?></li>
			<li num="audience"><?=anchor('admin-panel/users/audience','Слушатели');?></li>
			<li class="nav-header">Действия</li>
			<li><?=anchor('','Главная');?></li>
			<li num="search"><?=anchor('admin-panel/messages/search/orders/new-search','Поиск заказа');?></li>
			<li num="orders"><?=anchor('admin-panel/messages/orders/unpaid','Заказы');?></li>
			<li num="control"><?=anchor('admin-panel/actions/control','Панель управления');?></li>
		</ul>
	</div>
</div>