<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

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
		?>
		<div class="view-container">
  	<div class="nametov"><h1><?=$result["name"]?><h1></div>
  	<div class="pricetov">	<div class="price"><?=$result["price"]?></div></div>
  	<div class="photo-tov"><img  src="<?=$result["img"] == "" ? "img/no-img.png" : $result["img"]?>"></div>
  	<div class="opisanie-tov">
	<blockquote><?=$result["description"]?></blockquote> </div>
	<div class="harakt-tov">
			<?php
				$property = json_decode($result["property"], TRUE);
				$len = count($property["name"]);

				for($i=0; $i<$len; ++$i) {
					echo "<p>" . $property["name"][$i] . " - " . $property["value"][$i] . "</p>";
				}
			?>
			<?php
				switch($_SESSION["status"]) {
					case "user":
				$izvi=<<<_OUT

_OUT;
				echo $izvi;

				break;

					case "admin":
				$izvi=<<<_OUT
_OUT;
				echo $izvi;

				break;

					default:
				$izvi="";
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
