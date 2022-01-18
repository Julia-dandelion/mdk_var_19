<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";

	db_connect();

	if(!empty($_POST))
		if(isset($_POST["product"])) {

			$category = htmlentities(mysqli_real_escape_string($conn,$_POST["category"]));
			$name = htmlentities(mysqli_real_escape_string($conn,$_POST["name"]));
			$description = htmlentities(mysqli_real_escape_string($conn,$_POST["description"]));
			$price = htmlentities(mysqli_real_escape_string($conn,$_POST["price"]));
            $vender_id = htmlentities(mysqli_real_escape_string($conn, $_POST["vender_id"]));
            $status = htmlentities(mysqli_real_escape_string($conn, $_POST["status"]));


			$property_name = $_POST["property-name"];
			$property_value = $_POST["property-value"];

			$property= array(
				"name" => array(),
				"value" => array()
			);

			for($len = count($property_name), $i = 0; $i < $len; ++$i) {
				$property["name"][] = htmlentities(mysqli_real_escape_string($conn,$property_name[$i]));
				$property["value"][] = htmlentities(mysqli_real_escape_string($conn,$property_value[$i]));
			}

			$property = json_encode($property, JSON_UNESCAPED_UNICODE);

			if( $_FILES["img"]["error"] == UPLOAD_ERR_OK )

				if ( is_uploaded_file($_FILES["img"]["tmp_name"])) {
						$tmpPath = $_FILES["img"]["tmp_name"];
						$toBuffer = file_get_contents($tmpPath);
						$type = mime_content_type($tmpPath);
						$img = "data:$type;base64," . base64_encode($toBuffer);
					}
			var_dump($status);
            var_dump($vender_id);
            add_product($category, $name, $description, $img, $property, $price, $status, $vender_id);
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
		<h2>Добавление товара</h2>
		<form id="product" class="add" method="post" enctype="multipart/form-data">
			<div class="box">
				<label>Категория продукта</label>
				<select name="category">
					<option value="Гоночные" selected>Гоночные</option>
					<option value="Горные">Горные</option>
					<option value="Городские">Городские</option>
					<option value="Электротранспорт">Электротранспорт</option>
				</select>

				<label>Название</label>
				<input type="text" placeholder="Название" name="name" maxlength="50" required>

				<label>Выберите изображение</label>
				<input type="file" name="img" accept="image/jpeg,image/png">

				<label>Описание</label>
				<textarea placeholder="Краткое описание выдаваемое при поиске" name="description" required rows="4" style="resize: none;" maxlength="255"></textarea>

				<label>Цена</label>
				<input type="number" placeholder="Цена за единицу товара" name="price" step="0.1" required>

                <label>Производитель</label>
                <select name="vender_id">
                    <?php
                    if(!db_connect())
                    {
                        $query = "SELECT * FROM vender";
                        $res2 = mysqli_query($conn, $query);

                        while ($result2 = mysqli_fetch_array($res2)) {

                            echo <<<_OUT
							<option value="{$result2['id']}">{$result2['name']}</option>
_OUT;
                        }
                    }
                    ?>
                </select>

                <label>Статус наличия</label>
                <select name="status">
                    <option value="empty">Нет в наличии</option>
                    <option selected value="take">Есть в наличии</option>
                    <option value="not">Не выпускается</option>
                </select>

				<label>Характеристики</label>
				<div id="listProperty"></div>
				<button onclick="addProperty()" type="button">Добавить</button>
				<button onclick="deleteProperty()" type="button">Удалить</button>
			</div>

			<input type="submit" name="product" value="Записать в БД">

		</form>
	</main>


</body>
	<?php require_once "blocks/footer.php"; ?>
</html>
