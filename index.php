<!doctype html>
<head>
 <meta charset="UTF-8">
 	<link href="style.css" rel="stylesheet">

 <title>Test yandex api map</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--
			Укажите свой API-ключ. Тестовый ключ НЕ БУДЕТ работать на других сайтах.
			Получить ключ можно в Кабинете разработчика: https://developer.tech.yandex.ru/keys/
		-->
		<script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;apikey=1ea99bd0-d520-4f8c-bae9-9f9e44c64fe7" type="text/javascript"></script>
		<script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
		<script src="object_manager.js" type="text/javascript"></script>
		<style>
			html, body, #map {
				width: 100%; height: 100%; padding: 0; margin: 0;
			}
			a {
				color: #04b; /* Цвет ссылки */
				text-decoration: none; /* Убираем подчеркивание у ссылок */
			}
			a:visited {
				color: #04b; /* Цвет посещённой ссылки */
			}
			a:hover {
				color: #f50000; /* Цвет ссылки при наведении на нее курсора мыши */
			}
		</style>
</head>
<body>
	
	<div style='margin:10px; padding:10px;'><h1>API. Определение координат по адресу</h1>
	
	<form method="post" action="/">
		<input type="text" name="address" placeholder="Введите адрес" />
		<input type="submit" value="Get"/>
	</form>
	</div>
	
	<?php
	
	$adr = $_POST['address'];
	
	if (empty($adr)){
		$adr ='Москва';
	}
	echo "<div style='margin:10px; padding:10px;'>Получены координаты для адреса: <strong>$adr</strong></div>";
	// longitude долгота ЗВ coord_lon
	// latitude широта СЮ coord_lat
	// https://geocode-maps.yandex.ru/1.x/?apikey=1ea99bd0-d520-4f8c-bae9-9f9e44c64fe7&geocode=Москва,+Тверская+улица,+дом+7
			$params = array(
			'geocode' => $adr, 					// адрес
			'format'  => 'json',                         			// формат ответа
			'results' => 1,                               			// количество выводимых результатов
			'apikey'  => '1ea99bd0-d520-4f8c-bae9-9f9e44c64fe7', 	// ваш api key
		);
		$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));
		 
		if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
		{
			echo "<div style='margin:10px; padding:10px;'><h2>".$response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos."</h2></div>";
			//var_dump($response);
		}
		else
		{
			echo "<div>Ничего не найдено</div>";
		}
		
	?>
		<!-- <div id="map" style="width:700px;"></div> -->
	
</body>
</html>