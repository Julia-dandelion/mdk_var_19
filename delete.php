<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

    //Проверка наличия авторизации
    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    }
    else{
        header("Location: /signup.php");
    }

	db_connect();
	//Получаем id продукта
	$id = $_GET["product"];
	//Удаляем продукт
	delete_product($id);
    //Обновляем страницу
	header("Refresh: 1; url=" . $_SERVER['HTTP_REFERER'] );
	db_close();


?>