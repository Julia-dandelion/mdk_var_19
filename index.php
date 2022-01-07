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
				<img class='img_main_one' src='img/гоночные1.jpg'>
				</a><br>
		</div>

		<div class='dv_main'>
			<a href="category.php?category=Горные">
				<img class='img_main_one' src='img/горные1.jpg'>
				</a><br>
		</div>

		<div class='dv_main'>
			<a href="category.php?category=Городские">
				<img class='img_main_one' src='img/городские1.jpg'>
				</a><br>
		</div>

		<div class='dv_main'>
			<a href="category.php?category=Электротранспорт">
				<img class='img_main_one' src='img/электротранспорт1.jpg'>
					</a><br>
		</div>
            <br>
            <div class='dv_main'>
                <a href="category.php?category=Гоночные">
                    <img class='img_main_one' src='img/гоночные2.jpg'>
                    </a><br>
            </div>

            <div class='dv_main'>
                <a href="category.php?category=Горные">
                    <img class='img_main_one' src='img/горные2.jpg'>
                   </a><br>
            </div>

            <div class='dv_main'>
                <a href="category.php?category=Городские">
                    <img class='img_main_one' src='img/городские2.jpg'>
                    </a><br>
            </div>

            <div class='dv_main'>
                <a href="category.php?category=Электротранспорт">
                    <img class='img_main_one' src='img/электротранспорт2.jpg'>
                </a><br>
            </div>

            <h1 class='ctrh'>Рекомендуем</h1>
            <div class='dv_main_under'>
                <a href="category.php?category=Горные">
                    <img class='img_main_two' src='img/горные3.jpg'>
                </a><br>
            </div>

            <div class='dv_main_under'>
                <a href="category.php?category=Городские">
                    <img class='img_main_two' src='img/городские3.jpg'>
                </a><br>
            </div>

            <div class='dv_main_under'>
                <a href="category.php?category=Электротранспорт">
                    <img class='img_main_two' src='img/электротранспорт3.jpg'>
                </a><br>
            </div>
		</center>
	</main>
</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
