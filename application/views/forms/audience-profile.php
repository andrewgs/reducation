<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span9">
			<legend>Личные данные</legend>
			<div class="control-group">
				<label for="lastname" class="control-label"><strong>Фамилия</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['lastname'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="name" class="control-label"><strong>Имя</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['name'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="middlename" class="control-label"><strong>Отчество</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['middlename'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
				<div class="controls">
					<span class="help-inline"><?=$audience['fiodat'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="position" class="control-label">Должность</label>
				<div class="controls">
					<span class="help-inline"><?=$audience['position'];?></span>
				</div>
			</div>
			<legend>Адрес</legend>
			<div class="control-group">
				<label for="address" class="control-label"><strong>Область, город, улица, дом, корпус, квартира, индекс</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['address'];?></span>
				</div>
			</div>
			<legend>Контактные данные</legend>
			<div class="control-group" id="cgemail">
				<label for="personaemail" class="control-label"><strong>E-mail</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['personaemail'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="personaphone" class="control-label"><strong>Телефон</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['personaphone'];?></span>
				</div>
			</div>
			<legend>Данные о предыдущем образовании</legend>
			<div class="control-group">
				<label for="graduated" class="control-label"><strong>Наименование<br/>учебного заведения</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['graduated'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="year" class="control-label"><strong>Год окончания</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['year'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="typedocument" class="control-label"><strong>Документ<br/>об образовании</strong></label>
				<div class="controls">
				<?php if($audience['typedocument'] == 1):?>
					<span class="help-inline">Диплом</span>
				<?php elseif($audience['typedocument'] == 2):?>
					<span class="help-inline">Аттестат</span>
				<?php endif;?>
				</div>
			</div>
			<div class="control-group">
				<label for="documentnumber" class="control-label"><strong>Номер выданного<br/>документа</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['graduated'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="specialty" class="control-label"><strong>Специальность</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['documentnumber'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="qualification" class="control-label"><strong>Квалификация</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['specialty'];?></span>
				</div>
			</div>
			<hr/>
			<div class="control-group">
				<label for="signdate" class="control-label"><strong>Зарегистрирован</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$audience['signupdate'];?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="customer" class="control-label"><strong>Заказчик</strong></label>
				<div class="controls">
					<span class="help-inline"><?=$customer;?></span>
				</div>
			</div>
		</div>
	</fieldset>
<?= form_close(); ?>