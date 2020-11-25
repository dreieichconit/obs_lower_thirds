			

<div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header' >
                <h3 class='card-title' >Bauchbinde hinzufügen</h3>

                <div class='card-tools'>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body' id='' >
			  <form action='index.php?page=lower_add_script' method='POST'>
					
					<div class='form-group'>
						<label class='col-form-label' for='line1'>Zeile 1</label>
						<input required type='text' class='form-control' name='line1' id='' placeholder='Name'>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='line2'>Zeile 2</label>
						<input required type='text' class='form-control' name='line2' id='' placeholder='Funktion / Position / Lesungstitel'>
					</div>
					
					<div class='form-group'>
						<label class='col-form-label' for='dur'>Dauer</label>
						<input required type='dur' class='form-control' name='dur' id='' value="4000" placeholder='in ms'>
					</div>


					

					<div class='form-group'>
						<label class='col-form-label' for='symbol'>Symbol</label>
						<select required name="symbol" class="form-control">
							<option selected disabled>-- Eintrag auswählen --</option>
							<option value="elf">Elfe</option>
							<option value="dwarf">Zwerg</option>
							<option value="neutral">Neutral</option>
							<option value="dragon">BuCon-Drache</option>

						</select>
					</div>

					<div class='form-group'>
						<label class='col-form-label' for='item_id'>Programmpunkt</label>
						<select required name="item_id" class="form-control">

						<?php
							if(!isset($_GET['item_id'])){
								echo"<option selected disabled>-- Eintrag auswählen --</option>";
							}else{
								echo"<option  disabled>-- Eintrag auswählen --</option>";
							}

							$sql		= "SELECT * FROM st_items ORDER BY item_stream_id, item_start_planned";

							$pdo		= new PDO($pdo_mysql, $pdo_db_user, $pdo_db_pwd);

							$statement	= $pdo->prepare($sql);
								
							
								
							$statement->execute();

							while($row = $statement->fetch()){

								$item_id 	= $row['item_id'];
								$text		= "Stream " . $row['item_stream_id'] . ": ". UnixToStreamTime($row['item_start_planned']) . " - " . $row['item_title_internal'];
								
								if(isset($_GET['item_id']) && $_GET['item_id'] == $item_id){
									echo"<option selected value='$item_id'>$text</option>";
								}else{
									echo"<option value='$item_id'>$text</option>";
								}
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
		