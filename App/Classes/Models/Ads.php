<?php
namespace App\Classes\Models;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/DBConnection.php');
use App\Classes\DBConnection;
use PDO;

class Ads
{
	public static function getAllAds($affiliation = false)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$advAffiliationQuery = '';
		if ($affiliation) {
			$advAffiliationQuery = 'WHERE `A`.`user_ID` = ' . $_SESSION['AUTHORIZE']['userID'];
		}

		$query = $conn->prepare(
			"SELECT `A`.`ID`, `A`.`name`, `A`.`photo_src` FROM `ads` A
			INNER JOIN `users` U
			ON `A`.`user_ID` = `U`.`ID`" . $advAffiliationQuery . "
			ORDER BY `A`.`ID` DESC;"
		);
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function getAdvertisement($id)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"SELECT `A`.`ID`, `A`.`name` adv_name, `A`.`description`, `A`.`photo_src`, `U`.`ID` user_ID, `U`.`name`, `U`.`surname`, `U`.`phone`, `U`.`email`  FROM `ads` A
			INNER JOIN `users` U
			ON `A`.`user_ID` = `U`.`ID`
			WHERE `A`.`ID` = '$id';"
		);
		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function addAdvertisement($advertisementData)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"INSERT INTO `ads`
			(name, description, user_ID)
			VALUES
			('". $advertisementData['ads-name'] . "', '". $advertisementData['ads-description'] . "', '". $advertisementData['userID'] . "');"
		);
		$query->execute();

		return $conn->lastInsertId();
	}

	public static function editAdvertisement($advertisementData)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"UPDATE `ads`
			SET `name` = '". $advertisementData['ads-name'] . "',
				`description` = '". $advertisementData['ads-description'] . "',
				`photo_src` = '". $advertisementData['photo-src'] ."'
			WHERE `ID` = '" . $_SESSION['ADV_ID'] . "';"
		);
		$query->execute();
	}

	public static function deleteAdvertisement($id)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"DELETE FROM `ads` WHERE `id` = '$id';"
		);
		$query->execute();
	}
}
