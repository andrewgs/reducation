<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<div class="span9">
			<legend>Личные данные</legend>
			<div class="control-group">
				<label for="lastname" class="control-label"><strong>Фамилия</strong></label>
				<div class="controls">
					<input type="text" id="lastname" class="input-xlarge inpval" name="lastname" value="<?=$audience['lastname'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="name" class="control-label"><strong>Имя</strong></label>
				<div class="controls">
					<input type="text" id="name" class="input-xlarge inpval" name="name" value="<?=$audience['name'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="middlename" class="control-label"><strong>Отчество</strong></label>
				<div class="controls">
					<input type="text" id="middlename" class="input-xlarge inpval" name="middlename" value="<?=$audience['middlename'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="fiodat" class="control-label">Ф.И.О. в дательном падеже</label>
				<div class="controls">
					<input type="text" id="fiodat" class="input-xlarge inpval" name="fiodat" value="<?=$audience['fiodat'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="position" class="control-label">Должность</label>
				<div class="controls">
					<input type="text" id="position" class="input-xlarge inpval" name="position" value="<?=$audience['position'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Адрес</legend>
			<div class="control-group">
				<label for="address" class="control-label"><strong>Область, город, улица, дом, корпус, квартира, индекс</strong></label>
				<div class="controls">
					<input type="text" id="address" class="span6 inpval" name="address" value="<?=$audience['address'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Контактные данные</legend>
			<div class="control-group" id="cgemail">
				<label for="personaemail" class="control-label"><strong>E-mail</strong></label>
				<div class="controls">
					<input type="text" id="personaemail" class="input-xlarge inpval" name="personaemail" value="<?=$audience['personaemail'];?>">
					<span id="email" class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="personaphone" class="control-label"><strong>Телефон</strong></label>
				<div class="controls">
					<input type="text" id="personaphone" class="input-xlarge inpval" name="personaphone" value="<?=$audience['personaphone'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<legend>Данные о предыдущем образовании</legend>
			<div class="control-group">
				<label for="graduated" class="control-label"><strong>Наименование<br/>учебного заведения</strong></label>
				<div class="controls">
					<input type="text" id="graduated" class="span6 inpval" name="graduated" value="<?=$audience['graduated'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="year" class="control-label"><strong>Год окончания</strong></label>
				<div class="controls">
					<input type="text" id="year" class="span1 inpval digital" name="year" value="<?=$audience['year'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
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
					<input type="text" id="documentnumber" class="span2 inpval" name="documentnumber" value="<?=$audience['documentnumber'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="specialty" class="control-label"><strong>Специальность</strong></label>
				<div class="controls">
					<input type="text" id="specialty" class="span6 inpval" name="specialty" value="<?=$audience['specialty'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
				</div>
			</div>
			<div class="control-group">
				<label for="qualification" class="control-label"><strong>Квалификация</strong></label>
				<div class="controls">
					<input type="text" id="qualification" class="input-xlarge inpval" name="qualification" value="<?=$audience['qualification'];?>">
					<span class="help-inline" style="display:none;">&nbsp;</span>
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
	<div class="modal-footer">
		<button class="btn btn-success" type="submit" id="save" name="submit" value="save"><i class="icon-ok icon-white"></i> Сохранить</button>
	</div>
<?= form_close(); ?>