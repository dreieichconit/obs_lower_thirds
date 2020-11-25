<?php

	$internal		= isset($_POST['title_internal']) ? $_POST['title_internal'] : "";
	$external		= isset($_POST['title_external']) ? $_POST['title_external'] : "";
	$start			= isset($_POST['start']) ? $_POST['start'] : "";
	$duration		= isset($_POST['duration']) ? $_POST['duration'] : "";
	$notes			= isset($_POST['notes']) ? $_POST['notes'] : "";
	$stream			= isset($_POST['stream']) ? $_POST['stream'] : "";
	$type			= isset($_POST['type']) ? $_POST['type'] : "";
	$item_id		= isset($_POST['item_id']) ? $_POST['item_id'] : "";

	$start			= TimeToUnix($start);
	
	$duration		= explode(":", $duration);

	if(count($duration) == 3){
		$hour = $duration[0];
		$min = $duration[1];
		$sec = $duration[2];
	}

	
	if(count($duration) == 2){
		$hour = 0;
		$min = $duration[0];
		$sec = $duration[1];
	}

	
	if(count($duration) == 1){
		$hour = 0;
		$min = 0;
		$sec = $duration[0];
	}


	$duration = $sec + ($min * 60) + ($hour * 60 * 60);

	
	$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			echo"<pre>";
		}
	}

	$sql	= "UPDATE st_items SET item_title_internal = :intern, item_title_external = :extern, item_start_planned =  :st, item_duration_planned = :dur, item_notes = :notes, item_stream_id = :stream, item_type = :typ WHERE item_id = :item_id ";
	
	

	$intial = 0;

	$statement	= $pdo->prepare($sql);

	$statement->bindParam(':intern', $internal);
	$statement->bindParam(':extern', $external);
	$statement->bindParam(':st', $start);	
	$statement->bindParam(':dur', $duration);
	$statement->bindParam(':notes', $notes);
	$statement->bindParam(':stream', $stream);
	$statement->bindParam(':typ', $type);

	$statement->bindParam(':item_id', $item_id);

	$query = "Programmpunkt aktualisieren";


	//Begin MySQL-Gedöns, ab hier muss nix mehr geändert werden
	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			echo $statement->debugDumpParams();
		}
	}

	try{
		$db_result = $statement->execute();
	}catch (Exception $e){
		$reason_pdo = $e;
		$result = "nok";
	}

	$show_a_result = true;
	
	if($db_result == true){
		$result = "ok";
	}else{
		$result = "nok";
		if(isset($reason_pdo)){
			$reason = "PDO-Error:\n".$reason_pdo;
			$reason .= $pdo->errorInfo();
		}else{
			$reason = $pdo->errorInfo();
		}
		
	}

	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			print_r( $pdo->errorInfo());
			echo"</pre>";
		}
	}
	include("include/html_result.php");


	//End MySQL-Gedöns, hier darf wieder geändert werden


	include("schedule.php");
?>