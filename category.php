<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

	define("MAX_PRODUCTS_ON_PAGE", 4);

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

_OUT;
						break;

					case "admin":
						$article = <<<_OUT
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
_OUT;
						break;

					default:
						$article = <<<_OUT
						<section class="cardprice" id="$id">
					 <div class="card">
						 <img src="$img" alt="$name">
						 <h3>$name</h3>
						 <p class="price">$price руб.</p>
						 <p class="decsription">$decsription</p>
						 <a href="viewer.php?product=$id" class="btn"><button>Посмотреть</button></a>
					 </div>
					 </section>
_OUT;
					break;
				}

				/*
				if(isset($_SESSION["status"]))
					$article = <<<_OUT
						<article id="$id">
							<header class="name">$name</header>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>

							<p class="description">$decsription</p>
							</div>
							<footer class="price">$price руб.</footer>
							<a href="viewer.html?product=$id" class="btn">Посмотреть</a>
							<button type="button" onclick="productInTrash($id)">Заказать товар</button>
						</article>
_OUT;
				else
					$article = <<<_OUT
						<article id="$id">
							<header class="name">$name</header>
							<div class="wrap">
								<figure>
									<img src="$img">
								</figure>

							<p class="description">$decsription</p>
							</div>
							<footer class="price">$price</footer>
							<a href="viewer.html?product=$id" class="btn">Посмотреть</a>
						</article>
_OUT;
					*/

				echo $article;

				//if(count_article == MAX_PRODUCTS_ON_PAGE ) break;
			}

		?>


	</main>


</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
