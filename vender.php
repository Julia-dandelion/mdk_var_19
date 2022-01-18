<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

	db_connect();

	if(!empty($_POST))
	    var_dump(1);
		if(isset($_POST["vender"])) {
		    var_dump(2);


			$name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
			$inn = htmlentities(mysqli_real_escape_string($conn,$_POST["inn"]));
			$direct = htmlentities(mysqli_real_escape_string($conn,$_POST["direct"]));
            $phone_num = htmlentities(mysqli_real_escape_string($conn, $_POST["phone_num"]));
            $legal_ad = htmlentities(mysqli_real_escape_string($conn, $_POST["legal_ad"]));
            $physical_ad = htmlentities(mysqli_real_escape_string($conn, $_POST["physical_ad"]));
            $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));

			add_venders($name, $inn, $direct, $phone_num, $legal_ad, $physical_ad, $status);
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
                <label>Статус наличия</label>
                <select name="status">
                    <option value="0">Не активен</option>
                    <option selected value="1">Активен</option>
                </select>
			</div>

			<input type="submit" name="vender" value="Записать в БД">

		</form>
	</main>


</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
