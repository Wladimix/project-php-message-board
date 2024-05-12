<?php session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Header.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Controllers/UserController.php');
use App\Classes\Header;
use App\Classes\Controllers\UserController;

UserController::editUser($_POST);
echo Header::makeHeader('Регистрация');
?>

<div class="container">
	<?if (isset($_SESSION['AUTHORIZE'])):?>

		<div class="authorization-form">
			<form method="POST" enctype="multipart/form-data">
				<label for="user-name">Имя</label><br />
				<input id="user-name" name="user-name" type="text" value="<?=$_SESSION['AUTHORIZE']['userName'] ?? ''?>" /><br />
				<label for="user-surname">Фамилия</label><br />
				<input id="user-surname" name="user-surname" type="text" value="<?=$_SESSION['AUTHORIZE']['userSurname'] ?? ''?>" /><br />
				<label for="user-phone">Номер телефона</label><br />
				<input id="user-phone" name="user-phone" type="text" value="<?=$_SESSION['AUTHORIZE']['userPhone'] ?? ''?>" /><br />
				<label for="user-email">Электронная почта</label><br />
				<input id="user-email" name="user-email" type="text" value="<?=$_SESSION['AUTHORIZE']['userEmail'] ?? ''?>" /><br />
				<label for="user-password">Пароль</label><br />
				<input id="user-password" name="user-password" type="text" value="<?=$_SESSION['AUTHORIZE']['userPassword'] ?? ''?>" /><br />
				<label for="user-confirm">Подтверждение пароля</label><br />
				<input id="user-confirm" name="user-confirm" type="text" value="" /><br />
				<input type="submit" value="Редактировать">
			</form>
			<?if (!empty($_SESSION['ERRORS']) && !empty($_POST)):?>
				<div class="input-errors">
					<ul>
						<?foreach ($_SESSION['ERRORS'] as $error):?>
							<? echo ($error ? "<li>$error</li>" : '')?>
						<?endforeach;?>
					</ul>
				</div>
			<?endif;?>
		</div>

	<?else:?>
		<div class="logged-successfully-message">Вы не авторизованы.</div>
		<a class="authorization-form-button-link" href="./authorization.php">Авторизоваться</a>
	<?endif;?>
</div>
