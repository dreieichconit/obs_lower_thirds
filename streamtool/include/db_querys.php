<?php

function fetch_devices($eqid){
	global $pdo_mysql, $pdo_db_user, $pdo_db_pwd;
	
	$result		= array();
	$pdo 		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

	$sql		= "SELECT * FROM eq_barcodes WHERE eq_id = :eqid";
	
	$statement	= $pdo->prepare($sql);
	
	$statement->bindParam(':eqid', $eqid);
	
	$statement->execute();
	
	
	while($row = $statement->fetch()){
		
		array_push($result, $row);
	
	}
	
	return $result;
}

?>