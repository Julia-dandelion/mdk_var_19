<?php
	require_once "includes/mysqli.php";
    require_once "includes/session.php";

    //Проверка наличия авторизации
    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    }
    else{
        header("Location: /signup.php");
    }

	if($_POST["delite_ord"])
	{
		$id = $_POST["delite_ord"];
		if(!db_connect())
		{
			delite_ord($id);
			db_close();
            $ok = "Заказ успешно удален";
            header("Refresh: 1; url=ord.php");
		}
		else
		{
			$error = "Ошибка подключения!";
		}
	}
?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
    <?php require_once "blocks/head.php"; ?>
</head>
<body>
    <?php require_once "blocks/header.php"; //Модуль навигационного меню?>
    <?php //вывод ошибок\оповещений об успехе
    if(isset($error))
        echo <<<_OUT
				<div id="msg-error" class="msg msg-error">
					<div>$error</div>
					<div class="closed" onclick="msgClose('msg-error')">&#10006;</div>
				</div>
_OUT;
    else if(isset($ok))
        echo <<<_OUT
				<div id="msg-ok" class="msg msg-ok">
					<div>$ok</div>
					<div class="closed" onclick="msgClose('msg-ok')">&#10006;</div>
				</div>
_OUT;
    ?>
    <center>
	<form id="main" style="font-size: 14pt" method="post">
		<table>
			<tr>
				<th>Время</th>
				<th>Цена</th>
				<th>id пользователя</th>
				<th>Продукт</th>
				<th>Статус</th>
			</tr>
			<?php
				if(!db_connect())
				{
				    //Получаем всек заказы
					$query = "SELECT * FROM orders";
					$res2 = mysqli_query($conn, $query);
					//Выводим всае заказы
					while ($result = mysqli_fetch_array($res2)) {
						if($result['status'] == 'closed') {
							$st = "Закрыт";
						}elseif($result['status'] == 'processed'){
							$st = "В процессе";
						}else{
							$st = "Просрочен";
						}

						echo <<<_OUT
							<tr>
								<td>{$result['time']}</td>
								<td>{$result['price']}</td>
								<td>{$result['user_id']}</td>
								<td>{$result['status']}</td>
								<td>$st</td>
								<td><button name="delite_ord" value="{$result['id']}">Удалить</button></td>
							</tr>
_OUT;
					}
				}
				else
				{
					$error = "Ошибка подключения!";
				}
			?>
		</table>
	</form>
    </center>
</body>
<footer>
    <?php require_once "blocks/footer.php"; //подвал?>
</footer>
