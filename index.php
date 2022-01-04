<?php
	require_once "includes/session.php";
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
</head>

<body>

	<?php 	require_once "blocks/header.php"; ?>

	<main>
		<center>
		<h1 class='ctrh'>Популярное</h1>
		<div class='dv_main'>
			<a href="category.php?category=Гоночные">
				<img class='img_main_one' src='img/гоночные.jpg'>
				</a><br>
		</div>

		<div class='dv_main'>
			<a href="category.php?category=Горные">
				<img class='img_main_one' src='img/горные.jpg'>
				</a><br>
		</div>

		<div class='dv_main'>
			<a href="category.php?category=Городские">
				<img class='img_main_one' src='img/городские.jpg'>
				</a><br>
		</div>

		<div class='dv_main'>
			<a href="category.php?category=Электротранспорт">
				<img class='img_main_one' src='img/электротранспорт.jpg'>
					</a><br>
		</div>
            <br>
            <div class='dv_main'>
                <a href="category.php?category=Гоночные">
                    <img class='img_main_one' src='img/гоночные.jpg'>
                    </a><br>
            </div>

            <div class='dv_main'>
                <a href="category.php?category=Горные">
                    <img class='img_main_one' src='img/горные.jpg'>
                   </a><br>
            </div>

            <div class='dv_main'>
                <a href="category.php?category=Городские">
                    <img class='img_main_one' src='img/городские.jpg'>
                    </a><br>
            </div>

            <div class='dv_main'>
                <a href="category.php?category=Электротранспорт">
                    <img class='img_main_one' src='img/электротранспорт.jpg'>
                </a><br>
            </div>

            <h1 class='ctrh'>Рекомендуем</h1>
            <div class='dv_main_under'>
                <a href="category.php?category=Горные">
                    <img class='img_main_two' src='img/горные.jpg'>
                </a><br>
            </div>

            <div class='dv_main_under'>
                <a href="category.php?category=Городские">
                    <img class='img_main_two' src='img/городские.jpg'>
                </a><br>
            </div>

            <div class='dv_main_under'>
                <a href="category.php?category=Электротранспорт">
                    <img class='img_main_two' src='img/электротранспорт.jpg'>
                </a><br>
            </div>
		</center>
	</main>
</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
