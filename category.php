<?php
    //Подключаем сессию и команды для работы с БД
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

    //Проверка наличия авторизации
    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    }
    else{
        header("Location: /signup.php");
    }

	if(!empty($_GET["category"])) {
		$category = $_GET["category"];
		db_connect();
		// многомерный массив с результирующей таблицей
		$result = db_select("product", "category='$category'");
		db_close();
	} else
		header("Location: /");
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/category.css">
</head>

<body>

	<?php
		require_once "blocks/header.php"; // шапка сайта
	?>

	<main>
		<?php
        //Вывод товаров на страницу в зависимости от статуса пользователя
        //Если неавторизованный, то только с возможностью просмотра
        //Если авторизованный, то и с возможностью покупки
        //Если администратор, полное радвктирование и возможности других пользователей
			$count_article = 0;
			foreach($result as $key => $val) {
				$id = $val["id"];
				$name = $val["name"];
				$price = $val["price"];
				$decsription = $val["description"];
				$img = $val["img"];
				$count_article++;
				switch($_SESSION["status"]) {
					case "user":
						$article = <<<_OUT
                    
                    <center>
					<section class="usrcardprice" id="$id">
					 <div class="usrcard">
					   <img src="$img">
					   <h3>$name</h3>
					   <p class="usrprice">$price руб.</p>
					   <p class="usrdecsription">$decsription</p>
					   <button type="button" onclick="productInTrash($id)">Заказать товар</button>
						 <a href="viewer.php?product=$id" class="usrbtn"><button>Посмотреть</button></a>
					 </div>
					 </section>
					 <br>
					 </center>

_OUT;
						break;

					case "admin":
						$article = <<<_OUT
                    <center>
						<section class="cardprice" id="$id">
					 <div class="cardadm">
					   <img src="$img" alt="$name">
					   <h3>$name</h3>
					   <p class="price">$price руб.</p>
					   <p class="decsription">$decsription</p>
					   <button type="button" onclick="productInTrash($id)">Заказать</button>
						 <a href="viewer.php?product=$id" class="btn"><button>Посмотреть</button></a>
						 <a class="tools" href="edit.php?product=$id"><button>Изменить</button></a>
						 <a class="tools" href="delete.php?product=$id"><button>Удалить</button></a>
					 </div>
					 </section>
                      <br>
                      <br>
                     </center>
_OUT;
						break;

					default:
						$article = <<<_OUT
                    <center>
						<section class="cardprice" id="$id">
					 <div class="card">
						 <img src="$img" alt="$name">
						 <h3>$name</h3>
						 <p class="price">$price руб.</p>
						 <p class="decsription">$decsription</p>
						 <a href="viewer.php?product=$id" class="btn"><button>Посмотреть</button></a>
					 </div>
					 </section>
                        <br>
                         </center>
_OUT;
					break;
				}
				echo $article;
			}
		?>
	</main>
</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
