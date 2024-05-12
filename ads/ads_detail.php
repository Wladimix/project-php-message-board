<?php session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Constants.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Controllers/AdsController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Header.php');
use App\Classes\Constants;
use App\Classes\Controllers\AdsController;
use App\Classes\Header;

if (!empty($_POST) && $_POST['action'] === Constants::ADD_ADV) {
	$_SESSION['ADV_ID'] = AdsController::addAdvertisement($_POST);
} elseif (!empty($_POST) && $_POST['action'] === Constants::EDIT_ADV) {
	AdsController::editAdvertisement($_POST, $_FILES);
}

if (!empty($_GET['id'])) {
	$_SESSION['ADV_ID'] = $_GET['id'];
}

$advertisement = false;
if (isset($_SESSION['ADV_ID'])) {
	$advertisement = AdsController::getAdvertisement($_SESSION['ADV_ID']);
	$_SESSION['CURRENT_ADVERTISEMENT_DATA'] = $advertisement;
} else {
	header('Location: ./ads_list');
}

echo Header::makeHeader('Объявления');
?>

<div class="container">
	<div class="detail-container">

		<?if (
			$_FILES &&
			$_FILES['adv-photo']['error'] == UPLOAD_ERR_OK &&
			$_FILES['adv-photo']['type'] !== 'image/png' &&
			$_FILES['adv-photo']['type'] !== 'image/jpeg'
		):?>
			<p class="load-file-message">ВНИМАНИЕ: возможна только загрузка изображений .png и .jpeg</p>
		<?endif;?>

		<div class="detail-header">
			<img
				class="detail-img"
				src="<?=$advertisement['photo_src'] ? '../images/' . $advertisement['photo_src'] : '../images/no_photo.png'?>"
				width="470"
				height="370"
			/>
			<div class="owner-information">
				<h3>Владелец</h3>
				<p><?=$advertisement['name'] . ' ' . $advertisement['surname']?></p>
				<h3>Электронная почта</h3>
				<p><?=$advertisement['email']?></p>
				<h3>Телефон</h3>
				<p><?=$advertisement['phone']?></p>
			</div>
		</div>
		<p class="description"><?=$advertisement['description']?></p>

		<?if (
			$advertisement &&
			isset($_SESSION['AUTHORIZE']) &&
			$_SESSION['ADV_ID'] &&
			$advertisement['user_ID'] == $_SESSION['AUTHORIZE']['userID']
		):?>
			<div class="advertisement-buttons">
				<a class="edit-advertisement-button-link" href="./ads_edit.php?mode=<?=Constants::EDIT_ADV?>">РЕДАКТИРОВАТЬ</a>
				<a class="delete-advertisement-button-link" href="./ads_list.php?id=<?=$_SESSION['ADV_ID']?>&delete=yes">УДАЛИТЬ</a>
			</div>
		<?endif;?>

		<a class="backurl-ads-button-link" href="./ads_list.php?ads=<?=$_SESSION['MY_ADS'] ? Constants::MY_ADV : '';?>">К списку объявлений</a>

	</div>
</div>
