<?php
namespace App\Classes\Models;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/DBConnection.php');
use App\Classes\DBConnection;
use PDO;

class User
{
	public static function getUser($email, $password)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"SELECT * FROM `users`
			WHERE `email` = '$email'
			AND `password` = '$password';"
		);
		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function getUserForEmail($email)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"SELECT * FROM `users`
			WHERE `email` = '$email';"
		);
		$query->execute();

		$result = $query->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public static function addUser($userData)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"INSERT INTO `users`
			(name, surname, phone, email, password)
			VALUES
			('". $userData['user-name'] . "', '". $userData['user-surname'] . "', '". $userData['user-phone'] . "', '". $userData['user-email'] . "', '". $userData['user-password'] . "');"
		);
		$query->execute();

		return $conn->lastInsertId();
	}

	public static function editUser($userData)
	{
		$pdo = new DBConnection;
		$conn = $pdo->connectionToDatabase();

		$query = $conn->prepare(
			"UPDATE `users`
			SET `name` = '". $userData['user-name'] . "',
				`surname` = '". $userData['user-surname'] . "',
				`phone` = '". $userData['user-phone'] . "',
				`email` = '". $userData['user-email'] . "',
				`password` = '". $userData['user-password'] . "'
			WHERE `email` = '" . $_SESSION['AUTHORIZE']['userEmail'] . "';"
		);
		$query->execute();
	}
}
