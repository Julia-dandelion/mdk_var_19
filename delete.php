<?php
	require_once "includes/session.php";
	require_once "includes/mysqli.php";
	
	db_connect();
	
	$id = $_GET["product"];
	db_delete_product($id);


	header("Refresh: 2; url=" . $_SERVER['HTTP_REFERER'] );
	db_close();


?>