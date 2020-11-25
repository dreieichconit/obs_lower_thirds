<?php
header("Content-Type: application/json; charset=UTF-8");
	include("include/db_connect.php");

	$bauchbinden = [];

	if(!isset($_GET['stream_id'])){
		echo("[]");
		die;
	}

	

	$stream_id	= $_GET['stream_id'];

	$sql		= "SELECT * FROM st_items WHERE item_stream_id = :stream_id AND item_active";

	$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

	$statement	= $pdo->prepare($sql);
		
	$statement->bindParam(':stream_id', $stream_id);
		
	$statement->execute();

	while($row = $statement->fetch()){
		$start_ts = $row['item_start_planned'];
		$start_id = $row['item_id'];
	}



	if(isset($start_ts)){

		$sql		= "SELECT * FROM st_items WHERE item_start_planned > :start_ts AND item_stream_id = :stream_id LIMIT 2";

		$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

		$statement	= $pdo->prepare($sql);
			
		$statement->bindParam(':start_ts', $start_ts);
		$statement->bindParam(':stream_id', $stream_id);
			
		$statement->execute();

		while($row = $statement->fetch()){
			array_push($bauchbinden, $row);

		}



	}






	$json = json_encode($bauchbinden);

	echo $json;

?>