			

<div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header' >
                <h3 class='card-title' >Eintrag hinzufügen</h3>

                <div class='card-tools'>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body' id='' >
			  <form action='index.php?page=schedule_add_script' method='POST'>
					
					<div class='form-group'>
						<label class='col-form-label' for='title_internal'>Interner Titel</label>
						<input required type='text' class='form-control' name='title_internal' id='' placeholder=''>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='title_exnternal'>Öffentlicher Titel</label>
						<input required type='text' class='form-control' name='title_external' id='' placeholder='wird so angekündigt'>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='start'>geplanter Startzeitpunkt</label>
						<input required type='text' class='form-control' name='start' id='' value="21.11.2020 " placeholder='Format: dd.MM.yyyy hh:mm:ss'>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='duration'>Dauer</label>
						<input required type='text' class='form-control' name='duration' id='' placeholder='Format: hh:mm:ss'>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='notes'>Notizen</label>
						<textarea name="notes" class="form-control" rows="3" placeholder="Notizen zum Eintrag"></textarea>
					</div>


					<div class='form-group'>
						<label class='col-form-label' for='stream'>Stream Nr</label>
						<select required name="stream" class="form-control">
							<option selected disabled>-- Eintrag auswählen --</option>
							<option value="1">Stream 1 (klassisch)</option>
							<option value="2">Stream 2 (experimental)</option>

						</select>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='type'>Beitragsart</label>
						<select required name="type" class="form-control">
							<option selected disabled>-- Eintrag auswählen --</option>
							<option value="LIVE">Live via Discord</option>
							<option value="VIDEO">Video</option>

						</select>
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
		