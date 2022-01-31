<?php
    //Стус пользователя
    $status = $_SESSION["status"];
    //Размер корзины
	$lenTrash = count($_SESSION["trash"]);
	//Содержимое корзины
	$trash = $lenTrash != 0 ? "Корзина - $lenTrash товар" : "Корзина";
?>
<header>
	<ul class="ctrl-panel">
		<?php switch($status):
            //Свитч кейс статуса
            case "admin": //Админ?>
                <ul class="topmenu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a id="admp" class="widget-title1">Категории</a>
                        <ul class="submenu">
                            <li><h3 class="widget-title"><a id="1" href="category.php?category=Гоночные">Гоночные</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="category.php?category=Горные">Горные</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="category.php?category=Городские">Городские</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="category.php?category=Электротранспорт">Электротранспорт</a></h3></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">Контакты</a></li>
                    <li><a href="trash.php" id="trash_menu_txt"><?=$trash?></a></li>
                    <li><a id="admp" class="widget-title1">Администрирование</a>
                        <ul class="submenu">
                            <li><h3 class="widget-title"><a id="1" href="create.php">Новый пользователь</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="add.php">Добавление товара</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="client.php">Добавление заказчика</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="ord.php">Заказы</a></h3></li>
                        </ul>
                    </li>
                    <li><a href="includes/logout.php">Выход</a></li>
                </ul>
                <?php break; ?>
			<?php case "user": //Пользователь?>
			<ul class="topmenu">
				<li><a href="index.php">Главная</a></li>
                <li><a id="admp" class="widget-title1">Категории</a>
                    <ul class="submenu">
                        <li><h3 class="widget-title"><a id="1" href="category.php?category=Гоночные">Гоночные</a></h3></li>
                        <li><h3 class="widget-title"><a id="3" href="category.php?category=Горные">Горные</a></h3></li>
                        <li><h3 class="widget-title"><a id="3" href="category.php?category=Городские">Городские</a></h3></li>
                        <li><h3 class="widget-title"><a id="3" href="category.php?category=Электротранспорт">Электротранспорт</a></h3></li>
                    </ul>
                </li>
				<li><a href="contact.php">Контакты</a></li>
                <li><a href="trash.php" id="trash_menu_txt"><?=$trash?></a></li>
				<li><a href="includes/logout.php">Выход</a></li>
			</ul>
			<?php break; ?>

			<?php default: //По умолчанию?>
			<ul class="topmenu">
				<li><a href="index.php">Главная</a></li>
                <li><a id="admp" class="widget-title1">Категории</a>
                    <ul class="submenu">
                        <li><h3 class="widget-title"><a id="1" href="category.php?category=Гоночные">Гоночные</a></h3></li>
                        <li><h3 class="widget-title"><a id="3" href="category.php?category=Горные">Горные</a></h3></li>
                        <li><h3 class="widget-title"><a id="3" href="category.php?category=Городские">Городские</a></h3></li>
                        <li><h3 class="widget-title"><a id="3" href="category.php?category=Электротранспорт">Электротранспорт</a></h3></li>
                    </ul>
                </li>
				<li><a href="contact.php">Контакты</a></li>
				<li><a class="" href="signup.php">Вход</a></li>
				<li><a href="registration.php">Регистрация</a></li>
			</ul>
		<?php endswitch; ?>
	</ul>
</header>
