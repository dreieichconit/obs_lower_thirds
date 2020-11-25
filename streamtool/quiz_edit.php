<?php

if(!isset($_GET['quiz_id'])){
	include("400.php");
	include("include/html_footer.php");
	die;
}else{
	$id = $_GET['quiz_id'];
}


$sql		= "SELECT * FROM st_quiz WHERE quiz_id = :id";

$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

$statement	= $pdo->prepare($sql);
	
$statement->bindParam(':id', $id);
	
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
	$q_n		= $row['quiz_notes'];
	$q_s		= $row['quiz_sort'];

}

	?>

<div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header' >
                <h3 class='card-title' >Frage Nr. <?php echo $q_id; ?> bearbeiten</h3>

                <div class='card-tools'>
				<a class="btn btn-danger" href='index.php?page=quiz_delete&quiz_id=<?php echo($q_id);?>'>Frage löschen</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body' id='' >
			  <form action='index.php?page=quiz_edit_script' method='POST'>
					<input type="hidden" name="quiz_id" value='<?php echo $q_id; ?>'>
					<div class='form-group'>
						<label class='col-form-label' for='frage'>Frage</label>
						<input required type='text' class='form-control' name='frage' id='' placeholder='' value='<?php echo $q_q; ?>'>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='antwort_a'>Antwort A</label>
						<input type='text' class='form-control' name='antwort_a' id='' placeholder='' value='<?php echo $q_a; ?>'>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='antwort_b'>Antwort B</label>
						<input type='text' class='form-control' name='antwort_b' id='' placeholder='' value='<?php echo $q_b; ?>'>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='antwort_c'>Antwort C</label>
						<input type='text' class='form-control' name='antwort_c' id='' placeholder='' value='<?php echo $q_c; ?>'>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='antwort_d'>Antwort D</label>
						<input type='text' class='form-control' name='antwort_d' id='' placeholder='' value='<?php echo $q_d; ?>'>
					</div>

				

					<div class='form-group'>
						<label class='col-form-label' for='richtig'>Richtige Antwort</label>
						<input required type='text' class='form-control' name='richtig' id='' placeholder='' value='<?php echo $q_r; ?>'>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='notes'>Notizen (nur Quizmaster)</label>
						<textarea name="notes" class="form-control" rows="3" placeholder="Notizen zum Eintrag"><?php echo $q_n; ?></textarea>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='art'>Fragen-Art</label>
						<select required name="art" class="form-control">

						<?php
							if($q_t == "multiple"){
								echo"<option disabled>-- Eintrag auswählen --</option>
								<option selected value='multiple'>Multiple Choice</option>
								<option value='guess'>Schätzfrage</option>";
							}else{
								echo "<option disabled>-- Eintrag auswählen --</option>
								<option value='multiple'>Multiple Choice</option>
								<option selected value='guess'>Schätzfrage</option>";
							}



?>
							

						</select>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='punkte'>Punkte</label>
						<input required type='text' class='form-control' name='punkte' id='' placeholder='' value="<?php echo $q_p; ?>">
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='nummer'>Frage Nummer</label>
						<input required type='text' class='form-control' name='nummer' id='' placeholder='' value="<?php echo $q_s; ?>">
					</div>
					
					<br>
					
					<div class='card-footer mr-auto'>
						
						<button type='submit' class='btn btn-primary mr-auto'>Speichern</button>

						
						
					</div>
				</form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
		