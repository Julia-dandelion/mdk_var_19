<?php
    if(isset($_SESSION["login"])){
        $status = $_SESSION["status"];
    }
    else{
        $status = "none";
    }
?>
<header>

	<!-- Панель управления -->
	<ul class="ctrl-panel">

		<?php switch($status):
				 case "admin": ?>

			<div  class="widget">
				<ul class="topmenu">
					<li><h3 id="admp" class="widget-title1">Админ. панель</h3>
						<ul class="submenu">
							<!-- <li><h3 class="widget-title"><a id="1" href="create.php">Новый пользователь</a></h3></li> -->
							<li><h3 class="widget-title"><a id="3" href="add.php">Добавление товара</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="vender.php">Добавление поставщика</a></h3></li>
                            <li><h3 class="widget-title"><a id="3" href="ord.php">Заказы</a></h3></li>
						</ul>
					</li>
				</ul>
			</div>

			<!-- -->
			<?php case "user": ?>
			<ul class="topmenu">
				<li><a href="index.php">Главная</a></li>
				<li><a href="contact.php">Контакты</a></li>
				<li><a href="includes/logout.php">Выход</a></li>
			</ul>
			<?php break; ?>

			<?php default: ?>
			<ul class="topmenu">
				<li><a href="index.php">Главная</a></li>
				<li><a href="contact.php">Контакты</a></li>
				<li><a class="" href="sign-up.php">Вход</a></li>
				<li><a href="reg.php">Регистрация</a></li>
			</ul>

		<?php endswitch; ?>
	</ul>
</header>
