<?php

	
	
	$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			echo"<pre>";
		}
	}

	$sql	= "UPDATE st_items SET item_active = 0 WHERE 1";

	

	$statement	= $pdo->prepare($sql);

	
	

	$query = "Ablauf Zurücksetzen";


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


	
	
	$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			echo"<pre>";
		}
	}

	$sql	= "UPDATE st_items SET item_active = 1 WHERE item_id < 3";

	

	$statement	= $pdo->prepare($sql);

	
	

	$query = "Ablauf Zurücksetzen";


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


	include("start.php");
?>