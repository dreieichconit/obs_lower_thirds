

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Fragen fürs Quiz</h3>
				<div class="card-tools">
					<div class="input-group input-group-sm" style="width: 150px;">
					
					   </div>
				</div>
			</div>
			
			<div class="card-body table-responsive p-0" style="height: auto;">
				<table class="table table-head-fixed" id="filter_table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nr.</th>
							<th>Punkte</th>
							<th>Frage</th>
							<th>A</th>
							<th>B</th>
							<th>C</th>
							<th>D</th>
							
							
							
							
						</tr>
					</thead>

					<tbody>

					<?php

					

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
							$richtig= "class='bg-success' ";
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

							if($q_t == "guess"){
								
								echo"
								<tr>
									<td><a href='$link'>$q_id</a></td>
									<td><a href='$link'>$q_sort</a></td>
									<td><a href='$link'>$q_p</a></td>
									<td><a href='$link'>$q_q</a></td>
									<td $richtig colspan='4' style='text-align:center'><a  href='$link'>$q_r</a></td>
									
									

								</tr>
							";
							}else{
								echo"
								<tr>
									<td><a href='$link'>$q_id</a></td>
									<td><a href='$link'>$q_sort</a></td>
									<td><a href='$link'>$q_p</a></td>
									<td><a href='$link'>$q_q</a></td>
									<td $a_richtig><a  href='$link'>$q_a</a></td>
									<td $b_richtig><a href='$link'>$q_b</a></td>
									<td $c_richtig><a href='$link'>$q_c</a></td>
									<td $d_richtig><a  href='$link'>$q_d</a></td>
									
									

								</tr>
							";
							}

							
						}



						
						
					?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>