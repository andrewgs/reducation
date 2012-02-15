<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Последние добавленные курсы</li>
			<li><?=anchor('#','<i class="icon-inbox"></i> Курс 1');?></li>
			<li><?=anchor('#','<i class="icon-inbox"></i> Курс 2');?></li>
			<li class="nav-header">Справочники</li>
			<li num="trends"><?=anchor('admin-panel/references/trends','<i class="icon-list-alt"></i> Направления');?></li>
			<li num="courses"><?=anchor('admin-panel/references/courses','<i class="icon-list-alt"></i> Курсы');?></li>
			<li class="nav-header">Сообщения</li>
			<li num="private"><?=anchor('admin-panel/messages/private','<i class="icon-envelope"></i> Личные сообщения');?></li>
			<li num="support"><?=anchor('admin-panel/messages/support','<i class="icon-envelope"></i> Техническая поддержка');?></li>
			<li num="applications"><?=anchor('admin-panel/messages/applications','<i class="icon-envelope"></i> Заявки');?></li>
			<li class="nav-header">Действия</li>
			<li><?=anchor('','<i class="icon-home"></i> Главная');?></li>
			<li num="control"><?=anchor('admin-panel/actions/control','<i class="icon-cog"></i> Панель управления');?></li>
			<li num="cabinet"><?=anchor('admin-panel/actions/cabinet','<i class="icon-user"></i> Личный кабинет');?></li>
			<li><?=anchor('admin-logoff','<i class="icon-off"></i> Завершить сеанс');?></li>
		</ul>
	</div>
</div>