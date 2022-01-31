<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

    //Проверка наличия авторизации
    if(!empty($_SESSION["status"])) {
        $user = $_SESSION["login"];
    }
    else{
        header("Location: /signup.php");
    }

	db_connect();

	if(!empty($_GET["product"]) && isset($_GET["product"])) {

		$id = $_GET["product"];

		if(isset($_POST["product-edit"])) {
            //переменные
			$name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
			$description = htmlentities(mysqli_real_escape_string($conn,$_POST["description"]));
			$price = htmlentities(mysqli_real_escape_string($conn,$_POST["price"]));
			//процесс преобразование пары свойство/значение в строку формата JSON
			$property_name = $_POST["property-name"]; // получаем наши массивы
			$property_value = $_POST["property-value"];
			//из двух массивов сделаем один
			$property= array(
				"name" => array(),
				"value" => array()
			);
			// проверим каждое из значение массива на постороние вставки кода
			for($len = count($property_name), $i = 0; $i < $len; ++$i) {
				$property["name"][] = htmlentities(mysqli_real_escape_string($conn,$property_name[$i]));
				$property["value"][] = htmlentities(mysqli_real_escape_string($conn,$property_value[$i]));
			}

			//var_dump($property);

			//последний этап преобразуем массив в строку формата JSON
			$property = json_encode($property, JSON_UNESCAPED_UNICODE); //второй параметр чтобы отменить кодирование многобайтных символов
            //обновляем данные в БД
			db_update_product($id, $name, $description, $property, $price);

		}

		$id = $_GET["product"];

		$result = get_product($id)[0];
		//var_dump($result);
		$property = json_decode($result["property"], TRUE);
		//var_dump($property);
	}

	db_close();
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once "blocks/head.php"; ?>

	<link rel="stylesheet" href="css/add.css">
	<script src="js/add.js"></script>
</head>

<body>

	<?php
		require_once "blocks/header.php";
	?>

	<main>

		<h2>Редактирование</h2>

		<!-- Форма служит так же для отправки файла изображения -->
		<form id="product" class="add" method="post">
			<!-- Общая информация -->
			<div class="box">

				<label>Название</label>
				<input type="text" placeholder="Название" name="name" maxlength="50" required value="<?=$result["name"]?>">

				<label>Описание</label>
				<textarea placeholder="Краткое описание выдаваемое при поиске" name="description" required rows="4" style="resize: none;" maxlength="255"><?=$result["description"]?></textarea>

				<label>Цена</label>
				<input type="number" placeholder="Цена за единицу товара" name="price" step="0.1" value="<?=$result["price"]?>" required>

				<label>Характеристики</label>
				<div id="listProperty">

						<?php
                        //Получаем свойства продукта из БД и выводим их на страницу для редактирования
						$name = $property["name"];
						$value = $property["value"];

						foreach($name as $key => $val) {
							echo <<<_TXT
								<div class="items">
									<input maxlength="50" placeholder="Название свойства" name="property-name[]" required="" type="text" value="$val">
									<input maxlength="50" placeholder="Значение свойства" name="property-value[]" required="" type="text" value="{$value[$key]}">
								</div>
_TXT;
						}

						?>

				</div>

				<button onclick="addProperty()" type="button">Добавить</button>
				<button onclick="deleteProperty()" type="button">Удалить</button>

			</div>

			<input type="submit" name="product-edit" value="Изменить">

		</form>



	</main>


</body>

</html>
