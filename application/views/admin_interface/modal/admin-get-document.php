<div id="getDocument" class="modal hide fade">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Загрузка файла из системы</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<h4>Лекция: <?=$lecture['title'];?></h4>
			<ol>
				<li>Начните загрузку файла <strong><?=$filename;?></strong>, щелкнув на кнопке загрузки ниже</li>
				<li>В появившемся окне "Загрузка файла - предупреждение системы безопасности" нажмите на кнопку "Сохранить" и выберите папку на вашем компьютере для сохранения файла издания.</li>
				<li>После завершения загрузки файла запустите его на вашем компьютере.</li>
			</ol>
		</fieldset>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">Отменить</button>
		<button class="btn btn-info" data-dismiss="modal" id="download"><i class="icon-download-alt"></i> Загрузить</button>
	</div>
</div>
