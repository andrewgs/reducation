<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('users_interface/head');?>
<body>
	<?php $this->load->view('users_interface/header');?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Информация</h1>
				
				<p>
					Образовательный портал южно-окружного центра повышения квалификации – это система дистанционного обучения, 
					предназначенная для повышения квалификации через Интернет с выдачей удостоверения установленного образца. 
					Система позволяет организовать процесс обучения с помощью электронных учебных курсов в дистанционной форме 
					через Интернет.				    
				</p>
				<p>
					Южно-окружной центр повышения квалификации и переподготовки кадров для строительного и жилищно-коммунального комплекса
					является образовательным учреждением дополнительного профессионального образования.
				    Центр учрежден в 2012 году и находится в ведении Министерства регионального развития России. 2 апреля 2012 года центр был 
				    акредитован региональной службой по надзору и контролю в сфере образования Ростовской области и получил 
				    <a href="<?=base_url();?>img/license.jpg" target="_blank">лицензию</a> на
				    право осуществления образовательной деятельности в сфере дополнительного профессионального образования.
				</p>				
				<p>
					Документ о повышении квалификации – удостоверение установленного образца. Документы заказа (счёт, договор и акт) 
					пользователь получает автоматически, по завершению оформления заявки. Все документы заказа можно получить в оригинале.
				</p>
				<p>
					<a class="license" href="<?=base_url();?>img/license.jpg" target="_blank">
						<img src="<?=base_url();?>img/license.jpg" alt="лиценизия на право осуществления образовательной деятельности" />
					</a>
				</p>
			</div>
		<?php if($loginstatus['status'] && $loginstatus['zak']):?>
			<?php $this->load->view('users_interface/rightbarcus');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['slu']):?>
			<?php $this->load->view('users_interface/rightbaraud');?>
		<?php endif;?>
		<?php if($loginstatus['status'] && $loginstatus['adm']):?>
			<?php $this->load->view('users_interface/rightbaradm');?>
		<?php endif;?>
		</div>
	<?php $this->load->view('users_interface/footer');?>	
	</div>
	<?php $this->load->view('users_interface/scripts');?>
</body>
</html>
