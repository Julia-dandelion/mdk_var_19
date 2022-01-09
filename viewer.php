<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";
    if(isset($_SESSION["login"])){
        $status = $_SESSION["status"];
    }
    else{
        $status = "none";
    }
	if(!empty($_GET["product"])) {
		$product = $_GET["product"];

		db_connect();

		$result = get_product($product)[0]; // мы знаем что вернётся только одна строка
		//var_dump($result);
		db_close();
	}
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>
	<link rel="stylesheet" href="css/viewer.css">
</head>

<body>

	<?php
		require_once "blocks/header.php"; // шапка сайта
	?>

<main>
	<?php
	if (isset($result)) {
	    $id = $result["id"];
        $name = $result["name"];
        $price = $result["price"];
        $img = $result["img"];
        $description = $result["description"];

        $property = json_decode($result["property"], TRUE);
        $len = count($property["name"]);

        for($i=0; $i<$len; ++$i) {
            echo "<p>" . $property["name"][$i] . " - " . $property["value"][$i] . "</p>";
        }

				switch($status) {
					case "user":
				$izvi=<<<_OUT
                    <div class="view-container">
                    <div class="nametov"><h1>$name<h1></div>
                    <div class="pricetov">	<div class="price">$price</div></div>
                    <div class="photo-tov"><img  src="$img" ? "img/no-img.png" : $img></div>
                    <div class="opisanie-tov">
                    <blockquote>$description</blockquote> </div>
                    <div class="harakt-tov"><div><button type="button" onclick="productInTrash($id)">Заказать</button></div>
_OUT;
				echo $izvi;

				break;

					case "admin":
				$izvi=<<<_OUT
                    <div class="view-container">
                    <div class="nametov"><h1>$name<h1></div>
                    <div class="pricetov">	<div class="price">$price</div></div>
                    <div class="photo-tov"><img  src="$img" ? "img/no-img.png" : $img></div>
                    <div class="opisanie-tov">
                    <blockquote>$description</blockquote> </div>
                    <div class="harakt-tov">
                    <div>
                        <button type="button" onclick="productInTrash($id)">Заказать</button>
                        <a class="tools" href="edit.php?product=$id"><button>Изменить</button></a>
						 <a class="tools" href="delete.php?product=$id"><button>Удалить</button></a>
                    </div>
_OUT;
				echo $izvi;

				break;

					default:
				$izvi=<<<_OUT
                    <div class="view-container">
                    <div class="nametov"><h1>$name<h1></div>
                    <div class="pricetov">	<div class="price">$price</div></div>
                    <div class="photo-tov"><img  src="$img" ? "img/no-img.png" : $img"></div>
                    <div class="opisanie-tov">
                    <blockquote>$description</blockquote> </div>               
_OUT;
				echo $izvi;
				break;
				}
			?>
		</div>
<?php
}
else{
	?>
	<center>
<h1 class='block1'> ТОВАР НЕ СУЩЕСТВУЕТ </h1>
	</center>
	<?php
}
?>

	</div>
	</main>
	<?php require_once "blocks/footer.php"; ?>

</body>
</html>
