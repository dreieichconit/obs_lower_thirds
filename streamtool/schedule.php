<?php
	if(isset($_GET['stream'])){
		$streamid = $_GET['stream'];
	}else{
		if(isset($stream)){
			$streamid = $stream;
		}else{
			$stream = 1;
		}
	}

?>


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Streamplan für Stream Nr. <?php echo $streamid; ?></h3>
				<div class="card-tools">
					<div class="input-group input-group-sm" style="width: 150px;">
					
					   </div>
				</div>
			</div>
			
			<div class="card-body table-responsive p-0" style="height: auto;">
				<table class="table table-head-fixed" id="filter_table">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="10%">Zeiten</th>
							<th width="10%">Dauer</th>
							<th width="70%">Titel</th>
							<th width="5%">Views</th>
						</tr>
					</thead>

					<tbody>

					<?php

					

						$sql		= "SELECT * FROM st_items WHERE item_stream_id = :streamid ORDER BY item_start_planned";

						$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

						$statement	= $pdo->prepare($sql);
							
						$statement->bindParam(':streamid', $streamid);
							
						$statement->execute();

						while($row = $statement->fetch()){
							$item_id		= $row['item_id'];
							$title_int		= $row['item_title_internal'];
							$title_ext		= $row['item_title_external'];
							$start_pl		= UnixToStreamTime($row['item_start_planned']);
							$end_pl			= UnixToStreamTime($row['item_start_planned'] + $row['item_duration_planned']);
							$duration_pl	= timespanArray($row['item_duration_planned']);
							
							$viewcound		= $row['item_viewcount'];
							
							$duration_pl_str	= $duration_pl['hms'];
							
							echo"
								<tr>
									<td><a href='index.php?page=item_details&item_id=$item_id'>$item_id</a></td>
									<td><a href='index.php?page=item_details&item_id=$item_id'>$start_pl <br> $end_pl</a></td>
									<td><a href='index.php?page=item_details&item_id=$item_id'>$duration_pl_str</a></td>
									<td><a href='index.php?page=item_details&item_id=$item_id'>$title_int<br><i>$title_ext</i></a></td>

									<td><a href='index.php?page=item_details&item_id=$item_id'>$viewcound</a></td>
								</tr>
							";
						}



						
						
					?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>