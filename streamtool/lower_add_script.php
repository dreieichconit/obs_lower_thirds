<?php

	$line1			= isset($_POST['line1']) ? $_POST['line1'] : "";
	$line2			= isset($_POST['line2']) ? $_POST['line2'] : "";
	$dur			= isset($_POST['dur']) ? $_POST['dur'] : "";
	$symb			= isset($_POST['symbol']) ? $_POST['symbol'] : "";
	$item_id		= isset($_POST['item_id']) ? $_POST['item_id'] : "";

	
	$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			echo"<pre>";
		}
	}

	$sql	= "INSERT INTO st_lower (lower_symbol, lower_line_1, lower_line_2, lower_duration, item_id) VALUES (:symb, :l1, :l2, :du, :item);";

	$intial = 0;

	$statement	= $pdo->prepare($sql);

	$statement->bindParam(':symb', $symb);
	$statement->bindParam(':l1', $line1);
	$statement->bindParam(':l2', $line2);
	$statement->bindParam(':du', $dur);
	$statement->bindParam(':item', $item_id);
	

	$query = "Neue Bauchbinde erstellen";


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


	include("item_details.php");
?>