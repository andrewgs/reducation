<!DOCTYPE html>
<html lang="en">
<? $this->load->view('users_interface/head');?>
<body>
	<? $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div id="promo-banner" class="span12">
				<h1>Южно-окружной центр повышения квалификации и переподготовки кадров <br />для строительного и жилищно-коммунального комплекса</h1>
				<h3>Повышение квалификации через интернет с выдачей удостоверения установленного образца.</h3>
			</div>
		</div>
		<div class="row">
			<div class="span9">
				<div class="row review">
					<p>Наши курсы разработаны в соответствии с рекомендациями: </p>
					<ul class="partners">
						<li class="p1"><a title="Национальное объединение строителей" href="#">Национальное объединение строителей</a></li>
						<li class="p2"><a title="Национальное объединение проектировщиков" href="#">Национальное объединение проектировщиков</a></li>
						<li class="p3"><a title="Национальное объединение изыскателей" href="#">Национальное объединение изыскателей</a></li>
						<li class="p4"><a title="Национальное объединение энергоаудиторов" href="#">Национальное объединение энергоаудиторов</a></li>
					</ul>
				</div>
				<p>
					Образовательный портал АНО ДПО «Южно-окружной центр повышения квалификации и переподготовки кадров 
					для строительного и жилищно-коммунального комплекса» предлагает курсы дистанционного дополнительного 
					профессионального образования в сфере строительства, проектирования, инженерных изысканий, 
					коммунального хозяйства и энергетического менеджмента.
				</p>
				<p>
					Система дистанционного обучения позволяет организовать образовательный процесс с помощью электронных 
					учебных курсов в дистанционной форме через Интернет. После окончания обучения и успешной сдачи итогового 
					тестирования слушатели курсов получают удостоверения установленного образца.
				</p>
			</div>
			<div class="span3">
				<h4>Последние добавленые курсы</h4>
				<ul id="courses-new">
					<li><a href="#">БС-12. Безопасность строительства и качество выполнения геодезических, подготовительных и земляных работ</a></li>
					<li><a href="#">БС-14. Безопасность строительства и качество возведения бетонных и железобетонных строительных </a></li>
					<li><a class="details" href="#">Полный список курсов &raquo;</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<h2 class="bordered">Этапы прохождения обучения</h2>
			</div>
			<div class="span3">
				<p class="caption">1. Оформление заявки <span class="next">&gt;</span></p>
				<p>
					1. Зарегистрируйте заказчика; <br />
					2. Выберите курсы; <br />
					3. Зарегистрируйте слушателей; <br />
					4. Получите счет и договор.
				</p>
			</div>
			<div class="span3">
				<p class="caption">2. Оплата <span class="next">&gt;</span></p>
				<p>
					Счет Вы получите автоматически по завершению оформления заявки. Совершить оплату 
					Вы можете в любом банке. Доступ к лекциям открывается в течении 1-2 дней после оплаты. 
				</p>
			</div>
			<div class="span3">
				<p class="caption">3. Обучение <span class="next">&gt;</span></p>
				<p>
					Слушатели обучаются в своих личных кабинетах на сайте. Для завершения обучения 
					слушатели выполняют итоговое тестирование.  
				</p>
			</div>
			<div class="span3">
				<p class="caption">4. Получение удостоверения</p>
				<p>
					Как только слушатели успешно завершают обучение, мы выдаем удостоверения о 
					повышении квалификации. Документы можно забрать лично или получить экспресс-почтой.  
				</p>
			</div>
		</div>
	</div>
	<!--
	<div class="container">
		<div class="row">
			<div class="span12">
				<? 
				if(!$loginstatus['status']):
					$this->load->view('users_interface/rightbarauth');
				endif;
				if($loginstatus['status'] && $loginstatus['zak']):
					$this->load->view('users_interface/rightbarcus');
				endif;
				if($loginstatus['status'] && $loginstatus['slu']):
					$this->load->view('users_interface/rightbaraud');
				endif;
				if($loginstatus['status'] && $loginstatus['adm']):
					$this->load->view('users_interface/rightbaradm');
				endif;
				?>
			</div>
		</div>
	</div>
	-->
	<? $this->load->view('users_interface/footer');?>
	<? $this->load->view('users_interface/scripts');?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#lsend").click(function(event) {
				var err = false;
				$(".help-inline").hide();
				$("#top-restore").hide();
				$(".focused").each(function(i, element) {
					if($(this).val() == '') {
						$(this).siblings(".help-inline").html('<i class="icon-exclamation-sign" title="Поле не может быть пустым"></i>').show();
						$("#top-restore").show();
						err = true;
					}
				});
				if(err) {
					event.preventDefault()
				};
			});
		});
	</script>
</body>
</html>
