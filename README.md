# Доска объявлений на PHP

<p align="center">
  <img src="https://github.com/devicons/devicon/blob/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/nginx/nginx-original.svg#L1" title="NGINX" alt="NGINX" width="200" height="200">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://github.com/devicons/devicon/blob/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/php/php-original.svg?plain=1" title="PHP" alt="PHP" width="200" height="200">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://github.com/devicons/devicon/blob/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/mysql/mysql-plain-wordmark.svg?plain=1" title="MYSQL" width="200" height="200"><br>
  <img src="https://github.com/devicons/devicon/blob/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/html5/html5-plain.svg?plain=1" title="HTML" alt="HTML" width="200" height="200">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://github.com/devicons/devicon/blob/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/css3/css3-original.svg" title="CSS" alt="CSS" width="200" height="200">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <img src="https://github.com/devicons/devicon/blob/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/docker/docker-plain.svg?plain=1" title="DOCKER" alt="DOCKER" width="200" height="200">
</p>



## Описание
Простой локальный сайт. Позволяет зарегистрироваться и выкладывать свои объявления, видимые другим пользователям. Присутствует возможность редактирования и удаления собственных объявлений, а также редактирования данных своего профиля.
## Развёртывание
Среда для функционирования сайта размещена в контейнерах Docker.
### docker compose
В папке присутствует compose файл.<br>
Для запуска среды необходимо выполнить команду:
```
docker compose -f docker_compose.yml up -d
```
Присутствует проблема с доступом к папке с сайтом внутри контейнера с PHP во время загрузки фотографий объявлений. Для её решения потребуется дополнительно зайти в терминал контейнера с PHP:
```
docker exec -it php_container bash
```
Внутри выполнить команду:
```
chown -R www-data:www-data /var/www/my_site
```
И выйти:
```
exit
```
### docker run
Запускать контейнеры можно по отдельности командой run.<br>
Сначала нужно сбилдить контейнеры Nginx и PHP из docker-файлов:
```
docker build -f dockerfile.php -t  my_php_8.1 .
```
```
docker build -f dockerfile.nginx -t  my_nginx .
```
Далее создаём внутреннюю сеть для контейнеров:
```
docker network create my_network
```
После этого можно запускать контейнеры в следующем порядке:
```
docker run -d -v ./App/Database/mysql_data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root --network my_network --name mysql_container mysql:8.4
docker run -d -p 3002:80 -e PMA_HOST=mysql_container --network my_network --name phpmyadmin_container phpmyadmin:5.2.1
docker run -d -v ./:/var/www/my_site --network my_network --name php_container my_php_8.1
docker run -d -p 3001:3001 -v ./nginx.conf:/etc/nginx/conf.d/nginx.conf -v ./:/var/www/my_site --network my_network --name nginx_container my_nginx
```
Аналогично запуску через compose для возможности загрузки фото нужно дать права на папку сайта в контейнере:
```
docker exec -it php_container bash
```
```
chown -R www-data:www-data /var/www/my_site && exit
```
### Адрес
После запуска сайт доступен на 3001 порте:<br>http://localhost:3001<br>
Для управления базой данных используется PHPMyAdmin на 3002 порте:<br>http://localhost:3002<br>
## Фиктивные данные
Чтобы заполнить таблицу некоторыми данными, нужно перейти по ссылке:<br>
http://localhost:3001/App/Database/seed.php<br>
В результате в таблице появляются 3 объявления и пользователь с почтой <b>test@test.ru</b> и паролем <b>111111</b>.
