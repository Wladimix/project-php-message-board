<?php session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Header.php');
use App\Classes\Header;
echo Header::makeHeader('Доска объявлений');
?>

<div class="page-title-home-block">
	<div class="page-title-home-subblock">
		<div class="page-title-home">Добро пожаловать на</div>
		<div class="page-title-home">Сайт объявлений</div>
		<div class="page-subtitle-home">ЛУЧШИЕ ОБЪЯВЛЕНИЯ</div>
		<div class="page-title-button">
			<a href="./ads/ads_list.php" class="page-title-button-link">ПОКАЗАТЬ ОБЪЯВЛЕНИЯ</a>
		</div>
	</div>
</div>
