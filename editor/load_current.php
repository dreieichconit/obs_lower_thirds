<?php
header("Content-Type: application/json; charset=UTF-8");
	include("include/db_connect.php");

	

	$return_array = [];
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
		$now_item = $row;
		//array_push($bauchbinden, $row);
	}




			$return_array['now'] = $now_item;



			//hole nächsten Programmpunkt
	
			$next;
	
			$sql		= "SELECT * FROM st_items WHERE item_start_planned > :start_ts AND item_stream_id = :stream_id LIMIT 1";
	
			$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	
			$statement	= $pdo->prepare($sql);
				
			$statement->bindParam(':start_ts', $start_ts);
			$statement->bindParam(':stream_id', $stream_id);
				
			$statement->execute();
	
			while($row = $statement->fetch()){
				$next = $row;
	
			}
	
	
	
			$return_array['next'] = $next;

			

	



	$bauchbinden = [];

	if(!isset($_GET['stream_id'])){
		echo("[]");
		die;
	}


	
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
		$item_id = $row['item_id'];
	}





	

	$sql		= "SELECT * FROM st_lower WHERE item_id = :itemid";

	$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

	$statement	= $pdo->prepare($sql);
		
	$statement->bindParam(':itemid', $item_id);
		
	$statement->execute();

	while($row = $statement->fetch()){
		array_push($bauchbinden, $row);
	}

	


	$return_array['bb'] = $bauchbinden;


	// echo"<pre>";
	// print_r($return_array);
	// echo"</pre>";

	$return_string = json_encode($return_array);
	// echo(json_last_error());
	// echo(json_last_error_msg());
	echo $return_string;


?>