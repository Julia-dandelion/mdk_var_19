<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";
	if($_SESSION["login"] != "") {
		header("Location: /");
	}
	if(!empty($_POST)) {
		if( !db_connect() ) {

			$user = htmlentities(mysqli_real_escape_string($conn, $_POST["login"]));
			$password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
			$repeatpassword = htmlentities(mysqli_real_escape_string($conn, $_POST["repeatpassword"]));

			if (!empty($user))
				if (!db_check_usr($user))
					if (strcmp($password, $repeatpassword) === 0)
						if(!empty($password) || !empty($repeatpassword)){
							add_usr($user, $password);
							header("Refresh: 2; url=index.php");
						} else
							$error = "Пароль не может быть пустым";
					else
						$error = "Пароли не совпадают";
				else
					$error = "Пользователь с таким именем уже существует";
			else
				$error = "Логин не может быть пустым";
			db_close();
			$ok = "Вы зарегистрировались";
		} else
			$error = "Ошибка подключения";
	}

?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>

	<link rel="stylesheet" href="css/registration.css">
	<script src="js/reg.js"></script>
</head>

<body>

	<?php
		require_once "blocks/header.php";
	?>

	<main>
	<?php
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
		<form id="reg" method="post">
			<div class="reg-container">
			  <div class="regtext"><center><h1>Регистрация</h1><center></div>
			  <div class="reglogin"><input  type="email" name="login" placeholder="Введите Ваш e-mail" ></div>
			  <div class="regpasswd"><input  type="password" name="password" placeholder="Ваш сложный пароль" ></div>
				<div class="regpasswdok">	<input  type="password" name="repeatpassword" placeholder="Повторите Ваш сложный пароль" ></div>
			  <div class="regsubm"><input class="loginbut" type="submit" value="Зарегистрироваться"></div>
			</center>
			</div>
		</form>
	</main>
</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
