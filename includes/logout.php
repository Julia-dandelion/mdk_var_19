<?php
    //Подключение файла сессии, очистка и уничтожение сессии
	require_once "session.php";
	session_unset();
	session_destroy();
	header("Location: /");
	exit;
?>