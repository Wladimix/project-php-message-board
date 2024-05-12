<?php
namespace App\Classes\Controllers;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Constants.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Models/Ads.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Validation.php');
use App\Classes\Constants;
use App\Classes\Models\Ads;
use App\Classes\Validation;

class AdsController
{
	public static function getAllAds($queryParams)
	{
		if (isset($queryParams['ads']) && $queryParams['ads'] === Constants::MY_ADV) {
			$_SESSION['MY_ADS'] = true;
			$ads = Ads::getAllAds(Constants::MY_ADV);
			return $ads;
		} else {
			$_SESSION['MY_ADS'] = null;
			$ads = Ads::getAllAds();
			return $ads;
		}
	}

	public static function getAdvertisement($id)
	{
		$advertisement = Ads::getAdvertisement($id);
		return $advertisement;
	}

	public static function addAdvertisement($advertisementData)
	{
		$newAdvertisement = Ads::addAdvertisement($advertisementData);
		return $newAdvertisement;
	}

	public static function editAdvertisement($advertisementData, $fileData)
	{
		$advertisementData['photo-src'] = null;

		if (
			$fileData &&
			$fileData['adv-photo']['error']== UPLOAD_ERR_OK &&
			$fileData['adv-photo']['type'] == 'image/png' ||
			$fileData['adv-photo']['type'] == 'image/jpeg'
		)
		{
			$photoName = $fileData["adv-photo"]["name"];
			move_uploaded_file($fileData["adv-photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . '/images/' . 'upl_' . $photoName);
			$advertisementData['photo-src'] = 'upl_' . $photoName;
		}

		Ads::editAdvertisement($advertisementData);
	}

	public static function deleteAdvertisement($id)
	{
		Ads::deleteAdvertisement($id);
	}
}
