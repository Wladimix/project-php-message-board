<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/App/Classes/DBConnection.php');
use App\Classes\DBConnection;

$pdo = new DBConnection;
$conn = $pdo->connectionToDatabase();

$query = $conn->prepare(
	"DELETE FROM `ads`;"
);
$query->execute();

$query = $conn->prepare(
	"DELETE FROM `users`;"
);
$query->execute();

$query = $conn->prepare(
	"INSERT INTO `users`
	(name, surname, phone, email, password)
	VALUES
	('Тест', 'Тестов', '+79998887766', 'test@test.ru', '111111');"
);
$query->execute();
$fakeUserId = $conn->lastInsertId();

$query = $conn->prepare(
	"INSERT INTO `ads`
	(name, description, user_ID)
	VALUES
	('Ноутбук в отличном состоянии', 'Предлагаю к продаже свой ноутбук в идеальном состоянии. Ноутбук фирмы Dell, модель Inspiron. Процессор Intel Core i5, оперативная память 8 ГБ, жесткий диск 1 ТБ. Экран 15,6 дюймов, разрешение Full HD. Есть все необходимые порты и разъемы, включая USB 3.0 и HDMI. Ноутбук работает на операционной системе Windows 10. В комплекте идет зарядное устройство. Использовался бережно, без механических повреждений. Готов ответить на все ваши вопросы. Торг уместен.', '$fakeUserId');"
);
$query->execute();

$query = $conn->prepare(
	"INSERT INTO `ads`
	(name, description, user_ID)
	VALUES
	('Велосипед в отличном состоянии', 'Продаю свой велосипед марки Stels, модель Navigator 700. Велосипед в идеальном состоянии, использовался аккуратно. Рама выполнена из стали, размер 19 дюймов. Колеса диаметром 26 дюймов. Оборудован передними и задними тормозами типа V-brake. 18 скоростей. В комплекте идут крылья, подножка и звонок. Возможен торг, самовывоз.', '$fakeUserId');"
);
$query->execute();

$query = $conn->prepare(
	"INSERT INTO `ads`
	(name, description, user_ID)
	VALUES
	('Детская коляска в отличном состоянии', 'Продаю детскую коляску марки Baby Care, модель Sigma. Коляска в идеальном состоянии, использовалась аккуратно. Рама выполнена из алюминия, вес всего 7 кг. Колеса надувные, диаметром 20 см. Спинка регулируется до положения лёжа. Есть корзина для покупок и подстаканник. В комплекте идёт чехол на ножки и дождевик. Возможен торг, самовывоз.', '$fakeUserId');"
);
$query->execute();
