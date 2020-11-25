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

		//array_push($bauchbinden, $row);
	}




	

	if(isset($start_ts)){

		$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$now	= time();
	
		$sql	= "UPDATE st_items SET item_duration_actual = (:ts - item_start_actual), item_active = 0 WHERE item_id = :item;";
	
		$intial = 0;
	
		$statement	= $pdo->prepare($sql);
	
		$statement->bindParam(':item', $start_id);
		$statement->bindParam(':ts', $now);
		
	
	
		try{
			$db_result = $statement->execute();
		}catch (Exception $e){
		}

		if($db_result){
	
		}


		
		$sql		= "SELECT * FROM st_items WHERE item_start_planned > :start_ts AND item_stream_id = :stream_id LIMIT 1";

		$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

		$statement	= $pdo->prepare($sql);
			
		$statement->bindParam(':start_ts', $start_ts);
		$statement->bindParam(':stream_id', $stream_id);
			
		$statement->execute();

		while($row = $statement->fetch()){
			$next_item_id = $row['item_id'];
			$now_item = $row;
		}

		
		if(isset($next_item_id)){
			

			
			$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			$now	= time();
			
			$sql	= "UPDATE st_items SET item_active = 1, item_start_actual = :ts WHERE item_id = :item;";

			$intial = 0;

			$statement	= $pdo->prepare($sql);

			$statement->bindParam(':item', $next_item_id);
			$statement->bindParam(':ts', $now);
			


			try{
				$db_result = $statement->execute();
			}catch (Exception $e){
			}
			if($db_result){
				//array_push($bauchbinden, "success Update next");
			}
			

			$return_array['now'] = $now_item;



			//hole nächsten Programmpunkt
	
			$next;
	
			$sql		= "SELECT * FROM st_items WHERE item_start_planned > :start_ts AND item_stream_id = :stream_id LIMIT 2";
	
			$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	
			$statement	= $pdo->prepare($sql);
				
			$statement->bindParam(':start_ts', $start_ts);
			$statement->bindParam(':stream_id', $stream_id);
				
			$statement->execute();
	
			while($row = $statement->fetch()){
				$next = $row;
	
			}
	
	
	
			$return_array['next'] = $next;

			


		}

	
	}

	



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