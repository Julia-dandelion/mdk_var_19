<?php
	require_once "includes/session.php";
    //Проверка наличия авторизации
    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    }
    else{
        header("Location: /signup.php");
    }
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
</head>
<body>
	<?php 	require_once "blocks/header.php"; ?>
    <center>
	<main>
	<center><h1>	Контакты </h1></center>
    <table style = 'padding-top:25px; margin-bottom: 15%; margin-top: 10%'>
        <tr>
                <h2>Задайте вопрос и получите
                компетентный ответ</h2>
                Клиентская служба "Велоспорт"
                7 (800) 422-14-14
                или напишите письмо.
        </tr>
            <tr>
                <h2>Почтовый адрес</h2>
                445024
                Российская Федерация
                Самарская область
                г. Тольятти
                Южное шоссе, 36
            </tr>
    </table>
	</main>
    </center>
</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
