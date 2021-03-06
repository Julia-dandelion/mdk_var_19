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
    if(isset($_POST["user"])) {
        //переменные
        $name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
        $pas_one = htmlentities(mysqli_real_escape_string($conn,$_POST["pas_one"]));
        $pas_two = htmlentities(mysqli_real_escape_string($conn,$_POST["pas_two"]));
        $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));
        //Добавление пользователя
        add_user($name, $pas_two, $status);
        $ok = "Пользователь успешно добавлен";
        header("Refresh: 1; url=create.php");
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
    <h2>Добавление пользователя</h2>
    <form id="user" class="add" method="post" enctype="multipart/form-data">
        <div class="box">
            <label>Логин</label>
            <input type="text" placeholder="Логин" name="name" maxlength="50" required>
            <label>Пароль</label>
            <input type="text" placeholder="Пароль" name="pas_one" maxlength="50" required>
            <label>Повтор пароля</label>
            <input type="text" placeholder="Повтор пароля" name="pas_two" maxlength="50" required>
            <label>Тип аккаунта</label>
            <select name="status">
                <option selected value="user">Пользователь</option>
                <option  value="admin">Администратор</option>
            </select>
        </div>

        <input type="submit" name="user" value="Записать в БД">

    </form>
</main>
</body>
<?php require_once "blocks/footer.php"; ?>
</html>
