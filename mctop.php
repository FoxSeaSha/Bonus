<?php

	$secret_key = ''; # Вставляем сюда и на сайт секретное слово, 
	$host = 'localhost'; # Указываем IP сервера, на котором стоит База Данных
	$bd_user = 'root'; # Пользователь базы данных
	$bd_name = ''; # Название базы данных
	$user_pass = ''; # Пароль от базы данных
	$table = 'getItem'; //Таблица с плагина выдачи предметов
	$item_amount = '1'; //Количество блоков для выдачи

	$random[] = '5405'; //id блока №1
	$random[] = '5406'; //id блока №2

	srand ((double) microtime() * 1000000);
	$getitem = rand(0,count($random)-1); //Выборка из рандома
	if(isset($_GET['nickname']) && isset($_GET['token']))	
	{

	    $nickname = $_GET['nickname'];

	    $token = $_GET['token'];

	    if($token == md5($nickname.$secret_key))
        {
            $con = mysqli_connect($host, $bd_user, $user_pass, $bd_name);

            if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            mysqli_query($con, "INSERT INTO $table (player, item, amount) VALUES ('{$nickname}', '$random[$getitem]', '$item_amount')") or die(mysqli_error($con));

            mysqli_close($con);
        }

    }

?>