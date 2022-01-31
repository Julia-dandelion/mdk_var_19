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

	if(!empty($_POST))
		if(isset($_POST["vender"])) {
            //переменные
			$name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
			$inn = htmlentities(mysqli_real_escape_string($conn,$_POST["inn"]));
			$direct = htmlentities(mysqli_real_escape_string($conn,$_POST["direct"]));
            $phone_num = htmlentities(mysqli_real_escape_string($conn, $_POST["phone_num"]));
            $legal_ad = htmlentities(mysqli_real_escape_string($conn, $_POST["legal_ad"]));
            $physical_ad = htmlentities(mysqli_real_escape_string($conn, $_POST["physical_ad"]));
            $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));

            //добавляем заказчика
			add_client($name, $inn, $direct, $phone_num, $legal_ad, $physical_ad, $status);
            $ok = "Клиент успешно добавлен";
            header("Refresh: 1; url=client.php");
		}
	db_close();
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/add.css">
</head>
<body>
	<?php
		require_once "blocks/header.php";
	?>
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
	<main>
		<h2>Добавление поставщика</h2>
		<form id="vender" class="add" method="post" enctype="multipart/form-data">
			<div class="box">
				<label>Название</label>
				<input type="text" placeholder="Название" name="name" maxlength="50" required>
                <label>ИНН</label>
                <input type="text" placeholder="инн" name="inn" maxlength="50" required>
                <label>Директор</label>
                <input type="text" placeholder="ФИО" name="direct" maxlength="50" required>
                <label>Телефон</label>
                <input type="text" placeholder="номер" name="phone_num" maxlength="50" required>
                <label>Юридический адрес</label>
                <input type="text" placeholder="адрес" name="legal_ad" maxlength="50" required>
                <label>Физический адрес</label>
                <input type="text" placeholder="адрес" name="physical_ad" maxlength="50" required>
                <label>Статус</label>
                <select name="status">
                    <option value="0">Физ.лицо</option>
                    <option selected value="1">Юр.лицо</option>
                </select>
			</div>

			<input type="submit" name="vender" value="Записать в БД">

		</form>
	</main>
</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
