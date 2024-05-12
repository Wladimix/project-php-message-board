<?php
namespace App\Classes\Controllers;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Models/User.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Validation.php');
use App\Classes\Models\User;
use App\Classes\Validation;

class UserController
{
	public static function authorization($dataQuery)
	{
		if (isset($dataQuery['user-email']) && isset($dataQuery['user-password'])) {
			$user = User::getUser($dataQuery['user-email'], $dataQuery['user-password']);

			if (!empty($user)) {
				$_SESSION['AUTHORIZE'] = [
					'userID' => $user['ID'],
					'userName' => $user['name'],
					'userSurname' => $user['surname'],
					'userPhone' => $user['phone'],
					'userEmail' => $user['email'],
					'userPassword' => $user['password']
				];
				$_SESSION['ERRORS'] = null;
			} else {
				$_SESSION['AUTHORIZE'] = null;
				$_SESSION['ERRORS'] = [
					'почта или пароль неверны'
				];
			}
		}

		if (isset($dataQuery['logout']) && $dataQuery['logout'] == 'yes') {
			$_SESSION['AUTHORIZE'] = null;
			header('Location: ./authorization.php');
		}
	}

	public static function registration($dataQuery)
	{
		$_SESSION['ERRORS'] = null;

		if (
			isset($dataQuery['user-name']) &&
			isset($dataQuery['user-surname']) &&
			isset($dataQuery['user-phone']) &&
			isset($dataQuery['user-email']) &&
			isset($dataQuery['user-password']) &&
			isset($dataQuery['user-confirm'])
		) {
			$validationFlag = false;
			$validationResults = [];
			$validationResults[] = Validation::validateUserName($dataQuery['user-name'], $validationFlag);
			$validationResults[] = Validation::validateUserSurname($dataQuery['user-surname'], $validationFlag);
			$validationResults[] = Validation::validateUserPhone($dataQuery['user-phone'], $validationFlag);
			$validationResults[] = Validation::validateUserEmail($dataQuery['user-email'], $validationFlag);
			$validationResults[] = Validation::validateUserPassword($dataQuery['user-password'], $validationFlag);
			$validationResults[] = Validation::validateUserConfirm($dataQuery['user-password'], $dataQuery['user-confirm'], $validationFlag);
			$validationResults[] = Validation::checkUserAvailability($dataQuery['user-email'], $validationFlag);

			if (!$validationFlag) {
				$newUserId = User::addUser($dataQuery);

				$_SESSION['AUTHORIZE'] = [
					'userID' => $newUserId,
					'userName' => $dataQuery['user-name'],
					'userSurname' => $dataQuery['user-surname'],
					'userPhone' => $dataQuery['user-phone'],
					'userEmail' => $dataQuery['user-email'],
					'userPassword' => $dataQuery['user-password']
				];
			} else {
				$_SESSION['ERRORS'] = [];
				foreach ($validationResults as $itemValidationResult) {
					array_push($_SESSION['ERRORS'], $itemValidationResult);
				}
			}
		}
	}

	public static function editUser($dataQuery)
	{
		$_SESSION['ERRORS'] = null;

		if (
			isset($dataQuery['user-name']) &&
			isset($dataQuery['user-surname']) &&
			isset($dataQuery['user-phone']) &&
			isset($dataQuery['user-email']) &&
			isset($dataQuery['user-password']) &&
			isset($dataQuery['user-confirm'])
		) {
			$validationFlag = false;
			$validationResults = [];
			$validationResults[] = Validation::validateUserName($dataQuery['user-name'], $validationFlag);
			$validationResults[] = Validation::validateUserSurname($dataQuery['user-surname'], $validationFlag);
			$validationResults[] = Validation::validateUserPhone($dataQuery['user-phone'], $validationFlag);
			$validationResults[] = Validation::validateUserEmail($dataQuery['user-email'], $validationFlag);
			$validationResults[] = Validation::validateUserPassword($dataQuery['user-password'], $validationFlag);
			$validationResults[] = Validation::validateUserConfirm($dataQuery['user-password'], $dataQuery['user-confirm'], $validationFlag);

			if (!$validationFlag) {
				User::editUser($dataQuery);

				$currentUserId = $_SESSION['AUTHORIZE']['userID'];
				$_SESSION['AUTHORIZE'] = [
					'userID' => $currentUserId,
					'userName' => $dataQuery['user-name'],
					'userSurname' => $dataQuery['user-surname'],
					'userPhone' => $dataQuery['user-phone'],
					'userEmail' => $dataQuery['user-email'],
					'userPassword' => $dataQuery['user-password']
				];
			} else {
				$_SESSION['ERRORS'] = [];
				foreach ($validationResults as $itemValidationResult) {
					array_push($_SESSION['ERRORS'], $itemValidationResult);
				}
			}
		}
	}
}
