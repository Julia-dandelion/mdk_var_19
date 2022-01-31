<?php
	require_once "includes/session.php"; // на каждой странице
	require_once "includes/mysqli.php";

    //Проверка наличия авторизации
    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    }
    else{
        header("Location: /signup.php");
    }
    //Очистка корзины
    if(isset($_POST["clear"])) {
        unset($_SESSION["trash"]);
        unset($_SESSION["total_price"]);
        header("Refresh: 2; url=trash.php");
    }

	if(isset($_POST["submit"])) {
		
		db_connect();
		//переменные
		$total_price = $_SESSION["total_price"];
		$trash = json_encode($_SESSION["trash"], JSON_UNESCAPED_UNICODE);
		//Добавить проверку
		if(add_order($total_price, $_SESSION["login"], $trash) == true){
            $ok = "Заказ успешно оформлен !";
            header("Refresh: 2; url=trash.php");
        } else{
            $error = "Ошибка при оформлении";
        }
		//var_dump($_SESSION["trash"]);
        //удаление переменных из сессии
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
        <?php //вывод оповещений об успехе\ошибках
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
		<h2><p align="center">Ваша корзина</p></h2>
		<?php
            //Корзина не пустая - выводим товары
			if(isset($_SESSION["trash"])){
			    //полная стоимость
				$total_price = 0; // 0 рублей
                //цикл вывода
				foreach($_SESSION["trash"] as $key => $val){
					$id = $val["id"];
					$name = $val["name"];
					$price = $val["price"];
					$decsription = $val["description"];
					$img = $val["img"] == "" ? "img/no-img.png" : $val["img"];
					//складываем цены товаров
					$total_price += $price;
					//собираем товар из нашей корзины
					$article = <<<_OUT
						<article id="$id">
							<header class="name">$name</header>
							<div class="wrap">
								<figure>
									<img src="$img" class="fly">
								</figure>
							
							<p class="description">$decsription</p>
							</div>
							<a href="viewer.php?product=$id" class="btn"><input type="submit" class="submit" name="submit" value="Посмотреть"></a>
							<footer class="price">$price</footer>
							
						
						</article>
_OUT;
					//выводим на сайт
					echo $article;
					
				}
					echo <<<_OUT
						<div class="total">
							Итого: $total_price рублей
						</div>
_OUT;
				    //заносим в сессию полную стоиомтьс товаров в корзине
					$_SESSION["total_price"] = $total_price;
			?>
			<form method="POST" action="">
				<input type="submit" class="submit" name="submit" value="Заказать">
                <input type="submit" class="submit" name="clear" value="Очистить">
			</form>
			<?php //если корзина пустая - выводим что она пустая
                } else {?>
				<center><p>Ваша корзина пуста</p></center>
			<?php }?>
	</main>
	

</body>

</html>