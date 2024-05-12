<?php session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Constants.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Controllers/AdsController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Header.php');
use App\Classes\Constants;
use App\Classes\Controllers\AdsController;
use App\Classes\Header;

echo Header::makeHeader('Создание/редактирование объявления');
?>

<div class="container">
	<div class="advertisement-form">
		<?if (
			isset($_GET['mode']) &&
			isset($_SESSION['AUTHORIZE']) &&
			$_GET['mode'] === Constants::ADD_ADV
		):?>

			<form action="./ads_detail.php" method="POST">
				<input type="hidden" name="userID" value="<?=$_SESSION['AUTHORIZE']['userID']?>" />
				<input type="hidden" name="action" value="<?=Constants::ADD_ADV?>" />
				<label for="ads-name">Название</label><br />
				<input id="ads-name" name="ads-name" type="text" /><br />
				<label for="ads-description">Описание</label><br />
				<textarea id="ads-description" name="ads-description"></textarea><br />
				<input type="submit" value="Разместить">
			</form>

		<?elseif (
			isset($_GET['mode']) &&
			isset($_SESSION['AUTHORIZE']) &&
			isset($_SESSION['CURRENT_ADVERTISEMENT_DATA']) &&
			$_GET['mode'] === Constants::EDIT_ADV
		):?>

			<form action="./ads_detail.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="action" value="<?=Constants::EDIT_ADV?>" />
				<label for="ads-name">Изменить фото</label><br />
				<input type="file" name="adv-photo" /><br />
				<hr>
				<label for="ads-name">Название</label><br />
				<input id="ads-name" name="ads-name" type="text" value="<?=$_SESSION['CURRENT_ADVERTISEMENT_DATA']['adv_name']?>" /><br />
				<label for="ads-description">Описание</label><br />
				<textarea id="ads-description" name="ads-description"><?=$_SESSION['CURRENT_ADVERTISEMENT_DATA']['description']?></textarea><br />
				<input type="submit" value="Редактировать">
			</form>

		<?endif;?>
	</div>
</div>
