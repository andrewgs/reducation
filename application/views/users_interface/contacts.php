<!DOCTYPE html>
<html lang="en">
<? $this->load->view('users_interface/head'); ?>
<body>
	<? $this->load->view('users_interface/header'); ?>
	<div class="container">
		<div class="row">
			<div class="span9">
				<h1>Контакты</h1>
				<p>АНО ДПО «Южно-окружной центр повышения квалификации»</p> 
				<p>
					344001, Ростовская область, г.Ростов-на-Дону, ул.Республиканская, д.86 <br />
					тел.: (863) 273-66-61, (863) 238-53-53 <br />
					e-mail: <?= safe_mailto('info@roscentrdpo.ru', 'info@roscentrdpo.ru') ?> <br />
					www.roscentrdpo.ru
				</p>
				<p>
					Режим работы: пн-чт - 9:00-18:00, пт - 9:00-16:00, обед - 13:00-14:00
				</p>
				<p>На карте:</p>
				<div class="map-wrapper">
					<div id="YMapsID" style="width: 600px; height: 400px;"></div>
				</div>
			</div>
			<? if($loginstatus['status'] && $loginstatus['zak']): ?>
				<?php $this->load->view('users_interface/rightbarcus'); ?>
			<? endif; ?>
			<? if($loginstatus['status'] && $loginstatus['slu']): ?>
				<?php $this->load->view('users_interface/rightbaraud'); ?>
			<? endif; ?>
			<? if($loginstatus['status'] && $loginstatus['adm']): ?>
				<?php $this->load->view('users_interface/rightbaradm'); ?>
			<? endif; ?>
		</div>
 	<? $this->load->view('users_interface/footer'); ?>	
	</div>
	<? $this->load->view('users_interface/scripts'); ?>
	
	<script src="http://api-maps.yandex.ru/1.1/?key=AH8dcE8BAAAA1mo7ZgIAVjUxlJOJMw6Sa0PmwFUtVXCsGDcAAAAAAAAAAADcSoECPLnpIL3coIMcmYQj8CaAbw==&modules=pmap&wizard=constructor" type="text/javascript"></script>
  	<style type="text/css">
  		.overlay { position: absolute; z-index: 1; width: 40px; height: 36px; background: url(img/home_contacts.png); cursor:pointer; }
		.map-wrapper { border: 1px solid #999; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; height: 400px; padding: 3px; text-align: center; width: 600px; margin-bottom: 20px; }
		img { max-width: none; }
	</style>
	<script type="text/javascript">
		var map, stations = [{point: new YMaps.GeoPoint(39.677068,47.222102), name:"Южно-окружной центр повышения квалификации"}];
		    YMaps.jQuery(function () {
		        map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);
		        map.setCenter(new YMaps.GeoPoint(39.675995,47.223769), 15);
		        map.addControl(new YMaps.Zoom());
		        map.enableScrollZoom();
		        var s = new YMaps.Style();
		        s.iconStyle = new YMaps.IconStyle();
		        s.iconStyle.href = "http://api-maps.yandex.ru/i/0.3/placemarks/pmdbm.png";
		        s.iconStyle.size = new YMaps.Point(28, 29);
		        s.iconStyle.offset = new YMaps.Point(-8, -27);
		        
				YMaps.Styles.add("constructor#pmlbmPlacemark", {
				    iconStyle : {
				        href : "http://api-maps.yandex.ru/i/0.3/placemarks/pmdbm.png",
				            size : new YMaps.Point(28,29),
				            offset: new YMaps.Point(-8,-27)
				        }
				    });
				
				   map.addOverlay(createObject("Placemark", new YMaps.GeoPoint(39.677068,47.222102), "constructor#pmdbmPlacemark", "АНО ДПО «Южно-окружной центр повышения квалификации»"));
				
				function createObject (type, point, style, description) {
				    var allowObjects = ["Placemark", "Polyline", "Polygon"],
				        index = YMaps.jQuery.inArray( type, allowObjects),
				        constructor = allowObjects[(index == -1) ? 0 : index];
				        description = description || "";
				    
				    var object = new YMaps[constructor](point, {style: style, hasBalloon : !!description});
				    object.description = description;
				    
				    return object;
				}		        
		    }); 
	</script>
</body>
</html>
