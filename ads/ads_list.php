<?php session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Constants.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Controllers/AdsController.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Header.php');
use App\Classes\Constants;
use App\Classes\Controllers\AdsController;
use App\Classes\Header;

if (isset($_GET['delete']) && isset($_GET['id']) && $_SESSION['AUTHORIZE']) {
	AdsController::deleteAdvertisement($_GET['id']);
}

$ads = AdsController::getAllAds($_GET);
$numberOfTableRows = ceil(count($ads) / 3);

echo Header::makeHeader('Объявления');
?>

<div class="page-title-ads-block">
	<div class="page-title-ads-sybblock">
		<div class="page-title-ads">Объявления</div>
	</div>
</div>

<?if (isset($_SESSION['AUTHORIZE'])):?>
	<div class="ads-filter-container">
		<?if (isset($_SESSION['MY_ADS']) && $_SESSION['MY_ADS']):?>
			<a class="ads-filter-button" href="./ads_list.php">показать все объявления</a>
		<?else:?>
			<a class="ads-filter-button" href="./ads_list.php?ads=<?=Constants::MY_ADV?>">показать мои объявления</a>
		<?endif;?>
		<a class="add-adv-button" href="./ads_edit.php?mode=<?=Constants::ADD_ADV?>">СОЗДАТЬ ОБЪЯВЛЕНИЕ</a>
	</div>
<?endif;?>

<div class="container">
	<table class="advertisement-table">
		<?for ($i = 0; $i < $numberOfTableRows; $i++):?>
			<tr>
				<?for ($j = $i * 3; $j <= ($i * 3) + 2; $j++):?>

					<?if (!isset($ads[$j])) break;?>

					<td>
						<a href="./ads_detail.php?id=<?=$ads[$j]['ID']?>">
							<div class="advertisement">
								<div class="advertisement-content">
									<div class="ads-content">
										<div class="ads-name"><?=$ads[$j]['name']?></div>
									</div>
								</div>
								<img
									class="advertisement-image"
									src="<?=$ads[$j]['photo_src'] ? '../images/' . $ads[$j]['photo_src'] : '../images/no_photo.png'?>"
									width="370"
									height="270"
								/>
							</div>
						</a>
					</td>

				<?endfor;?>
			</tr>
		<?endfor;?>
	</table>
</div>
