<?php
header("Content-Type: application/json; charset=UTF-8");
	include("include/db_connect.php");

	$bauchbinden = [];

	if(!isset($_GET['item_id'])){
		echo("[]");
		die;
	}


	$item_id	= $_GET['item_id'];

	$sql		= "SELECT * FROM st_lower WHERE item_id = :itemid";

	$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

	$statement	= $pdo->prepare($sql);
		
	$statement->bindParam(':itemid', $item_id);
		
	$statement->execute();

	while($row = $statement->fetch()){
		array_push($bauchbinden, $row);
	}

	$json = json_encode($bauchbinden);

	echo $json;

?>