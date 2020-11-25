<?php
	if(isset($_GET['item_id'])){
		$item_id = $_GET['item_id'];
	}else{
		if(isset($item_id)){
			$item_id = $item_id;
		}else{
			include("400.php");
			include("include/html_footer.php");
			die;
		}
	}


	$data_item;
	
	$sql		= "SELECT * FROM st_items WHERE item_id = :id";

	$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

	$statement	= $pdo->prepare($sql);
		
	$statement->bindParam(':id', $item_id);
		
	$statement->execute();

	while($row = $statement->fetch()){
		$data_item = $row;
	}

?>


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Item Nr <?php echo $item_id; ?>: <?php echo $data_item['item_title_internal'] ?></h3>
				<div class="card-tools">
					
						<a href="#" onClick="toggle_div('form_body', 'o')" id="form_body_link">Aufklappen <span class="fas fa-arrow-circle-down"></span></a>
					
				</div>
			</div>
			
			<div class="card-body" style="height: auto" id="form_body">
			<form action='index.php?page=schedule_edit_script' method='POST'>
					<input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
					<div class='form-group'>
						<label class='col-form-label' for='title_internal'>Interner Titel</label>
						<input required type='text' class='form-control' name='title_internal' id='' placeholder='' value='<?php echo $data_item['item_title_internal']; ?>'>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='title_exnternal'>Öffentlicher Titel</label>
						<input required type='text' class='form-control' name='title_external' id='' placeholder='wird so angekündigt' value='<?php echo $data_item['item_title_external']; ?>'>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='start'>geplanter Startzeitpunkt</label>
						<input required type='text' class='form-control' name='start' id='' placeholder='Format: dd.MM.yyyy hh:mm:ss' value='<?php echo UnixToTime($data_item['item_start_planned']); ?>'>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='duration'>Dauer</label>
						<input required type='text' class='form-control' name='duration' id='' placeholder='Format: hh:mm:ss' value='<?php echo timespanArray($data_item['item_duration_planned'])["hms"]; ?>'>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='notes'>Notizen</label>
						<textarea name="notes" class="form-control" rows="3" placeholder="Notizen zum Eintrag"><?php echo $data_item['item_notes']; ?></textarea>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='stream'>Stream Nr</label>
						<select required name="stream" class="form-control">
							<?php
								$stream = $data_item['item_stream_id'];

								if($stream == "1"){
									echo"
									<option  disabled>-- Eintrag auswählen --</option>

									<option selected value='1'>Stream 1 (klassisch)</option>
									<option value='2'>Stream 2 (experimental)</option>
		
									";
								}else{
									echo"
									<option  disabled>-- Eintrag auswählen --</option>

									<option  value='1'>Stream 1 (klassisch)</option>
									<option selected value='2'>Stream 2 (experimental)</option>
		
									";
								}

							?>
							
							
						</select>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='type'>Beitragsart</label>
						<select required name="type" class="form-control">
							
						<?php
								$typ = $data_item['item_type'];

								if($typ == "LIVE"){
									echo"
										<option  disabled>-- Eintrag auswählen --</option>
										<option selected value='LIVE'>Live via Discord</option>
										<option value='VIDEO'>Video</option>
									";
								}else if($typ == "VIDEO"){
									echo"
										<option  disabled>-- Eintrag auswählen --</option>
										<option  value='LIVE'>Live via Discord</option>
										<option selected value='VIDEO'>Video</option>
		
									";
								}else{
									echo"
										<option selected disabled>-- Eintrag auswählen --</option>
										<option  value='LIVE'>Live via Discord</option>
										<option  value='VIDEO'>Video</option>
		
									";
								}

							?>



							

						</select>
					</div>
					
					<br>
					
					<div class='card-footer'>
						<button type='submit' class='btn btn-primary'>Speichern</button>
					</div>
				</form>
					
			</div>
		</div>
	</div>
</div>





<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Bauchbinden für Eintrag <?php echo $item_id; ?>: <?php echo $data_item['item_title_internal'] ?></h3>
				<div class="card-tools">
				<a href="index.php?page=lower_add&item_id=<?php echo $item_id; ?>" class="btn btn-primary"><span class="fas fa-plus-circle"></span> neu</a>
				</div>
			</div>
			
			<div class="card-body table-responsive p-0" style="height: auto;">
				<table class="table table-head-fixed" id="filter_table">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="70%">Text</th>
							<th width="12.5%">Symbol</th>
							<th width="12.5%">Dauer</th>
							
						</tr>
					</thead>

					<tbody>

					<?php

					

						$sql		= "SELECT * FROM st_lower WHERE item_id = :itemid";

						$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

						$statement	= $pdo->prepare($sql);
							
						$statement->bindParam(':itemid', $item_id);
							
						$statement->execute();

						while($row = $statement->fetch()){
							$lower_id		= $row['lower_id'];
							$line1			= $row['lower_line_1'];
							$line2			= $row['lower_line_2'];
							$dur			= $row['lower_duration'];
							$symbol			= $row['lower_symbol'];
							$item_id		= $row['item_id'];
							
							
							echo"
								<tr>
									<td><a href='index.php?page=lower_edit&lower_id=$lower_id'>$lower_id</a></td>
									<td><a href='index.php?page=lower_edit&lower_id=$lower_id'>$line1 <br> $line2</a></td>
									<td><a href='index.php?page=lower_edit&lower_id=$lower_id'><img src='img/$symbol.png' height='40px'></a></td>
									<td><a href='index.php?page=lower_edit&lower_id=$lower_id'>$dur ms</a></td>

									
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



