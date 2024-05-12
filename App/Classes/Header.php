<?php
namespace App\Classes;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Constants.php');
use App\Classes\Constants;

class Header
{

	public static function makeHeader($pageTitle)
	{

		$siteURL = 'http://' . $_SERVER['HTTP_HOST'];
		$currentURL = $siteURL . $_SERVER['REQUEST_URI'];
		$pagesURL = [
			'index' => $siteURL . '/index.php',
			'ads' => $siteURL . '/ads/ads_list.php',
			'about' => $siteURL . '/about.php',
			'reviews' => $siteURL . '/reviews.php'
		];

		$profileButtonsContent = '';
		if (isset($_SESSION['AUTHORIZE'])) {
			$profileButtonsContent = '
				<div class="header-profile-button">
					<a class="header-profile-button-link" href="'. $siteURL . '/login/profile.php">ПРОФИЛЬ</a>
				</div>
				<div class="header-logout-button">
					<a class="header-logout-button-link" href="'. $siteURL . '/login/authorization.php?logout=yes">
						<img src="'. $siteURL . '/images/icons/logout-svgrepo-com.svg" width="50px" height="50px">
					</a>
				</div>
			';
		} else {
			$profileButtonsContent = '
				<div class="header-profile-button">
					<a class="header-profile-button-link" href="'. $siteURL . '/login/authorization.php">ВОЙТИ</a>
				</div>
			';
		}

		return '
			<!DOCTYPE html>
			<html lang="ru">
				<head>
					<title>' . $pageTitle . '</title>
					<link href="http://' . $_SERVER['HTTP_HOST'] . '/styles/style.css" rel="stylesheet" />
				</head>

				<body>

					<div class="header">
						<div class="container">
							<div class="header-line">
								<div class="header-logo">
									<a href="' . $siteURL . '/index.php">
										<img src="http://' . $_SERVER['HTTP_HOST'] . '/images/icons/php-svgrepo-com.svg" width="65px" height="65px">
									</a>
								</div>
								<div class="header-nav">
									<a class="header-nav-item ' . ($currentURL === $pagesURL['index'] ? 'active' : '') . '" href="' . $pagesURL['index'] . '">ГЛАВНАЯ</a>
									<a class="header-nav-item ' . (($currentURL === $pagesURL['ads']) || ($currentURL === $pagesURL['ads'] . '?ads=' . Constants::MY_ADV) || ($currentURL === $pagesURL['ads'] . '?ads=')   ? 'active' : '') . '" href="' . $pagesURL['ads']   . '">ОБЪЯВЛЕНИЯ</a>
									<a class="header-nav-item ' . ($currentURL === $pagesURL['about'] ? 'active' : '') . '" href="' . $pagesURL['about'] . '">О НАС</a>
									<a class="header-nav-item ' . ($currentURL === $pagesURL['reviews'] ? 'active' : '') . '" href="' . $pagesURL['reviews'] . '">ОТЗЫВЫ</a>
								</div>
								<div class="header-phone">
									<div class="header-phone-holder">
										<div class="header-phone-img">
											<img src="http://' . $_SERVER['HTTP_HOST'] . '/images/icons/phone-svgrepo-com.svg" width="50px">
										</div>
										<div class="header-phone-number">
											<a class="header-phone-number-link" href="#">+999-888-76-54</a>
										</div>
									</div>
									<div class="header-phone-text">
										Свяжитесь с нами для получения<br />информации
									</div>
								</div>
								<div class="header-profile-buttons">
									' . $profileButtonsContent . '
								</div>
							</div>
						</div>
					</div>
		';
	}

}
