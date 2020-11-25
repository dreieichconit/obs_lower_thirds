<?php
header("Content-Type: application/json; charset=UTF-8");
	include("include/db_connect.php");

	$bauchbinden = [];

	if(!isset($_GET['binde_id'])){
		echo("[]");
		die;
	}


	$binde_id	= $_GET['binde_id'];

	$sql		= "SELECT * FROM st_lower WHERE lower_id = :binde_id";

	$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

	$statement	= $pdo->prepare($sql);
		
	$statement->bindParam(':binde_id', $binde_id);
		
	$statement->execute();

	while($row = $statement->fetch()){
		$bauchbinden = $row;
	}

	$json = json_encode($bauchbinden);

	echo $json;

?>