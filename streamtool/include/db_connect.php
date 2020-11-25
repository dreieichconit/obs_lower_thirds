<?php


if($_SERVER['SERVER_NAME'] == "localhost"){
	$pdo_server		= "localhost";
	$pdo_database	= "streamtool";
	
	$pdo_mysql		= "mysql:host=".$pdo_server.";dbname=".$pdo_database;
	
	$pdo_db_user	= "streamtool";
	$pdo_db_pwd		= "streamtool";
}else if($_SERVER['SERVER_NAME'] == "192.168.178.21"){
	$pdo_server		= "localhost";
	$pdo_database	= "streamtool";
	
	$pdo_mysql		= "mysql:host=".$pdo_server.";dbname=".$pdo_database;
	
	$pdo_db_user	= "streamtool";
	$pdo_db_pwd		= "streamtool";
}else{
	$pdo_server		= "rdbms.strato.de";
	$pdo_database	= "DB4359607";
	
	$pdo_mysql		= "mysql:host=".$pdo_server.";dbname=".$pdo_database;
	
	$pdo_db_user	= "U4359607";
	$pdo_db_pwd		= "VgEu;7z6ggSX";

	
}
	

?>