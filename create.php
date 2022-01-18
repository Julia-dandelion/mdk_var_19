<?php
require_once "includes/session.php";
require_once "includes/mysqli.php";

db_connect();

if(!empty($_POST))
    var_dump(1);
if(isset($_POST["vender"])) {
    var_dump(2);


    $name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
    $pas_one = htmlentities(mysqli_real_escape_string($conn,$_POST["pas_one"]));
    $pas_two = htmlentities(mysqli_real_escape_string($conn,$_POST["pas_two"]));
    $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));


    add_usr($name, $pas_one, $pas_two, $status);
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
                <option  value="employee">Продавец</option>
            </select>
        </div>

        <input type="submit" name="user" value="Записать в БД">

    </form>
</main>


</body>
<?php require_once "blocks/footer.php"; ?>
</html>
