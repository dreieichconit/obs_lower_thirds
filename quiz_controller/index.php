<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="initial-scale=1.0" />
		<title>Quiz Controller</title>
		
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
			integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
			crossorigin="anonymous"
		/>
		<style>
			@font-face {
				font-family: charlemagne;
				src: url(./fonts/charlemagne.otf);
			}
		</style>
	</head>

	<body>
	
			
	<h1>Fragenliste</h1>

<table border="1">
	<thead>
		<tr>
			<th>ID</th>
			<th>Sort</th>
			<th>Frage</th>
			<th>A</th>
			<th>B</th>
			<th>C</th>
			<th>D</th>
			<th>Richtig</th>
			<th>Punkte</th>
			<th>Typ</th>
			<th>Senden</th>
		</tr>	
	</thead>
	<tbody>



	<?php
		include("../streamtool/include/db_connect.php");

		
		$sql		= "SELECT * FROM st_quiz ORDER BY quiz_sort";

		$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

		$statement	= $pdo->prepare($sql);
			
		// $statement->bindParam(':streamid', $streamid);
			
		$statement->execute();

		while($row = $statement->fetch()){
			$q_id		= $row['quiz_id'];
			$q_q		= $row['quiz_q'];
			$q_a		= $row['quiz_a'];
			$q_b		= $row['quiz_b'];
			$q_c		= $row['quiz_c'];
			$q_d		= $row['quiz_d'];
			$q_r		= $row['quiz_right'];
			$q_t		= $row['quiz_type'];
			$q_p		= $row['quiz_points'];
			$q_sort		= $row['quiz_sort'];


			$link		= "index.php?page=quiz_edit&quiz_id=$q_id";
			
			$a_richtig = "";
			$b_richtig = "";
			$c_richtig = "";
			$d_richtig = "";

			$richtig = "style='background-color: green'";


			switch ($q_r){
				case 'A':
					$a_richtig = $richtig;
					break;
				case 'B':
					$b_richtig = $richtig;
					break;
				case 'C':
					$c_richtig = $richtig;
					break;
				case 'D':
					$d_richtig = $richtig;
					break;
	}

			echo"
				<tr>
					<td>$q_id</td>
					<td>$q_sort</td>
					<td id='frage_$q_id'>$q_q</td>
					<td id='a_$q_id' $a_richtig>$q_a</td>
					<td id='b_$q_id'$b_richtig>$q_b</td>
					<td id='c_$q_id'$c_richtig>$q_c</td>
					<td id='d_$q_id'$d_richtig>$q_d</td>
					<td id='richtig_$q_id'>$q_r</td>
					<td id='punkte_$q_id'>$q_p</td>
					<td id='typ_$q_id'>$q_t</td>
					<td><a href='#' onClick='send_question($q_id)'>Absenden</a>
					

				</tr>
			";
		}


	?>




		
		</tbody>
	</table>
<br>
<h1> Multiple-Choice-Frage</h1>
	<button onClick="einloggen('A')">A Einloggen</button>
	<button onClick="einloggen('B')">B Einloggen</button>
	<button onClick="einloggen('C')">C Einloggen</button>
	<button onClick="einloggen('D')">D Einloggen</button>
	
	
	&nbsp;&nbsp;&nbsp;&nbsp;

	<button onClick="aufloesen()">Auflösen</button>
	<br>
	
	<h1> Schätzfrage</h1>
	Elfen: <input type="text" name="guess_elf" id="guess_elf" onchange="calc_abstand()">&nbsp;&nbsp;&nbsp;&nbsp;
	Zwerge: <input type="text" name="guess_dwarf" id="guess_dwarf" onchange="calc_abstand()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<button onClick="guess_transmit('elf')">Elfen</button>&nbsp;&nbsp;&nbsp;&nbsp;
	<button onClick="guess_transmit('dwarf')">Zwerge</button>&nbsp;&nbsp;&nbsp;&nbsp;
	<button onClick="guess_aufloesen()">Schätzfrage auflösen</button><br>
	Elfenabstand: <span id="elfenabstand"></span> &nbsp;&nbsp;&nbsp;&nbsp; Zwergenabstand<span id="zwergenabstand"></span>
	&nbsp;&nbsp;&nbsp;&nbsp; Winner: <span id="winner"></span> 


	<hr>
Aktives Team:<br>
	<select id="active_team" onchange="update_active_team()" size="2" >
		<option selected value="dwarf">Zwerge</option>
		<option value="elf">Elfen</option>
	</select>

	<hr>
	<h1> Punkte</h1>
	Elfen: <input type="text" name="elfenpunkte" id="punkte_elf" ><br>
	Zwerge: <input type="text" name="zwergenpunkte" id="punkte_dwarf"><br>
	<button onClick="punkte_aktualisieren()">Aktualisieren</button>


		<script
			src="https://code.jquery.com/jquery-3.5.1.js"
			integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			crossorigin="anonymous"
		></script>

		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
			integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
			crossorigin="anonymous"
		></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>
		<script src="../websocket-server.js"></script>
		<script src="socket_q.js"></script>
		
			

		
		</script>
	</body>
</html>
