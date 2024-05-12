<?php session_start();
require_once ('./App/Classes/Header.php');
use App\Classes\Header;

echo Header::makeHeader('О нас');
?>

<div class="page-title-about-block">
	<div class="page-title-about-sybblock">
		<div class="page-title-about">О нас</div>
		<div class="page-subtitle-about">УЗНАЙТЕ О НАС ПОБОЛЬШЕ</div>
	</div>
</div>

<div class="cards">
	<div class="container">
		<div class="cards-holder">
			<div class="card">
				<div class="card-image">
					<img class="card-img" src="./images/icons/home-house-svgrepo-com.svg" width="75px">
				</div>
				<div class="card-title">
					Широкий <span>Спектр</span>
				</div>
				<div class="card-desc">
					У нас Вы найдёте объявления на любой вкус:
					будь то недвижимость и земельные участки, либо бытовая техника и запчасти к ней.
				</div>
			</div>
			<div class="card">
				<div class="card-image">
					<img class="card-img" src="./images/icons/exclamation-mark-svgrepo-com.svg" width="75px">
				</div>
				<div class="card-title">
					Высокие <span>Рейтинги</span>
				</div>
				<div class="card-desc">
					Наши дорогие пользователи не скупятся на хорошие отзывы и оценки.
					Воспользуйтесь нашими услугами и убедитесь в этом сами.
				</div>
			</div>
			<div class="card">
				<div class="card-image">
					<img class="card-img" src="./images/icons/book-open-svgrepo-com.svg" width="75px">
				</div>
				<div class="card-title">
					Богатая <span>История</span>
				</div>
				<div class="card-desc">
					За всё время нашей работы мы менялись, эволюционировали.
					Но подход к пользователям остался таким же качественным.
				</div>
			</div>
		</div>
	</div>
</div>

<div class="history">
	<div class="history-holder">
		<div class="history-info">
			<div class="history-title">
				Наша <span>История</span>
			</div>
			<div class="history-desc">
				Однажды талантливый программист создал сайт объявлений.
				Он вложил в него всю свою душу и знания. Сайт получился удобным и функциональным.
				Люди быстро оценили его преимущества перед газетами и журналами.
				Через несколько лет сайт стал популярным ресурсом, где люди могли продавать свои вещи,
				обмениваться ими, искать работу и жильё.
			</div>
			<div class="history-number">
				<div class="history-number-item">
					3476 <span>объявлений</span>
				</div>
				<div class="history-number-item">
					20 <span>наград</span>
				</div>
				<div class="history-number-item">
					800 <span>пользователей</span>
				</div>
			</div>
		</div>
		<div class="history-images">
			<img class="history-image-1" src="images/default_picture_1.jpg" height="350px">
			<img class="history-image-2" src="images/default_picture_2.jpg" height="350px">
			<img class="history-image-3" src="images/default_picture_3.jpg" width="350">
		</div>
	</div>
</div>
