			

<div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header' >
                <h3 class='card-title' >Neue Frage</h3>

                <div class='card-tools'>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body' id='' >
			  <form action='index.php?page=quiz_add_script' method='POST'>
					
					<div class='form-group'>
						<label class='col-form-label' for='frage'>Frage</label>
						<input required type='text' class='form-control' name='frage' id='' placeholder=''>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='antwort_a'>Antwort A</label>
						<input type='text' class='form-control' name='antwort_a' id='' placeholder=''>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='antwort_b'>Antwort B</label>
						<input type='text' class='form-control' name='antwort_b' id='' placeholder=''>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='antwort_c'>Antwort C</label>
						<input type='text' class='form-control' name='antwort_c' id='' placeholder=''>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='antwort_d'>Antwort D</label>
						<input type='text' class='form-control' name='antwort_d' id='' placeholder=''>
					</div>

				

					<div class='form-group'>
						<label class='col-form-label' for='richtig'>Richtige Antwort</label>
						<input required type='text' class='form-control' name='richtig' id='' placeholder=''>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='notes'>Notizen (nur Quizmaster)</label>
						<textarea name="notes" class="form-control" rows="3" placeholder="Notizen zum Eintrag"></textarea>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='art'>Fragen-Art</label>
						<select required name="art" class="form-control">
							<option selected disabled>-- Eintrag auswählen --</option>
							<option value="multiple">Multiple Choice</option>
							<option value="guess">Schätzfrage</option>

						</select>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='punkte'>Punkte</label>
						<input required type='text' class='form-control' name='punkte' id='' placeholder='' value="10">
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='nummer'>Frage Nummer</label>
						<input required type='text' class='form-control' name='nummer' id='' placeholder='' value="">
					</div>
					
					<br>
					
					<div class='card-footer'>
						<button type='submit' class='btn btn-primary'>Speichern</button>
					</div>
				</form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
		