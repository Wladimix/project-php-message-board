<?php
namespace App\Classes;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Models/User.php');
use App\Classes\Models\User;

class Validation
{
	public static function validateUserName($userName, &$validationFlag)
	{
		if ($userName === '') {
			$validationFlag = true;
			return 'имя не должно быть пустым';
		}
		if (strlen($userName) > 20) {
			$validationFlag = true;
			return 'длина имени не должна превышать 20 символов';
		}

		return null;
	}

	public static function validateUserSurname($userSurname, &$validationFlag)
	{
		if ($userSurname === '') {
			$validationFlag = true;
			return 'фамилия не должна быть пустой';
		}
		if (strlen($userSurname) > 20) {
			$validationFlag = true;
			return 'длина фамилии не должна превышать 20 символов';
		}

		return null;
	}

	public static function validateUserPhone($userPhone, &$validationFlag)
	{
		if ($userPhone === '') {
			$validationFlag = true;
			return 'номер телефона не должен быть пустым';
		}
		if (!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $userPhone)) {
			$validationFlag = true;
			return 'некорректный номер телефона';
		}

		return null;
	}

	public static function validateUserEmail($userEmail, &$validationFlag)
	{
		if ($userEmail === '') {
			$validationFlag = true;
			return 'электронная почта не должна быть пустой';
		}
		if (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i", $userEmail)) {
			$validationFlag = true;
			return 'некорректный адрес электронной почты';
		}

		return null;
	}

	public static function validateUserPassword($userPassword, &$validationFlag)
	{
		if ($userPassword === '') {
			$validationFlag = true;
			return 'пароль не должен быть пустым';
		}
		if (!preg_match("/^[a-zA-Z0-9]+$/i", $userPassword)) {
			$validationFlag = true;
			return 'в пароле разрешены только латинские символы';
		}
		if (strlen($userPassword) < 6) {
			$validationFlag = true;
			return 'минимальная длина пароля - 6 символов';
		}

		return null;
	}

	public static function validateUserConfirm($userPassword, $userConfirm, &$validationFlag)
	{
		if ($userPassword !== $userConfirm) {
			$validationFlag = true;
			return 'пароли не совпадают';
		}

		return null;
	}

	public static function checkUserAvailability($email, &$validationFlag)
	{
		$result = User::getUserForEmail($email);
		if ($result) {
			$validationFlag = true;
			return 'такой пользователь существует';
		}

		return null;
	}
}
