<?php

 $host = 'localhost'; //Сервер бд
 $bd_user = 'root'; //Юзер бд
 $bd_name = ''; //Название бд
 $user_pass = ''; //Пароль бд
 $table = 'getItem'; //Таблица с плагина выдачи предметов
 $item_amount = '1'; //Количество блоков для выдачи
 $conf['secretkey'] = '';
 
 $random[] = '5405'; //id блока №1
 $random[] = '5406'; //id блока №2
 
 srand ((double) microtime() * 1000000);
 $getitem = rand(0,count($random)-1); //Выборка из рандома
 $timestamp = $_POST['timestamp']; //Передает время, когда человек проголосовал за проект
 $username = htmlspecialchars($_POST['username']); //Передает Имя проголосовавшего за проект

 mysql_connect($host, $bd_user, $user_pass) or die('error connect');
 mysql_select_db($bd_name) or die('error select');
 
  if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) die("Bad login");
 
 if ($_POST['signature'] != sha1($username.$timestamp.$conf['secretkey'])) die("hash mismatch");
  $sql_username = strtolower($username);
  mysql_query("INSERT INTO $table (player, item, amount) VALUES ('$sql_username', '$random[$getitem]', '$item_amount')")or die(mysql_error());
  echo 'OK<br />';
  mysql_query($sql);

?>