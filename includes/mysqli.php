<?php

    // параметры подключения
	$host = "localhost";// хост
	$login = "root";	// логин / пароль пользователя
	$password = "root";
	$db = "mosiaeva_db";	// имя БД с которой будем работать

    // объект соединения
	$conn = FALSE; // соединений на данном этапе нет


	//отрываем подключение к бд
	function db_connect($host = "localhost", $login = "root", $password = "root", $db = "mosiaeva_db") {
		global $conn;
		$err = false; // ошибок нет

		$conn = @mysqli_connect($host, $login, $password, $db);
		if($conn)
			return $err; // connection OK
		else {
			//echo mysqli_connect_errno() . " - " . mysqli_connect_error(); // ошибка подключения
			return $err = true; // сообщаем об ошибке
		}
	}
	//закрытие подключения бд
	function db_close() {
		@mysqli_close($GLOBALS["conn"]);
	}
	//добавление пользователя
	function add_user($login, $password, $status = "user") {
		global $conn;
		$salt = get_salt();
		$password = hash("sha256", $password . $salt);
		$query = "INSERT INTO login VALUES(NULL, '$login', '$password', '$salt', '$status')";
		mysqli_query($conn, $query);
	}
    //добавление продуктов
	function add_product($category, $name, $description, $img, $property, $price, $status) {
		global $conn;
		$query = "INSERT INTO product VALUES(NULL , '$category', '$name', '$description', '$img', '$property', '$price', '$status' )";
		//var_dump()
        (mysqli_query($conn, $query));
	}
    //удаление продукта
    function delete_product($id) {
        global $conn;
        $query = "DELETE FROM product WHERE id=$id";

        //var_dump($query);

        mysqli_query($conn, $query);
    }
    //добавление клиента
    function add_client($name, $inn, $dir, $phone, $ur_adr, $fiz_adr, $status) {
        global $conn;
        $query = "INSERT INTO client VALUES(NULL, '$name', '$inn', '$dir', '$phone', '$ur_adr', '$fiz_adr', $status)";
        mysqli_query($conn, $query);
    }
	// проверка пары логин/пароль
	function db_login($login, $password) {
		global $conn;
		$query = "SELECT * FROM login WHERE login = '$login'";

		$result = mysqli_query($conn, $query);
		if( mysqli_num_rows($result) != 0 ) {

			$row = mysqli_fetch_assoc($result);
			$password = hash("sha256", $password . $row["salt"]);

			return strcmp($password, $row["password"]);
		} else
			return TRUE;
	}
    //обновление пароля
	function update_password($login, $password) {
		global $conn;
		$salt = get_salt(); //новый пароль - новая соль
		$password = hash("sha256", $password . $salt);

		$query = "UPDATE usr SET password = '$password', salt = '$salt' WHERE login = '$login'";

		mysqli_query($conn, $query);
	}
	//проверка на существование пользователя
	function db_check_usr($login) {
		global $conn;
		$query = "SELECT * FROM login WHERE login = '$login'";

		$result = mysqli_query($conn, $query);

		return mysqli_num_rows($result) != 0; // смотрим на количество строк результирующего запроса
	}
	//создание уникальной соли
	function get_salt() {
		return md5(uniqid() . time() . mt_rand());
	}

    //формируем из результурующей таблицы один массив
    //(все записи в таблицы постепенно добавляем в один массив)
	function rowSet($result) {
		$fetchArray = array();

		while($row = mysqli_fetch_assoc($result))
			array_push($fetchArray, $row);

		return $fetchArray;
	}
    //получение продукта по id
	function get_product($id = ""){
		global $conn;
		$query = $id === "" ? "SELECT * FROM product" : "SELECT * FROM product WHERE id = $id";


		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0)
			return rowSet($result);
	}
	// Получаем список из
    function get_prod_ord($id){
        global $conn;
        $query = "SELECT * FROM orders WHERE user_id = $id";

        //var_dump($query);

        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)
            return rowSet($result);
    }
    // Получаем список из
    function get_all_prod_ord(){
        global $conn;
        $query = "SELECT * FROM orders";

        //var_dump($query);

        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)
            return $result;
    }
	//фкнция для выборки продуктов по категориям
	function db_select($table = "", $where = "") {
		global $conn;
		$table = $table == "" ? "product" : $table;
		$where = $where == "" ? "" : " WHERE $where";
		$query = "SELECT * FROM $table $where"; // !!! НЕ НАДО писать ключевое слово WHERE

		//var_dump($query);

		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0)
			return rowSet($result);
	}
    //получение статуса пользователя
	function get_user_status($login) {
		global $conn;
		$query = "SELECT status FROM login WHERE login = '$login'";

		//var_dump($query);

		$result = mysqli_query($conn, $query);

		return mysqli_fetch_array($result)["status"];
	}
    //получение всей информации о пользователе
    function get_user_all_info($login) {
        global $conn;
        $query = "SELECT * FROM login WHERE login = '$login'";

        //var_dump($query);

        $result = mysqli_query($conn, $query);

        return mysqli_fetch_array($result);
    }
    //обновление информации о товаре
	function db_update_product($id, $name, $description, $property, $price) {
		global $conn;
		$query = "UPDATE product SET name='$name', description='$description', property='$property', price='$price', status='take' WHERE id=$id";

		//var_dump($query);

		mysqli_query($conn, $query);
	}

    //удаление заказа
    function delite_ord($id) {
        global $conn;
        $query = "DELETE FROM orders WHERE id=$id";
        mysqli_query($conn, $query);
    }
    //оформляем заказ
    function add_order($price, $login, $product, $status = "processed") {
        global $conn;
        $user_id = db_select("login", "login = '$login'")[0]["id"];
        $time = date("Y-m-d H:i:s");

        $query = "INSERT INTO `orders` VALUES(NULL, '$time', $price, $user_id, '$product', '$status')";

        //var_dump($query);

        if(mysqli_query($conn, $query) == true){
            return 1;
        } else{
            return 0;
        }
    }
