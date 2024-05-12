<?php
namespace App\Classes;
use PDO;

class DBConnection
{
	private function connectionToServerAndCreateDatabase()
	{
		$pdo = new PDO('mysql:host=mysql_container', 'root', 'root');
		$pdo->query('CREATE DATABASE IF NOT EXISTS message_board');
		$pdo = null;
	}

	public function connectionToDatabase()
	{
		$this->connectionToServerAndCreateDatabase();

		$pdo = new PDO('mysql:host=mysql_container;dbname=message_board', 'root', 'root');

		$pdo->query(
			'CREATE TABLE IF NOT EXISTS `users` (
			`ID` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
			`name` VARCHAR(20) NOT NULL,
			`surname` VARCHAR(20) NOT NULL,
			`phone` VARCHAR(20) NOT NULL,
			`email` TEXT NOT NULL,
			`password` TEXT NOT NULL);'
		);

		$pdo->query(
			'CREATE TABLE IF NOT EXISTS `ads` (
			`ID` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
			`name` TEXT NOT NULL,
			`description` TEXT NOT NULL,
			`photo_src` TEXT DEFAULT NULL,
			`user_ID` INT NOT NULL,
			FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`));'
		);

		return $pdo;
	}
}
