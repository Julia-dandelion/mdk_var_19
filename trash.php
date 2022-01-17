<?php
	require_once "includes/session.php"; // на каждой странице
	require_once "includes/mysqli.php";

    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    } else
        header("Location: /");


	if(isset($_POST["submit"])) {
		
		db_connect();
		
		$total_price = $_SESSION["total_price"];
		$trash = json_encode($_SESSION["trash"], JSON_UNESCAPED_UNICODE);
		
		add_order($total_price, $_SESSION["login"], $trash);
		
		//var_dump($_SESSION["trash"]);
		
		unset($_SESSION["trash"]);
		unset($_SESSION["total_price"]);
		
		db_close();
		
	}
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	
	<link rel="stylesheet" href="css/trash.css">
</head>

<body>

	<?php 
		require_once "blocks/header.php"; // шапка сайта
	?>
	
	<main>
		<h2><p align="center">Корзина пользователя <?=$user?></p></h2>
		<?php

			if(isset($_SESSION["trash"])){
			
				$total_price = 0; // 0 рублей
				foreach($_SESSION["trash"] as $key => $val){
					$id = $val["id"];
					$name = $val["name"];
					$price = $val["price"];
					$decsription = $val["description"];
					$img = $val["img"] == "" ? "img/no-img.png" : $val["img"];
					
					$total_price += $price;
					
					$article = <<<_OUT
						<article id="$id">
							<header class="name">$name</header>
							<div class="wrap">
								<figure>
									<img src="$img" class="fly">
								</figure>
							
							<p class="description">$decsription</p>
							</div>
							<a href="viewer.php?product=$id" class="btn">Посмотреть</a>
							<footer class="price">$price</footer>
							
						
						</article>
_OUT;

					echo $article;
					
				}
					echo <<<_OUT
						<div class="total">
							Итого: $total_price рублей
						</div>
_OUT;
					$_SESSION["total_price"] = $total_price;
				
			?>
			
			<form method="POST" action="">
				<input type="submit" class="submit" name="submit" value="Заказать">
			</form>
			
			<?php } else {?>
				<p>Ваша корзина пуста</p>
			<?php }?>
	</main>
	

</body>

</html>