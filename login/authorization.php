<?php session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Header.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/Controllers/UserController.php');
use App\Classes\Header;
use App\Classes\Controllers\UserController;

UserController::authorization($_REQUEST);
echo Header::makeHeader('Авторизация');
?>

<div class="container">
	<?if (!isset($_SESSION['AUTHORIZE'])):?>

		<div class="authorization-form">
			<form method="POST">
				<label for="user-email">Электронная почта</label><br />
				<input id="user-email" name="user-email" type="text" value="<?=$_POST['user-email'] ?? ''?>" /><br />
				<label for="user-password">Пароль</label><br />
				<input id="user-password" name="user-password" type="text" value="<?=$_POST['user-password'] ?? ''?>"/><br />
				<input type="submit" value="Войти">
			</form>

			<?if (isset($_SESSION['ERRORS']) && !empty($_POST)):?>
				<div class="input-errors">
					<ul>
						<?foreach ($_SESSION['ERRORS'] as $error):?>
							<li><?echo $error;?></li>
						<?endforeach;?>
					</ul>
				</div>
			<?endif;?>
		</div>
		<a class="authorization-form-button-link" href="./registration.php">Регистрация</a>

	<?else:?>
		<div class="logged-successfully-message">Вы зарегистрированы и успешно авторизовались.</div>
		<a class="authorization-form-button-link" href="../index.php">На главную</a>
	<?endif;?>
</div>
