<?php

use App\Core\Routing\Router;

// включаем автозагрузку классов. Нам не нужно указывать require в классах
require_once './vendor/autoload.php';

//todo
//описать 5ю - 7ю тезисами работу такси приложения
//1. Я как пассажир могу зарегистрироваться в приложении для вызова такси
//2. Я как пассажир могу создать заказ в приложении
//3. Я как пассажир могу отменить заказ в приложении
//4. Я как водитель могу зарегистрироваться в приложении
//5. Я как водитель могу принять заказ
//6. Я как водитель могу отказаться от заказа
//7. Я как пользователь могу посмотреть статстику
//8. Я как водитель могу завершить заказ

//todo
//1. досоздать все таблицы
//2. тестовые данные минимум 10


// php и mysql

//
//echo "<html> <body>";
//echo "<h1> TAXI </h1>";
//echo "<ul>";
//$stmt = $db->query("SELECT * FROM users");
//while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
//    echo "<li>";
//    echo "Username: " . $row->login;
//    echo "</li>";
//}
//
//echo "</ul>";
//echo "</body> </html>";

//todo
//1. построить админку
//2. уметь в браузере увидеть всех пользователей ( url GET /users)
//3. уметь из браузера создать пользователя ( url POST /users)
//4. уметь в браузере удалить пользователя ( url DELETE /users/1)


//add
//$user = new User(null, 'Sergey', '12341234', 'sergey@mail.ru', 1);


//$userController = new \App\Http\UserController();
//$userController->delete(18);

// todo в отдельный файл require, include
include 'routing.php';
