<?php

	$frage		= isset($_POST['frage']) ? $_POST['frage'] : "";
	$antwort_a		= isset($_POST['antwort_a']) ? $_POST['antwort_a'] : "";
	$antwort_b			= isset($_POST['antwort_b']) ? $_POST['antwort_b'] : "";
	$antwort_c		= isset($_POST['antwort_c']) ? $_POST['antwort_c'] : "";
	$antwort_d			= isset($_POST['antwort_d']) ? $_POST['antwort_d'] : "";
	$richtig			= isset($_POST['richtig']) ? $_POST['richtig'] : "";
	$notes			= isset($_POST['notes']) ? $_POST['notes'] : "";
	$art			= isset($_POST['art']) ? $_POST['art'] : "";
	$punkte			= isset($_POST['punkte']) ? $_POST['punkte'] : "";
	$nummer			= isset($_POST['nummer']) ? $_POST['nummer'] : "";
	$quiz_id			= isset($_POST['quiz_id']) ? $_POST['quiz_id'] : "";


	
	$pdo= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	if(isset($_SESSION['debug'])){
		if($_SESSION['debug']==true)
		{
			echo"<pre>";
		}
	}

	$sql	= "UPDATE st_quiz SET quiz_q = :frage, quiz_a = :a, quiz_b = :b, quiz_c = :c, quiz_d = :d, quiz_right = :richtig,
	quiz_type = :typ, quiz_points = :punkte, quiz_sort = :sort, quiz_notes = :notes WHERE quiz_id = :id";

	$intial = 0;

	$statement	= $pdo->prepare($sql);

	$statement->bindParam(':frage', $frage);
	$statement->bindParam(':a', $antwort_a);
	$statement->bindParam(':b', $antwort_b);
	$statement->bindParam(':c', $antwort_c);
	$statement->bindParam(':d', $antwort_d);
	$statement->bindParam(':richtig', $richtig);
	$statement->bindParam(':typ', $art);
	$statement->bindParam(':punkte', $punkte);
	$statement->bindParam(':sort', $nummer);
	$statement->bindParam(':notes', $notes);
	$statement->bindParam(':id', $quiz_id);
	

	$query = "Frage aktualisieren";


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


	include("quiz.php");
?>